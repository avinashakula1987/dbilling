$(document).ready(function(){
	
	function isValidInput(string){
		trimmedText = $.trim(string);
		if( trimmedText.length>0 ){
			return trimmedText;
		}else{
			return false;
		}
	}
	
	$('#create').click(function(){
		balance = $('#balance').val();
		
		$.post("processing.php", {updateBalance:balance}, function(res){
			if( res == true ){
				$('#balance').val(balance);	
				msg = "Successfully updated";
				alert(msg);
				
			}else{
				alert("Something went wrong, try again");		
			}	
		});
		
	});
	
	$('#createmoderator').click(function(){
		username = $('#username').val();
		password = $('#password').val();
		name = $('#name').val();
		$.post("processing.php", {musername:username, mpassword:password, mname:name}, function(res){
			if( res == true ){
				$('#username').val('');	
				$('#password').val('');	
				$('#name').val('');	
				alert("Successfully created");
			}else{
				alert(res);				
			}	
		});
	});
	
	$('#createcustomer').click(function(){
		customer_mobile = $('#mobile').val();
		customer_name = $('#name').val();
		customer_address = $('#address').val();
		customer_gstin = $('#gstin').val();
		// alert(customer_mobile);
		// alert(customer_name);
		// alert(customer_address);
		// alert(customer_gstin);
		$.post("processing.php", {customer_gstin:customer_gstin, customer_mobile:customer_mobile, customer_name:customer_name, customer_address:customer_address}, function(res){
			alert(res);
			// if( res == true ){
			// 	$('#mobile').val('');	
			// 	$('#name').val('');	
			// 	$('#address').val('');	
			// 	alert("Successfully created");
			// }else{
			// 	alert(res);				
			// }	
		});
	});
	
	$('#createvehicle').click(function(){
		vehicleno = $('#vehicleno').val();
		vehiclename = $('#vehiclename').val();
		description = $('#description').val();
		$.post("processing.php", {vehicleno:vehicleno, vehiclename:vehiclename, description:description}, function(res){
			if( res == true ){
				$('#vehicleno').val('');	
				$('#vehiclename').val('');	
				$('#description').val('');	
				alert("Successfully created");
			}else{
				alert(res);				
			}	
		});
	});
	
	$('#createdriver').click(function(){
		driverno = $('#driverno').val();
		drivername = $('#drivername').val();
		description = $('#address').val();
		$.post("processing.php", {driverno:driverno, drivername:drivername, description:description}, function(res){
			if( res == true ){
				$('#driverno').val('');	
				$('#drivername').val('');	
				$('#address').val('');	
				alert("Successfully created");
			}else{
				alert(res);				
			}	
		});
	});
	
	
	// Creating fresh stock can be updated too...
	$('.productinstockcreation').keyup(function(){
		cat1 = $(this).val();
		cat2 = $(this).attr('hiddenid');
		if( cat2 != undefined ){
			$(this).removeAttr('hiddenid');
			$('.newqty_formblock').hide();
			$('#stock_qty').removeAttr("readonly");
			$('#stock_qty').val('');
			$('#stock_price').val('');
			$('#stock_price').removeAttr('readonly');
		}
		
	});
	function gstCalculation(){
		typeofgst = $('#gsttype').val();
		
		gst = parseInt($('#gst').val()) || 0;	
		gst_itemprice = parseFloat($('#stock_price').val()) || 0;
		
		$('#gst').val(gst);	
		$('#stock_price').val(gst_itemprice);	
		gst_qty = parseFloat($('#stock_qty').val());
		if( typeofgst == 1 ){
			gst_gstpercentage = gst+100; 
			gst_price = ( gst_itemprice * gst ) / gst_gstpercentage;
		}else if( typeofgst == 2 ){
			gst_gstpercentage = 100; 
			gst_price = ( gst_itemprice * gst ) / gst_gstpercentage;
		}
		
		$('#gstprice').val(gst_price.toFixed(2));
	}
	$('#gst, #stock_price').keyup(function(){
		gstCalculation();
	});
	$('#stock_qty2').keyup(function(){
		qty1 = parseInt($(this).val());
		qty2 = parseInt($('#stock_qty').val());
		qty3 = qty1 + qty2;
		$('#totalfreshqty').text(qty3);
		
	});
	
	
	$('#gsttype').change(function(){
		gsttype = $(this).val();
		if( gsttype == "1" ){
			$('#gst, #gstprice').val(0);
		}else{
			$('#gst, #gstprice').val(0);		
		}
		
	});
	
	
	
	$('#createStock').click(function(){
		
		newstock_productname = $('#product').val();
		newstock_quantity = $('#quantity').val();		
		newstock_price = $('#individualnetprice').val();		
		
		if( 
			newstock_productname != "" && newstock_productname.length>0 
			&& newstock_quantity != "" && newstock_quantity.length>0 
		){
				$.post("processing.php", {newstock_productname:newstock_productname, newstock_quantity:newstock_quantity, newstock_price:newstock_price}, function(res){
					let result = JSON.parse(res);
				
					if( result.stock == true ){
						$('.stockform input').val('');	
						showDialog("New Stock", "Stock successfully created !");
					}else{
						showDialog("New Stock", "Stock not created !");				
					}	
				});
			
		}else{
			alert("Provide Item Title");
		}
		
		
	});


	function showDialog(header, msg){		
		$("#modalheadertitle").html(`${header}`);
		$("#modalbodymsg").html(`<p>${msg}</p>`);
		$("#dialogueBox").modal();
	}
	
});