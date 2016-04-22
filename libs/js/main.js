//$(function() {

$().ready(function() {

 	$("div#infovis").tooltip();
 	
	$( "#createmeasures" ).accordion({
		collapsible: true,
		heightStyle: "content"
	});
	
	$( "#createlocations" ).accordion({
		collapsible: true,
		heightStyle: "content"
	});
	
	$( "#createunittype" ).accordion({
		collapsible: true,
		heightStyle: "content"
	});
	
	$( "#createusers" ).accordion({
		collapsible: true,
		heightStyle: "content"
	});
	
	$( "#createviews" ).accordion({
		collapsible: true,
		heightStyle: "content"
	});
	
	$("div#periodmonth").dialog ({
		autoOpen : false,
		show : "slide",
		hide : "puff",
		height: 500,
		width: 600,
		modal: true,
	});
	
	$("#btnDone").click(function (event) {
		window.location.reload();
	});
	
	$("#btnDoneQ").click(function (event) {
		window.location.reload();
	});
	
	$("div#periodquarter").dialog ({
		autoOpen : false,
		show : "slide",
		hide : "puff",
		height: 500,
		width: 600,
		modal: true,
	});
	
	$("div#periodweek").dialog ({
		autoOpen : false,
		show : "slide",
		hide : "puff",
		height: 250,
		width: 990,
		modal: true,
	});
	
	
	$("#createmeasureform").validate({
		rules: {
			measurename: "required",
			measuretype: "required",
			//measurepolarity: "required",
			storageperiod: "required",
			//unittype: "required",
			owner: "required",
			//consf: "required",
			location: "required"
		},
		messages: {
			measurename: "Please enter measure name",
			measuretype: "Please choose measure type",
			//measurepolarity: "Please choose measure polarity",
			storageperiod: "Please choose storage period",
			//unittype: "Please choose unit type",
			owner: "Please choose unit owner",
			//consf: "Please choose period consolidation functions",
			location: "Please choose location"
		},
		errorPlacement: function(error, element) {
			//error.appendTo( element.parent().next() );
			error.appendTo( $(".errorm") );
		},
		invalidHandler: function(event, validator) {
			if (validator.numberOfInvalids() > 0) {
				validator.showErrors();
				// Open accordion tab with errors
				$(".errorm").show();
				var index = $(".error")
					.closest(".ui-accordion-content")
					.index(".ui-accordion-content");
				$("#createmeasures").accordion("option", "active", index);
			} else {
				$(".errorm").hide();
			}
		},
		ignore: [],
	});
	
	$("#createlocationform").validate({
		rules: {
			locationname: "required",
			parentlocation: "required",
			owner: "required",
		},
		messages: {
			locationname: "Please enter location name",
			parentlocation: "Please choose parent location",
			owner: "Please choose owner location",
		},
		errorPlacement: function(error, element) {
			//error.appendTo( element.parent().next() );
			error.appendTo( $(".errorm") );
		},
		invalidHandler: function(event, validator) {
			if (validator.numberOfInvalids() > 0) {
				validator.showErrors();
				// Open accordion tab with errors
				$(".errorm").show();
				var index = $(".error")
					.closest(".ui-accordion-content")
					.index(".ui-accordion-content");
				$("#createlocations").accordion("option", "active", index);
			} else {
				$(".errorm").hide();
			}
		},
		ignore: [],
	});
	
	$("#unittypeform").validate({
		rules: {
			unitname: "required",
		},
		messages: {
			unitname: "Please enter unit name",
		},
		errorPlacement: function(error, element) {
			//error.appendTo( element.parent().next() );
			error.appendTo( $(".errorm") );
		},
		invalidHandler: function(event, validator) {
			if (validator.numberOfInvalids() > 0) {
				validator.showErrors();
				// Open accordion tab with errors
				$(".errorm").show();
				var index = $(".error")
					.closest(".ui-accordion-content")
					.index(".ui-accordion-content");
				$("#createunittype").accordion("option", "active", index);
			} else {
				$(".errorm").hide();
			}
		},
		ignore: [],
	});
	
	$("#createuserform").validate({
		rules: {
			username: "required",
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			emailaddress: {
				required: true,
				email: true
			},
		},
		messages: {
			username: "Please enter user name",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			emailaddress: "Please enter a valid email address",
		},
		errorPlacement: function(error, element) {
			//error.appendTo( element.parent().next() );
			error.appendTo( $(".errorm") );
		},
		invalidHandler: function(event, validator) {
			if (validator.numberOfInvalids() > 0) {
				validator.showErrors();
				// Open accordion tab with errors
				$(".errorm").show();
				var index = $(".error")
					.closest(".ui-accordion-content")
					.index(".ui-accordion-content");
				$("#createusers").accordion("option", "active", index);
			} else {
				$(".errorm").hide();
			}
		},
		ignore: [],
	});
	
	$("#createviewform").validate({
		rules: {
			viewname: "required",
			topmeasure: "required",
			toplocation: "required",
			displayby: "required",
		},
		messages: {
			viewname: "Please enter view name",
			topmeasure: "Please choose top measure",
			toplocation: "Please choose top location",
			displayby: "Please choose display by",
		},
		errorPlacement: function(error, element) {
			//error.appendTo( element.parent().next() );
			error.appendTo( $(".errorm") );
		},
		invalidHandler: function(event, validator) {
			if (validator.numberOfInvalids() > 0) {
				validator.showErrors();
				// Open accordion tab with errors
				$(".errorm").show();
				var index = $(".error")
					.closest(".ui-accordion-content")
					.index(".ui-accordion-content");
				$("#createviews").accordion("option", "active", index);
			} else {
				$(".errorm").hide();
			}
		},
		ignore: [],
	});
	
	$('#begins5').on('input', function() {
	    var ends4 = parseFloat($('#begins5').val()) - 1;
	    $('#ends4').val(ends4);
	});

	$('#begins4').on('input', function() {
	    var ends3 = parseFloat($('#begins4').val()) - 1;
	    $('#ends3').val(ends3);
	});

	$('#begins3').on('input', function() {
	    var ends2 = parseFloat($('#begins3').val()) - 1;
	    $('#ends2').val(ends2);
	});

	$('#begins2').on('input', function() {
	    var ends1 = parseFloat($('#begins2').val()) - 1;
	    $('#ends1').val(ends1);
	});

	$('#begins1').val('0');

	$(".openpasswd").off('click')
	$(".openpasswd").on('click', (function (event){
		console.log(this.id);
		$("#idusercp").val(this.id);
		$("#newpass").val("");
		$("#confirmpass").val("");
		$("#changepass").dialog ("open"); 
	}));

	$("div#changepass").dialog ({
		autoOpen : false,
		show : "slide",
		hide : "puff",
		height: 180,
		width: 325,
		modal: true,
	});

	$("#closecp").click(function (event) {
		$("div#changepass").dialog ("close"); 
	});

	/* change password user */
	$( "#savesp" ).click ( function( event ) {
		var iduser = $("#idusercp").val();
		var passwd = $("#newpass").val();
		dataString = 'iduser=' + iduser + '&passwd='+passwd;
		$.ajax({ 
			type: 'POST',
			//url: '/performance_is/index.php/setup/changepasswd',
			url: '/index.php/setup/changepasswd',
			data: dataString,
			success: function(data) {	
				$("div#changepass").dialog ("close"); 
			}
		});
	});

	/* handle duplicate username */
	$("#loginname").blur(function(){
	 	var username = $("#loginname").val();
	 	dataString = 'username=' + username;
		$.ajax({
			type: 'GET',
			//url: '/performance_is/index.php/setup/checkduplicateloginname',
			url: '/index.php/setup/checkduplicateloginname',
			data: dataString,
			success: function(data) {
				//console.log(data);
				if(data == 1) {
					 $("#submitform").attr("disabled", "disabled");
					 $("#warn").css('display','block');
				} else {
					$("#submitform").removeAttr("disabled");
					$("#warn").css('display','none');
				}
			}
		});
	});

	
	
	//$( "#tabs" ).tabs();
	$( "#tabs2" ).tabs();

	$( "#tabs" ).tabs();
	
	$( "#tabs2quarter" ).tabs();

	$( "#tabsquarter" ).tabs();

	/* proses save pada from pop up saveperiodmonth di hirarki kpi */
	$("#submitactcomm").click(function(e) {
		e.preventDefault();
		var comments = $("#comments").val(); 
		var actionplans = $("#actionplans").val();
		var idmeasureactcomm = $("#idmeasureactcomm").val();
		var dataString = 'comments='+comments+'&actionplans='+actionplans+'&idmeasureactcomm='+idmeasureactcomm;
		$.ajax({
			type:'POST',
			data:dataString,
			//url: '/performance_is/index.php/setup/saveactcomm',
			url: '/index.php/setup/saveactcomm',
			//url:'insert.php',
			success:function(data) {
				alert('Data succesfully saved');
			}
		});
	});
	
	/* save action and comment on each measure */
	$("#submitactcommQ").click(function(e) {
		e.preventDefault();
		var comments = $("#commentsQ").val(); 
		var actionplans = $("#actionplansQ").val();
		var idmeasureactcomm = $("#idmeasureactcommQ").val();
		var dataString = 'comments='+comments+'&actionplans='+actionplans+'&idmeasureactcomm='+idmeasureactcomm;
		$.ajax({
			type:'POST',
			data:dataString,
			//url: '/performance_is/index.php/setup/saveactcomm',
			url: '/index.php/setup/saveactcomm',
			success:function(data) {
				alert('Data succesfully saved');
			}
		});
	});
	
	/* refresh data displayed on chart monitoring and performance */
	$( "#savesp" ).click ( function( event ) {
		var idview = this.name;
		dataString = 'idview=' + idview;
		$.ajax({ 
			type: 'POST',
			//url: '/performance_is/index.php/chart/refreshData/',
			url: '/index.php/chart/refreshData/',
			data: dataString,
			success: function(data) {	
				alert('OK');
			}
		});
	});
	
	/* delete submeasure from measure group */
	$(".delsubmeasure").click(function (event) {
		var idsubmeasure = this.id;
		var idview = this.name;
		var parent = this.rel;
		dataString = 'idsubmeasure=' + idsubmeasure + '&idview=' + idview + '&parent=' + parent;
		$.ajax({ 
			type: 'POST',
			//url: '/performance_is/index.php/setup/delsubmeasure/',
			url: '/index.php/setup/delsubmeasure/',
			data: dataString,
			success: function(data) {	
				window.location.reload();
			}
		});
	});
	
	/* delete granted security measure to user */
	$(".delsecuritymeasure").click(function (event) {
		var idmeasure = this.id;
		var iddb = this.name;
		var idusers = this.hreflang;
		dataString = 'idmeasure=' + idmeasure + '&iddb=' + iddb + '&idusers=' + idusers;
		$.ajax({ 
			type: 'POST',
			//url: '/performance_is/index.php/setup/delSecurityMeasure/',
			url: '/index.php/setup/delSecurityMeasure/',
			data: dataString,
			success: function(data) {	
				window.location.reload();
			}
		});
	});
	
	/* check all checkbox on security measure */
	$('#selecctallview').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkview').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkview').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
	
	$('#selecctalledit').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkedit').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkedit').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
	
	$('#selecctallentry').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkentry').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkentry').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
	
	$('#akumulasi').click(function() {
    if( $(this).is(':checked')) {
		$("#con11").hide();
		$("#con111").hide();
		$("#con12").show();
		$("#con122").show();
		
		$("#con21").hide();
		$("#con211").hide();
		$("#con22").show();
		$("#con222").show();
    } else {
		$("#con11").show();
		$("#con111").show();
		$("#con12").hide();
		$("#con122").hide();
		
		$("#con21").show();
		$("#con211").show();
		$("#con22").hide();
		$("#con222").hide();
    }
	}); 
	
	$('#typegroup').click(function() {
    if( $('#typegroup').is(':checked')) {
		$("#polarityshow").hide();
		$("#unitshow").hide();
		$("#conshead").hide();
		$("#consbody").hide();
	}
	}); 
	
	$('#typedata').click(function() {
    if( $(this).is(':checked')) {
		$("#polarityshow").show();
		$("#unitshow").show();
		$("#conshead").show();
		$("#consbody").show();
	} 
	}); 
	
	$('#typeformula').click(function() {
    if( $(this).is(':checked')) {
		$("#polarityshow").show();
		$("#unitshow").show();
		$("#conshead").show();
		$("#consbody").show();
	} 
	}); 

	/* delete submeasure from measure group */
	$(".delmeasurereport").click(function (event) {
		
		var idreport = this.name;
		var idmeasure = this.id;
		
		dataString = 'idmeasure=' + idmeasure + '&idreport=' + idreport;
		$.ajax({ 
			type: 'POST',
			
			url: '/index.php/setup/delmeasurereport/',
			data: dataString,
			success: function(data) {	
				window.location.reload();
			}
		});
	});
	
});




