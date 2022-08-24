<html lang="en">

<head>
	<style data-styles="">
	ion-icon {
		visibility: hidden
	}
	
	.hydrated {
		visibility: inherit
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
	.chosen-container {
		width: 95% !important;
	}
	.badge{
		width: 100%!important;
	}
	.courier_start_order{
		border: 1px solid black;
		width: 155px;
		margin: 0 auto;
		margin-top: 10px;
		margin-bottom: 10px;
		background-color: #74a8f7;
		color: #fff;
		border-radius: 10px;
		font-size: 16px;
		font-weight: 900;
		padding: 8px;
		cursor: pointer;
	}
	#ui-datepicker-div {
			z-index: 999!important;
		}
		
		.ui-state-active {
			background-color: #e00c33!important;
			color: #fff!important;
		}
		
		.ui-state-highlight {
			background-color: #ffffff!important;
			color: #000!important;
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
		
		.k-grid-toolbar {
			display: flex;
		}
		
		#new_writing, #new_product, #new_glass, #new_path {
			border: 1px solid black;
			width: fit-content;
			padding: 7px;
			font-size: 18px;
			color: #fff;
			background-color: #2aad2e;
			cursor: pointer;
		}
		
		#copy_writing, #copy_product, #copy_glass {
			border: 1px solid black;
			width: fit-content;
			padding: 7px;
			font-size: 18px;
			color: #fff;
			background-color: purple;
			cursor: pointer;
			margin-left: 20px;
		}
		
		#del_writing, #del_product, #del_glass, #del_path {
			border: 1px solid black;
			width: fit-content;
			padding: 7px;
			font-size: 18px;
			color: #fff;
			background-color: red;
			cursor: pointer;
			margin-left: 20px;
		}
		
		.red_dot {
			width: 100%;
			height: 20px;
			background-color: red;
		}
		
		.yellow_dot {
			width: 100%;
			height: 20px;
			background-color: yellow;
		}
		
		.blue_dot {
			width: 100%;
			height: 20px;
			background-color: blue;
		}
		
		.green_dot {
			width: 100%;
			height: 20px;
			background-color: green;
		}
		.mid_yellow_dot{
			width: 100%;
			height: 20px;
			background-color: #b2c73f;
		}
		.purple_dot {
			width: 100%;
			height: 20px;
			background-color: purple;
		}
		
		#logout {
			background-color: red;
			width: fit-content;
			padding: 5px;
			font-size: 18px;
			font-weight: bold;
			color: #fff;
			margin: 10px;
			cursor: pointer;
		}
		
		#leftSMS {
			background-color: green;
			width: fit-content;
			padding: 5px;
			font-size: 18px;
			font-weight: bold;
			color: #fff;
			margin: 10px;
		}
		
		.k-grid td {
			word-break: break-word;
			font-size: 15px;
		}
		
		#sms_to_all {
			border: 1px solid black;
			width: fit-content;
			padding: 7px;
			font-size: 18px;
			color: #fff;
			background-color: #2aad2e;
			cursor: pointer;
			margin-left: 320px;
		}
		
		#sms_to_checked {
			border: 1px solid black;
			width: fit-content;
			padding: 7px;
			font-size: 18px;
			color: #fff;
			background-color: #2aad2e;
			cursor: pointer;
			margin-left: 20px;
		}
		.ui-widget-content{
			background-color: #fff!important;
		}
		.fieldset input {
			height: 34.14px !important;
		}
		.bootstrap-datetimepicker-widget{
			z-index: 9999999;
		}
		.calendar_table{
			width: 100%;
			table-layout: fixed;
		}
		.time_block_container{
			display: flex;
			flex-direction: row;
			justify-content: space-evenly;
		}
		.time_block, .left_table{
			width: 30px;
			height: 30px;
		}

		.left_table_vert{
			width: 60px;
			height: 30px;
			position: relative;
			border: 1px solid #cacaca;
		}
		.time_header{
			height: 30px;
		}

		.write_block{
			position: absolute;
			border: 1px solid #fff;
			top: 0;
			left: 0;
			white-space: nowrap;
			overflow: hidden;
			height: 30px;
			background-color: #1ab11a;
			padding-left: 5px;
			color: white;
			cursor: pointer;
			z-index: 20;
			text-align: center;
			transition: 0.4s ease;
		}
		.write_block:hover{
			box-shadow: 5px 5px 0.4pc #888888;
			opacity: 0.8;
		}
		.data-table td{
			position: relative;
		}
		.data-table{
    		overflow-x: scroll;
			height: 79vh;
			padding: 10px 2px;
		}

		.data-table0{
			height: 79vh;
			overflow: hidden;
			padding: 10px 2px;
		}
		
		.block_table{
			width: max-content;
		}
		.data-table::-webkit-scrollbar {
			width: 20px!important;
		}

		/* Track */
		.data-table::-webkit-scrollbar-track {
			background: #f1f1f1; 
		}
		
		/* Handle */
		.data-table::-webkit-scrollbar-thumb {
			background: #888; 
		}

		/* Handle on hover */
		.data-table::-webkit-scrollbar-thumb:hover {
			background: #555; 
		}
		.time_block:hover{
			background-color: #d3d3d3;
			cursor: pointer;
		}
		.order_detail{
			position: absolute;
			z-index: 99999;
			background-color: #fff;
			width: 260px;
			display: none;
			padding: 8px;
			border-radius: 12px;
			top: 30px;
			border: 1px solid #0000002b;
			box-shadow: 7px 8px 8px 2px rgba(0,0,0,0.36);
			-webkit-box-shadow: 7px 8px 8px 2px rgba(0,0,0,0.36);
			-moz-box-shadow: 7px 8px 8px 2px rgba(0,0,0,0.36);
		}

		.order_detail_left{
			position: absolute;
			z-index: 99999;
			background-color: #fff;
			width: 260px;
			display: none;
			padding: 8px;
			border-radius: 12px;
			border: 1px solid #0000002b;
			box-shadow: 7px 8px 8px 2px rgba(0,0,0,0.36);
			-webkit-box-shadow: 7px 8px 8px 2px rgba(0,0,0,0.36);
			-moz-box-shadow: 7px 8px 8px 2px rgba(0,0,0,0.36);
			top: 0px;
    		right: 0px;
		}
		.order_detail p, .order_detail_left p{
			margin-bottom: 4px;
			font-size: 14px;
		}



		.vertical_td{
			width: 180px;
			position: sticky;
            top: 64px;
			z-index: 50;
		}

		.top_header td{
			background: gray;
			color: white;
			border: 1px solid white;
			text-align: center;
			box-shadow: 5px 5px #d7d2d2;
		}
		.vert_time_block{
			background: #808080;
			color: white;
			text-align: center;
			border: 1px solid white;

			position: sticky;
			
			left: 239px;
			z-index: 49;
		
		}

		/* .top_first{
			position: sticky;
			top: 64px;
			left: 0;
			z-index: 50;
		} */
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
						<h2 class="main-content-title tx-24 mg-b-5">ჩაწერები</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">ჩაწერები</a></li>
							<li class="breadcrumb-item active" aria-current="page">მიმდინარე ჩაწერები</li>
						</ol>
					</div>
				</div>
				<!-- End Page Header -->
				<!-- Row -->
					<div class="row" style="margin-bottom:10px;">
						<div class="col-md-3">
							<input id="cal_date">
						</div>
					</div>
					<div class="row calendar_div">
						<div class="data-table-vert col-md-12">
							<table class="calendar_table" border="1">
								<tr class="top_header">
									<td class="left_table_vert">დრო</td>
								</tr>
							</table>
						</div>
					</div>
					<!-- <div class="row">
							<div class="data-table0 col-md-3">
								<table class="calendar_table" border="1">
									<tr class="top_header">
										<td class="left_table">თანამშრომლები</td>
									</tr>
								</table>
							</div>
							<div class="data-table col-md-9">
								<table class="block_table" border="1">
									
									
									
								</table>
							</div>
					</div> -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Main Content-->
		<!-- Sidebar -->
		<div class="sidebar sidebar-right sidebar-animate">
			<div class="sidebar-icon"> <a href="#" class="text-right float-right text-dark fs-20" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a> </div>
			<div class="sidebar-body">
				<h5>Todo</h5>
				<div class="d-flex p-2">
					<label class="ckbox">
						<input checked="" type="checkbox"><span>Hangout With friends</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<div class="d-flex p-2 border-top">
					<label class="ckbox">
						<input type="checkbox"><span>Prepare for presentation</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<div class="d-flex p-2 border-top">
					<label class="ckbox">
						<input type="checkbox"><span>Prepare for presentation</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<div class="d-flex p-2 border-top">
					<label class="ckbox">
						<input checked="" type="checkbox"><span>System Updated</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<div class="d-flex p-2 border-top">
					<label class="ckbox">
						<input type="checkbox"><span>Do something more</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<div class="d-flex p-2 border-top">
					<label class="ckbox">
						<input type="checkbox"><span>System Updated</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<div class="d-flex p-2 border-top">
					<label class="ckbox">
						<input type="checkbox"><span>Find an Idea</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<div class="d-flex p-2 border-top mb-4 border-bottom">
					<label class="ckbox">
						<input type="checkbox"><span>Project review</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
				<h5>Overview</h5>
				<div class="p-2">
					<div class="main-traffic-detail-item">
						<div> <span>Founder &amp; CEO</span> <span>24</span> </div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" class="progress-bar progress-bar-xs wd-20p" role="progressbar"></div>
						</div>
						<!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div> <span>UX Designer</span> <span>1</span> </div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="15" class="progress-bar progress-bar-xs bg-secondary wd-15p" role="progressbar"></div>
						</div>
						<!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div> <span>Recruitment</span> <span>87</span> </div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" class="progress-bar progress-bar-xs bg-success wd-45p" role="progressbar"></div>
						</div>
						<!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div> <span>Software Engineer</span> <span>32</span> </div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar progress-bar-xs bg-info wd-25p" role="progressbar"></div>
						</div>
						<!-- progress -->
					</div>
					<div class="main-traffic-detail-item">
						<div> <span>Project Manager</span> <span>32</span> </div>
						<div class="progress">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar progress-bar-xs bg-danger wd-25p" role="progressbar"></div>
						</div>
						<!-- progress -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
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
	
	<div title="ჩაწერა" id="get_edit_page"></div>
	<div title="ჩაწერა - პროცედურა" id="get_product_page"></div>
		
	</div>
	<script>
		$(document).ready(function(){
			var today = new Date();
			var dd = today.getDate();

			var mm = today.getMonth()+1; 
			var yyyy = today.getFullYear();

			if(mm < 10){
				mm = '0'+mm;
			}

			var op = yyyy+'-'+mm+'-'+dd;
			$("#cal_date").val(op)
			$("#cal_date").datetimepicker({
				timepicker:false,
				format:'Y-m-d',
			});

			loadCalendar($("#cal_date").val(),'vertical');			
		});

		$(document).on('change', '#cal_date', function(){
			loadCalendar($("#cal_date").val(),'vertical');
			
		})

		function generateTDVertical(colspan = 4, user_count){
			let html;
			let start_hour = 9;
			for(let i = 0; i<13; i++){
				let start_minute = 0;
				if(start_hour < 10){
					start_hour = '0'+start_hour;
				}
				for(let j = 0; j<colspan;j++){
					html += `<tr>`
					let user_index = 0;
					for(let k = 0; k<=user_count-1;k++){
						if(start_minute == '0'){
							start_minute = '00';
						}
						if(k == 0 && j%colspan == 0){
							html += `<td rowspan="4" class="vert_time_block">`+start_hour+`:00</td>`
							let child = user_index+2;
							let personal_id = $(".top_header td:nth-child("+child+")").attr('personal-id')
							html += `<td personal-id="`+personal_id+`" hour="`+start_hour+`" minute="`+start_minute+`" class="time_block left_table_vert"><p class="time_hover">`+start_hour+`:`+start_minute+`</p></td>`
							user_index++;
						}
						else{
							let child = user_index+2;
							let personal_id = $(".top_header td:nth-child("+child+")").attr('personal-id')
							html += `<td personal-id="`+personal_id+`" hour="`+start_hour+`" minute="`+start_minute+`" class="time_block left_table_vert"><p class="time_hover">`+start_hour+`:`+start_minute+`</p></td>`
							user_index++;
						}
						
					}
					html += `</tr>`;
					start_minute = parseInt(start_minute)+15;
				}
				start_hour++;
			}

			return html;
			
		}

		function generateTD(colspan = 4, personal_id){
			let html = `<tr>`;
			let start_hour = 9;
			
			for(let i = 0; i<13; i++){
				let start_minute = 0;
				for(let j = 0; j<colspan;j++){
					html += `<td personal="`+personal_id+`" hour="`+start_hour+`" minute="`+start_minute+`" class="time_block"></td>`;
					start_minute = start_minute+15;
				}
				start_hour++;
			}

			html += `</tr>`;

			return html;
			
		}

		$(document).on('mouseover', '.write_block,.order_detail_left', function(){
			let sort = $(this).attr('sort');
			
			$(".order_detail[sort='"+sort+"']").css('display','block')
			$(".order_detail_left[sort='"+sort+"']").css('display','block')
		})
		$(document).on('mouseleave', '.write_block,.order_detail_left', function(){
			let sort = $(this).attr('sort');

			$(".order_detail[sort='"+sort+"']").css('display','none')
			$(".order_detail_left[sort='"+sort+"']").css('display','none')
		})

		$(document).on('mouseover', '.time_block',function(){
			$(this).children().css("display", 'block');
		});
		$(document).on('mouseleave', '.time_block',function(){
			$(this).children().css("display", 'none');
		});

		$(".data-table").on('scroll', function(e) { 
			var ele = $(e.currentTarget);
			var left = ele.scrollLeft();
			var top = ele.scrollTop();

			$(".data-table0").scrollTop(top);

			/* if (ele.attr("id") === 'div1') {
				$("#div2").scrollTop(top);
				$("#div2").scrollLeft(left);
			} else {
				$("#div1").scrollTop(top);
				$("#div1").scrollLeft(left);
			} */
		});


		$(document).on('click', '.time_block', function(e){
			let personal_id = $(this).attr('personal-id');
			let hour = $(this).attr('hour');
			let minute = $(this).attr('minute');
			if($(e.target).hasClass('time_block')){
				

				new_writing('',personal_id,hour,minute);
			}
			else if($(e.target).hasClass('write_block') || $(e.target).hasClass('order_detail_left') || $(e.target).parent().hasClass('order_detail_left')){
				let order_id = $(e.target).attr('order-id');
				
				if(order_id == '' || typeof order_id == 'undefined'){
					order_id = $(e.target).parent().attr('order-id');
				}
				new_writing(order_id,personal_id);
			}

			
		});
		

		function loadCalendar(date, calendar_type = 'vertical'){
			$(".calendar_div").html(``);
			
			

			if (calendar_type == 'vertical'){
				$(".calendar_div").html(`	<div class="data-table-vert col-md-12">
												<table class="calendar_table" border="1">
													<tr class="top_header">
														<td class="left_table_vert">დრო</td>
													</tr>
												</table>
											</div>`);
				let colspan = 4;
				let step_minute = 15;
				let height_step = 30;

				$.ajax({
					url: "server-side/calendar.action.php",
					type: "POST",
					data: {
						act: "get_cal_data",
						date: date
					},
					dataType: "json",
					success: function(data) {

						let user_count = data.length;
						let personal_ids = [];
						//alert(user_count)
						let pers_procedures = [];
						data.forEach(function(i, x){
							$(".top_header").append(`<td  personal-id="`+i.id+`" class="vertical_td">`+i.name+`</td>`)
							personal_ids.push(i.id);
							pers_procedures[i.id] = i.procedures;
							console.log(x);
							if(x == user_count-1){
								$(".calendar_table").append(generateTDVertical(4, user_count));
							}

						})

						pers_procedures.forEach(function(j, x){
							j.forEach(function(u,t){
								
								let hour = u.start_proc.split(':')[0];
								let minute = u.start_proc.split(':')[1];

								if(minute == '00'){
									minute = 0;
								}

								let height = (u.duration/step_minute)*height_step;

								$(".time_block[personal-id='"+x+"'][hour='"+hour+"'][minute='"+minute+"']").html(	`<div order-id="`+u.order_id+`" sort="`+u.procedure_id+`" style="width:100%;height: `+height+`px;background-color:`+u.color+`" class="write_block">
																														<span>`+u.client_name+` `+u.client_phone+`</span>
																													</div>
																													<div order-id="`+u.order_id+`" sort="`+u.procedure_id+`" class="order_detail_left">
																														<p><b>პერსონალი:</b> `+u.personal+`</p>
																														<p><b>კლიენტი:</b> `+u.client_name+`</p>
																														<p><b>ტელეფონი:</b> `+u.client_phone+`</p>
																														<p><b>პროცედურა:</b> `+u.proc_name+`</p>
																														<p><b>ხანგძლივობა:</b> `+u.duration+` წუთი</p>
																														<p><b>დრო:</b> `+u.start_proc+`-`+u.end_proc+`</p>
																														<p><b>ფასი:</b> `+u.price+` GEL</p>
																													</div>`)
							})
							
							//<div style="width: 270px;" class="write_block">ჩაწერა ლაშა ტოროლა</div>
						});


					}
				});
				
			}
			else if(calendar_type == 'horizontal'){
				let colspan = 4;
				let step_minute = 15;
				let width_step = 30;

				$(".block_table").append(`	<tr>
												<td class="time_header" colspan="`+colspan+`">09:00</td>
												<td class="time_header" colspan="`+colspan+`">10:00</td>
												<td class="time_header" colspan="`+colspan+`">11:00</td>
												<td class="time_header" colspan="`+colspan+`">12:00</td>
												<td class="time_header" colspan="`+colspan+`">13:00</td>
												<td class="time_header" colspan="`+colspan+`">14:00</td>
												<td class="time_header" colspan="`+colspan+`">15:00</td>
												<td class="time_header" colspan="`+colspan+`">16:00</td>
												<td class="time_header" colspan="`+colspan+`">17:00</td>
												<td class="time_header" colspan="`+colspan+`">18:00</td>
												<td class="time_header" colspan="`+colspan+`">19:00</td>
												<td class="time_header" colspan="`+colspan+`">20:00</td>
												<td class="time_header" colspan="`+colspan+`">21:00</td>
											</tr>`)
				

				//asda
				$.ajax({
					url: "server-side/calendar.action.php",
					type: "POST",
					data: {
						act: "get_cal_data",
						date: $('#cal_date').val()
					},
					dataType: "json",
					success: function(data) {
						data.forEach(function(i, x){
							$(".calendar_table").append(`	<tr>
																<td personal-id="`+i.id+`" class="left_table">`+i.name+`</td>
															</tr>`)

							$(".block_table").append(generateTD(colspan, i.id));

							let procedures = i.procedures;
							console.log(procedures)
							procedures.forEach(function(j, x){
								
								let hour = j.start_proc.split(':')[0];
								let minute = j.start_proc.split(':')[1];
								if(minute == '00'){
									minute = 0;
								}

								let width = (j.duration/step_minute)*width_step;

								$(".time_block[personal='"+i.id+"'][hour='"+hour+"'][minute='"+minute+"']").html(	`<div order-id="`+j.order_id+`" sort="`+j.procedure_id+`" style="width: `+width+`px;" class="write_block">
																														<span>`+j.client_name+` `+j.client_phone+`</span>
																													</div>
																													<div sort="`+j.procedure_id+`" class="order_detail">
																														<p><b>პერსონალი:</b> `+i.name+`</p>
																														<p><b>კლიენტი:</b> `+j.client_name+`</p>
																														<p><b>ტელეფონი:</b> `+j.client_phone+`</p>
																														<p><b>პროცედურა:</b> `+j.proc_name+`</p>
																														<p><b>ხანგძლივობა:</b> `+j.duration+` წუთი</p>
																														<p><b>დრო:</b> `+j.start_proc+`-`+j.end_proc+`</p>
																														<p><b>ფასი:</b> `+j.price+` GEL</p>
																													</div>`)
								//<div style="width: 270px;" class="write_block">ჩაწერა ლაშა ტოროლა</div>
							});
							
						})
					}
				});
			}
		}
	</script>
            
</body>

</html>