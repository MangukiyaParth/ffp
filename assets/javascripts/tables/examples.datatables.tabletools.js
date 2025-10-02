/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.7.0
*/

/* (function($) {

    'use strict';

    var datatableInit = function() {
        var $table = $('#datatable-tabletools');

        $table.dataTable({
            sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
            oTableTools: {
                sSwfPath: $table.data('swf-path'),

                aButtons: [{
                        sExtends: 'pdf',
                        sButtonText: 'PDF'
                    },
                    {
                        sExtends: 'csv',
                        sButtonText: 'CSV'
                    },
                    {
                        sExtends: 'xls',
                        sButtonText: 'Excel'
                    },
                    {
                        sExtends: 'print',
                        sButtonText: 'Print',
                        sInfo: 'Please press CTR+P to print or ESC to quit',
                        smessageTop: 'This print was produced using the Print button for DataTables'
                    },
                    {
                        sExtends: 'colvis',
                        sButtonText: 'column'
                    },
                ]
            }
        });

    };

    $(function() {
        datatableInit();
    });

}).apply(this, [jQuery]); */

$('#datatable-tabletools').DataTable( {
        fontSize: 11,
        pageLength: 50,
        orderCellsTop: true,
        fixedHeader: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
           	'print'
           
        ]
    } );

var url = window.location.href;
var res = url.split('/');
var name = $('.listname').html();
var coll = name.split("/");
(function($) {

    'use strict';

    var datatableInit = function() {
        var $table = $('.datatable-tabletools');
        $table.dataTable({
            fontSize: 11,
            pageLength: 50,
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Blfrtip',
            lengthMenu: [[10, 25, 50,100,500,1000, -1], [10, 25, 50,100,500,1000, "All"]],
            /* columnDefs: [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ], */
            /* order: [[ 0, 'asc' ]], */
            buttons: [
                /*  {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },*/
                {
                    extend: 'excelHtml5',
                    title: coll[0],
                    filename: coll[0] + '-' + date,
                    exportOptions: {
                        columns: [coll[2]]
                    }
                },
                /* {
                        extend: 'pdfHtml5',
                        exportOptions: {
                        columns: [ 0, 1, 2, 5 ]
                    }
                },*/
                /*{
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 5 ]
                    }
                },*/
                {
                    footer: true,
                    /*header: false,*/
                    extend: 'print',
                    filename: coll[0] + '-' + date,
                    title: coll[0],
                    exportOptions: {
                        columns: [coll[1]]
                    }
                },
            ]
        });
    };

    $(function() {
        datatableInit();
    });

}).apply(this, [jQuery]);


(function($) {

    'use strict';

    var datatableInit = function() {
        var $table = $('.datatable-tabletools2');
        $table.dataTable({
            fontSize: 11,
            pageLength: 50,
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [
                /*  {
                      extend: 'copyHtml5',
                      exportOptions: {
                          columns: [ 0, ':visible' ]
                      }
                  },*/
                {
                    extend: 'excelHtml5',
                    title: coll[0],
                    filename: coll[0] + '-' + date,
                    exportOptions: {
                        columns: [coll[2]]
                    }
                },
                /* {
                     extend: 'pdfHtml5',
                     exportOptions: {
                         columns: [ 0, 1, 2, 5 ]
                     }
                 },*/
                /*{
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 5 ]
                    }
                },*/
                {
                    footer: true,
                    /*header: false,*/
                    extend: 'print',
                    filename: coll[0] + '-' + date,
                    title: coll[0],
                    exportOptions: {
                        columns: [coll[1]]
                    }
                },



            ]
        });

    };

    $(function() {
        datatableInit();
    });

}).apply(this, [jQuery]);

/*$('.datatable-tabletools').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
       	dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
           	'print'
           
        ]
    } );*/



(function($) {

    'use strict';

    var datatableInit = function() {
        var $table = $('.tabletools');
        var no = 6;
        $('.tabletools thead tr').clone(true).appendTo('.tabletools thead');
        $('.tabletools thead tr:eq(1) th').each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="filter" id="guj' + no + '" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
            no++;
        });

        var table = $('.tabletools').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5]
                    }
                },
                'print'

            ]
        });

        /*$table.dataTable({
        	sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
        	oTableTools: {
        		sSwfPath: $table.data('swf-path'),
        		aButtons: [
        			{
        				sExtends: 'pdf',
        				sButtonText: 'PDF'
        			},
        			{
        				sExtends: 'csv',
        				sButtonText: 'CSV'
        			},
        			{
        				sExtends: 'xls',
        				sButtonText: 'Excel'
        			},
        			{
        				sExtends: 'print',
        				sButtonText: 'Print',
        				sInfo: 'Please press CTR+P to print or ESC to quit'
        			}
        		]
        	}
        });*/

    };

    $(function() {
        datatableInit();
    });

}).apply(this, [jQuery]);