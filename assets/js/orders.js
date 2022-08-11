function new_writing(){
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_edit_page"
        },
        dataType: "json",
        success: function(data) {
            $('#get_edit_page').html(data.page);
            $("#personal,#statuses,#cabinet,#client_sex").chosen();
            $("#order_date").datetimepicker();
            /* $(document).on('click', '#sex_set label', function() {
                var sex_id = $(this).prev().val();
                var kendo = new kendoUI();
                var multiselect = $("#zones").data("kendoMultiSelect");
                $(".k-content").html('');
                $(".k-content").append('<select id="zones" style="width: 100% !important; font-size: 12px;"></select>');
                if(sex_id == 1) {
                    kendo.kendoMultiSelector('zones', 'server-side/writes.action.php', 'get_selected_zones_female', "აირჩით ზონები", data.selectedZones);
                } else if(sex_id == 2) {
                    kendo.kendoMultiSelector('zones', 'server-side/writes.action.php', 'get_selected_zones_male', "აირჩით ზონები", data.selectedZones);
                }
                var multiselect = $("#zones").data("kendoMultiSelect");
                multiselect.bind("change", reloadImpulses);
            }); */
            var pr = "&order_id="+$("#writing_id").val();
            LoadKendoTable_product(pr);
            $("#get_edit_page").dialog({
                resizable: false,
                height: "auto",
                width: 1200,
                modal: true,
                buttons: {
                    "შენახვა": function() {
                        save_order();
                    },
                    'დახურვა': function() {
                        $(this).dialog("close");
                    }
                }
            });
        }
    });
}
function new_product(){
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_product_page"
        },
        dataType: "json",
        success: function(data) {
            $('#get_product_page').html(data.page);
            var kendo = new kendoUI();
            $("#procedure_cat,#personal_id").chosen();
            $("#duration").timepicker({
                uiLibrary: 'bootstrap4'
            });
            $("#get_product_page").dialog({
                resizable: false,
                height: 400,
                width: 1100,
                modal: true,
                buttons: {
                    "შენახვა": function() {
                        //save_product();
                    },
                    'დახურვა': function() {
                        $(this).dialog("close");
                    }
                }
            });
        }
    });
}
$(document).on('click', '#new_product', function(){
    
});
$(document).on("change", "#procedure_cat", function(){
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_procedure_data",
            id: $("#procedure_cat").val()
        },
        dataType: "json",
        success: function(data) {
            $("#duration").val(data.duration);
            $("#price").val(data.price);
            $("#salary_fix").val(0);

        }
    });
});


function LoadKendoTable_product(hidden) {
    //KendoUI CLASS CONFIGS BEGIN
    var aJaxURL = "server-side/writes.action.php";
    var gridName = 'product_div';
    var actions = '<div id="new_product">დამატება</div><div id="copy_product">კოპირება</div><div id="del_product"> წაშლა</div>';
    var editType = "popup"; // Two types "popup" and "inline"
    var itemPerPage = 100;
    var columnsCount = 5;
    var columnsSQL = ["id2:string", "name_product:string", "glass_count:string", "picture:string", "action:string"];
    var columnGeoNames = ["ID", "დასახელება", "ხანგძლივობა", "შემსრულებელი", "ფასი"];
    var showOperatorsByColumns = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var selectors = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var locked = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var lockable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var filtersCustomOperators = '{"date":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}, "number":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}}';
    //KendoUI CLASS CONFIGS END
    const kendo = new kendoUI();
    kendo.loadKendoUI(aJaxURL, 'get_list_product', itemPerPage, columnsCount, columnsSQL, gridName, actions, editType, columnGeoNames, filtersCustomOperators, showOperatorsByColumns, selectors, hidden, 1, locked, lockable);
}