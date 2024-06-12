@extends('app')

@section('content')

    <table id="tblEra_Year"><th></th></table>
    <div id="jqGridPager"></div>

    <script type="text/javascript">

        $(document).ready(function () {

            var myGrid = $("#tblEra_Year").jqGrid({
                url: "{!! route('erayears') !!}",
                datatype: "json",
                colModel: [
                    { label: 'ID', name: 'Era_YearId', key:true, width:30, align:'center'},
                    { label: 'Year', name: 'Year', editable: true, width:100},
                    { label: 'BC/AD', name: 'IsBC', editable: true, width:50, align:'center',
                        editable:true,
                        edittype:'custom',
                        editoptions: {custom_element: isBCEditElement, custom_value:isBCEditElementValue}
//                        edittype:'select',
//                        editoptions:{
//                            value:eraYears,
//                            defaultValue:this,
//                            dataEvents: [
////                                { type: 'focus', fn: function(e) { prevEra = $(this).val(); } },
////                                { type: 'change', fn: function(e) {funcOnChangeEra(this); } },
//                            ]
//                        }
                    }
                ],
                caption:'Era Years',
                pager: "#jqGridPager",
                width: $(window).width()-80,
                height: 'auto',
                rowNum: 15,
                sortable: true,
                sortname: "Era_YearId",
                viewrecords: true, // show the current page, data rang and total records on the toolbar
                gridview: true,
                onSelectRow: editRow

            }).navGrid('#jqGridPager',{edit:false,add:false,del:false,search:false})
              .navButtonAdd('#jqGridPager',{
                caption:"Add",
                buttonicon:"ui-icon-add",
                onClickButton: function(){

                    var newData= {Era_YearId:"new",Year:"",IsBC:"BC" };
                    var newRowId = $.jgrid.randId(); // new row ID

                    $("#tblEra_Year").jqGrid('addRowData', newRowId, newData);
                    $("#tblEra_Year").jqGrid('setSelection',newRowId);
                },
                position:"last"
            })
            .navButtonAdd('#jqGridPager',{
                caption:"Del",
                buttonicon:"ui-icon-del",
                onClickButton: function(){

                    var rowId = myGrid.jqGrid ('getGridParam', 'selrow');
                    var eraYearId = myGrid.jqGrid ('getCell', rowId, 'Era_YearId');
                    if(eraYearId != null) {

                        $.ajax({
                            url: "{!!route('delete_era_year') !!}",
                            type: 'POST',
                            data: {Era_YearId: eraYearId, '_token':"{{ csrf_token() }}"},
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
                    "url" : "{!! route('update_era_year') !!}",
                    "extraparam" : {'_token':"{{ csrf_token() }}"},
                    "aftersavefunc" : funcAfterSave,
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

            function funcAfterSave() {
                myGrid.trigger('reloadGrid');
                lastSelection = null;
            }

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
