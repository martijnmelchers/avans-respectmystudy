@extends('layouts/dashboard')

@section("title", "Importeer Data")

@section('content')
    <style>
        .bar {
            width: 80%;
            min-height: 17px;
            position: relative;
            background: white;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin: 5px auto;
            text-align: center;
            border: 2px solid rgba(0, 0, 0, 0.1);
            padding: 2px;
            overflow: hidden;
        }

        .bar .inner {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            background: #F64646;
            -webkit-transition: width 0.2s;
            -moz-transition: width 0.2s;
            -ms-transition: width 0.2s;
            -o-transition: width 0.2s;
            transition: width 0.2s;
            z-index: 1;
        }

        .bar .text {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 2;
            width: 100%;
            height: 100%;
            color: black;;
        }
    </style>
    <div class="content wide top">
        <div class="wrapper">
            <article>
                <h1>Importeer minors</h1>

                <div class="bar">
                    <div class="inner"></div>
                    <div class="text">Nog niks aan het importeren</div>
                </div>
            </article>

            <div id="errors">

            </div>

            <div class="buttons">
                <div class="button" onclick="importProgrammes()">Importeer minors</div>
                <div class="button" onclick="importLocations()">Importeer Locaties</div>
                <div class="button" onclick="importSchools()">Importeer Organisaties</div>
                <div class="button" onclick="importPersons()">Importeer Contactpersonen</div>
                <div class="button" onclick="importGroups()">Importeer Contactgroepen</div>
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

                document.getElementsByClassName("text")[0].innerHTML = "Organisaties importeren";
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

                document.getElementsByClassName("text")[0].innerHTML = "Minors importeren";
                document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

                if (o.errors != null && o.errors.length > 0) {
                    o.errors.forEach(function (e) {
                        addError(e);
                    });
                }

                if (o.next != null) {
                    importProgrammes(page + 1, progress);
                }
            });
        }

        function importPersons(page = 1, progress = 0) {
            $.getJSON("/import/contactpersons/?page=" + page, function (o) {
                console.log(o);

                total = o.count;
                progress += o.results.length;

                console.log("Pagina " + page + "; Progress: " + progress);

                document.getElementsByClassName("text")[0].innerHTML = total + " Contactpersonen importeren";
                document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

                if (o.errors != null && o.errors.length > 0) {
                    o.errors.forEach(function (e) {
                        addError(e);
                    });
                }

                if (o.next != null) {
                    importPersons(page + 1, progress);
                }
            });
        }

        function importGroups(page = 1, progress = 0) {
            $.getJSON("/import/contactgroups/?page=" + page, function (o) {
                console.log(o);

                total = o.count;
                progress += o.results.length;

                console.log("Pagina " + page + "; Progress: " + progress);

                document.getElementsByClassName("text")[0].innerHTML = total + " Contactgroupen importeren";
                document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

                if (o.errors != null && o.errors.length > 0) {
                    o.errors.forEach(function (e) {
                        addError(e);
                    });
                }

                if (o.next != null) {
                    importGroups(page + 1, progress);
                }
            });
        }

        function addError(e) {
            $("<div></div>")
                .text(e)
                .addClass("alert")
                .addClass("red")
                .click(function () {
                    $(this).remove();
                })
                .appendTo("#errors");
        }
    </script>
@endsection