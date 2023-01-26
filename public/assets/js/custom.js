function initSelect2() {
    $('.select2').each(function () {
        $(this).select2({
            searchInputPlaceholder: 'message.search',
            dropdownParent: $(this).parent(),
            width: '100%',
        });

        $(this).on('select2:open', function () {
            $('.select2-selection__choice__remove').addClass('select2-remove-right');
        });
    });
}

initSelect2();

function initListDataTable() {
    //$('.dataTables_scrollBody').css('min-height', '580px');
    $('.is-search-table').DataTable({
        responsive: true,
        destroy: true,
        sDom: '<"row"<"col-lg-4"l><"col-lg-4 text-right"B><"col-lg-4"f>><"table-responsive"t>p', // 'Bfrtip'
        buttons: [
            "excel",
            'csv',
            'pdf'
        ],
        language: {
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing": "Traitement...",
            //"sSearch": "Rechercher :",
            "searchPlaceholder": "Rechercher ...",
            "sZeroRecords": "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        },
        "aaSorting": [],
        "scrollX": true,
        "scrollY": "450px",
        "scrollCollapse": true,
        "searching": true,
        "paging": true,
        "pageLength": 50,
        /*"initComplete": function(settings, json) {
            //var api = new $.fn.dataTable.Api( settings );
            var self = $(this);
            // buildMinLineTable(self)
        }*/
    });
}

initListDataTable();

function initFormDataTable() {
    //$('.dataTables_scrollBody').css('min-height', '580px');
    $('.is-form-table').DataTable({
        responsive: false,
        destroy: true,
        dom: 'Bfrtip',
        buttons: [
            "copy",
            "excel",
            'csv',
            'pdf'
        ],
        language: {
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing": "Traitement...",
            "sSearch": "Rechercher :",
            "sZeroRecords": "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        },
        "scrollX": true,
        //"scrollY": "500px",
        "scrollCollapse": true,
        "searching": false,
        "paging": false,
        "ordering": false,
        "initComplete": function (settings, json) {
            //var api = new $.fn.dataTable.Api( settings );
            var self = $(this);
            // buildMinLineTable(self)
        }

    });

}

initFormDataTable();


window.onload = function () {

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.is-phone').keyup(function () {
            if (isNaN(this.value)) {
                this.value = this.defaultValue;
            } else {
                this.defaultValue = this.value;
            }
        });


        $('.is-number').each(function () {
            $(this).keyup(function () {
                if (isNaN(this.value)) {
                    this.value = this.defaultValue;
                } else {
                    this.defaultValue = this.value;
                }
            });
        })

        $('.nobr').keyup(function () {
            let data = this.value
            if ($.trim(data) !== "") {
                this.value = data.replace(/\n/g, ", ")
            } else {
                this.value = ""
            }
        })
    })
}
