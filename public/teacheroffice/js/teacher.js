/*
 * Copyright (c) Liigem 2017.
 */

window.TeacherHawk = window.TeacherHawk || {
    assignments:{},
    teachers:{}
    };



window.TeacherHawk.classes = {
    edit:function (name, id) {
        $("#update_classes").text("Détails de la classe : "+name+" (id n° "+id+")")
    }
};

window.TeacherHawk.documents = {
    init:function () {
        $("#class-select").change(window.TeacherHawk.documents.filter)
    },
    filter:function () {

        var id = $("#class-select").val() ;
        $("#assignment-select option").hide() ;
        $("#assignment-select [data-class='"+id+"']").show();
        $("#assignment-select [value='null']").show();
    }
};

window.TeacherHawk.table = {
    init:function () {
        //Permet d'ajouter le callback qui ajoute une ligne au tableau éditable en cas d'appui sur entré
        console.log('ok', $("[name='add_per_mail']").length)
            $("[name='add_per_mail']").keyup(function (ev) {
                if ( ev.which == 13 ) { ev.preventDefault(); window.TeacherHawk.table.add() ; }
            });

        //Empêche le formulaire de se déclancher automatiquement à la touche entrée
        $("form").keypress(function (ev) {
            if (ev.which == 13) {
                ev.preventDefault();
            }
        });

        //Permet d'activer la "création de nouveau sujet"
            $("[name='class-subject']").change(function () {
                if ($("[name='class-subject'] option:last-child:selected").length) {
                    $("[name='add_subject']").show() ;
                } else {
                    $("[name='add_subject']").hide() ;
                }
            }).change();

        //Actualise la valeur de autre dans la liste des sujets
            $("[name='add_subject']").keyup(function (ev) {
                $("[name='class-subject'] option:last-child").val($("[name='add_subject']").val()) ;
            });

        //Actualisation du nombre d'inscrits
            $('[name="selected_students[]"]').click(window.TeacherHawk.table.count) ;
            $('[name="unselected_students[]"]').click(window.TeacherHawk.table.count) ;
            window.TeacherHawk.table.count()

    },
    //Compte le nombre d'élèves inscrits
    count:function () {
        var nb = $("[name='selected_students[]']:checked").length + $('[name="unselected_students[]"]:checked').length ;
        $("#nb_students").text(nb > 0 ? nb+" inscrit"+(nb > 1 ? "s" : "") : "Aucun élève inscrit") ;
    },

    add:function () {
        var value = $("[name='add_per_mail']").val() ;

        //Rajout d'une ligne s'il s'agit d'un mail valide
            if (value.match(/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i)) {
                $("<span>" + value + "</span><input type='checkbox' value='" + value + "' name='selected_students[]' checked>").appendTo(".form-group");
                $("[name='add_per_mail']").val("");
            }
        //Actualisation du nombre d'inscrits
            window.TeacherHawk.table.count();
    },

    invert:function () {
        //Masque les cases
            $('[name="unselected_students[]"]').hide() ;
        //Inverse les cases checkés et non checkés
            var checked = $('[name="unselected_students[]"]:checked') ;
        var unchecked = $('[name="unselected_students[]"]:not(:checked)');
            checked.prop('checked', false) ;
            unchecked.prop('checked', true) ;
    }
};




window.TeacherHawk.calendar = function () {
    $('<link rel="stylesheet" href="/students/js/calendar/fullcalendar.min.css">').appendTo("head") ;
        $.getScript("/students/js/calendar/moment.min.js", function () {
            $.getScript("/students/js/calendar/fullcalendar.min.js", function () {
                $.getScript("/students/js/calendar/locale/fr.js", function () {
                    console.log(window.TeacherHawk.calendar.prepared);
                    $("#calendar").fullCalendar({locale:"fr", events:window.TeacherHawk.calendar.prepared}).fullCalendar("today") ;
                }) ;
            }) ;
        })
};

window.TeacherHawk.datatable = function()  {
    $('<link rel="stylesheet" href="/bower_components/datatables/dataTables.bootstrap.css">').appendTo("head");
    $.getScript("/bower_components/datatables/jquery.dataTables.min.js", function () {
        $.getScript("/bower_components/datatables/dataTables.bootstrap.js", function () {
        $('.datatables').DataTable({
            language:{
                "decimal":        "",
                "emptyTable":     "Aucun résultat correspondant",
                "info":           "",
                "infoEmpty":      "",
                "infoFiltered":   "",
                "infoPostFix":    "",
                "thousands":      " ",
                "lengthMenu":     "Afficher _MENU_ entrées",
                "loadingRecords": "Chargement...",
                "processing":     "Chargement...",
                "search":         "Rechercher : ",
                "zeroRecords":    "Aucun résultat correspondant",
                "paginate": {
                    "first":      "Première page",
                    "last":       "Dernière page",
                    "next":       " Suivant ",
                    "previous":   " Précédent "
                },
                "aria": {
                    "sortAscending":  ": Afficher par ordre croissant/alphabétique",
                    "sortDescending": ": Afficher par ordre décroissant/alphabétique inverse"
                }
            }
        });
        })
    })
};

window.TeacherHawk.datepicker = function () {
    $('<link rel="stylesheet" href="/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css">').appendTo("head") ;

    $.getScript("/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js", function () {
        $('.set-datepicker-inline').datepicker({
            todayHighlight: true,
            language:"fr",
        }).on('changeDate', function () {
            var date = new Date($(this).datepicker("getDate")) ;
            var str = date.getFullYear()+"-"+("0"+(date.getMonth()+1)).substr(-2)+"-"+("0"+date.getDate()).substr(-2);
                $("[name='"+$(this).attr("data-edit")+"']").val(str) ;
        });
    }) ;

};

$(function () {

    window.TeacherHawk.table.init();

    window.TeacherHawk.documents.init();

    window.TeacherHawk.datepicker();

    window.TeacherHawk.datatable() ;
})
