<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

function getRootDir()
{
    return getcwd() . '/';
}

function extractApplication()
{
    $zip = new ZipArchive;
    if ($zip->open('application.zip') === TRUE) {
        $success = $zip->extractTo(getRootDir());
        $zip->close();
        return $success;
    } else {
        return false;
    }
}

function testDatabase($host, $name, $user, $pass)
{
    $dsn = "mysql:host=$host;dbname=$name;charset=utf8";
    try {
        $pdo = new PDO($dsn, $user, $pass, []);
        return true;
    } catch (\PDOException $e) {
        return false;
    }
}

function createEnvFile()
{
    // reset file
    unlink(getRootDir() . '.env');

    appendToEnvFile('APP_NAME', 'RespectMyStudy');
    appendToEnvFile('APP_ENV', 'production');
    // TODO remove important
    appendToEnvFile('APP_DEBUG', 'true');
    appendToEnvFile('APP_KEY', '');

    appendToEnvFile('FILESYSTEM_DRIVER', 'production');

    appendToEnvFile('DB_CONNECTION', 'mysql');
}

function appendToEnvFile($key, $value)
{
    file_put_contents(getRootDir() . '.env', "$key=$value" . PHP_EOL, FILE_APPEND);
}

function initLaravel()
{
    require __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';

    \Illuminate\Support\Facades\Facade::clearResolvedInstances();
    \Illuminate\Support\Facades\Facade::setFacadeApplication($app);

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    return $app;
}

function generateAppKey()
{
    artisanCall('key:generate', ['--force' => true]);
}

function clearConfig()
{
    artisanCall('config:clear');
}

function linkStorage()
{
    artisanCall('storage:link');
}

function resetDb()
{
    foreach (DB::select('SHOW TABLES') as $table) {
        $table_array = get_object_vars($table);
        Schema::disableForeignKeyConstraints();
        Schema::drop($table_array[key($table_array)]);
        Schema::enableForeignKeyConstraints();
    }
}

function migrate()
{
    artisanCall('migrate', ['--force' => true]);
}

function seedDatabase()
{
    artisanCall('db:seed', ['--force' => true]);
}

function artisanCall($command, $args = null)
{
    if ($args === null) {
        Illuminate\Support\Facades\Artisan::call($command);
    } else {
        Illuminate\Support\Facades\Artisan::call($command, $args);
    }
}

function insertAdminAccount($name, $email, $pass)
{
    // Delete all users
    DB::table('users')->delete();

    DB::table('users')->insert([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($pass),
        'role_id' => 2,
        'username' => ""
    ]);
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case "extract":
            ini_set('max_execution_time', 60000);
            if (extractApplication()) {
                $status = 'success';
                $response = compact('status');
            } else {
                $status = 'error';
                $error = 'Er is iets fout gegaan bij het uitpakken van de applicatie';
                $response = compact('status', 'error');
            }
            echo json_encode($response);
            break;
        case "testdb":
            $host = $_POST['host'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (testDatabase($host, $name, $username, $password)) {
                $status = 'success';
                $response = compact('status');
                createEnvFile();
                appendToEnvFile('DB_HOST', $host);
                appendToEnvFile('DB_DATABASE', $name);
                appendToEnvFile('DB_USERNAME', $username);
                appendToEnvFile('DB_PASSWORD', $password);

                initLaravel();
                generateAppKey();
                clearConfig();
                resetDb();
                migrate();
                seedDatabase();
                clearConfig();

            } else {
                $status = 'error';
                $error = 'De database connectie werkt niet. Heb je de gegevens wel goed ingevuld?';
                $response = compact('status', 'error');
            }
            echo json_encode($response);
            break;
        case "account":
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $status = 'success';
            $response = compact('status');

            initLaravel();
            clearConfig();
            insertAdminAccount($name, $email, $password);

            echo json_encode($response);
            break;
        case "other":
            $kiesopmaat = $_POST['kiesopmaat'];
            $key = $_POST['ga-key'];
            $viewId = $_POST['ga-view-id'];

            $success = true;
            if (isset($_FILES['credentials'])) {
                if (file_exists(getRootDir() . 'service-account-credentials.json')) {
                    unlink(getRootDir() . 'service-account-credentials.json');
                }
                $success = move_uploaded_file($_FILES['credentials']['tmp_name'], getRootDir() . 'service-account-credentials.json');
            }

            appendToEnvFile('KIESOPMAAT_TOKEN', $kiesopmaat);
            appendToEnvFile('GOOGLE_ANALYTICS_KEY', $key);
            appendToEnvFile('ANALYTICS_VIEW_ID', $viewId);

            initLaravel();
            clearConfig();

            if ($success) {
                $status = 'success';
                $response = compact('status');
            } else {
                $status = 'error';
                $error = 'Er is iets fout gegaan bij het opslaan van de overige gegevens.';
                $response = compact('status', 'error');
            }
            echo json_encode($response);
            break;
        case "finish":
            initLaravel();
            clearConfig();

            $htaccess = "<IfModule mod_rewrite.c>
                            RewriteEngine On
                            RewriteRule ^(.*)$ public/$1 [L]
                        </IfModule>";
            file_put_contents(getRootDir() . '.htaccess',  $htaccess);

            $status = 'success';
            $response = compact('status');

            echo json_encode($response);
            break;
    }

    exit(200);
}

