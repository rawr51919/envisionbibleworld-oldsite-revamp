@extends('app')

@section('content')

    <table id="tblCategory"><th></th></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">
        var statusTypes;
        $(document).ready(function () {
            if (!window.console) window.console = {};
            if (!window.console.log) window.console.log = function () { };

            loadStatusTypes();

            var myGrid = $("#tblCategory").jqGrid({
                url: "{!! route('categories') !!}",
                datatype: "json",
                colModel: [
                    { label: 'CategoryId', name: 'CategoryId', key:true, width: 20, sorttype:"string"},
                    { label: 'Category', name: 'Category', editable: true, width: 60},
                    { label: 'Explanation', name: 'Explanation', editable: true, width: 50},
                ],
                onSelectRow: editRow,
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                width: $(window).width()-50,
                height: 'auto',
                rowNum: 10,
                sortable: true,
                pager: "#jqGridPager",
                gridview: true,
                sortname: "Category",
                caption:'Categories',
                subGrid: true,
                subGridOptions: {
                    "plusicon"  : "ui-icon-triangle-1-e",
                    "minusicon" : "ui-icon-triangle-1-s",
                    "openicon"  : "ui-icon-arrowreturn-1-e",
                    //cellEdit: true,
                    // load the subgrid data only once
                    // and the just show/hide
                    "reloadOnExpand" : true,
                    // select the row when the expand column is clicked
                    "selectOnExpand" : true
                },
                subGridRowExpanded: function(subgrid_id, row_id) {

                    var subgrid_table_id, pager_id;
                    subgrid_table_id = subgrid_id+"_t";
                    pager_id = "p_"+subgrid_table_id;

                    var mySubGrid = $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                    jQuery("#"+subgrid_table_id).jqGrid({
                        postData: {rowId: row_id},
                        url:"{!! route('subcategories') !!}",
                        datatype: "json",
                        colModel: [
                            { label: 'Subcategory ID', name: 'SubcategoryId', editable:false, width: 5, key:true, align:'center'},
                            { label: 'Name', name: 'Subcategory', editable:true, width: 50, nullable: true, search: true, stype: 'text'},
                            { label: 'Explanation', name: 'Subcategory_Explanation', editable:true, width: 80, nullable: true},
                            { label: 'StatusType', name: 'StatusType', editable:true, width: 10, align:'center',
                                edittype:'select',
                                editoptions:{
                                    value:statusTypes,
                                    defaultValue:this,
                                    dataEvents: [
                                        { type: 'change', fn: function(e) {funcOnChangeStatusType(this); } }
                                    ]
                                }},
                            { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true }
                        ],
                        height: 'auto',
                        width: $(window).width()-80,
                        rowNum:5,
                        sortname: 'num',
                        sortorder: "asc",
                        pager: pager_id
                    });

                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                    var sourceId = myGrid.jqGrid ('getCell', rowId, 'SourceId');

                    jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:true,add:true,del:true, search:true, refresh:true},
                            // options for the Edit Dialog
                            {
                                editCaption: "Edit Record",
                                mtype: 'POST',
                                editData: {'_token':"{{ csrf_token() }}"},
                                url: "{!! route('updatesubcategory') !!}",
                                recreateForm: true,
                                savekey: [true,13],
                                checkOnUpdate : true,
                                checkOnSubmit : true,
                                closeAfterEdit: true,
                                errorTextFormat: function (data) {
                                    return 'Error: ' + data.responseText
                                }
                            },
                            // options for the Add Dialog
                            {
                                closeAfterAdd: true,
                                addCaption: "Add Record",
                                mtype: 'POST',
                                checkOnSubmit : true,
                                editData: {categoryId: function() {
                                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                                    var value = myGrid.jqGrid ('getCell', rowId, 'CategoryId');
                                    return value;
                                }, '_token':"{{ csrf_token() }}"},
                                url: "{!! route('updatesubcategory') !!}",
                                recreateForm: true,
                                errorTextFormat: function (data) {
                                    return 'Error: ' + data.responseText
                                }
                            },
                            {
                                mtype: 'POST',
                                delData: {'_token':"{{ csrf_token() }}"},
                                url: "{!! route('deletesubcategory') !!}",
                                errorTextFormat: function (data) {
                                    return 'Error: ' + data.responseText
                                }
                            })


                }

            });

//            jQuery("#tblCategory").jqGrid('filterToolbar', {
//                //autosearch: true,
//                stringResult:true,
//                searchOnEnter:false,
//                //searchOperators:true,
//                defaultSearch : "cn"
//            });
//            $(".ui-jqgrid-sortable").css('white-space', 'normal');
//            $(".ui-jqgrid-sortable").css('height', 'auto');
//            $(".ui-jqgrid tr.jqgrow td").css('white-space', 'normal');
//            $(".ui-jqgrid tr.jqgrow td").css('height', 'auto');
//            jqGrid('searchGrid', options );

            jQuery("#tblCategory")
                    .navGrid('#jqGridPager',{edit:false,add:false,del:false,search:true},

                    {
                        caption: "Search...",
                        closeAfterSearch:true,
                        defaultSearch : "cn",
                        searchOnEnter: true,
                        multipleSearch: true,
                        Find: "Find",
                        Reset: "Reset",
                    })
                    .navButtonAdd('#jqGridPager',{
                        caption:"Add",
                        buttonicon:"ui-icon-add",
                        onClickButton: function(){

                            var newData = { CategoryId:"new", Category:"", Explanation:"" };
                            var rowId = $.jgrid.randId(); // new row ID

                            $("#tblCategory").jqGrid('addRowData', rowId, newData);
                            $("#tblCategory").jqGrid('setSelection',rowId);

                        },
                        position:"last"
                    })
                    .navButtonAdd('#jqGridPager',{
                        caption:"Del",
                        buttonicon:"ui-icon-del",
                        onClickButton: function(){

                            var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                            var categoryId = myGrid.jqGrid ('getCell', rowId, 'CategoryId');
                            if(categoryId != null) {

                                $.ajax({
                                    url: "{!! route('deletecategory') !!}",
                                    type: 'POST',
                                    data: {CategoryId: categoryId, '_token':"{{ csrf_token() }}"},
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
                    "url" : "{!! route('updatecategory') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#tblCategory");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcAfterSave() {
                myGrid.trigger('reloadGrid');
            }

            function funcOnChangeStatusType(obj) {
                var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                myGrid.jqGrid("setCell", rowId, "StatusTypeId", obj.value);
            }

            {{--function onSearch() {--}}
{{--//                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');--}}
{{--//                    var categoryId = myGrid.jqGrid ('getCell', rowId, 'CategoryId');--}}
{{--//                    if(categoryId != null) {--}}

                        {{--$.ajax({--}}
                            {{--type: 'POST',--}}
                            {{--//data: {CategoryId: categoryId, '_token':"{{ csrf_token() }}"},--}}
                            {{--async: false,--}}
                            {{--success: function(data, result) {--}}
                                {{--alert(data.msg);--}}
                                {{--myGrid.trigger('reloadGrid');--}}
                                {{--lastSelection = null;--}}
                            {{--}--}}
                        {{--});--}}
{{--//                    }--}}
            {{--}--}}
        });

        function loadStatusTypes() {
            $.ajax({
                url: "{!! route('statustypes') !!}",
                async: false,
                success: function(data, result) {
                    statusTypes = data;
                    if (!result) alert('Failure to retrieve the Status Types.');
                }
            });
        }



    </script>
@endsection


