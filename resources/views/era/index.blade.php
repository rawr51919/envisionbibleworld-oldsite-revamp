@extends('app')

@section('content')

    <table id="tblEra"></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">

        var eraYears;
        $(document).ready(function () {
            if (!window.console) window.console = {};
            if (!window.console.log) window.console.log = function () { };

            loadEraYears();


            var myGrid = $("#tblEra").jqGrid({
                url: "{!! route('eras') !!}",
                datatype: "json",
                colModel: [
                    { label: 'EraId', name: 'EraId', key:true, width:30, align:'center'},
                    { label: 'Era', name: 'Era', editable: true, width:100},
                    { label: 'Begin Year', name: 'BeginYear', editable: true, width:50, align:'center',
                        edittype:'select',
                        editoptions:{
                            value:eraYears,
                            defaultValue:this,
                            dataEvents: [
//                                { type: 'focus', fn: function(e) { prevEra = $(this).val(); } },
//                                { type: 'change', fn: function(e) {funcOnChangeEra(this); } },
                            ]
                        }

                    },
                    { label: 'End Year', name: 'EndYear', editable: true, width:50, align:'center',
                        edittype:'select',
                        editoptions:{
                            value:eraYears,
                            defaultValue:this,
                            dataEvents: [
//                                { type: 'focus', fn: function(e) { prevEra = $(this).val(); } },
//                                { type: 'change', fn: function(e) {funcOnChangeEra(this); } },
                            ]
                        }

                    },
                    { label: 'Era_Explanation', name: 'Era_Explanation', editable: true}
                ],
                caption:'Eras',
                pager: "#jqGridPager",
                width: $(window).width()-80,
                height: 'auto',
                rowNum: 15,
                sortable: true,
                sortname: "Era",
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                gridview: true,
                onSelectRow: editRow

            }).navGrid('#jqGridPager',{edit:false,add:false,del:false,search:false})
              .navButtonAdd('#jqGridPager',{
                caption:"Add",
                buttonicon:"ui-icon-add",
                onClickButton: function(){

                    var newData= {EraId:"new",Era:"",BeginYear:"",EndYear:"",Era_Explanation:""};

                    var rowId = $.jgrid.randId(); // new row ID
                    $("#tblEra").jqGrid('addRowData', rowId, newData);
                    $("#tblEra").jqGrid('setSelection',rowId);
                },
                position:"last"
            })
            .navButtonAdd('#jqGridPager',{
                caption:"Del",
                buttonicon:"ui-icon-del",
                onClickButton: function(){

                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                    var eraId = myGrid.jqGrid ('getCell', rowId, 'EraId');
                    if(eraId != null) {

                        $.ajax({
                            url: "{!!route('delete_era') !!}",
                            type: 'POST',
                            data: {EraId: eraId, '_token':"{{ csrf_token() }}"},
                            async: false,
                            success: function(data, result) {
                                alert(data.msg);
                                myGrid.trigger('reloadGrid');
                                lastSelection = null;
                            }
                        });
                    }
                },
                position:"last"
            });

            var lastSelection;
            function editRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('update_era') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                };

                if (id && id !== lastSelection) {
//                    var grid = $("#tblEra");
//                    grid.jqGrid('restoreRow',lastSelection);
//                    grid.jqGrid('editRow',id, editparameters );
//                    lastSelection = id;
                    myGrid.jqGrid('restoreRow',lastSelection);
                    myGrid.jqGrid('editRow',id, editparameters );

                    lastSelection = id;
                }
            }

            function funcAfterSave() {
                myGrid.trigger('reloadGrid');
                lastSelection = null;
            }

            {{--function buttonView(id)--}}
            {{--{--}}
                {{--return "<a href='{{ URL::route('category.show') }}?CategoryId=12'. method='GET' class='btn btn-default'>View</a>";--}}
            {{--}--}}

//            function viewEra() {
//                selectedRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
//                        cellValue = myGrid.jqGrid ('getCell', selectedRowId, 'CategoryId');
//
//                document.getElementsByClassName("btnViewEra").onclick = function () {
//                    document.location.href="/era/'.cellValue'";
//                };
//            }
        });

        function loadEraYears() {
            $.ajax({
                url: "{!!route('era_years') !!}",
                async: false,
                success: function(data, result) {
                    eraYears = data;
                    if (!result) alert('Failure to retrieve the Countries.');
                }
            });
        }

    </script>
@endsection

