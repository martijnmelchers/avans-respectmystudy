@extends('layouts/default')

@section("title", "Importeer Minors")

@section('content')
    <div class="content">
        <div class="wrapper">
            <article>
                <h1>Importeer minors</h1>

                <div class="bar">
                    <div class="inner"></div>
                    <div class="text"></div>
                </div>

                <div id="errors">

                </div>
            </article>

            <div class="buttons">
                <div class="button" onclick="importProgrammes()">Importeer minors</div>
                <div class="button" onclick="importLocations()">Importeer Locaties</div>
                <div class="button" onclick="importSchools()">Importeer Organisaties</div>
            </div>
        </div>
    </div>

    <script>
        document.getElementsByClassName("inner")[0].style.width = "0%";
        document.getElementsByClassName("text")[0].innerHTML = "Nog niks aan het importeren";

        var errors = [];

        function importSchools(page = 1, progress = 0) {
            $.getJSON("/import/organizations/?page=" + page, function (o) {
                console.log(o);
                console.log("Pagina " + page + "; Progress: " + progress);

                total = o.count;
                progress += o.results.length;

                document.getElementsByClassName("text")[0].innerHTML = "Scholen importeren";
                document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

                if (o.next != null) {
                    importSchools(page + 1, progress);
                } else {
                    document.getElementsByClassName("text")[0].innerHTML = "Scholen geïmporteerd";
                }
            });
        }

        function importLocations(page = 1, progress = 0) {
            $.getJSON("/import/locations/?page=" + page, function (o) {
                console.log(o);

                total = o.count;
                progress += o.results.length;

                console.log("Pagina " + page + "; Progress: " + progress);

                document.getElementsByClassName("text")[0].innerHTML = "Locaties importeren";
                document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

                if (o.next != null) {
                    importLocations(page + 1, progress);
                }
            });
        }

        function importProgrammes(page = 1, progress = 0) {
            $.getJSON("/import/minors/?page=" + page, function (o) {
                console.log(o);

                total = o.count;
                progress += o.results.length;

                console.log("Pagina " + page + "; Progress: " + progress);

                document.getElementsByClassName("text")[0].innerHTML = "Locaties importeren";
                document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

                if (o.errors != null && o.errors.length > 0) {
                    o.errors.forEach(function (e) {
                        errors.push(e);
                    })
                }

                document.getElementById('errors').innerHTML = "";
                errors.forEach(function (e) {
                    document.getElementById("errors").innerHTML += "<div class='alert red'>" + e.error + "</div>";
                });

                if (o.next != null) {
                    importProgrammes(page + 1, progress);
                }
            });
        }
    </script>
@endsection