$stage = 'extract';

if (file_exists(getRootDir() . 'server.php')) {
    $stage = 'database';
}

if ($stage === 'database' && strpos(file_get_contents(getRootDir() . ".env"), 'DB_PASS') !== false) {
    $stage = 'account';
}

//$databaseAdded = strpos(file_get_contents("./uuids.txt"), $_GET['id']) !== false;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>RespectMyStudy Installer</title>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        #extract-progress, #db-progress {
            display: none;
        }
    </style>
</head>

<body>

<div class="container">

    <div id="error-modal" class="modal">
        <div class="modal-content">
            <h4>Fout</h4>
            <p id="error-modal-text"></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Sluiten</a>
        </div>
    </div>

    <div class="row">
        <h1 class="center-align">RespectMyStudy Installer</h1>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-tabs">
                <ul id="installer-tabs" class="tabs tabs-fixed-width">
                    <li id="extract-tab" class="tab<?php if ($stage !== 'extract') echo ' disabled' ?>">
                        <a class="<?php if ($stage === 'extract') echo 'active' ?>" href="#extract">Applicatie
                            uitpakken</a>
                    </li>
                    <li id="database-tab" class="tab<?php if ($stage !== 'database') echo ' disabled' ?>">
                        <a class="<?php if ($stage === 'database') echo 'active' ?>" href="#database">Database</a>
                    </li>
                    <li id="account-tab" class="tab<?php if ($stage !== 'account') echo ' disabled' ?>">
                        <a class="<?php if ($stage === 'account') echo 'active' ?>" href="#account">Account</a>
                    </li>
                    <li id="other-tab" class="tab">
                        <a class="" href="#other">Overig</a>
                    </li>
                    <li id="finish-tab" class="tab">
                        <a class="" href="#finish">Afronden</a>
                    </li>
                </ul>
            </div>
            <div id="extract">
                <div class="card-content grey lighten-4">
                    <p>Welkom bij de installer van RespectMyStudy. Druk op de start knop om te beginnen met het
                        uitpakken van de applicatie. Dit kan even duren.
                    </p>
                </div>
                <div class="card-action row">
                    <div class="col s4">
                        <a id="extract-btn" class="waves-effect waves-light btn" onclick="startExtracting()">Start met
                            uitpakken</a>
                    </div>
                    <div class="col s8">
                        <div id="extract-progress" class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="database">
                <div class="card-content grey lighten-4">
                    <p>Vul hier de database gegevens in.</p>
                    <div class="row">
                        <form id="database-form" class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="host" name="host" type="text" class="validate" value="localhost">
                                    <label for="host">Database Host</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="db-name" name="name" type="text" class="validate">
                                    <label for="db-name">Database Naam</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="db-username" name="username" type="text" class="validate">
                                    <label for="db-username">Database Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="db-password" name="password" type="password" class="validate">
                                    <label for="db-password">Database Wachtwoord</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-action row">
                    <div class="col s4">
                        <a id="db-save-btn" class="waves-effect waves-light btn" onclick="testDatabase()">Opslaan</a>
                    </div>
                    <div class="col s8">
                        <div id="db-progress" class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="account">
                <div class="card-content grey lighten-4">
                    <p>Vul hier de gegevens in voor de admin account.</p>
                    <div class="row">
                        <form id="account-form" class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="acc-name" name="name" type="text" class="validate" value="admin">
                                    <label for="acc-name">Account Naam</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="acc-email" name="email" type="text" class="validate">
                                    <label for="acc-email">Account Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="acc-password" name="password" type="password" class="validate">
                                    <label for="acc-password">Account Wachtwoord</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-action">
                    <a class="waves-effect waves-light btn" onclick="addAdminAccount()">Opslaan</a>
                </div>
            </div>
            <div id="other">
                <div class="card-content grey lighten-4">
                    <p>Vul hier de overige gegevens in.</p>
                    <div class="row">
                        <form id="other-form" class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="kiesopmaat" name="kiesopmaat" type="text" class="validate">
                                    <label for="kiesopmaat">KiesOpMaat Token</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="ga-key" name="ga-key" type="text" class="validate">
                                    <label for="ga-key">Google Analytics Key</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="ga-view-id" name="ga-view-id" type="text" class="validate">
                                    <label for="ga-view-id">Google Analytics View Id</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Service Account Credentials</span>
                                        <input type="file" name="credentials">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-action">
                    <a class="waves-effect waves-light btn" onclick="saveOtherInfo()">Opslaan</a>
                </div>
            </div>
            <div id="finish">
                <div class="card-content grey lighten-4">
                    <p>Als het goed is heb je nu al de benodigde gegevens ingevuld. Druk op afronden als je klaar bent.</p>
                </div>
                <div class="card-action">
                    <a class="waves-effect waves-light btn" onclick="finish()">Afronden</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let elems = document.querySelectorAll('.tabs');
        M.Tabs.init(elems, {});
        elems = document.querySelectorAll('.modal');
        M.Modal.init(elems, {});
    });

    function executeAction(action) {
        let formData = new FormData();
        formData.append('action', action);
        return fetch(window.location.href, {
            method: 'POST',
            body: formData
        }).then(response => response.json());
    }

    function disableTab(tab) {
        document.getElementById(tab).classList.add('disabled');
    }

    function enableTab(tab) {
        document.getElementById(tab).classList.remove('disabled');
    }

    function selectTab(tab) {
        let instance = M.Tabs.getInstance(document.getElementById('installer-tabs'));
        instance.select(tab);
    }

    function showError(resp) {
        if (resp.status === 'error') {
            document.getElementById('error-modal-text').textContent = resp.error;
            let errorModal = document.getElementById('error-modal');
            let instance = M.Modal.getInstance(errorModal);
            instance.open();
            return false;
        }
        return resp.status === 'success';
    }

    async function startExtracting() {
        let extractBtn = document.getElementById('extract-btn');
        let extractProgress = document.getElementById('extract-progress');
        extractBtn.classList.add('disabled');
        extractProgress.style.display = 'block';
        let resp = await executeAction('extract');
        extractBtn.classList.remove('disabled');
        extractProgress.style.display = 'none';

        if (showError(resp)) {
            disableTab('extract-tab');
            enableTab('database-tab');
            selectTab('database');
        }
    }

    async function testDatabase() {
        let dbBtn = document.getElementById('db-save-btn');
        let dbProgress = document.getElementById('db-progress');
        let formData = new FormData(document.getElementById('database-form'));
        formData.append('action', 'testdb');
        dbBtn.classList.add('disabled');
        dbProgress.style.display = 'block';
        let resp = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        }).then(response => response.json());
        dbBtn.classList.remove('disabled');
        dbProgress.style.display = 'none';

        if (showError(resp)) {
            disableTab('database-tab');
            enableTab('account-tab');
            selectTab('account');
        }
    }

    async function addAdminAccount() {
        let formData = new FormData(document.getElementById('account-form'));
        formData.append('action', 'account');
        let resp = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        }).then(response => response.json());

        if (showError(resp)) {
            selectTab('other');
        }
    }

    async function saveOtherInfo() {
        let formData = new FormData(document.getElementById('other-form'));
        formData.append('action', 'other');
        let resp = await fetch(window.location.href, {
            method: 'POST',
            body: formData
        }).then(response => response.json());

        if (showError(resp)) {
            selectTab('finish');
        }
    }

    async function finish() {
        let resp = await executeAction('finish');

        if (showError(resp)) {
            location.reload();
        }
    }
</script>

</body>

</html>