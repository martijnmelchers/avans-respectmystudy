$(window).ready(function () {
    document.getElementsByClassName("inner")[0].style.width = "0%";
    document.getElementsByClassName("text")[0].innerHTML = "Nog niks aan het importeren";
});

var errors = [];
let importing = false;

function importAll() {
    if (importing) {
        alert("je bent al aan het importeren");
        return;
    }

    importing = true;
    $(".button").addClass("disabled");
    importSchools(1, 0, true);
}

function importSchools(page = 1, progress = 0, auto = false) {
    $.getJSON("/import/organizations/?page=" + page, function (o) {
        console.log(o);
        console.log("Pagina " + page + "; Progress: " + progress);

        total = o.count;
        progress += o.results.length;

        if (o.errors != null)
            addErrors(o.errors);

        document.getElementsByClassName("text")[0].innerHTML = "Organisaties importeren";
        document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

        if (o.next != null) {
            importSchools(page + 1, progress, auto);
        } else {
            document.getElementsByClassName("text")[0].innerHTML = "Scholen geïmporteerd";

            if (auto)
                importLocations(1, 0, auto);
        }
    });
}

function importLocations(page = 1, progress = 0, auto = false) {
    $.getJSON("/import/locations/?page=" + page, function (o) {
        console.log(o);

        total = o.count;
        progress += o.results.length;

        if (o.errors != null)
            addErrors(o.errors);

        console.log("Pagina " + page + "; Progress: " + progress);

        document.getElementsByClassName("text")[0].innerHTML = "Locaties importeren";
        document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

        if (o.next != null) {
            importLocations(page + 1, progress, auto);
        } else {
            if (auto)
                importGroups(1, 0, true);
        }
    });
}

function importProgrammes(page = 1, progress = 0, auto) {
    $.getJSON("/import/minors/?page=" + page, function (o) {
        console.log(o);

        total = o.count;
        progress += o.results.length;

        if (o.errors != null)
            addErrors(o.errors);

        console.log("Pagina " + page + "; Progress: " + progress);

        document.getElementsByClassName("text")[0].innerHTML = "Minors importeren";
        document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

        if (o.next != null) {
            importProgrammes(page + 1, progress, auto);
        } else {
            if (auto) {
                $(".button").removeClass("disabled");
                importing = false;
                alert("Alles is geimporteerd!");
            }
        }
    });
}

function importPersons(page = 1, progress = 0, auto = false) {
    $.getJSON("/import/contactpersons/?page=" + page, function (o) {
        console.log(o);

        total = o.count;
        progress += o.results.length;

        if (o.errors != null)
            addErrors(o.errors);

        console.log("Pagina " + page + "; Progress: " + progress);

        document.getElementsByClassName("text")[0].innerHTML = total + " Contactpersonen importeren";
        document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

        if (o.next != null) {
            importPersons(page + 1, progress, auto);
        } else {
            if (auto)
                importPeriods(1, 0, auto);
        }
    });
}

function importGroups(page = 1, progress = 0, auto = false) {
    $.getJSON("/import/contactgroups/?page=" + page, function (o) {
        console.log(o);

        total = o.count;
        progress += o.results.length;

        if (o.errors != null)
            addErrors(o.errors);

        document.getElementsByClassName("text")[0].innerHTML = total + " Contactgroupen importeren";
        document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

        if (o.errors != null && o.errors.length > 0) {
            o.errors.forEach(function (e) {
                addError(e);
            });
        }

        if (o.next != null) {
            importGroups(page + 1, progress, auto);
        } else {
            if (auto)
                importPersons(1, 0, true);
        }
    });
}

function importPeriods(page = 1, progress = 0, auto = false) {
    $.getJSON("/import/periods/?page=" + page, function (o) {
        console.log(o);

        total = o.count;
        progress += o.results.length;

        if (o.errors != null)
            addErrors(o.errors);

        document.getElementsByClassName("text")[0].innerHTML = total + " Periodes importeren";
        document.getElementsByClassName("inner")[0].style.width = ((100 * progress) / total) + "%";

        if (o.errors != null && o.errors.length > 0) {
            o.errors.forEach(function (e) {
                addError(e);
            });
        }

        if (o.next != null) {
            importPeriods(page + 1, progress, auto);
        } else {
            if (auto)
                importProgrammes(1, 0, true);
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

function addErrors(array) {
    if (array.length > 0) {
        array.forEach(function (e) {
            addError(e);
        });
    }
}