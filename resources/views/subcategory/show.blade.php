@extends('app')

@section('content')

    <h3>Subcategories of {{ $category->Category }}</h3>

    <hr />

    <table id="tblSubcategory"><th></th></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">

        $(document).ready(function () {
            if (!window.console) window.console = {};
            if (!window.console.log) window.console.log = function () { };

            var myGrid = $("#tblSubcategory").jqGrid({
                url: "{!! route('subcategories') !!}",
                postData: {
                    CategoryId : "{{ $category->CategoryId }}"
                },
                datatype: "json",
                colModel: [
                    { label: 'SubcategoryId', name: 'SubcategoryId', key:true, width:  20},
                    { label: 'Subcategory', name: 'Subcategory', editable: true, width: 50},
                    { label: 'CategoryId', name: 'CategoryId', editable: true, width:  20},
                    { label: 'Subcategory_Explanation', name: 'Subcategory_Explanation', editable: true, width: 50, nullable: true},
                    { label: 'StatusTypeId', name: 'StatusTypeId', editable: true, width: 20, nullable: true,
                        cellEdit:true,
                        edittype: 'select',
                        formatter: 'select',
                        align: 'center',
                        editoptions:{value: getAllSelectOptions()} }
                ],
                onSelectRow: editRow,
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                width: $(window).width()-40,
                height: 'auto',
                rowNum: 10,
                sortable: true,
                pager: "#jqGridPager",
                gridview: true,
                sortname: "Subcategory",
                caption:'Subcategories'
            });

            function getAllSelectOptions(){
                var statustypes = { '1': 'Verify', '2': 'Accept', '3': 'Changed',
                    '4': 'Deleted', '5': 'Fixed', '6': 'New' };

                return statustypes;

            }

            jQuery("#tblSubcategory")
                    .navGrid('#jqGridPager',{edit:false,add:false,del:false,search:true})
                    .navButtonAdd('#jqGridPager',{
                        caption:"Add",
                        buttonicon:"ui-icon-add",
                        onClickButton: function(){

                            var newData = { SubcategoryId:"new", Subcategory:"", CategoryId:"",  Subcategory_Explanation:"", StatusTypeId:"" };
                            var rowId = $.jgrid.randId(); // new row ID

                            $("#tblSubcategory").jqGrid('addRowData', rowId, newData);
                            $("#tblSubcategory").jqGrid('setSelection',rowId);

                        },
                        position:"last"
                    })
                    .navButtonAdd('#jqGridPager',{
                        caption:"Del",
                        buttonicon:"ui-icon-del",
                        onClickButton: function(){

                            var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                            var subcategoryId = myGrid.jqGrid ('getCell', rowId, 'SubcategoryId');
                            if(subcategoryId != null) {

                                $.ajax({
                                    url: "{!! route('deletesubcategory') !!}",
                                    type: 'POST',
                                    data: {SubcategoryId: subcategoryId, '_token':"{{ csrf_token() }}"},
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
                    "url" : "{!! route('updatesubcategory') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#tblSubcategory");
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
