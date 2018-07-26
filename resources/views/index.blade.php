<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <script type="text/ecmascript" src="http://www.guriddo.net/demo/js/jquery.min.js"></script>
       	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- We support more than 40 localizations -->
        <script type="text/ecmascript" src="http://www.guriddo.net/demo/js/trirand/i18n/grid.locale-en.js"></script>
        <!-- This is the Javascript file of jqGrid -->
        <script type="text/ecmascript" src="http://www.guriddo.net/demo/js/trirand/src/jquery.jqGrid.js"></script>
        <!-- This is the localization file of the grid controlling messages, labels, etc.
        <!-- A link to a jQuery UI ThemeRoller theme, more than 22 built-in and many more custom -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- The link to the CSS that the grid needs -->
        <link rel="stylesheet" type="text/css" media="screen" href="http://www.guriddo.net/demo/css/trirand/ui.jqgrid-bootstrap.css" />
    	<script>
    		$.jgrid.defaults.width = 780;
            $.jgrid.defaults.responsive = true;
        	$.jgrid.defaults.styleUI = 'Bootstrap';
    	</script>



    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div>
            <div style="margin-left:20px;margin-top:20px;">
                <table id="jqGrid"></table>
                <div id="jqGridPager"></div>
            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    var template = "<div style='margin-left:15px;'><div> Заголовок: </div><div>{title} </div>";
                    template += "<div> Описание: </div><div {description}</div>";
                    template += "<div> {sData} {cData}  </div></div>";

                    $("#jqGrid").jqGrid({
                        url: '/grid/data',
                        // we set the changes to be made at client side using predefined word clientArray
                        editurl: '{{route('grid.edit')}}',
                        datatype: "json",
                        colModel: [
                            {
                                label: 'id',
                                name: 'id',
                                width: 35,
                                key: true,
                                editable: false,
                            },
                            {
                                label: 'title',
                                name: 'title',
                                width: 75,
                                editable: true,
                                editrules: {
                                    required: true
                                }
                            },
                            {
                                label: 'description',
                                name: 'description',
                                width: 140,
                                editable: true // must set editable to true if you want to make the field editable
                            },
                            {
                                label: 'created_at',
                                name: 'created_at',
                                width: 75,
                                editable: false,
                            },

                        ],
                        sortname: 'id',
                        sortorder: 'desc',
                        loadonce: true,
                        viewrecords: true,
                        width: 780,
                        height: 200,
                        rowNum: 10,
                        pager: "#jqGridPager"
                    });

                    $('#jqGrid').navGrid('#jqGridPager',
                        // the buttons to appear on the toolbar of the grid
                        {
                            edit: true,
                            add: true,
                            del: true,
                            search: false,
                            refresh: false,
                            view: false,
                            position: "left",
                            cloneToTop: false
                        },
                        // options for the Edit Dialog
                        {
                            editCaption: "The Edit Dialog",
                            template: template,
                            errorTextFormat: function(data) {
                                return 'Error: ' + data.responseText
                            }
                        },
                        // options for the Add Dialog
                        {
                            template: template,
                            errorTextFormat: function(data) {
                                return 'Error: ' + data.responseText
                            }
                        },
                        // options for the Delete Dailog
                        {
                            errorTextFormat: function(data) {
                                return 'Error: ' + data.responseText
                            }
                        });
                });
            </script>



            <script type="text/javascript">
                   $(document).ready(function () {
                       //
                       // $("#jqGrid").jqGrid({
                       //     url: '/grid/data',
                       //     mtype: "GET",
           				// styleUI : 'Bootstrap',
                       //     datatype: "jsonp",
                       //     colModel: [
                       //         { label: 'id', name: 'id', key: true, width: 75 },
                       //         { label: 'title', name: 'title', width: 150 },
                       //         { label: 'description', name: 'description', width: 150 },
                       //         { label: 'created_at', name: 'created_at', width: 150 },
                       //     ],
           				// viewrecords: true,
                       //     height: 250,
                       //     rowNum: 20,
                       //     pager: "#jqGridPager"
                       // });

                       $('a.create').click(function(){
                            $('#myModal').modal();
                            $('#myModal form').attr('action','{{route('grid.create')}}')
                       });

                       $("#form").submit(function() {
                           $.post(
                              $(this).attr('action'),
                              $(this).serializeArray(),
                              function(data) {
                               if(data) {
                                   var items = [];
                                   $.each( data, function( key, val ) {
                                       items.push( "<li id='" + key + "'>" + val + "</li>" );
                                   });

                                   $( "<ul/>", {
                                       "class": "my-new-list",
                                       html: items.join( "" )
                                   }).appendTo("#errors");
                               }
                           });
                       });

                   });

              </script>

        </div>
    </body>
</html>
