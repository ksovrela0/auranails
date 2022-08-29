function maxLengthCheck(object)
{
    if (object.value.length > object.maxLength)
        object.value = object.value.slice(0, object.maxLength)
}
function new_writing(order_id = '',personal_id='',hour='',minute=''){
    let cal_date = $("#cal_date").val();
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_edit_page",
            id: order_id,
            personal_id: personal_id,
            hour: hour,
            minute: minute,
            cal_date: cal_date
        },
        dataType: "json",
        success: function(data) {
            $('#get_edit_page').html(data.page);
            $("#personal,#statuses,#cabinet,#client_sex").chosen();
            $("#order_date").datetimepicker({
                timepicker:false,
                format:'Y-m-d',
            });
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
            $( "#client_name" ).autocomplete({
                source: "server-side/writes.action.php?act=find_client",
                minLength: 2,
                select: function( event, ui ) {
                    $("#client_id").val(ui.item.id);
                    $("#client_name").val(ui.item.value);
                    $("#client_phone").val(ui.item.client_phone);
                    $("#client_sex").val(ui.item.client_sex);
                    $("#client_sex").trigger("chosen:updated");
                }
            });
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
            act: "get_product_page",
            order_id: $("#writing_id").val()
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

            let hour = $("#pr_hour").val();
            let minute = $("#pr_minute").val();

            if(minute == '0'){
                minute = '00';
            }

            let write_time = hour+':'+minute;

            if($("#procedure_start").val() == ''){
                $("#procedure_start").val(write_time);
            }
            

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
    var actions = '<div id="new_product">დამატება</div>';
    var editType = "popup"; // Two types "popup" and "inline"
    var itemPerPage = 100;
    var columnsCount = 9;
    var columnsSQL = ["id2:string", "name_product:string", "proc_start:string", "proc_duration:string", "picture:string", "price:string", "reservation:string", "proc_status:string", "action:string"];
    var columnGeoNames = ["ID", "დასახელება", "დაწყება", "ხანგძლივობა", "შემსრულებელი", "ფასი", "რეზერვი", "სტატუსი", "ქმედება"];
    var showOperatorsByColumns = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var selectors = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var locked = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var lockable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var filtersCustomOperators = '{"date":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}, "number":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}}';
    //KendoUI CLASS CONFIGS END
    const kendo = new kendoUI();
    kendo.loadKendoUI(aJaxURL, 'get_list_product', itemPerPage, columnsCount, columnsSQL, gridName, actions, editType, columnGeoNames, filtersCustomOperators, showOperatorsByColumns, selectors, hidden, 1, locked, lockable);
}

