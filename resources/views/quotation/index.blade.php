@extends('app')

{{--@section('content')--}}
{{--<h1>Categories</h1>--}}
{{--<hr>--}}
{{--<a class="btn btn-info" href="{{ URL::previous() }}">back</a>--}}
{{--<table class="resizable display table table-bordered responsive resourceTable" id="tblCategory">--}}
{{--<thead>--}}
{{--<tr class="colHeaders">--}}
{{--<th>CategoryId</th>--}}
{{--<th>Category</th>--}}
{{--<th>Explanation</th>--}}
{{--<th>Edit</th>--}}
{{--<th>View</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--</table>--}}

{{--<script>--}}

{{--$(function() {--}}
{{--$.ajaxSetup({--}}
{{--headers: {--}}
{{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--}--}}
{{--});--}}

{{--$('#tblCategory').DataTable({--}}
{{--processing: true,--}}
{{--serverSide: true,--}}
{{--'ajax': {--}}
{{--'url': "{!! route('categories') !!}"--}}
{{--},--}}
{{--widthFixed: false,--}}
{{--columns: [--}}
{{--{ data: 'CategoryId', name: 'CategoryId' },--}}
{{--{ data: 'Category', name: 'Category' },--}}
{{--{ data: 'Explanation', name: 'Explanation' },--}}
{{--{ data: 'action-edit', name: 'edit', orderable: false, searchable: false},--}}
{{--{ data: 'action-view', name: 'view', orderable: false, searchable: false}--}}
{{--]--}}
{{--});--}}
{{--});--}}
{{--</script>--}}

{{--@endsection--}}

@section('content')

    <table id="tblQuotation"></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">

        var statusTypes;
        $(document).ready(function () {
//            if (!window.console) window.console = {};
//            if (!window.console.log) window.console.log = function () { };
            //load status types
            loadStatusTypes();

            var myGrid = $("#tblQuotation").jqGrid({
                url: "{!! route('quotations') !!}",
                datatype: "json",
                colModel: [
                    { label: 'QuotationId', name: 'QuotationId', key:true, width:  20},
                    { label: 'Quotation', name: 'Quotation', editable: true, width: 150},
                    { label: 'StatusType', name: 'StatusType', editable: true, width: 20,
                        edittype:'select',
                        editoptions:{
                            value:statusTypes,
                            defaultValue:this,
                            dataEvents: [
                                { type: 'change', fn: function(e) {funcOnChangeStatusType(this); } },
                            ]
                        }
                    },
                    { label: 'EntryDate', name: 'EntryDate', editable: false, width: 30},
                    { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true }
                ],
                onSelectRow: editRow,
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                width: $(window).width()-40,
                height: 'auto',
                rowNum: 15,
                sortable: true,
                pager: "#jqGridPager",
                gridview: true,
                sortname: "Quotation",
                caption:'Quotations'
            }).navGrid('#jqGridPager', {
                edit:false,
                add:false,
                del:false,
                search:false
            }).navButtonAdd('#jqGridPager',{
                caption:"Add",
                buttonicon:"ui-icon-add",
                onClickButton: function(){

                    var newData= { QuotationId:"new", Quotation:"", StatusType:"6" };
                    var newRowId = $.jgrid.randId(); // new row ID

                    $("#tblQuotation").jqGrid('addRowData', newRowId, newData);
                    $("#tblQuotation").jqGrid('setSelection',newRowId);
                },
                position:"last"
            })
            .navButtonAdd('#jqGridPager',{
                caption:"Del",
                buttonicon:"ui-icon-del",
                onClickButton: function(){

                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                    var quotationId = myGrid.jqGrid ('getCell', rowId, 'QuotationId');
                    if(quotationId != null) {

                        $.ajax({
                            url: "{!!route('delete_quotation') !!}",
                            type: 'POST',
                            data: {QuotationId: quotationId, '_token':"{{ csrf_token() }}"},
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
                    "successfunc" : funcSuccess,
                    "url" : "{!! route('update_quotation') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : null,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#tblQuotation");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcSuccess(obj) {
                alert(obj.responseJSON.msg);

                //refresh grid
                myGrid.trigger('reloadGrid');
                lastSelection = null;
            }

//            function funcAfterSave() {
//                alert('here');
//                myGrid.trigger('reloadGrid');
//                lastSelection = null;
//            }

            function funcOnChangeStatusType(obj) {
                var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                myGrid.jqGrid("setCell", rowId, "StatusTypeId", obj.value);
            }
        });

        function loadStatusTypes() {
            $.ajax({
                url: "{!!route('status_types') !!}",
                async: false,
                success: function(data, result) {
                    statusTypes = data;
                    if (!result) alert('Failure to retrieve the Countries.');
                }
            });
        }
    </script>
@endsection


