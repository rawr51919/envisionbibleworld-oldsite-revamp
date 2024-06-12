@extends('app')

@section('content')

    <h3>Standard Entries</h3>
    <table id="topGrid"><th></th></table>
    <div id="topGridPager"></div>
    <hr>

    <table id="bottomGrid"><th></th></table>
    <div id="bottomGridPager"></div>

    <div id="dialogAddNew" title="Add New Standard Entry" style="display:none;">
        <form id="entryForm">
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="SacrificeId">Sacrifice</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="SacrificeId" id="SacrificeId">
                    <input type="text" class="form-control" placeholder="Sacrifice" name="Sacrifice" id="Sacrifice" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchSacrifice">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="Location">Location</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="LocationId" id="LocationId">
                    <input type="text" class="form-control" placeholder="Location" name="Location" id="Location" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchLocation">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="Quotation">Sub Category</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="SubcategoryId" id="SubcategoryId">
                    <input type="text" class="form-control" placeholder="Subcategory" name="Subcategory" id="Subcategory" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchSubcategory">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="SacrificeId">Summary</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="SummaryId" id="SummaryId">
                    <input type="text" class="form-control" placeholder="Summary" name="Summary" id="Summary" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchSummary">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="Source">Source</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="SourceId" id="SourceId">
                    <input type="text" class="form-control" placeholder="Source" name="Source" id="Source" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchSource">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="Source_Quoted">Source Quoted</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="Source_QuotedId" id="Source_QuotedId">
                    <input type="text" class="form-control" placeholder="Source_Quoted" name="Source_Quoted" id="Source_Quoted" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchSourceQuoted">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="Era">Era</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="EraId" id="EraId">
                    <input type="text" class="form-control" placeholder="Era" name="Era" id="Era" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchEra">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label" for="Quotation">Quotation</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="QuotationId" id="QuotationId">
                    <input type="text" class="form-control" placeholder="Quotation" name="Quotation" id="Quotation" readonly>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-info standard-search" id="searchQuotation">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}"
        </form>
    </div>

    <div id="dialogGrids" title="Dialog for Grids" style="display:none;">
        <div id="sacrificeLayer">
            <table id="sacrificeGrid"></table>
            <div id="sacrificeGridPager"></div>
        </div>
        <div id="locationLayer">
            <table id="locationGrid"></table>
            <div id="locationGridPager"></div>
        </div>
        <div id="categoryLayer">
            <table id="categoryGrid"></table>
            <div id="categoryGridPager"></div>
        </div>
        <div id="summaryLayer">
            <table id="summaryGrid"></table>
            <div id="summaryGridPager"></div>
        </div>
        <div id="sourceLayer">
            <table id="sourceGrid"></table>
            <div id="sourceGridPager"></div>
        </div>
        <div id="sourceQuotedLayer">
            <table id="sourceQuotedGrid"></table>
            <div id="sourceQuotedGridPager"></div>
        </div>
        <div id="quotationLayer">
            <table id="quotationGrid"></table>
            <div id="quotationGridPager"></div>
        </div>
        <div id="eraLayer">
            <table id="eraGrid"></table>
            <div id="eraGridPager"></div>
        </div>
    </div>
    <script>
        // defining flags
        var isCtrl = false;
        var isShift = false;

        //declare variables for combobox.
        var eras;
        var categories;
        var subCategories;
        var prevEra;
        var lastSelection;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //load data for era, category, and subcategory which are using on grid
            loadEras();
            loadCategories();
            loadSubcategories();

            //Top grid, just readonly
            var jqTopGrid = $("#topGrid").jqGrid({
                url: "{!!route('summary_details') !!}",
                mtype: "GET",
                datatype: "json",
                colModel: [
                    { label: 'ID', name: 'Summary_DetailsId', key: true, width: 40 },
                    { label: 'Era', name: 'Era', width: 180, editable: false},
                    { label: 'Category', name: 'Category', width: 150, editable: false},
                    { label: 'Subcategory', name: 'Subcategory', width: 250, editable: false},
                    { label: 'Source_Type', name: 'Source_Type_Abbreviation', width: 30, editable: false },
                    { label: 'SourceName', name: 'SourceName', width: 120, editable: false },
                    { label: 'ChapterOrSectionBegin', name: 'BeginChptrSectionMinute', width: 50, editable: false },
                    { label: 'BegVersPg', name: 'BeginVersePageSecond', width: 50, editable: false },
                    { label: 'Summary', name: 'Summary', width: 550, editable: false},
                    { label: 'ChapterOrSectionEnd', name: 'EndChptrSectionMinute', width: 50, editable: false },
                    { label: 'EndVersPg', name: 'EndVersePageSecond', width: 50, editable: false },
                    { label: 'Explanation', name: 'Source_Explanation', width: 50, editable: false },
                    { label: 'Quotation', name: 'Quotation', width: 500, editable: false },
                    { label: 'Status', name: 'StatusType', width: 50, editable: false },
                ],
                viewrecords: true,
                width: $( window ).width()-40,
                height: 'auto',
                rowNum: 15,
                pager: "#topGridPager",
                multiSort:true,
                sortname: "Source_Type asc, SourceName asc, BeginChptrSectionMinute asc, BeginVersePageSecond asc, Summary ",
                sortorder: "asc",
                gridview: true,
                caption:'Standard Entries-Readonly',
                shrinkToFit: false
            });

            //Bottom grid
            //editible grid, user can add and delete standard entry data.
            var jqBottomGrid = $("#bottomGrid").jqGrid({
                url: "{!!route('summary_details') !!}",
                mtype: "GET",
                postData: {'_type':'bottom'},
                datatype: "json",
                colModel: [
                    { label: 'ID', name: 'Summary_DetailsId', key: true, width: 40, search:false},
                    { label: 'Era', name: 'Era', width: 180, editable: true, search:false,
                        edittype:'select',
                        editoptions:{
                            //dataUrl:"{!!route('eras_for_combobox') !!}",
                            value:eras,
                            defaultValue:this,
                            dataEvents: [
                                { type: 'focus', fn: function(e) { prevEra = $(this).val(); } },
//                                { type: 'change', fn: function(e) {funcOnChangeEra(this); } },
                            ]
                        }
                    },
                    { label: 'Category', name: 'Category', width: 150, editable: true,
                        edittype:'select',
                        editoptions:{
                            //dataUrl:"{!!route('category_for_combobox') !!}",
                            value:categories,
                            defaultValue:this,
                            dataEvents: [
                                { type: 'change', fn: function(e) {funcOnChangeCategory(); } },
                            ]
                        }
                    },
                    { label: 'Subcategory', name: 'Subcategory', width: 250, editable: true,
                        edittype:'select',
                        editoptions:{
                            //dataUrl:"{!!route('subcategory_for_combobox') !!}?" + $('#33_Category')[0].selectedIndex;,
                            value:subCategories,
                            defaultValue:this,
                            dataEvents: [
//                                { type: 'change', fn: function(e) {funcOnChangeSubcategory(); } },
                            ]
                        }
                    },
                    { label: 'Summary', name: 'Summary', width: 550, editable: true, edittype: "text" ,search:true},
                    { label: 'Source_Type', name: 'Source_Type_Abbreviation', width: 30, editable: true },
                    { label: 'SourceName', name: 'SourceName', width: 120, editable: true },
                    { label: 'ChapterOrSectionBegin', name: 'BeginChptrSectionMinute', width: 50, editable: true, search:false },
                    { label: 'BegVersPg', name: 'BeginVersePageSecond', width: 50, editable: true, search:false },
                    { label: 'ChapterOrSectionEnd', name: 'EndChptrSectionMinute', width: 50, editable: true, search:false },
                    { label: 'EndVersPg', name: 'EndVersePageSecond', width: 50, editable: true, search:false },
                    { label: 'Explanation', name: 'Source_Explanation', width: 50, editable: true, search:false },
                    { label: 'Quotation', name: 'Quotation', width: 500, editable: true, search:false },
                    { label: 'Status', name: 'StatusType', width: 50, editable: true, search:false,
                        edittype:'select',
                        editoptions:{
                            value:getStatusTypes(),
                            defaultValue:this
                        }},
                ],
                onSelectRow: editRow,
                viewrecords: false,
                pgbuttons : false,
                pgtext : '',
                pginput : false,
                width: $( window ).width()-40,
                height: 300,
                rowNum: 1000000,
                pager: "#bottomGridPager",
                multiSort:true,
                sortname: "Category asc, Subcategory asc, Summary ",
                sortorder: "asc",
                gridview: true,
                caption:'Standard Entries-Editable',
                shrinkToFit: false
            }).navGrid('#bottomGridPager',{edit:false,add:false,del:true,search:true},
                    {}, {},
                // options for the Delete Dailog
                {
                    mtype: 'POST',
                    delData: {'_token':"{{ csrf_token() }}"},
                    url: "{!! route('delete_details') !!}",
                    errorTextFormat: function (data) {
                        return 'Error: ' + data.responseText
                    },

                    afterShowForm: function($form) {
                        var dialog = $form.closest('div.ui-jqdialog'),
                                selRowId = jqBottomGrid.jqGrid('getGridParam', 'selrow'),
                                selRowCoordinates = $('#' + selRowId).offset();

                        dialog.offset(selRowCoordinates);
                    }
                },
                {
                    caption: "Search Here",
                    Find: "Find",
                    Reset: "Reset",
                    sopt:['cn', 'eq'],
                    //searchoptions : ['equal', 'contains'],
                    //groupOps: [ { op: "AND", text: "all" }, { op: "OR", text: "any" } ],
                    matchText: " match",
                    rulesText: " rules",
                    searchOnEnter: true
                }
            )
            .navButtonAdd('#bottomGridPager',{
                title:'Add',
                caption:"",
                buttonicon:"ui-icon ui-icon-plus",
                onClickButton: function(){
                    $("#dialogAddNew").dialog('open');

                    $('#searchSourceQuoted').prop("disabled",true);
                },
                position:"first"
            });
            {{--.navButtonAdd('#bottomGridPager',{--}}
                {{--title:"Delete selected Row",--}}
                {{--buttonicon:"ui-icon ui-icon-trash",--}}
                {{--onClickButton: function(){--}}

                    {{--var rowId = jqBottomGrid.jqGrid ('getGridParam', 'selrow');--}}
                    {{--var summaryDetailsId = jqBottomGrid.jqGrid ('getCell', rowId, 'Summary_DetailsId');--}}
                    {{--if(summaryDetailsId != null) {--}}

                        {{--$.ajax({--}}
                            {{--url: "{!!route('delete_details') !!}",--}}
                            {{--type: 'POST',--}}
                            {{--data: {Summary_DetailsId: summaryDetailsId, '_token':"{{ csrf_token() }}"},--}}
                            {{--async: false,--}}
                            {{--success: function(data, result) {--}}
                                {{--alert(data.msg);--}}
                                {{--jqBottomGrid.trigger('reloadGrid');--}}
                                {{--lastSelection = null;--}}
                            {{--}--}}
                        {{--});--}}
                    {{--}--}}
                {{--},--}}
                {{--position:"last"--}}
            {{--});--}}


            function editRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : funcOnChangeCategory,
                    "successfunc" : null,
                    "url" : "{!!route('update_details') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#bottomGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcOnChangeCategory(){
                var rowId = $("#bottomGrid").jqGrid('getGridParam','selrow');
                var categorySelectbox = $('#' + rowId + '_Category')[0];
                var categoryId = categorySelectbox.value;

                var subCategorySelectbox = $('#' + rowId + '_Subcategory')[0];
                var subCategoryId = subCategorySelectbox.value;


                $.ajax({
                    url: "{!!route('subcategory_for_combobox') !!}",
                    data:{CategoryId: categoryId, SubcategoryId: subCategoryId},
                    async: false,
                    success: function(data, result) {
                        $('#' + rowId + '_Subcategory').empty().append(data);
                    }
                });
            }
            function funcAfterSave() {
                jqTopGrid.trigger('reloadGrid');
                jqBottomGrid.trigger('reloadrid');
                lastSelection = null;
            }


            //set dialog for adding form
            $("#dialogAddNew").dialog({
                width:1000,
                autoOpen: false,
                modal: true,
                buttons: {
                    "Submit" : {
                        text: "Submit",
                        id: "btnSubmit",
                        click: function(){

                            var parameters = {
                                'SummaryId': $('#SummaryId').val(),
                                'SacrificeId': $('#SacrificeId').val(),
                                'Source_QuotedId': $('#Source_QuotedId').val(),
                                'QuotationId': $('#QuotationId').val(),
                                'EraId': $('#EraId').val(),
                                'LocationId': $('#LocationId').val(),
                                'SubcategoryId': $('#SubcategoryId').val()
                            }
                            $.ajax({
                                url: "{!!route('add_details') !!}",
                                type: "GET",
                                data: parameters,
                                dataType: 'json',
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    alert("An error has occurred making the request: " + errorThrown)
                                },
                                success: function (data) {
                                    alert(data.msg);
                                    if(data.result) {

                                        jqTopGrid.trigger('reloadGrid');
                                        jqBottomGrid.trigger('reloadrid');
                                        $("#dialogAddNew").dialog("close");
                                    }
                                }
                            });
                        }
                    },
                    "Close": function () {
                        $(this).dialog("close");
                    }
                },
                open: function() {

                    $('#SacrificeId').val('');
                    $('#LocationId').val('');
                    $('#SubcategoryId').val('');
                    $('#SummaryId').val('');
                    $('#SourceId').val('');
                    $('#Source_QuotedId').val('');
                    $('#QuotationId').val('');
                    $('#EraId').val('');

                    $('#Sacrifice').val('');
                    $('#Location').val('');
                    $('#Subcategory').val('');
                    $('#Summary').val('');
                    $('#Source').val('');
                    $('#Source_Quoted').val('');
                    $('#Quotation').val('');
                    $('#Era').val('');

                    $('#btnSubmit').prop("disabled",true);
                }
            })

            //set dialog for searching Grid
            $("#dialogGrids").dialog({
                width:1000,
                autoOpen: false,
                modal: true,
                buttons: {
//                    "OK": function () {
//                        alert(lastSelection);
//                    },
                    "Close": function () {
                        $(this).dialog("close");
                    }
                }
            });


            loadCategoryGrid();
            loadSummaryGrid();
            loadSourceGrid();
            loadSourceQuotedGrid();
            loadQuotationGrid();
            loadEraGrid();


            //set binding click event handler to every search button on adding form
            $('.standard-search').each(function(index) {
                $(this).on("click", function(){
                    lastSelection = null;
                    $('#sacrificeLayer').hide();
                    $('#locationLayer').hide();
                    $('#summaryLayer').hide();
                    $('#sourceLayer').hide();
                    $('#sourceQuotedLayer').hide();
                    $('#quotationLayer').hide();
                    $('#eraLayer').hide();
                    $('#categoryLayer').hide();
                    $('#subcategoryLayer').hide();

                    switch($(this).attr('id')) {
                        case 'searchSacrifice':
                            alert('It is not ready.. We are woking on now..');
                            //$('#sacrificeLayer').show();
                            break;
                        case 'searchLocation':
                            alert('It is not ready.. We are woking on now..');
                            //$('#locationLayer').show();
                            break;
                        case 'searchSummary':
                            $("#summaryGrid").trigger('reloadGrid');
                            $('#summaryLayer').show();
                            break;
                        case 'searchSource':
                            $("#sourceGrid").trigger('reloadGrid');
                            $('#sourceLayer').show();
                            break;
                        case 'searchSourceQuoted':
                            $("#sourceQuotedGrid").setGridParam({'postData': {'SourceId':$('#SourceId').val()}});
                            $("#sourceQuotedGrid").trigger('reloadGrid');
                            $('#sourceQuotedLayer').show();
                            break;
                        case 'searchQuotation':
                            $("#quotationGrid").trigger('reloadGrid');
                            $('#quotationLayer').show();
                            break;
                        case 'searchEra':
                            $("#eraGrid").trigger('reloadGrid');
                            $('#eraLayer').show();
                            break;
                        case 'searchSubcategory':
                            $("#categoryGrid").trigger('reloadGrid');
                            $('#categoryLayer').show();
                            break;
                        default:
                            break;
                    }

                    $("#dialogGrids").dialog('open');
                });
            });


            //load grid for Category
            function loadCategoryGrid() {

                var categoryGrid = $("#categoryGrid").jqGrid({
                    url: "{!! route('categories') !!}",
                    datatype: "json",
                    colModel: [
                        { label: 'CategoryId', name: 'CategoryId', key:true, width:  20},
                        { label: 'Category', name: 'Category', editable: true, width: 60},
                        { label: 'Explanation', name: 'Explanation', editable: true, width: 50},
                    ],
                    onSelectRow: editCategoryRow,
                    viewrecords: true, // show the current page, data rang and total records on the toolbar
                    width: 960,
                    height: 'auto',
                    rowNum: 10,
                    sortable: true,
                    pager: "#categoryGridPager",
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
                                { label: 'Subcategory ID', name: 'SubcategoryId', editable:false, width: 80, key:true},
                                { label: 'Name', name: 'Subcategory', editable:true, width: 80, nullable: true},
                                { label: 'Explanation', name: 'Subcategory_Explanation', editable:true, width: 80, nullable: true},
                                { label: 'StatusType', name: 'StatusType', editable:true, width: 80,
                                    edittype:'select',
                                    editoptions:{
                                        value:getStatusTypes(),
                                        defaultValue:this,
                                        dataEvents: [
                                            { type: 'change', fn: function(e) {funcOnChangeStatusType(this); } }
                                        ]
                                    }},
                                { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true }
                            ],
                            height: '100%',
                            width: 920,
                            rowNum:5,
                            sortname: 'num',
                            sortorder: "asc",
                            pager: pager_id,
                            ondblClickRow: function(rowid) {
                                //var rowId = $("#"+subgrid_table_id).jqGrid ('getGridParam', 'selrow');
                                var subGrid = $('#'+subgrid_table_id).jqGrid('getRowData', rowid);

                                $('#SubcategoryId').val(subGrid.SubcategoryId);
                                $('#Subcategory').val(subGrid.Subcategory);

                                //validate inpu form and make submit button is clickable
                                validateNewStandard();
                                $("#dialogGrids").dialog('close');
                            }
                        });


                        jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,
                            {edit:true,add:true,del:true, search:true, refresh:true},
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
                                    var rowId = categoryGrid.jqGrid ('getGridParam', 'selrow');
                                    var value = categoryGrid.jqGrid ('getCell', rowId, 'CategoryId');
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
                            }
                        );
                    }

                }).navGrid('#categoryGridPager',{edit:false,add:false,del:false,search:true})
                .navButtonAdd('#categoryGridPager',{
                    title:"Add new row",
                    caption:"",
                    buttonicon:"ui-icon-plus",
                    onClickButton: function(){

                        var newData = { CategoryId:"new", Category:"", Explanation:"" };
                        var rowId = $.jgrid.randId(); // new row ID

                        categoryGrid.jqGrid('addRowData', rowId, newData);
                        categoryGrid.jqGrid('setSelection',rowId);

                    },
                    position:"first"
                })
                .navButtonAdd('#categoryGridPager',{
                    caption:"Del",
                    buttonicon:"ui-icon-del",
                    onClickButton: function(){

                        var rowId = categoryGrid.jqGrid ('getGridParam', 'selrow');
                        var categoryId = categoryGrid.jqGrid ('getCell', rowId, 'CategoryId');
                        if(categoryId != null) {

                            $.ajax({
                                url: "{!! route('deletecategory') !!}",
                                type: 'POST',
                                data: {CategoryId: categoryId, '_token':"{{ csrf_token() }}"},
                                async: false,
                                success: function(data, result) {
                                    alert(data.msg);
                                    categoryGrid.trigger('reloadGrid');
                                    lastSelection = null;
                                }
                            });
                        }
                    },
                    position:"last"
                });

            }

            function editCategoryRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('updatesubcategory') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSaveCategory,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                };

                if (id && id !== lastSelection) {
                    var grid = $("#categoryGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcAfterSaveCategory() {
                lastSelection = null;
                $("#categoryGrid").trigger('reloadGrid');
            }


            //Load grid for Summary
            function loadSummaryGrid() {
                var summaryGrid = $("#summaryGrid").jqGrid({
                    url: "{!! route('summaries') !!}",
                    datatype: "json",
                    colModel: [
                        { label: 'SummaryId', name: 'SummaryId', key:true, width:  20},
                        { label: 'Summary', name: 'Summary', editable: true, width: 200},
                        { label: 'StatusTypeId', name: 'StatusTypeId', nullable: true, editable: true, width: 30,
                            cellEdit:true,
                            edittype: 'select',
                            formatter: 'select',
                            align: 'center',
                            editoptions:{value: getStatusTypes()} },
                        { label: 'EntryDate', name: 'EntryDate', width: 30},
                    ],
                    onSelectRow: editSummaryRow,
                    ondblClickRow: function(rowId) {

                        var summaryId = $("#summaryGrid").jqGrid ('getCell', rowId, 'SummaryId');
                        if(summaryId != null) {
                            $('#SummaryId').val(summaryId);
                            $('#Summary').val($('#'+summaryId+'_Summary').val());

                            //validate inpu form and make submit button is clickable
                            validateNewStandard();
                            $("#dialogGrids").dialog('close');
                        }
                    },
                    viewrecords: true, // show the current page, data rang and total records on the toolbar
                    width: 960,
                    height: 'auto',
                    rowNum: 10,
                    sortable: true,
                    pager: "#summaryGridPager",
                    gridview: true,
                    sortname: "Summary",
                    caption:'Summaries'
                }).navGrid('#summaryGridPager',{edit:false,add:false,del:false,search:true})
                .navButtonAdd('#summaryGridPager',{
                    caption:"Add",
                    buttonicon:"ui-icon-add",
                    onClickButton: function(){

                        var newData = { SummaryId:"new", Summary:"", StatusTypeId:"6" };
                        var rowId = $.jgrid.randId(); // new row ID

                        $("#summaryGrid").jqGrid('addRowData', rowId, newData);
                        $("#summaryGrid").jqGrid('setSelection',rowId);

                    },
                    position:"last"
                })
                .navButtonAdd('#summaryGridPager',{
                    caption:"Del",
                    buttonicon:"ui-icon-del",
                    onClickButton: function(){

                        var rowId = summaryGrid.jqGrid ('getGridParam', 'selrow');
                        var summaryId = summaryGrid.jqGrid ('getCell', rowId, 'SummaryId');
                        if(summaryId != null) {

                            $.ajax({
                                url: "{!! route('deletesummary') !!}",
                                type: 'POST',
                                data: {SummaryId: summaryId, '_token':"{{ csrf_token() }}"},
                                async: false,
                                success: function(data, result) {
                                    alert(data.msg);
                                    summaryGrid.trigger('reloadGrid');
                                    lastSelection = null;
                                }
                            });
                        }
                    },
                    position:"last"
                });
            }

            function editSummaryRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('updatesummary') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSaveSummary,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#summaryGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }


            function funcAfterSaveSummary() {
                $("#summaryGrid").trigger('reloadGrid');
            }


            function loadSourceGrid() {
                var sourceGrid = $("#sourceGrid").jqGrid({
                    url: "{!! route('sources') !!}",
                    datatype: "json",
                    colModel: [
                        { label: 'Source ID', name: 'SourceId', key:true, width:  20},
                        { label: 'Source Abbreviation', name: 'Source_Type_Abbreviation', editable: true, width: 20, nullable: true,
                            edittype:'select',
                            editoptions:{
                                value:getSourceTypes(),
                                defaultValue:this,
                                dataEvents: [
                                    { type: 'change', fn: function(e) {funcOnChangeSourceType(this); } },
                                ]
                            }},
                        { label: 'SourceTypeId', name: 'Source_TypeId', editable: false, hidden:true},
                        { label: 'SourceName', name: 'SourceName', editable: true, width: 40},
                        { label: 'LastChptrOrSection', name: 'LastChptrOrSection', editable: true, width: 30, nullable: true},
                        { label: 'ChptrOfLastVrs', name: 'ChptrOfLastVrs', editable:true, width: 30, nullable: true},
                        { label: 'LastVerseOrPage', name: 'LastVerseOrPage', editable:true, width: 30, nullable: true},
                        { label: 'ScreenShotName', name: 'ScreenShotName', editable:true, width: 30, nullable: true},
                        { label: 'StatusType', name: 'StatusType', editable:true, width: 20,
                            edittype:'select',
                            editoptions:{
                                value:getStatusTypes(),
                                defaultValue:this,
                                dataEvents: [
                                    { type: 'change', fn: function(e) {funcOnChangeStatusType(this); } },
                                ]
                            }},
                        { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true },
                        { label: 'PublisherName', name: 'PublisherName', editable: true, width: 30,
                            edittype:'select',
                            editoptions:{
                                value: getPublishers(),
                                defaultValue:this,
                                dataEvents: [
                                    { type: 'change', fn: function(e) {funcOnChangePublisher(this); } },
                                ]
                            }},
                        { label: 'PublisherId', name: 'PublisherId', editable:false, width: 30, nullable: true, hidden: true}
                    ],
                    onSelectRow: editSourceRow,
                    ondblClickRow: function(rowId) {

                        var grid = $('#sourceGrid').jqGrid('getRowData', rowId);

                        $('#SourceId').val(grid.SourceId);
                        $('#Source').val($('#'+grid.SourceId+'_SourceName').val());

                        $('#searchSourceQuoted').prop("disabled", false);
                        //validate inpu form and make submit button is clickable
                        validateNewStandard();
                        $("#dialogGrids").dialog('close');
                    },
                    viewrecords: true, // show the current page, data rang and total records on the toolbar
                    width: 960,
                    height: 'auto',
                    rowNum: 10,
                    sortable: true,
                    pager: "#sourceGridPager",
                    gridview: true,
                    sortname: "Source",
                    caption:'Sources'
                }).navGrid('#sourceGridPager',{edit:false,add:false,del:false,search:true})
                .navButtonAdd('#sourceGridPager',{
                    caption:"Add",
                    buttonicon:"ui-icon-add",
                    onClickButton: function(){
                        var newData = { SourceId:"new", SourceName:"", LastChptrOrSection:"",
                            ChptrOfLastVrs:"", LastVerseOrPage:"", ScreenShotName:"", StatusType:1,
                            PublisherName:"", Source_Type_Abbreviation:1 };
                        var rowId = $.jgrid.randId(); // new row ID

                        sourceGrid.jqGrid('addRowData', rowId, newData);
                        sourceGrid.jqGrid('setSelection',rowId);

                    },
                    position:"last"
                })
                .navButtonAdd('#sourceGridPager',{
                    caption:"Del",
                    buttonicon:"ui-icon-del",
                    onClickButton: function(){
                        var rowId = sourceGrid.jqGrid ('getGridParam', 'selrow');
                        var sourceId = sourceGrid.jqGrid ('getCell', rowId, 'SourceId');
                        if(sourceId != null) {

                            $.ajax({
                                url: "{!! route('deletesource') !!}",
                                type: 'POST',
                                data: {SourceId: sourceId, '_token':"{{ csrf_token() }}"},
                                async: false,
                                success: function(data, result) {
                                    alert(data.msg);
                                    sourceGrid.trigger('reloadGrid');
                                    lastSelection = null;
                                }
                            });
                        }
                    },
                    position:"last"
                });
            }


            function editSourceRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('updatesource') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSaveSource,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                };

                if (id && id !== lastSelection) {
                    var grid = $("#sourceGrid");
                    grid.jqGrid('restoreRow', lastSelection);
                    grid.jqGrid('editRow', id, editparameters);
                    lastSelection = id;
                }
            }

            function funcAfterSaveSource() {
                lastSelection = null;
                $("#sourceGrid").trigger('reloadGrid');
            }

            function funcOnChangeStatusType(obj) {
                var rowId = $("#sourceGrid").jqGrid('getGridParam', 'selrow');
                $("#sourceGrid").jqGrid("setCell", rowId, "StatusTypeId", obj.value);
            }

            function funcOnChangePublisher(obj) {
                var rowId = $("#sourceGrid").jqGrid('getGridParam', 'selrow');
                $("#sourceGrid").jqGrid("setCell", rowId, "PublisherId", obj.value);
            }

            function funcOnChangeSourceType(obj) {
                var rowId = $("#sourceGrid").jqGrid('getGridParam', 'selrow');
                $("#sourceGrid").jqGrid("setCell", rowId, "Source_TypeId", obj.value);
            }


            //load grid for source_quoted
            function loadSourceQuotedGrid() {
                var sourceQuotedGrid = $("#sourceQuotedGrid").jqGrid({
                    url: "{!! route('sourcesquoted') !!}",
                    datatype: 'json',
                    postData: {'SourceId': 0},
                    colModel: [
                        { label: 'Source_QuotedId', name: 'Source_QuotedId', key:true, width:  20},
                        { label: 'SourceID', name: 'SourceId', editable: false, width: 20},
                        { label: 'Source', name: 'SourceName', editable: true, width: 160,
                            edittype:'select',
                            editoptions:{
                                value: getSources(),
                                defaultValue:this,
                                dataEvents: [
                                    { type: 'change', fn: function(e) {
                                        var rowId = sourceQuotedGrid.jqGrid ('getGridParam', 'selrow');
                                        sourceQuotedGrid.jqGrid("setCell", rowId, "SourceId", this.value);
                                    }},
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
                                value:getStatusTypes(),
                                defaultValue:this,
                                dataEvents: [
                                    { type: 'change', fn: function(e) {
                                        var rowId = sourceQuotedGrid.jqGrid ('getGridParam', 'selrow');
                                        sourceQuotedGrid.jqGrid("setCell", rowId, "StatusTypeId", this.value);
                                    } },
                                ]
                            }},
                        { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true}
                    ],
                    onSelectRow: editSourceQuotedRow,
                    ondblClickRow: function(rowId) {

                        var sourceQuotedId = $("#sourceQuotedGrid").jqGrid ('getCell', rowId, 'Source_QuotedId');
                        if(sourceQuotedId != null) {
                            $('#Source_QuotedId').val(sourceQuotedId);
                            var sourceName = 'BeginChptr:';
                            sourceName += $('#'+sourceQuotedId+'_BeginChptrSectionMinute').val();
                            sourceName += ', BeginVerse:';
                            sourceName += $('#'+sourceQuotedId+'_BeginVersePageSecond').val();
                            sourceName += ', EndChptr:';
                            sourceName += $('#'+sourceQuotedId+'_EndChptrSectionMinute').val();
                            sourceName += ', EndVerse:';
                            sourceName += $('#'+sourceQuotedId+'_EndVersePageSecond').val();
                            sourceName +=
                            $('#Source_Quoted').val(sourceName);

                            //validate inpu form and make submit button is clickable
                            validateNewStandard();
                            $("#dialogGrids").dialog('close');
                        }
                    },
                    viewrecords: true, // show the current page, data rang and total records on the toolbar
                    width: 960,
                    height: 'auto',
                    rowNum: 10,
                    sortable: true,
                    pager: "#sourceQuotedGridPager",
                    gridview: true,
                    sortname: "SourceQuoted",
                    caption:'Source Quoted'
                }).navGrid('#sourceQuotedGridPager',{edit:false,add:false,del:false,search:true})
                .navButtonAdd('#sourceQuotedGridPager',{
                    caption:"",
                    title:'Add new row',
                    buttonicon:"ui-icon-plus",
                    onClickButton: function(){
                        var newData = { Source_QuotedId:"new", SourceName:"", BeginChptrSectionMinute:"",
                            BeginVersePageSecond:"", EndChptrSectionMinute:"", EndVersePageSecond:"",
                            Source_Explanation:"", StatusType:1};
                        var rowId = $.jgrid.randId(); // new row ID

                        $("#sourceQuotedGrid").jqGrid('addRowData', rowId, newData);
                        $("#sourceQuotedGrid").jqGrid('setSelection',rowId);

                    },
                    position:"first"
                })
                .navButtonAdd('#sourceQuotedGridPager',{
                    caption:"Del",
                    buttonicon:"ui-icon-del",
                    onClickButton: function(){

                        var rowId = sourceQuotedGrid.jqGrid ('getGridParam', 'selrow');
                        var sourcequotedId = sourceQuotedGrid.jqGrid ('getCell', rowId, 'Source_QuotedId');
                        if(sourcequotedId != null) {

                            $.ajax({
                                url: "{!! route('deletesourcequoted') !!}",
                                type: 'POST',
                                data: {Source_QuotedId: sourcequotedId, '_token':"{{ csrf_token() }}"},
                                async: false,
                                success: function(data, result) {
                                    alert(data.msg);
                                    sourceQuotedGrid.trigger('reloadGrid');
                                    lastSelection = null;
                                }
                            });
                        }
                    },
                    position:"last"
                });
            }

            function editSourceQuotedRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('updatesourcequoted') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSaveSourceQuoted,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                };

                if (id && id !== lastSelection) {
                    var grid = $("#sourceQuotedGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcAfterSaveSourceQuoted() {
                lastSelection = null;
                $("#sourceQuotedGrid").trigger('reloadGrid');
            }


            //load grid for quotation
            function loadQuotationGrid() {
                var quotationGrid = $("#quotationGrid").jqGrid({
                    url: "{!! route('quotations') !!}",
                    datatype: "json",
                    colModel: [
                        { label: 'QuotationId', name: 'QuotationId', key:true, width:  20},
                        { label: 'Quotation', name: 'Quotation', editable: true, width: 150},
                        { label: 'StatusType', name: 'StatusType', editable: true, width: 20,
                            edittype:'select',
                            editoptions:{
                                value:getStatusTypes(),
                                defaultValue:this,
                                dataEvents: [
                                    { type: 'change', fn: function(e) {funcOnChangeStatusType(this); } },
                                ]
                            }
                        },
                        { label: 'EntryDate', name: 'EntryDate', editable: false, width: 30},
                        { label: 'StatusTypeId', name: 'StatusTypeId', editable: false, hidden: true }
                    ],
                    onSelectRow: editQuotationRow,
                    ondblClickRow: function(rowId) {

                        var quotationId = $("#quotationGrid").jqGrid ('getCell', rowId, 'QuotationId');
                        if(quotationId != null) {
                            $('#QuotationId').val(quotationId);
                            $('#Quotation').val($('#'+quotationId+'_Quotation').val());

                            //validate inpu form and make submit button is clickable
                            validateNewStandard();
                            $("#dialogGrids").dialog('close');
                        }
                    },
                    viewrecords: true, // show the current page, data rang and total records on the toolbar
                    width: 960,
                    height: 'auto',
                    rowNum: 15,
                    sortable: true,
                    pager: "#quotationGridPager",
                    gridview: true,
                    sortname: "Quotation",
                    caption:'Quotations'
                }).navGrid('#quotationGridPager',{edit:false,add:false,del:false,search:true})
                .navButtonAdd('#quotationGridPager',{
                    caption:"Add",
                    buttonicon:"ui-icon-add",
                    onClickButton: function(){

                        var newData = { QuotationId:"new", Quotation:"", StatusType:"6" };
                        var rowId = $.jgrid.randId(); // new row ID

                        $("#quotationGrid").jqGrid('addRowData', rowId, newData);
                        $("#quotationGrid").jqGrid('setSelection',rowId);

                    },
                    position:"last"
                })
                .navButtonAdd('#quotationGridPager',{
                    caption:"Del",
                    buttonicon:"ui-icon-del",
                    onClickButton: function(){
                        var rowId = quotationGrid.jqGrid ('getGridParam', 'selrow');
                        var quotationId = quotationGrid.jqGrid ('getCell', rowId, 'QuotationId');
                        if(quotationId != null) {

                            $.ajax({
                                url: "{!! route('delete_quotation') !!}",
                                type: 'POST',
                                data: {QuotationId: quotationId, '_token':"{{ csrf_token() }}"},
                                async: false,
                                success: function(data, result) {
                                    alert(data.msg);
                                    quotationGrid.trigger('reloadGrid');
                                    lastSelection = null;
                                }
                            });
                        }
                    },
                    position:"last"
                });
            }

            function editQuotationRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('update_quotation') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSaveQuotation,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                }

                if (id && id !== lastSelection) {
                    var grid = $("#quotationGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcAfterSaveQuotation() {
                lastSelection = null;
                $("#quotationGrid").trigger('reloadGrid');
            }


            //Load grid for Era
            function loadEraGrid() {
                var eraYears;
                $.ajax({
                    url: "{!!route('era_years') !!}",
                    async: false,
                    success: function(data, result) {
                        eraYears = data;
                        if (!result) alert('Failure to retrieve the Countries.');
                    }
                });
                var eraGrid = $("#eraGrid").jqGrid({
                    url: "{!! route('eras') !!}",
                    datatype: "json",
                    colModel: [
                        { label: 'EraId', name: 'EraId', key:true, width:30, align:'center'},
                        { label: 'Era', name: 'Era', editable: true, width:100},
                        { label: 'Begin Year', name: 'BeginYear', editable: true, width:50, align:'center',
                            edittype:'select',
                            editoptions:{
                                value:eraYears,
                                defaultValue:this
                            }
                        },
                        { label: 'End Year', name: 'EndYear', editable: true, width:50, align:'center',
                            edittype:'select',
                            editoptions:{
                                value:eraYears,
                                defaultValue:this
                            }
                        },
                        { label: 'Era_Explanation', name: 'Era_Explanation', editable: true}
                    ],
                    caption:'Eras',
                    pager: "#eraGridPager",
                    width: 960,
                    height: 'auto',
                    rowNum: 15,
                    sortable: true,
                    sortname: "Era",
                    viewrecords: true, // show the current page, data rang and total records on the toolbar
                    gridview: true,
                    onSelectRow: editEraRow,
                    ondblClickRow: function(rowId) {

                        var eraId = $("#eraGrid").jqGrid ('getCell', rowId, 'EraId');
                        if(eraId != null) {
                            $('#EraId').val(eraId);
                            $('#Era').val($('#'+eraId+'_Era').val());

                            //validate inpu form and make submit button is clickable
                            validateNewStandard();
                            $("#dialogGrids").dialog('close');
                        }
                    }
                }).navGrid('#eraGridPager',{edit:false,add:false,del:false,search:false})
                .navButtonAdd('#eraGridPager',{
                    caption:"Add",
                    buttonicon:"ui-icon-add",
                    onClickButton: function(){
                        var newData= {EraId:"new",Era:"",BeginYear:"",EndYear:"",Era_Explanation:""};
                        var rowId = $.jgrid.randId(); // new row ID
                        $("#eraGrid").jqGrid('addRowData', rowId, newData);
                        $("#eraGrid").jqGrid('setSelection',rowId);
                    },
                    position:"last"
                })
                .navButtonAdd('#eraGridPager',{
                    caption:"Del",
                    buttonicon:"ui-icon-del",
                    onClickButton: function(){

                        var rowId = eraGrid.jqGrid ('getGridParam', 'selrow');
                        var eraId = eraGrid.jqGrid ('getCell', rowId, 'EraId');
                        if(eraId != null) {
                            $.ajax({
                                url: "{!!route('delete_era') !!}",
                                type: 'POST',
                                data: {EraId: eraId, '_token':"{{ csrf_token() }}"},
                                async: false,
                                success: function(data, result) {
                                    alert(data.msg);
                                    eraGrid.trigger('reloadGrid');
                                    lastSelection = null;
                                }
                            });
                        }
                    },
                    position:"last"
                });
            }

            function editEraRow(id) {
                var editparameters = {
                    "keys" : true,
                    "oneditfunc" : null,
                    "successfunc" : null,
                    "url" : "{!! route('update_era') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSaveEra,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                };

                if (id && id !== lastSelection) {
                    $("#eraGrid").jqGrid('restoreRow',lastSelection);
                    $("#eraGrid").jqGrid('editRow',id, editparameters );
                    lastSelection = id;
                }
            }

            function funcAfterSaveEra() {
                $("#eraGrid").trigger('reloadGrid');
                lastSelection = null;
            }




            // action on key up
            $(document).keyup(function(e) {
                if(e.which == 17) {
                    isCtrl = false;
                }
                if(e.which == 16) {
                    isShift = false;
                }
            });
            // action on key down
            $(document).keydown(function(e) {
                if(e.which == 17) {
                    isCtrl = true;
                }
                if(e.which == 16) {
                    isShift = true;
                }
                if(e.which == 120 && isCtrl && isShift) {
                    alert('');
                }
            });

        });

        function loadEras() {
            $.ajax({
                url: "{!!route('eras_for_combobox') !!}",
                async: false,
                success: function(data, result) {
                    eras = data;
                    if (!result) alert('Failure to retrieve the Countries.');
                }
            });
        }

        function loadCategories() {
            $.ajax({
                url: "{!!route('category_for_combobox') !!}",
                async: false,
                success: function(data, result) {
                    categories = data;
                    if (!result) alert('Failure to retrieve the Countries.');
                }
            });
        }

        function loadSubcategories() {
            $.ajax({
                url: "{!!route('subcategory_for_combobox') !!}",
                async: false,
                success: function(data, result) {
                    subCategories = data;
                    if (!result) alert('Failure to retrieve the Countries.');
                }
            });
        }


        function getStatusTypes() {
            var statusTypes;
            $.ajax({
                url: "{!! route('statustypes') !!}",
                async: false,
                success: function(data, result) {
                    statusTypes = data;
                    if (!result) alert('Failure to retrieve the Status Types.');
                }
            });

            return statusTypes;
        }

        function getPublishers() {
            var publishers;
            $.ajax({
                url: "{!! route('publishers') !!}",
                async: false,
                success: function(data, result) {
                    publishers = data;
                    if (!result) alert('Failure to retrieve the Publishers.');
                }
            });

            return publishers;
        }

        function getSourceTypes() {
            var sourceTypes;

            $.ajax({
                url: "{!! route('sourcetypes') !!}",
                async: false,
                success: function(data, result) {
                    sourceTypes = data;
                    if (!result) alert('Failure to retrieve the Source Types.');
                }
            });

            return sourceTypes;
        }

        function getSources() {
            var sources;
            $.ajax({
                url: "{!! route('getsources_quoted') !!}",
                async: false,
                success: function(data, result) {
                    sources = data;
                    if (!result) alert('Failure to retrieve the Status Types.');
                }
            });
            return sources;
        }

        function validateNewStandard() {
            var subcategoryId = $('#SubcategoryId').val();
            var summaryId = $('#SummaryId').val();
            var sourceQuotedId = $('#Source_QuotedId').val();
            var eraId = $('#EraId').val();
            var quotationId = $('#QuotationId').val();

            if(subcategoryId != '' && summaryId != '' && sourceQuotedId != '' &&
                eraId != '' && quotationId != '') {
                $('#btnSubmit').prop("disabled", false);
            }
        }


    </script>
@endsection