function LoadKendoTable_reserve(hidden) {
    //KendoUI CLASS CONFIGS BEGIN
    var aJaxURL = "server-side/writes.action.php";
    var gridName = 'reserve_div';
    var actions = '<div id="take_from_reserve">რეზერვიდან გამოყვანა</div>';
    var editType = "popup"; // Two types "popup" and "inline"
    var itemPerPage = 100;
    var columnsCount = 9;
    var columnsSQL = ["id2:string", "client_name:string", "client_sex:string", "client_phone:string", "procedure:string", "personal:string", "reservation:string", "write_date2:string", "duration:string"];
    var columnGeoNames = ["ID", "კლიენტი", "ტელეფონი", "სქესი", "პროცედურა", "შემსრულებელი", "რეზერვაციის თარიღი", "ჩაწერის თარიღი", "ხანგძლივობა"];
    var showOperatorsByColumns = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var selectors = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var locked = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var lockable = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var filtersCustomOperators = '{"date":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}, "number":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}}';
    //KendoUI CLASS CONFIGS END
    const kendo = new kendoUI();
    kendo.loadKendoUI(aJaxURL, 'get_list_reserve', itemPerPage, columnsCount, columnsSQL, gridName, actions, editType, columnGeoNames, filtersCustomOperators, showOperatorsByColumns, selectors, hidden, 1, locked, lockable);
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
    params.client_id = $("#client_id").val();

    var ready_to_save = 0;
    if(params.client_id == '') {
        alert('გთხოვთ აირჩიოთ კლიენტი ან დაამატოთ ახალი');
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
                    loadCalendar($("#cal_date").val(),'vertical', grand_minutes);
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
    params.order_date = $("#order_date").val();
    params.salary_percent = $("#salary_percent").val();
    params.start_proc = $("#procedure_start").val();

    var ready_to_save = 0;

    if(params.procedure_cat_id == '' || params.procedure_cat_id == '0'){
        alert('აირჩიეთ პროცედურა!');
        ready_to_save++;
    }
    console.log(params.personal_id)
    if(params.personal_id == '' || params.personal_id == '0' ||  params.personal_id == null){
        alert('აირჩიეთ შემსრულებელი!');
        ready_to_save++;
    }
    if(params.start_proc == ''){
        alert('შეიყვანეთ დაწყების დრო');
        ready_to_save++;
    }
    if(params.duration == ''){
        alert('შეიყვანეთ ხანგძლივობა');
        ready_to_save++;
    }
    if(params.price == ''){
        alert('შეიყვანეთ ფასი');
        ready_to_save++;
    }
    if(params.salary_percent == ''){
        alert('შეიყვანეთ ხელფასი');
        ready_to_save++;
    }

    if(ready_to_save == 0) {
        $.ajax({
            url: "server-side/writes.action.php",
            type: "POST",
            data: params,
            dataType: "json",
            success: function(data) {
                if(data.error != ''){
                    let addToReserve = confirm(data.error);

                    if(addToReserve){
                        params.act = 'add_to_reserve';
                        $.ajax({
                            url: "server-side/writes.action.php",
                            type: "POST",
                            data: params,
                            dataType: "json",
                            success: function(data) {
                                if(data.error == ''){
                                    alert("პროცედურა დამატებულია რეზერვში");

                                    $("#product_div").data("kendoGrid").dataSource.read();
                                    $('#get_product_page').dialog("close");
                                    try{
                                        loadCalendar($("#cal_date").val(),'vertical', grand_minutes);
                                    }
                                    catch{
                                        
                                    }

                                }
                            }
                        });
                    }
                }
                else{
                    $("#product_div").data("kendoGrid").dataSource.read();
                    $('#get_product_page').dialog("close");
                    try{
                        loadCalendar($("#cal_date").val(),'vertical', grand_minutes);
                    }
                    catch{
                        
                    }
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
            $("#order_date").datetimepicker({
                timepicker:false,
                format:'Y-m-d',
            });
            $("#start_proc,#end_proc").timepicker({
                uiLibrary: 'bootstrap4'
            });
            var kendo = new kendoUI();
            $( "#client_name" ).autocomplete({
                source: "server-side/writes.action.php?act=find_client",
                minLength: 2,
                select: function( event, ui ) {
                    $("#client_id").val(ui.item.id);
                    $("#client_name").val(ui.item.value);
                    $("#client_phone").val(ui.item.client_phone);
                    $("#client_sex").val(ui.item.client_sex);
                    $("#client_sex").trigger("chosen:updated");
                }
            });
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

$(document).on('click', '.del_procedure', function(){
    let proc_id = $(this).attr('data-id');

    var ask = confirm("ნამდვილად გსურთ პროცედურის გაუქმება?");
    if(ask){
        $.ajax({
            url: "server-side/writes.action.php",
            type: "POST",
            data: {
                act: "disable",
                type: "procedure",
                id: proc_id
            },
            dataType: "json",
            success: function(data) {
                $("#product_div").data("kendoGrid").dataSource.read();
                try{
                    loadCalendar($("#cal_date").val(),'vertical', grand_minutes);
                }
                catch{
                    
                }

                if(data.reserve_procedures > 0){
                    let unReserve = confirm("თქვენ გაქვთ "+data.reserve_procedures+" პროცედურა/ჩაწერა რეზერვში. გსურთ რომელიმე პროცედურის/ჩაწერის რეზერვიდან გამოყვანა?");

                    if(unReserve){

                        $.ajax({
                            url: "server-side/writes.action.php",
                            type: "POST",
                            data: {
                                act: "get_reserve_page"
                            },
                            dataType: "json",
                            success: function(data) {
                                $('#get_reserve_page').html(data.page);
                                LoadKendoTable_reserve();
                                $("#get_reserve_page").dialog({
                                    resizable: false,
                                    height: 800,
                                    width: 1200,
                                    modal: true,
                                    buttons: {
                                        'დახურვა': function() {
                                            $(this).dialog("close");
                                        }
                                    }
                                });
                            }
                        });

                    }
                }
            }
        });
    }
});

$(document).on('click', '#take_from_reserve', function(){
    var grid = $("#reserve_div").data("kendoGrid");
    var selectedRows = grid.select();
    var proc_id;
    selectedRows.each(function(index, row) {
        var selectedItem = grid.dataItem(row);
        proc_id = selectedItem.id2;
    });
    if(typeof proc_id == 'undefined') {
        alert('აირჩიეთ მხოლოდ 1 პროცედურა');
    }
    else{
        $.ajax({
            url: "server-side/writes.action.php",
            type: "POST",
            data: {
                act: "get_reserve_from_page",
                proc_id: proc_id
            },
            dataType: "json",
            success: function(data) {
                $('#get_reserve_from_page').html(data.page);
    
                $("#personal_id_reserve").chosen();
                $("#write_date_reserve").datetimepicker({
                    timepicker:false,
                    format:'Y-m-d',
                });
                $("#start_proc_reserve").datetimepicker({
                    datepicker:false,
                    format:'H:i',
                    step: 15
                });
                $("#get_reserve_from_page").dialog({
                    resizable: false,
                    height: 400,
                    width: 600,
                    modal: true,
                    buttons: {
                        'გააქტიურება': function() {
                            $.ajax({
                                url: "server-side/writes.action.php",
                                type: "POST",
                                data: {
                                    act: "take_from_reserve",
                                    proc_id: $("#proc_id_reserve").val(),
                                    personal_id: $("#personal_id_reserve").val(),
                                    write_date: $("#write_date_reserve").val(),
                                    start_proc: $("#start_proc_reserve").val(),
                                    duration: $("#duration_reserve").val(),
                                    order_id: $("#order_id_reserve").val(),
                                },
                                dataType: "json",
                                success: function(data) {
                                    if(data.error == ''){
                                        $("#get_reserve_from_page").dialog("close");
                                        $("#product_div").data("kendoGrid").dataSource.read();
                                        $("#reserve_div").data("kendoGrid").dataSource.read();
                                        try{
                                            loadCalendar($("#cal_date").val(),'vertical', grand_minutes);
                                        }
                                        catch{
                                            
                                        }
                                    }
                                    else{
                                        alert(data.error)
                                    }
                                    

                                    
                                }
                            });
                        },
                        'დახურვა': function() {
                            $(this).dialog("close");
                        }
                    }
                });
            }
        });
    }
    

});

function save_new_client(){


    let ready_to_save = 0;
    if($("#client_name_new").val() == ''){
        alert('გთხოვთ შეიყვანოთ კლიენტის სახელი');
        ready_to_save++;
    }
    if($("#client_phone_new").val() == ''){
        alert('გთხოვთ შეიყვანოთ კლიენტის ტელეფონი');
        ready_to_save++;
    }
    if($("#client_phone_new").val().length < 9){
        alert('არასწორი ტელეფონი');
        ready_to_save++;
    }
    if(ready_to_save == 0){
        $.ajax({
            url: "server-side/writes.action.php",
            type: "POST",
            data: {
                act: "save_new_client",
                id: $("#new_client_id").val(),
                client_name: $("#client_name_new").val(),
                client_sex: $("#client_sex_new").val(),
                client_phone: $("#client_phone_new").val(),
                send_sms: $("#get_system_sms").is(':checked')
            },
            dataType: "json",
            success: function(data) {
                if(data.error == ''){
                    try{
                        $("#get_client_page").dialog("close");
                        $("#client_id").val($("#new_client_id").val())
                        $("#client_name").val($("#client_name_new").val())
                        $("#client_phone").val($("#client_phone_new").val())
                        $("#client_sex").val($("#client_sex_new").val())
                        $("#client_sex").trigger("chosen:updated");
                        $("#clients_div").data("kendoGrid").dataSource.read();
                    }
                    catch{
    
                    }
                    
                }
                else{
                    alert(data.error)
                }
                
    
                
            }
        });
    }
    
}
$(document).on('click', '#add_new_client', function(){
    $.ajax({
        url: "server-side/writes.action.php",
        type: "POST",
        data: {
            act: "get_client_page"
        },
        dataType: "json",
        success: function(data) {
            $('#get_client_page').html(data.page);
            $("#client_sex_new").chosen();
            $("#get_client_page").dialog({
                resizable: false,
                height: 350,
                width: 800,
                modal: true,
                buttons: {
                    'შენახვა': function() {
                        save_new_client();
                    },
                    'დახურვა': function() {
                        $(this).dialog("close");
                    }
                }
            });
        }
    });
});