<html lang="en">

<head>
	<style data-styles="">
	ion-icon {
		visibility: hidden
	}
	
	.hydrated {
		visibility: inherit
	}
	#ui-datepicker-div{
			z-index: 9999999!important;
		}
	</style>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="Dashlead -  Admin Panel HTML Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="sales dashboard, admin dashboard, bootstrap 4 admin template, html admin template, admin panel design, admin panel design, bootstrap 4 dashboard, admin panel template, html dashboard template, bootstrap admin panel, sales dashboard design, best sales dashboards, sales performance dashboard, html5 template, dashboard template">
	<!-- Favicon -->
	<link rel="icon" href="assets/img/brand/favicon.ico" type="image/x-icon">
	<!-- Title -->
	<title>Dashlead - Admin Panel HTML Dashboard Template</title>
	<!---Fontawesome css-->
	<?php include('includes/functions.php'); ?>
	
	<meta http-equiv="imagetoolbar" content="no">
	<style type="text/css">

	<style type="text/css" media="print">
	< !-- body {
		display: none
	}
	.k-grid-header th .k-grid-filter {
		top: 7px!important;
		right: 0!important;
	}
	.k-grid-header .k-header {
		position: relative!important;
		vertical-align: middle !important;
		cursor: default!important;
		
	}
	</style>
	<!--[if gte IE 5]><frame></frame><![endif]-->
	<script src="file:///C:/Users/giorgi/AppData/Local/Temp/Rar$EXa10780.17568/www.spruko.com/demo/dashlead/assets/plugins/ionicons/ionicons/ionicons.z18qlu2u.js" data-resources-url="file:///C:/Users/giorgi/AppData/Local/Temp/Rar$EXa10780.17568/www.spruko.com/demo/dashlead/assets/plugins/ionicons/ionicons/" data-namespace="ionicons"></script>
</head>

