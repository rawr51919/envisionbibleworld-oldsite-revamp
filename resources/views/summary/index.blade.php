@extends('app')


@section('content')

    <table id="tblSummary"></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">

        $(document).ready(function () {
            if (!window.console) window.console = {};
            if (!window.console.log) window.console.log = function () { };

            var myGrid = $("#tblSummary").jqGrid({
                url: "{!! route('summaries') !!}",
                datatype: "json",
                colModel: [
                    { label: 'SummaryId', name: 'SummaryId', key:true, width:  20},
                    { label: 'Summary', name: 'Summary', editable: true, width: 90},
                    { label: 'StatusTypeId', name: 'StatusTypeId', nullable: true, editable: true, width: 30,
                        cellEdit:true,
                        edittype: 'select',
                        formatter: 'select',
                        align: 'center',
                        editoptions:{value: getAllSelectOptions()} },
                    { label: 'EntryDate', name: 'EntryDate', width: 30},
                ],
                onSelectRow: editRow,
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                width: $(window).width()-40,
                height: 'auto',
                rowNum: 10,
                sortable: true,
                pager: "#jqGridPager",
                gridview: true,
                sortname: "Summary",
                caption:'Summaries'
            });

            function getAllSelectOptions(){
                var statustypes = { '1': 'Verify', '2': 'Accept', '3': 'Changed',
                    '4': 'Deleted', '5': 'Fixed', '6': 'New' };
                return statustypes;
            }

            jQuery("#tblSummary")
                    .navGrid('#jqGridPager',{edit:false,add:false,del:false,search:true})
                    .navButtonAdd('#jqGridPager',{
                        caption:"Add",
                        buttonicon:"ui-icon-add",
                        onClickButton: function(){

                            var newData = { SummaryId:"new", Summary:"", StatusTypeId:"6" };
                            var rowId = $.jgrid.randId(); // new row ID

                            $("#tblSummary").jqGrid('addRowData', rowId, newData);
                            $("#tblSummary").jqGrid('setSelection',rowId);

                        },
                        position:"last"
                    })
                    .navButtonAdd('#jqGridPager',{
                        caption:"Del",
                        buttonicon:"ui-icon-del",
                        onClickButton: function(){

                            var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                            var summaryId = myGrid.jqGrid ('getCell', rowId, 'SummaryId');
                            if(summaryId != null) {

                                $.ajax({
                                    url: "{!! route('deletesummary') !!}",
                                    type: 'POST',
                                    data: {SummaryId: summaryId, '_token':"{{ csrf_token() }}"},
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
                    "url" : "{!! route('updatesummary') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#tblSummary");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcAfterSave() {
                myGrid.trigger('reloadGrid');
            }
        });
    </script>
@endsection


