window.TeacherHawk = window.TeacherHawk || {
    assignments:{},
    teachers:{}
}

window.TeacherHawk.assignments.dates = function () {
    //Formattage date simple
        $(".date-format").each(function () {
            var date = new Date($(this).text()) ;
            $(this).text(date.toLocaleString("fr-FR", {year:"numeric", month:"long", day:"numeric"})+" à "+date.toLocaleTimeString()).removeClass("date-format") ;
        })

    $(".dates").each(function () {
        //Affichage de la date formattée aux normes locales de la langue
            var date = new Date($(this).find(".due-date").text()) ;
            $(this).find(".due-date-formatted").text(date.toLocaleString("fr-FR", {weekday:"long", year:"numeric", month:"long", day:"numeric"})+" à "+date.toLocaleTimeString()) ;
        //Calcul du temps total disponible
            var creation = new Date($(this).find(".created-date").text()) ;
            $(this).find(".created-date-formatted").text(creation.toLocaleString("fr-FR", {weekday:"long", year:"numeric", month:"long", day:"numeric"})+" à "+creation.toLocaleTimeString()) ;
            var total = date.getTime() - creation.getTime() ;
        //Calcul du temps restant
            var time = date.getTime() - Date.now() ;
            var left = time > 0 ? date.getTime() - Date.now() : Date.now() - date.getTime() ;
            var s = Math.floor(left/1000) ;
            var m = Math.floor(s/60) ; s -= m*60 ;
            var h = Math.floor(m/60) ; m -= h*60 ;
            var d = Math.floor(h/24) ; h -= d*24 ;
            var w = Math.floor(d/7) ; d -= w*7 ;
        //Affichage du texte
            var text = [
                w ? w + " semaine" + (w != 1 ? "s" : "") : "",
                d ? d + " jour" + (d != 1 ? "s" : "") : "",
                h ? h + " heure" + (h != 1 ? "s" : "") : "",
                m ? m + " minute" + (m != 1 ? "s" : "") : "",
                s ? s + " seconde" + (s != 1 ? "s" : "") : ""
            ].filter(function (t) { return t.length ; }).slice(0, 2) ;
            text = text.join(" et ") + (time > 0 ? " restant"+((!d)&&(w|h|m|s) ? "e" : "")+"s" : " de retard") ;
        //Actualisation de l'affichage
            $(this).find(".time-left").text(text).removeClass("text-success").removeClass("text-danger").addClass("text-"+(time < 0 ? "danger" : time > 2*24*3600*1000 ? "success" : "warning")) ;
            $(this).find(".progress-bar").css("width", 100*((Date.now()-creation.getTime())/total)+"%")
                .removeClass("progress-bar-success").removeClass("progress-bar-warning").removeClass("progress-bar-danger")
                .addClass("progress-bar-"+(time < 0 ? "danger" : time > 2*24*3600*1000 ? "success" : "warning"))
    })
}

window.TeacherHawk.toogle = function (selector, show) {
    //
        if (!!parseInt(show)) {
            $(selector).show() ;
        } else {
            $(selector).hide() ;
        }

}

window.TeacherHawk.toogle.init = function (selector) {
    $(".activity-visibility .btn").click(function () {
        $(".activity-visibility .btn").removeClass("btn-primary").addClass("btn-default") ;
        $(this).removeClass("btn-default").addClass("btn-primary") ;
        TeacherHawk.toogle(selector, $(this).attr("data-value")) ;
    }) ;

    $($(".activity-visibility .btn")[0]).click();
}


window.TeacherHawk.smooth_scroll = function () {
    $("*[data-scroll-to]").click(function() {
            var target = $("[data-id="+$(this).attr("data-scroll-to")+"]");
            if (target.length) {
                $('html, body').animate({scrollTop: target.offset().top}, 1000);
                return false;
            }
    });
}

window.TeacherHawk.calendar = function () {
    $('<link rel="stylesheet" href="/students/js/calendar/fullcalendar.min.css">').appendTo("head") ;
        $.getScript("/students/js/calendar/moment.min.js", function () {
            $.getScript("/students/js/calendar/fullcalendar.min.js", function () {
                $.getScript("/students/js/calendar/locale/fr.js", function () {
                    console.log(window.TeacherHawk.calendar.prepared)
                    $("#calendar").fullCalendar({locale:"fr", events:window.TeacherHawk.calendar.prepared}).fullCalendar("today") ;
                }) ;
            }) ;
        })
}



window.TeacherHawk.dropify = function () {
    $('<link rel="stylesheet" href="/adminoffice/bower_components/dropify/dist/css/dropify.min.css">').appendTo("head") ;
    $.getScript("/students/js/dropify.min.js", function () {

        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function (event, element) { return confirm("Do you really want to delete \"" + element.file.name + "\" ?"); });
        drEvent.on('dropify.afterClear', function (event, element) { alert('File deleted'); });
        drEvent.on('dropify.errors', function (event, element) { console.log('Has Errors'); });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function (e) {
            e.preventDefault();
            if (drDestroy.isDropified()) { drDestroy.destroy() ; } else { drDestroy.init(); }
        })
    });
}

window.TeacherHawk.calendar();
$(document).ready(function() { $(".dropdown-toggle").dropdown() ; });