<body class="main-body">
	
	<!-- Start Switcher -->
	<?php include('includes/switcher.php'); ?>
	<!-- End Switcher -->
	<!-- Loader -->
	<div id="global-loader" style="display: none;"> <img src="assets/img/loader.svg" class="loader-img" alt="Loader"> </div>
	<!-- End Loader -->
	<!-- Page -->
	<div class="page">
		<!-- Sidemenu -->
		<?php include('includes/menu.php'); ?>
		<!-- End Sidemenu -->
		<!-- Main Content-->
		<div class="main-content side-content pt-0">
			<!-- Main Header-->
			<?php include('includes/header.php'); ?>
			<!-- End Main Header-->
			<div class="container-fluid">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5">SMS შაბლონები</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">მომხმარებლები და კომუნიკაცია</a></li>
							<li class="breadcrumb-item active" aria-current="page">SMS შაბლონები</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->
				<!-- Row -->
                <div class="row" style="margin-bottom:20px;">
                    
                    <div class="col-sm-6">
                        <p>{personalName} - <b>თანამშრომლის სახელი და გვარი ვისთანაც ჩაწერილია კლიენტი (მხოლოდ სისტემური)</b></p>
                        <p>{procedureName} - <b>პროცედურა რომელზეც ჩაწერილია კლიენტი (მხოლოდ სისტემური)</b></p>
                        <p>{procedureDate} - <b>პროცედურის თარიღი და დრო როდის არის ჩაწერილი კლიენტი (მხოლოდ სისტემური)</b></p>
                        <p>{procedureID} - <b>ჩაწერის/პროცედურის უნიკალური კოდი კლიენტისთვის (მხოლოდ სისტემური)</b></p>
                    </div>
                    <div class="col-sm-6">
                        <p>{clientFirstname} - <b>კლიენტის სახელი</b></p>
                        <p>{clientLastname} - <b>კლიენტის გვარი</b></p>
                        <p>{clientPhone} - <b>კლიენტის ტელეფონი</b></p>
                    </div>
                    <div class="col-sm-6">
                        <fieldset class="fieldset">
                            <legend>ახალი ჩაწერის შაბლონი</legend>
                            <textarea id="javshani_text" class="template_textarea"></textarea>
                            <a id="save_javshani" style="color:white;" data-id="1" class="btn ripple btn-primary new_add little_save">შენახვა</a>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset class="fieldset">
                            <legend>ჩაწერის ცვლილების შაბლონი</legend>
                            <textarea id="edit_text" class="template_textarea"></textarea>
                            <a id="save_edit" style="color:white;" data-id="2" class="btn ripple btn-primary new_add little_save">შენახვა</a>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset class="fieldset">
                            <legend>ჩაწერის შეხსენების შაბლონი</legend>
                            <textarea id="reminder_text" class="template_textarea"></textarea>
                            <a id="save_reminder" style="color:white;" data-id="3" class="btn ripple btn-primary new_add little_save">შენახვა</a>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset class="fieldset">
                            <legend>ჩაწერის გაუქმების შაბლონი</legend>
                            <textarea id="cancel_text" class="template_textarea"></textarea>
                            <a id="save_cancel" style="color:white;" data-id="4" class="btn ripple btn-primary new_add little_save">შენახვა</a>
                        </fieldset>
                    </div>
                </div>
				<div class="row">
					<div id="shablon_div"></div>
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Main Content-->
		<!-- Main Footer-->
		<div class="main-footer text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-12"> <span>Copyright © 2019 <a href="#">Dashlead</a>. Designed by <a href="https://www.spruko.com/">Spruko</a> All rights reserved.</span> </div>
				</div>
			</div>
		</div>
		<!--End Footer-->
	</div>
	<!-- End Page -->
	<!-- Back-to-top --><a href="#top" id="back-to-top" style="display: none;"><i class="fe fe-arrow-up"></i></a>
	<!-- Jquery js-->
	
	<div class="main-navbar-backdrop"></div>
	<div title="შაბლონი" id="get_temp_page">
		
	</div>
	<script>
	var aJaxURL = "server-side/templates.action.php";
	$(document).on("dblclick", "#shablon_div tr.k-state-selected", function () {
		var grid = $("#shablon_div").data("kendoGrid");
		var dItem = grid.dataItem($(this));
		
		if(dItem.id == ''){
			return false;
		}
		
		$.ajax({
			url: aJaxURL,
			type: "POST",
			data: {
				act: "get_temp_page",
				id: dItem.id
			},
			dataType: "json",
			success: function(data){
				$('#get_temp_page').html(data.page);

				$("#get_temp_page").dialog({
					resizable: false,
					height: "auto",
					width: 900,
					modal: true,
					buttons: {
						"შენახვა": function() {
							save_temp();
						},
						'დახურვა': function() {
							$( this ).dialog( "close" );
						}
					}
				});
			}
		});
	});
    $(document).on('click', '.little_save', function(){
        let id = $(this).attr('data-id');
        let text;
        if(id == 1){
            text = $('#javshani_text').val();
        }
        else if(id == 2){
            text = $('#edit_text').val();
        }
        else if(id == 3){
            text = $('#reminder_text').val();
        }
        else if(id == 4){
            text = $('#cancel_text').val();
        }

        if(text == ''){
            alert('გთხოვთ შეავსოთ სისტემური შაბლონის ტექსტი')
        }
        else{
            $.ajax({
                url: aJaxURL,
                type: "POST",
                data: "act=save_sys_temp&id="+id+"&text="+encodeURIComponent(text),
                dataType: "json",
                success: function (data) {
                    alert("შაბლონი შენახულია!!!");
                }
            });
        }

        

    })
	$(document).on('click','#add_new_temp',function(){
		$.ajax({
			url: aJaxURL,
			type: "POST",
			data: {
				act: "get_temp_page"
			},
			dataType: "json",
			success: function(data){
				$('#get_temp_page').html(data.page);

				$("#get_temp_page").dialog({
					resizable: false,
					height: "auto",
					width: 900,
					modal: true,
					buttons: {
						"შენახვა": function() {
							save_temp();
						},
						'დახურვა': function() {
							$( this ).dialog( "close" );
						}
					}
				});
			}
		});
	});
    function save_temp(){
        let params 			= new Object;
		params.act 			= 'save_temp';
		params.id 			= $("#temp_id").val();
		params.temp_title 	= $("#temp_title").val();
		params.temp_text 	= $("#temp_text").val();


		$.ajax({
			url: aJaxURL,
			type: "POST",
			data: params,
			dataType: "json",
			success: function(data){
				$("#shablon_div").data("kendoGrid").dataSource.read();
				$('#get_temp_page').dialog("close");
			}
		});
    }
	$(document).on('click','#delete_temp',function(){
		var removeIDS = [];
		var entityGrid = $("#shablon_div").data("kendoGrid");
		var rows = entityGrid.select();
		rows.each(function(index, row) {
			var selectedItem = entityGrid.dataItem(row);
			// selectedItem has EntityVersionId and the rest of your model
			removeIDS.push(selectedItem.id);
		});
		$.ajax({
			url: aJaxURL,
			type: "POST",
			data: "act=disable&id=" + removeIDS,
			dataType: "json",
			success: function (data) {
				$("#shablon_div").data("kendoGrid").dataSource.read();
			}
		});
	});
	$( document ).ready(function() {
		LoadKendoTable_incomming();

        $.ajax({
			url: aJaxURL,
			type: "POST",
			data: "act=get_system_temps",
			dataType: "json",
			success: function (data) {
				$('#javshani_text').html(data[1])
                $('#edit_text').html(data[2])
                $('#reminder_text').html(data[3])
                $('#cancel_text').html(data[4])
			}
		});
	});
    function LoadKendoTable_branches(hidden){

		//KendoUI CLASS CONFIGS BEGIN
		var aJaxURL	        =   "server-side/objects.action.php";
		var gridName        = 	'object_branches';
		var actions         = 	'<div class="btn btn-list"><a id="button_add" style="color:white;" class="btn ripple btn-primary"><i class="fas fa-plus-square"></i> დამატება</a><a id="button_trash" style="color:white;" class="btn ripple btn-primary"><i class="fas fa-trash"></i> გამორთვა</a></div>';
		var editType        =   "popup"; // Two types "popup" and "inline"
		var itemPerPage     = 	20;
		var columnsCount    =	5;
		var columnsSQL      = 	[
									"id:string",
									"name_geo:string",

									"work_h:string",
									"phone:string",
                                    "address:string"
								];
		var columnGeoNames  = 	[
									"ID", 
									"სახელი გვარი",
									"ტელეფონი",
									"სამუშაო გრაფიკი",
                                    "პერსონალის ხელფასი"
								];

		var showOperatorsByColumns  =   [0,0,0,0,0,0,0,0,0,0]; 
		var selectors               =   [0,0,0,0,0,0,0,0,0,0]; 

		var locked                  =   [0,0,0,0,0,0,0,0,0,0];
		var lockable                =   [0,0,0,0,0,0,0,0,0,0];

		var filtersCustomOperators = '{"date":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}, "number":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}}';
		//KendoUI CLASS CONFIGS END
			
		const kendo = new kendoUI();
		kendo.loadKendoUI(aJaxURL,'get_list_branches',itemPerPage,columnsCount,columnsSQL,gridName,actions,editType,columnGeoNames,filtersCustomOperators,showOperatorsByColumns,selectors,hidden, 1, locked, lockable);

	}
	function LoadKendoTable_incomming(hidden){

		//KendoUI CLASS CONFIGS BEGIN
		var aJaxURL	        =   "server-side/templates.action.php";
		var gridName        = 	'shablon_div';
		var actions         = 	'<div class="btn btn-list"><a id="add_new_temp" style="color:white;" class="btn ripple btn-primary new_add"><i class="fas fa-plus-square"></i> დამატება</a><a id="delete_temp" style="color:white;" class="btn ripple btn-primary new_del">წაშლა</a></div>';
		var editType        =   "popup"; // Two types "popup" and "inline"
		var itemPerPage     = 	20;
		var columnsCount    =	3;
		var columnsSQL      = 	[
									"id:string",
									"temp_name:string",

									"work_h:string"
								];
		var columnGeoNames  = 	[
									"ID", 
									"შაბლონის სახელი",
									"შაბლონის ტექსტი"
								];

		var showOperatorsByColumns  =   [0,0,0,0,0,0,0,0,0,0]; 
		var selectors               =   [0,0,0,0,0,0,0,0,0,0]; 

		var locked                  =   [0,0,0,0,0,0,0,0,0,0];
		var lockable                =   [0,0,0,0,0,0,0,0,0,0];

		var filtersCustomOperators = '{"date":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}, "number":{"start":"-დან","ends":"-მდე","eq":"ზუსტი"}}';
		//KendoUI CLASS CONFIGS END
			
		const kendo = new kendoUI();
		kendo.loadKendoUI(aJaxURL,'get_list_temp',itemPerPage,columnsCount,columnsSQL,gridName,actions,editType,columnGeoNames,filtersCustomOperators,showOperatorsByColumns,selectors,hidden, 1, locked, lockable);

	}
	$(document).on('click','#upload_img',function(){
		$("#upload_back_img").trigger('click');
	});
	$(document).on('change','#upload_back_img', function(e){

		//submit the form here
		//var name = $(".fileupchat").val();
		var file_data = $('#upload_back_img').prop('files')[0];
		var fileName = e.target.files[0].name;
		var fileNameN = Math.ceil(Math.random()*99999999999);
		var fileSize = e.target.files[0].size;
		var fileExt = $(this).val().split('.').pop().toLowerCase();
		var form_data = new FormData();
		var object_id = $("#object_id").val();
		form_data.append('act', 'upload_object_logo');
		form_data.append('file', file_data);
		form_data.append('ext', fileExt);
		form_data.append('original', fileName);
		form_data.append('newName', fileNameN);
		form_data.append('object_id', object_id);

		var fileExtension = ['jpg','png','jpeg'];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("დაუშვებელი ფორმატი!!!  გამოიყენეთ მხოლოდ: "+fileExtension.join(', '));
			$("#upload_back_img").val('');
		}
		else {

			if(fileSize>20971520) {
				alert("შეცდომა! ფაილის ზომა 20MB-ზე მეტია!!!");
				$(".upload_back_img").val('');
			}
			else{
				$.ajax({
				url: 'up.php', // point to server-side PHP script
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (data) {
					//$("#upload_back_img").val(data);
					console.log(data)
					$('#dialog_image_1').html('<img src="'+data+'"/>');
				}
				});
			}

		}
	});



	$(document).on('click','#upload_img_cat',function(){
		$("#upload_default_cat_img").trigger('click');
	});
	$(document).on('change','#upload_default_cat_img', function(e){

		//submit the form here
		//var name = $(".fileupchat").val();
		var file_data = $('#upload_default_cat_img').prop('files')[0];
		var fileName = e.target.files[0].name;
		var fileNameN = Math.ceil(Math.random()*99999999999);
		var fileSize = e.target.files[0].size;
		var fileExt = $(this).val().split('.').pop().toLowerCase();
		var form_data = new FormData();
		var object_id = $("#object_id").val();
		form_data.append('act', 'upload_object_default_cat');
		form_data.append('file', file_data);
		form_data.append('ext', fileExt);
		form_data.append('original', fileName);
		form_data.append('newName', fileNameN);
		form_data.append('object_id', object_id);

		var fileExtension = ['jpg','png','jpeg'];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("დაუშვებელი ფორმატი!!!  გამოიყენეთ მხოლოდ: "+fileExtension.join(', '));
			$("#upload_default_cat_img").val('');
		}
		else {

			if(fileSize>20971520) {
				alert("შეცდომა! ფაილის ზომა 20MB-ზე მეტია!!!");
				$(".upload_default_cat_img").val('');
			}
			else{
				$.ajax({
				url: 'up.php', // point to server-side PHP script
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (data) {
					//$("#upload_back_img").val(data);
					console.log(data)
					$('#dialog_image_2').html('<img src="'+data+'"/>');
				}
				});
			}

		}
	});


	$(document).on('click','#upload_img_product',function(){
		$("#upload_default_product_img").trigger('click');
	});
	$(document).on('change','#upload_default_product_img', function(e){

		//submit the form here
		//var name = $(".fileupchat").val();
		var file_data = $('#upload_default_product_img').prop('files')[0];
		var fileName = e.target.files[0].name;
		var fileNameN = Math.ceil(Math.random()*99999999999);
		var fileSize = e.target.files[0].size;
		var fileExt = $(this).val().split('.').pop().toLowerCase();
		var form_data = new FormData();
		var object_id = $("#object_id").val();
		form_data.append('act', 'upload_object_default_product');
		form_data.append('file', file_data);
		form_data.append('ext', fileExt);
		form_data.append('original', fileName);
		form_data.append('newName', fileNameN);
		form_data.append('object_id', object_id);

		var fileExtension = ['jpg','png','jpeg'];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			alert("დაუშვებელი ფორმატი!!!  გამოიყენეთ მხოლოდ: "+fileExtension.join(', '));
			$("#upload_default_product_img").val('');
		}
		else {

			if(fileSize>20971520) {
				alert("შეცდომა! ფაილის ზომა 20MB-ზე მეტია!!!");
				$(".upload_default_product_img").val('');
			}
			else{
				$.ajax({
				url: 'up.php', // point to server-side PHP script
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (data) {
					//$("#upload_back_img").val(data);
					console.log(data)
					$('#dialog_image_3').html('<img src="'+data+'"/>');
				}
				});
			}

		}
	});
	function save_personal(){
		let params 			= new Object;
		params.act 			= 'save_personal';
		params.id 			= $("#personal_id").val();
		params.firstname 	= $("#firstname").val();
		params.lastname 	= $("#lastname").val();
		params.phone		= $("#phone").val();
		params.salary 		= $("#salary").val();
		params.work_start 	= $("#work_start").val();
		params.work_end 	= $("#work_end").val();
		
		var grafik = [];
		$('#grafik option:selected').toArray().map(c => grafik.push(c.value));

		params.grafik 	= $("#grafik").val();
		$.ajax({
			url: aJaxURL,
			type: "POST",
			data: params,
			dataType: "json",
			success: function(data){
				$("#product_categories").data("kendoGrid").dataSource.read();
				$('#get_edit_page').dialog("close");
			}
		});
		
	}
	</script>
</body>

</html>