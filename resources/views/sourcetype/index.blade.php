@extends('app')

@section('content')

    <table id="tblSource_Type"></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">

        $(document).ready(function () {

            var myGrid = $("#tblSource_Type").jqGrid({
                url: "{!! route('source_types') !!}",
                datatype: "json",
                colModel: [
                    { label: 'ID', name: 'Source_TypeId', key:true, width:30, align:'center'},
                    { label: 'Source Type', name: 'Source_Type', editable: true, width:100},
                    { label: 'Abbreviation', name: 'Source_Type_Abbreviation', editable: true, width:50}
                ],
                caption:'Source Type',
                pager: "#jqGridPager",
                width: $(window).width()-80,
                height: 'auto',
                rowNum: 15,
                sortable: true,
                sortname: "Source_TypeId",
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                gridview: true,
                onSelectRow: editRow

            }).navGrid('#jqGridPager',{edit:false,add:false,del:false,search:false})
              .navButtonAdd('#jqGridPager',{
                caption:"Add",
                buttonicon:"ui-icon-add",
                onClickButton: function(){

                    var newData= {Source_TypeId:"new",Source_Type:"",Source_Type_Abbreviation:"" };
                    var newRowId = $.jgrid.randId(); // new row ID

                    $("#tblSource_Type").jqGrid('addRowData', newRowId, newData);
                    $("#tblSource_Type").jqGrid('setSelection',newRowId);
                },
                position:"last"
            })
            .navButtonAdd('#jqGridPager',{
                caption:"Del",
                buttonicon:"ui-icon-del",
                onClickButton: function(){

                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                    var sourceTypeId = myGrid.jqGrid ('getCell', rowId, 'Source_TypeId');
                    if(sourceTypeId != null) {

                        $.ajax({
                            url: "{!!route('delete_source_type') !!}",
                            type: 'POST',
                            data: {Source_TypeId: sourceTypeId, '_token':"{{ csrf_token() }}"},
                            async: false,
                            success: function(data, result) {
                                if(data != null && data.msg != null)
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
                    "url" : "{!! route('update_source_type') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : null,
                    "errorfunc": null,
                    "afterrestorefunc" : null,
                    "restoreAfterError" : true,
                    "mtype" : "POST"
                };

                if (id && id !== lastSelection) {

                    myGrid.jqGrid('restoreRow',lastSelection);
                    myGrid.jqGrid('editRow',id, editparameters );

                    lastSelection = id;
                }
            }

            function funcSuccess(obj) {
                if(obj != null && obj.responseJSON != null)
                    alert(obj.responseJSON.msg);

                //refresh grid
                myGrid.trigger('reloadGrid');
                lastSelection = null;
            }
//            function funcAfterSave() {
//                myGrid.trigger('reloadGrid');
//                lastSelection = null;
//            }

            function isBCEditElement(value, editOptions) {
                var span = $("<span />");
                var label = $("<span />", { html: "BC" });
                var radio = $("<input>", { type: "radio", value: "true", name: "IsBC", id: "bc", checked: value == 'BC'});
                var label1 = $("<span />", { html: "AD" });
                var radio1 = $("<input>", { type: "radio", value: "false", name: "IsBC", id: "ad", checked: value == 'AD' });

                //<label class="radio-inline"><input type="radio" name="optradio">Option 1</label>
                span.append(label).append(radio).append(label1).append(radio1);

                return span;
            }

            // The javascript executed specified by JQGridColumn.EditTypeCustomGetValue when EditType = EditType.Custom
            // One parameter passed - the custom element created in JQGridColumn.EditTypeCustomCreateElement
            function isBCEditElementValue(elem, oper, value) {
                if (oper === "set") {
                    var radioButton = $(elem).find("input:radio[value='" + value + "']");
                    if (radioButton.length > 0) {
                        radioButton.prop("checked", true);
                    }
                }

                if (oper === "get") {
                    return $(elem).find("input:radio:checked").val();
                }
            }
        });

    </script>
@endsection

