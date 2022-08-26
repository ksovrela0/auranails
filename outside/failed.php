<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://orders.auranails.ge/assets/plugins/jquery/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" language="javascript" src="https://orders.auranails.ge/assets/plugins/jquery-ui/chosen.jquery.js"></script>
        <link href="https://orders.auranails.ge/assets/plugins/jquery-ui/chosen.css" rel="stylesheet" type="text/css"/>



		<script type="text/javascript" language="javascript" src="https://orders.auranails.ge/assets/js/jquery.datetimepicker.full.min.js"></script> 
		<link href="https://orders.auranails.ge/assets/css/jquery.datetimepicker.min.css" rel="stylesheet">
        <title>Aura Nails - ჩაწერა</title>
        <style type="text/css">
            .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
            }
            .card-registration .select-arrow {
            top: 13px;
            }
			.chosen-container{
				width: 97%!important;
			}
        </style>
    </head>
    <body>
        <section class="h-100 bg-dark" style="height: 100vh!important;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100" style="width: 100%;">
                    <div class="col">
                        <div class="card card-registration my-4">
                            <div class="row g-0">
                                <div class="col-xl-6 d-none d-xl-block" style="display:none">
                                    <img src="aura.jpg"
                                        alt="Sample photo" class="img-fluid"
                                        style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;display:none;" />
                                </div>
                                <div class="col-xl-12">
                                    <div class="card-body p-md-5 text-black">
                                        <h3 class="mb-5">გადახდა ვერ განხორციელდა!!!</h3>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
<script>
	let ajax = "../api/api.php";
	$(document).on('click', '#payButton', function(){
		
		let params = new Object();
		params.name = $("#firstname").val();
		params.lastname = $("#lastname").val();
		params.phone = $("#phone").val();
		params.sex = $('input[name=sex]:checked').val();


		params.procedure = $("#procedure").val();
		params.write_date = $("#write_date").val();
		params.personal = $("#personal").val();
		params.proc_time = $("#proc_time").val();

		params.comment = $("#comment").val();


		let read_to_save = 0;

		if(params.name == ''){
			$("#firstname").css("border","1px solid red");
			read_to_save++;
		}
		if(params.lastname == ''){
			$("#lastname").css("border","1px solid red");
			read_to_save++;
		}
		if(params.phone == ''){
			$("#phone").css("border","1px solid red");
			read_to_save++;
		}

		if(params.sex == '' || typeof params.sex == 'undefined'){
			alert("აირჩიეთ სქესი");
			read_to_save++;
		}

		if(params.procedure == ''){
			alert("აირჩიეთ პროცედურა");
			read_to_save++;
		}
		if(params.write_date == ''){
			alert("აირჩიეთ ჩაწერის თარიღი");
			read_to_save++;
		}
		if(params.personal == '' || params.personal == null){
			alert("აირჩიეთ პერსონალი");
			read_to_save++;
		}
		if(params.proc_time == '' || params.proc_time == null){
			alert("აირჩიეთ ჩაწერის დრო");
			read_to_save++;
		}
		

		if(read_to_save == 0){
			let ammount = $(this).attr('ammount');
			/* window.open ("payment.php?ammount="+ammount,"mywindow","menubar=1,resizable=1,width=550,height=650"); */

			$.ajax({
				url: 'payment.php',
				type: "POST",
				data: "ammount="+ammount,
				dataType: "json",
				success: function (data) {
					let payID = data.payId;
					let orderID = data.merchantPaymentId;

					window.open (data.links[1].uri,"mywindow","menubar=1,resizable=1,width=550,height=650");

					let timer = setInterval(function(){
						checkPayment(payID,orderID)
					},1000)
				}
			});
		}

	});


	function checkPayment(payID, orderID){
		$.ajax({
				url: 'check_payment.php',
				type: "POST",
				data: "payID="+payID,
				dataType: "json",
				success: function (data) {
					if(data.status == 'Succeeded'){
						window.location.href = "success.php";
					}
                    else if(data.status == 'failed'){
                        window.location.href = "failed.php";
                    }
					

				}
			});
	}


    $(document).ready(function(){
    	$("#procedure,#personal,#proc_time").chosen();

		var today = new Date();
		var dd = today.getDate();

		var mm = today.getMonth()+1; 
		var yyyy = today.getFullYear();

		if(mm < 10){
			mm = '0'+mm;
		}

		var op = yyyy+'-'+mm+'-'+dd;
		$("#write_date").val(op)

		$("#write_date").datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			minDate:'-1970/01/01',
			maxDate:'+1970/01/10'
		});

		$.ajax({
			url: ajax,
			type: "POST",
			data: "act=get_procedures",
			dataType: "json",
			success: function (data) {
				$("#procedure").html(data.procedures);
				$("#procedure").trigger("chosen:updated");
			}
		});


    });
	$(document).on('change', '#procedure', function(){
		let proc_id = $(this).val();
		let write_date = $("#write_date").val();

		getAvaliable(proc_id,write_date);
	})

	$(document).on('change', '#personal', function(){
		let personal = $(this).val();
		let proc_id = $("#procedure").val();
		let write_date = $("#write_date").val();

		$.ajax({
			url: ajax,
			type: "POST",
			data: "act=get_times&procedure_id="+proc_id+"&date="+write_date+"&personal="+personal,
			dataType: "json",
			success: function (data) {
				$("#proc_time").html(data.times);
				$("#proc_time").trigger("chosen:updated");
			}
		});
	})

	function maxLengthCheck(object){
		if (object.value.length > object.maxLength)
			object.value = object.value.slice(0, object.maxLength)
	}

	function getAvaliable(proc_id,write_date){
		$.ajax({
			url: ajax,
			type: "POST",
			data: "act=get_personal&procedure_id="+proc_id+"&date="+write_date,
			dataType: "json",
			success: function (data) {
				$("#personal").html(data.personal);
				$("#personal").trigger("chosen:updated");

				$("#total").html(data.total)
				$("#percent").html(data.percent)
				$("#payButton").attr('ammount',data.percent)
				$("#payButton").html(`გადახდა <span style="color:green">`+data.percent+`</span> GEL`);
			}
		});
	}
</script>