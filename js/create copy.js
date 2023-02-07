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
		newcategory = $('#category').val();
		newcategory1 = isValidInput(newcategory);
		if(  newcategory1 == false ){
			msg = "Provide Valid Category";
			$('#desire_message .modal-body p').html(msg);
			$('#desire_message').modal('show');
		}else{
			$.post("processing.php", {createcategory:newcategory1}, function(res){
				if( res == true ){
					$('#category').val('');	
					msg = "Successfully created";
					$('#desire_message .modal-body p').html(msg);
					$('#desire_message').modal('show');
				}else{
					$('#desire_message .modal-body p').html(res);
					$('#desire_message').modal('show');				
				}	
			});
		}
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
		fresh_barcode = $('#barcode').val();
		fresh_hsn = $('#stock_hsn').val();
		fresh_category = $('#category').val();
		fresh_categoryid = $('#category').attr('hiddenid');
		fresh_product = $('#product').val();
		fresh_productid = $('#product').attr('hiddenid');
		
		
		fresh_qty = $('#stock_qty').val();
		fresh_mrpprice = $('#mrp_price').val();
		fresh_discount = $('#discount').val();
		fresh_price = $('#stock_price').val();
		gsttype = $('#gsttype').val();
		gst = $('#gst').val();
		gstprice = $('#gstprice').val();
		if( gsttype == 2 ){
			if( gst==0 || gstprice==0 ){
				alert("Provide GST!");
				exit();
			}
		}else{
			if( gst==0 || gstprice==0 ){
				alert("Provide GST!");
				exit();
			}
		}
		
		
		
		//newcategory1 = isValidInput(newcategory);
		if( fresh_category != "" && fresh_category.length>0 && fresh_categoryid != undefined ){
			if( fresh_product != "" && fresh_product.length>0 ){
				if( fresh_productid == undefined ){
					$.post("processing.php", {fresh_discount:fresh_discount, fresh_mrpprice:fresh_mrpprice, fresh_barcode:fresh_barcode, fresh_hsn:fresh_hsn, newstock_categoryid:fresh_categoryid, newstock_productname:fresh_product, newstock_quantity:fresh_qty, newstock_price:fresh_price, gsttype:gsttype, gst:gst, gstprice:gstprice}, function(res){
						if( res == true ){
							$('.stockform input').val('');	
							alert("Stock successfully created !");
						}else{
							alert(res);				
						}	
					});
				}else if( fresh_productid != undefined && fresh_productid.length>0){
					newstock_qty2 = $('#stock_qty2').val();
					if( newstock_qty2 != "" && newstock_qty2.length>0 ){
						if( confirm("Product already existed! Do you want to update the quantity ?\n'Ok' for Update old stock\n'Cancel' for cancel the task") ){
							$.post("processing.php", {updatestock_categoryid:fresh_categoryid, updatestock_productid:fresh_productid, updatestock_productname:fresh_product, updatestock_quantity:fresh_qty, updatestock_quantity2:newstock_qty2, updatestock_price:fresh_price}, function(res){
								if( res == true ){
									$('.stockform input').val('');	
									alert("Stock successfully created !");
								}else{
									alert(res);				
								}	
								$('.newqty_formblock').hide();
								$('#stock_qty').removeAttr("readonly");
								$('#product').removeAttr('hiddenid');
								$('#stock_price').removeAttr('readonly');
							});
						}
					}else{
						alert("Provide new stock quantity");
					}
					
				}
			}else{
				alert("Provide Item Title");
			}
		}else{
			alert("Provide Valid Category");
			
		}
		
	});
	
});