function new_writing(order_id = '',personal_id='',hour='',minute=''){
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_edit_page",
            id: order_id
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
            $("#duration,#procedure_start").datetimepicker({
                datepicker:false,
                step: 15,
                format:'H:i',
            });
            $("#get_product_page").dialog({
                resizable: false,
                height: 400,
                width: 1100,
                modal: true,
                buttons: {
                    "შენახვა": function() {
                        save_product();
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
    new_product();
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

            $("#personal_id").html(data.personal);

            $("#personal_id").trigger("chosen:updated");

        }
    });
});

$(document).on('change', '#personal_id', function(){
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_personal_interest",
            id: $(this).val()
        },
        dataType: "json",
        success: function(data) {
            $("#salary_percent").val(data.salary);
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
    var columnsCount = 6;
    var columnsSQL = ["id2:string", "name_product:string", "proc_start:string", "proc_duration:string", "picture:string", "action:string"];
    var columnGeoNames = ["ID", "დასახელება", "დაწყება", "ხანგძლივობა", "შემსრულებელი", "ფასი"];
    var showOperatorsByColumns = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var selectors = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var locked = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var lockable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var filtersCustomOperators = '{"date":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}, "number":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}}';
    //KendoUI CLASS CONFIGS END
    const kendo = new kendoUI();
    kendo.loadKendoUI(aJaxURL, 'get_list_product', itemPerPage, columnsCount, columnsSQL, gridName, actions, editType, columnGeoNames, filtersCustomOperators, showOperatorsByColumns, selectors, hidden, 1, locked, lockable);
}

function save_order() {
    let params = new Object;

    params.act = 'save_order';
    params.id = $("#writing_id").val();
    params.client_name = $("#client_name").val();
    params.client_sex = $("#client_sex").val();
    params.client_phone = $("#client_phone").val();
    params.order_date = $("#order_date").val();
    params.start_proc = $("#start_proc").val();
    params.end_proc = $("#end_proc").val();
    params.client_comment = $("#client_comment").val();

    var ready_to_save = 0;
    if(params.client_name == '') {
        alert('შეიყვანეთ კლიენტის სახელი');
        ready_to_save++;
    }
    if(params.client_phone == '') {
        alert('შეიყვანეთ კლიენტის ნომერი');
        ready_to_save++;
    }

    if(ready_to_save == 0) {
        $.ajax({
            url: "server-side/writes.action.php",
            type: "POST",
            data: params,
            dataType: "json",
            success: function(data) {
                try{
                    $("#main_div").data("kendoGrid").dataSource.read();
                }
                catch{

                }
                
                $('#get_edit_page').dialog("close");

                try{
                    loadCalendar();
                }
                catch{

                }
            }
        });
    }
}

function save_product() {
    let params = new Object;

    params.act = 'save_procedure';
    params.proc_id = $("#procedure_id").val();
    params.order_id = $("#writing_id").val();
    params.procedure_cat_id = $("#procedure_cat").val();
    params.personal_id = $("#personal_id").val();
    params.duration = $("#duration").val();
    params.price = $("#price").val();
    params.salary_percent = $("#salary_percent").val();
    params.start_proc = $("#procedure_start").val();

    var ready_to_save = 0;


    if(ready_to_save == 0) {
        $.ajax({
            url: "server-side/writes.action.php",
            type: "POST",
            data: params,
            dataType: "json",
            success: function(data) {
                $("#product_div").data("kendoGrid").dataSource.read();
                $('#get_product_page').dialog("close");
                try{
                    loadCalendar();
                }
                catch{
                    
                }
            }
        });
    }
}

$(document).on("dblclick", "#main_div tr.k-state-selected", function() {
    var grid = $("#main_div").data("kendoGrid");
    var dItem = grid.dataItem($(this));
    if(dItem.id == '') {
        return false;
    }
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_edit_page",
            id: dItem.id
        },
        dataType: "json",
        success: function(data) {
            $('#get_edit_page').html(data.page);
            $("#personal,#statuses,#cabinet,#client_sex").chosen();
            GetDate("order_date");
            $("#start_proc,#end_proc").timepicker({
                uiLibrary: 'bootstrap4'
            });
            var kendo = new kendoUI();
            /* var sex_id = $("input[name='sex_id']:checked").val();
            $.ajax({
                url: "server-side/writes.action.php",
                type: "POST",
                data: {
                    act: "get_selected_zones",
                    id: dItem.id
                },
                dataType: "json",
                success: function(data) {
                    if(sex_id == 1) {
                        kendo.kendoMultiSelector('zones', 'server-side/writes.action.php', 'get_selected_zones_female', "აირჩით ზონები", data.selectedZones);
                    } else if(sex_id == 2) {
                        kendo.kendoMultiSelector('zones', 'server-side/writes.action.php', 'get_selected_zones_male', "აირჩით ზონები", data.selectedZones);
                    }
                    var multiselect = $("#zones").data("kendoMultiSelect");
                    multiselect.bind("change", reloadImpulses);
                }
            }); */
            var pr = "&order_id="+dItem.id;
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
});

$(document).on("dblclick", "#product_div tr.k-state-selected", function() {
    var grid = $("#product_div").data("kendoGrid");
    var dItem = grid.dataItem($(this));
    if(dItem.id == '') {
        return false;
    }
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_product_page",
            id: dItem.id2
        },
        dataType: "json",
        success: function(data) {
            $('#get_product_page').html(data.page);
            $("#procedure_cat,#personal_id").chosen();
            $("#duration,#procedure_start").datetimepicker({
                datepicker:false,
                step: 15,
                format:'H:i',
            });
            $("#get_product_page").dialog({
                resizable: false,
                height: 400,
                width: 1100,
                modal: true,
                buttons: {
                    "შენახვა": function() {
                        save_product();
                    },
                    'დახურვა': function() {
                        $(this).dialog("close");
                    }
                }
            });
        }
    });
});

$(document).on('click', '#del_product', function() {
    var grid = $("#product_div").data("kendoGrid");
    var selectedRows = grid.select();
    var writing_id;
    selectedRows.each(function(index, row) {
        var selectedItem = grid.dataItem(row);
        writing_id = selectedItem.id2;
    });
    if(typeof writing_id == 'undefined') {
        alert('აირჩიეთ პროდუქტი!!!');
    } else {
        var ask = confirm("ნამდვილად გსურთ პროდუქტის წაშლა?");
        if(ask){
            $.ajax({
                url: "server-side/writes.action.php",
                type: "POST",
                data: {
                    act: "disable",
                    type: "product",
                    id: writing_id
                },
                dataType: "json",
                success: function(data) {
                    $("#product_div").data("kendoGrid").dataSource.read();
                }
            });
        }
        
    }
});