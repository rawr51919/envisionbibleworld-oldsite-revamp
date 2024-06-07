@extends('app')

@section('content')

    <table id="tblSourceQuoted"></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">
        var statusTypes;
        var sources;
        $(document).ready(function () {
            if (!window.console) window.console = {};
            if (!window.console.log) window.console.log = function () { };

            loadStatusTypes();
            loadSources();

            var myGrid = $("#tblSourceQuoted").jqGrid({
                url: "{!! route('sourcesquoted') !!}",
                datatype: "json",
                colModel: [
                    { label: 'Source_QuotedId', name: 'Source_QuotedId', key:true, width:  20},
                    { label: 'SourceID', name: 'SourceId', editable: false, width: 20},
                    { label: 'Source', name: 'SourceName', editable: true, width: 160,
                        edittype:'select',
                        editoptions:{
                            value: sources,
                            defaultValue:this,
                            dataEvents: [
                                { type: 'change', fn: function(e) {funcOnChangeSource(this); } },
                            ]
                        }},
                    { label: 'BeginChptrSectionMinute', name: 'BeginChptrSectionMinute', editable: true, width: 20},
                    { label: 'BeginVersePageSecond', name: 'BeginVersePageSecond', editable: true, width: 20},
                    { label: 'EndChptrSectionMinute', name: 'EndChptrSectionMinute', editable: true, width: 20},
                    { label: 'EndVersePageSecond', name: 'EndVersePageSecond', editable: true, width: 20},
                    { label: 'Source_Explanation', name: 'Source_Explanation', editable: true, width: 90},
                    { label: 'StatusType', name: 'StatusType', editable:true, width: 40, align: 'center',
                        edittype:'select',
                        editoptions:{
                            value:statusTypes,
                            defaultValue:this,
                            dataEvents: [
                                { type: 'change', fn: function(e) {funcOnChangeStatusType(this); } },
                            ]
                        }},
                    { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true}
                ],
                onSelectRow: editRow,
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                width: $(window).width()-40,
                height: 'auto',
                rowNum: 10,
                sortable: true,
                pager: "#jqGridPager",
                gridview: true,
                sortname: "SourceQuoted",
                caption:'Source Quoted'
            });

            jQuery("#tblSourceQuoted")
                    .navGrid('#jqGridPager',{edit:false,add:false,del:false,search:true})
                    .navButtonAdd('#jqGridPager',{
                        caption:"Add",
                        buttonicon:"ui-icon-add",
                        onClickButton: function(){

                            var newData = { Source_QuotedId:"new", SourceName:"", BeginChptrSectionMinute:"",
                                BeginVersePageSecond:"", EndChptrSectionMinute:"", EndVersePageSecond:"",
                                Source_Explanation:"", StatusType:1};
                            var rowId = $.jgrid.randId(); // new row ID

                            $("#tblSourceQuoted").jqGrid('addRowData', rowId, newData);
                            $("#tblSourceQuoted").jqGrid('setSelection',rowId);

                        },
                        position:"last"
                    })
                    .navButtonAdd('#jqGridPager',{
                        caption:"Del",
                        buttonicon:"ui-icon-del",
                        onClickButton: function(){

                            var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                            var sourcequotedId = myGrid.jqGrid ('getCell', rowId, 'Source_QuotedId');
                            if(sourcequotedId != null) {

                                $.ajax({
                                    url: "{!! route('deletesourcequoted') !!}",
                                    type: 'POST',
                                    data: {Source_QuotedId: sourcequotedId, '_token':"{{ csrf_token() }}"},
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
                    "url" : "{!! route('updatesourcequoted') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#tblSourceQuoted");
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

            function funcOnChangeSource(obj) {
                var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                myGrid.jqGrid("setCell", rowId, "SourceId", obj.value);
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

        function loadSources() {
            $.ajax({
                url: "{!! route('getsources_quoted') !!}",
                async: false,
                success: function(data, result) {
                    sources = data;
                    if (!result) alert('Failure to retrieve the Status Types.');
                }
            });
        }
    </script>
@endsection


