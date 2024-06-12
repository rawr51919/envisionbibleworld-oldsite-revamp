@extends('app')

@section('content')

    <table id="tblSource"><th></th></table>
    <div id="jqGridPager"></div>


    <script type="text/javascript">
        var statusTypes;
        var sourceTypes;
        var publishers;
        $(document).ready(function () {
            if (!window.console) window.console = {};
            if (!window.console.log) window.console.log = function () { };

            loadStatusTypes();
            loadSourceTypes();
            loadPublishers();

            var myGrid = $("#tblSource").jqGrid({
                url: "{!! route('sources') !!}",
                datatype: "json",
                colModel: [
                    { label: 'Source ID', name: 'SourceId', key:true, width:  20},
                    { label: 'Source Abbreviation', name: 'Source_Type_Abbreviation', editable: true, width: 20, nullable: true,
                        edittype:'select',
                        editoptions:{
                            value:sourceTypes,
                            defaultValue:this,
                            dataEvents: [
                                { type: 'change', fn: function(e) {funcOnChangeSourceType(this); } },
                            ]
                        }},
                    { label: 'SourceTypeId', name: 'Source_TypeId', editable: false, hidden:true},
                    { label: 'SourceName', name: 'SourceName', editable: true, width: 40},
                    { label: 'LastChptrOrSection', name: 'LastChptrOrSection', editable: true, width: 30, nullable: true},
                ],
                onSelectRow: editRow,
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                width: $(window).width()-40,
                height: 'auto',
                rowNum: 10,
                sortable: true,
                pager: "#jqGridPager",
                gridview: true,
                sortname: "Source",
                caption:'Sources',
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

                    //alert(row_id);
                    // we pass two parameters
                    // subgrid_id is a id of the div tag created within a table
                    // the row_id is the id of the row
                    // If we want to pass additional parameters to the url we can use
                    // the method getRowData(row_id) - which returns associative array in type name-value
                    // here we can easy construct the following
                    var subgrid_table_id, pager_id;
                    subgrid_table_id = subgrid_id+"_t";
                    pager_id = "p_"+subgrid_table_id;

                    var mySubGrid = $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                    jQuery("#"+subgrid_table_id).jqGrid({
                        postData: {rowId: row_id},
                        url:"{!! route('source_details') !!}",
                        datatype: "json",
//                        colNames: ['Source Detail ID','Chapter of Last Verse','Last Verse Or Page','Screen Shot','Status Type', 'Publisher', 'Status Type ID', 'Publisher ID'],
                        colModel: [
                            { label: 'Source_DetailId', name: 'Source_DetailId', editable:false, width: 5, key:true},
                            { label: 'ChptrOfLastVrs', name: 'ChptrOfLastVrs', editable:true, width: 10, nullable: true},
                            { label: 'LastVerseOrPage', name: 'LastVerseOrPage', editable:true, width: 10, nullable: true},
                            { label: 'StatusType', name: 'StatusType', editable:true, width: 10, align:'center',
                                edittype:'select',
                                editoptions:{
                                    value:statusTypes,
                                    defaultValue:this,
                                    dataEvents: [
                                        { type: 'change', fn: function(e) {funcOnChangeStatusType(this); } },
                                    ]
                                }},
                            { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true },
                            { label: 'PublisherName', name: 'PublisherName', editable: true, width: 10,
                                edittype:'select',
                                editoptions:{
                                    value: publishers,
                                    defaultValue:this,
                                    dataEvents: [
                                        { type: 'change', fn: function(e) {funcOnChangePublisher(this); } },
                                    ]
                                }},
                            { label: 'PublisherId', name: 'PublisherId', editable:false, width: 80, nullable: true, hidden: true}
                        ],
                        height: '100%',
                        width: $(window).width()-80,
                        rowNum:5,
                        sortname: 'num',
                        sortorder: "asc",
                        pager: pager_id,

                        //onSelectRow: editRow,
                    });

                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                    var sourceId = myGrid.jqGrid ('getCell', rowId, 'SourceId');

                    jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:true,add:true,del:true, search:true, refresh:true},
                            // options for the Edit Dialog
                            {
                                editCaption: "Edit Record",
                                mtype: 'POST',
                                {{-- rowId: sourceId,  --}}
                                editData: {'_token':"{{ csrf_token() }}"},
                                url: "{!! route('editsource_detail') !!}",
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
                                editData: {rowId: function() {
                                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                                    var sourceId = myGrid.jqGrid ('getCell', rowId, 'SourceId');
                                    return sourceId;
                                }, '_token':"{{ csrf_token() }}"},
                                url: "{!! route('editsource_detail') !!}",
                                recreateForm: true,
                                errorTextFormat: function (data) {
                                    return 'Error: ' + data.responseText
                                }
                            },
                            {
                                mtype: 'POST',
                                delData: {'_token':"{{ csrf_token() }}"},
                                url: "{!! route('deletesource_detail') !!}",
                                errorTextFormat: function (data) {
                                    return 'Error: ' + data.responseText
                                }
                            })


                }

            });
            jQuery("#tblSource")
                    .navGrid('#jqGridPager',{edit:false,add:false,del:false,search:true})
                    .navButtonAdd('#jqGridPager',{
                        caption:"Add",
                        buttonicon:"ui-icon-add",
                        onClickButton: function(){

                            var newData = { SourceId:"new", SourceName:"", LastChptrOrSection:"",
                                ChptrOfLastVrs:"", LastVerseOrPage:"", StatusType:1,
                                PublisherName:"", Source_Type_Abbreviation:1 };
                            var rowId = $.jgrid.randId(); // new row ID

                            $("#tblSource").jqGrid('addRowData', rowId, newData);
                            $("#tblSource").jqGrid('setSelection',rowId);

                        },
                        position:"last"
                    })
                    .navButtonAdd('#jqGridPager',{
                        caption:"Del",
                        buttonicon:"ui-icon-del",
                        onClickButton: function(){

                            var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                            var sourceId = myGrid.jqGrid ('getCell', rowId, 'SourceId');
                            if(sourceId != null) {

                                $.ajax({
                                    url: "{!! route('deletesource') !!}",
                                    type: 'POST',
                                    data: {SourceId: sourceId, '_token':"{{ csrf_token() }}"},
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

            function getAllSelectOptions(){
                var statustypes = { '1': 'Verify', '2': 'Accept', '3': 'Changed',
                    '4': 'Deleted', '5': 'Fixed', '6': 'New' };

                return statustypes;

            }

            var lastSelection;

            function editRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('updatesource') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#tblSource");
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

            function funcOnChangePublisher(obj) {
                var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                myGrid.jqGrid("setCell", rowId, "PublisherId", obj.value);
            }

            function funcOnChangeSourceType(obj) {
                var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                myGrid.jqGrid("setCell", rowId, "Source_TypeId", obj.value);
            }


            function funcSuccess(obj) {
                alert(obj.responseJSON.msg);

                //refresh grid
                myGrid.trigger('reloadGrid');
                lastSelection = null;
            }
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

        function loadPublishers() {
            $.ajax({
                url: "{!! route('publishers') !!}",
                async: false,
                success: function(data, result) {
                    publishers = data;
                    if (!result) alert('Failure to retrieve the Publishers.');
                }
            });
        }

        function loadSourceTypes() {
            $.ajax({
                url: "{!! route('sourcetypes') !!}",
                async: false,
                success: function(data, result) {
                    sourceTypes = data;
                    if (!result) alert('Failure to retrieve the Source Types.');
                }
            });
        }
    </script>
@endsection
