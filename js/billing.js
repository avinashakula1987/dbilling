$(document).ready(function(){
	
	
	function addNewBillRow(itemIdinBill){
		return `
			<div class='${`ro billrow_`+itemIdinBill}'>
				<div class='form-group col-md-3 col-sm-3 col-xs-3 row'>
					<input type='text' id='${`billingproduct_`+itemIdinBill}' data-id='${itemIdinBill}' class='form-control stock_dropdown_billing' placeholder='Product' />
				</div>				
				<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>										
					<input type='text' id='${`billingchoosenqty_`+itemIdinBill}' data-id='${itemIdinBill}' readonly class='form-control billingchoosenqty qtyinputfield' placeholder='Measure' />
				</div>
				<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
					<input type='text' id='${`billingqty_`+itemIdinBill}' data-id='${itemIdinBill}' class='form-control billingqty qtyinputfield' placeholder='Qty' />
				</div>
				<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
					<input type='text' id='${`billingactualprice_`+itemIdinBill}' data-id='${itemIdinBill}' class='form-control billingactualprice' placeholder='Actual Price' />
				</div>
				<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
					<input type='text' id='${`billingdiscount_`+itemIdinBill}' data-id='${itemIdinBill}' class='form-control billingdiscount' value='0' placeholder='Discount' />
				</div>
				<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
					<input type='text' id='${`billingprice_`+itemIdinBill}' data-id='${itemIdinBill}' class='form-control billingprice' placeholder='Price' />
				</div>
				<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
					<input type='text' id='${`billingwithgstprice_`+itemIdinBill}' data-id='${itemIdinBill}' class='form-control billingwithgstprice' placeholder='Total' />
				</div>
				<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
					<a class='removeIndividualRow btn btn-md btn-danger' data-id='${itemIdinBill}' id='${`removeIndividualRow_`+itemIdinBill}'>X</a>
				</div>
			</div>
		`;
	}
	function remNewBillRow(itemIdinBill){
		newBillRows = parseInt(itemIdinBill) - 1;
		alert(itemIdinBill);
		if( itemIdinBill>1 ){
			$('.billrow_'+itemIdinBill).hide();
			$('.addbillingrow').attr('data-id', newBillRows);
		}else if( itemIdinBill==1 ){
			msg = "Atleast one item required for Billing !";
			$('#desire_message .modal-body p').html(msg);
			$('#desire_message').modal('show');
		}		
	}
	function nextRow(){
		$('.stock_dropdown_billing').each(function(){
			nextpro = $(this).val();
			if( nextpro.length!=0 ){
				$('.addbillingrow').trigger('click');				
			}else{
				$(this).focus();
				return false;
			}
		});
	}
	/*$(document).on('change', '#driver', function(){		
		nextRow();
	});*/
	
	$(document).on('click', '.addbillingrow', function(){		
		totalItemsInBills = $(this).attr('data-id');
		totalItemsInBill = parseInt(totalItemsInBills) + 1;		
		newItemsRow = addNewBillRow(totalItemsInBill);
		$(this).attr('data-id', totalItemsInBill);
		$('.billingblock').append(newItemsRow);
	});
	
	$(document).on('click', '.removebillingrow', function(){		
		totalItemsInBills = $('.addbillingrow').attr('data-id');
		remNewBillRow(totalItemsInBills);		
	});

	$(document).on('click', '.removeIndividualRow', function(){		
		let id = $(this).attr('data-id');
		$('.billrow_'+id).remove();
		// remNewBillRow(totalItemsInBills);		
		alert(id);
	});
	
	$(document).on('keyup', '.stockcreation_discount', function(){		
		stockcreation_discount = $(this).val();
		stockcreation_mrp = $('.stockcreation_mrp').val();
		stkprice = ( parseFloat(stockcreation_discount) * parseFloat(stockcreation_mrp) ) / 100;
		
		$('#stock_price').val(stockcreation_mrp-stkprice);			
	});
	
	$(document).on('keyup', '.billingdiscount', function(){		
		billingdiscountrow = $(this).attr('data-id');
		billingdiscountrowprice = $("#billingactualprice_"+billingdiscountrow).val();
		billingdiscountno = $(this).val();
		afterdiscountprice = (parseFloat(billingdiscountrowprice) * parseFloat(billingdiscountno))/100;
		finalamount = billingdiscountrowprice-afterdiscountprice;
		$('#billingprice_'+billingdiscountrow).val(finalamount);	
		$('#billingprice_'+billingdiscountrow).attr("actual-price", finalamount);	
		billingrowqty = $('#billingqty_'+billingdiscountrow).val();
		billrowtot = billingrowqty * finalamount;
		$('#billingwithgstprice_'+billingdiscountrow).val(billrowtot.toFixed(2));
	});
	
	
	
	
	$(document).on('keyup', '.billingqty', function(){
		billing_selected_qty = $(this).val();
		
		if( billing_selected_qty<1 ){
			billing_selected_qty = 1;
		}else{
			billing_selected_qty = parseInt(billing_selected_qty);
		}		
		
		billing_rowid = $(this).attr('data-id');
		billing_rowprice = parseFloat($('#billingprice_'+billing_rowid).attr('actual-price'));
		billing_rowgstprice = parseFloat($('#billinggstprice_'+billing_rowid).val());

		billing_rowprice2 = parseFloat($('#billingactualprice_'+billing_rowid).val());

		let bDiscount = $('#billingdiscount_'+billing_rowid).val();
		let discountPrice = (billing_rowprice2 * bDiscount) / 100;
		
		billing_rowtotal = billing_selected_qty * (billing_rowprice2-discountPrice);
		$('#billingprice_'+billing_rowid).val(billing_rowprice2-discountPrice);
		finalIndividualTotal = billing_rowtotal;
		$('#billingwithgstprice_'+billing_rowid).val(finalIndividualTotal.toFixed(2));
		
	});

	$(document).on('keyup', '.billingactualprice', function(){
		billing_rowprice2 = $(this).val();
		billing_rowid = $(this).attr('data-id');
		billing_selected_qty = $('#billingqty_'+billing_rowid).val();
		
		if( billing_selected_qty<1 ){
			billing_selected_qty = 1;
		}else{
			billing_selected_qty = parseInt(billing_selected_qty);
		}				
		
		billing_rowprice = parseFloat($('#billingprice_'+billing_rowid).attr('actual-price'));
		billing_rowgstprice = parseFloat($('#billinggstprice_'+billing_rowid).val());


		let bDiscount = $('#billingdiscount_'+billing_rowid).val();
		let discountPrice = (billing_rowprice2 * bDiscount) / 100;
		
		billing_rowtotal = billing_selected_qty * (billing_rowprice2-discountPrice);
		$('#billingprice_'+billing_rowid).val(billing_rowprice2-discountPrice);
		finalIndividualTotal = billing_rowtotal;
		$('#billingwithgstprice_'+billing_rowid).val(finalIndividualTotal.toFixed(2));
		
	});

	
	$('#fullPayment').change(function(){
		let fullPaymentType = $(this).val();
		if( fullPaymentType == "Partial" ){
			$('#partialPayment').attr("disabled", false)
		}else{
			$('#partialPayment').attr("disabled", true)
		}
	});	
		
	
	//Final Billing starts
	$(document).on('click', '#createBill', function(){		
		customername = $('#customername').val();
		mobile = $('#mobile').val();
		state = $('#state').val();
		city = $('#city').val();
		address = $('#address').val();
		pincode = $('#pincode').val();
		gst = $('#gstno').val();
		dispatchThrough = $('#dispatchThrough').val();
		vehicle = $('#vehicle').val();
		transaction = $('#transaction').val();
		openingBalance = $('#openingBalance').val();		
		fullPayment = $('#fullPayment').val();		
		partialPayment = $('#partialPayment').val();	
		returnStatus = $('#returnStatus').is(":checked");
		if( returnStatus == true ){
			returnStatus = 1;
		}else{
			returnStatus = 0;
		}
		totalItemsInBills = $('.addbillingrow').attr('data-id');
		billingInfo = [];		
		billTotal = 0;
		billFinalTotal = 0;
		billTotalQty = 0;
		for( i=1; i<=totalItemsInBills; i++ ){
			if( $('#billingproduct_'+i).val() ){
				billingInfo[i] = [0, 0, $('#billingproduct_'+i).val(), $('#billingproduct_'+i).attr('hiddenid'), $('#billingqty_'+i).val(), $('#billingprice_'+i).val(), $('#billingprice_'+i).attr('actual-price'), $('#billinggstprice_'+i).val(), $('#billingwithgstprice_'+i).val(), $('#billingactualprice_'+i).val(), $('#billingdiscount_'+i).val(), $('#billingchoosenqty_'+i).val()];
				billTotal = parseFloat(billTotal) + parseFloat($('#billingprice_'+i).val());
				billFinalTotal = parseFloat(billFinalTotal) + parseFloat($('#billingwithgstprice_'+i).val());
				billTotalQty = parseInt(billTotalQty) + parseInt($('#billingqty_'+i).val());
				alert(billFinalTotal);
			}
		}
		
		billingInfos = JSON.stringify(billingInfo);		

		if( confirm("Are you sure?") ){
			$.post('processing.php', {returnStatus:returnStatus, customername:customername, mobile:mobile, state:state, city:city, address:address, pincode:pincode, gst:gst, dispatchThrough:dispatchThrough, vehicle:vehicle, transaction:transaction, billingInfos:billingInfos, billTotal:billTotal, billTotalQty:billTotalQty, billFinalTotal:billFinalTotal, openingBalance:openingBalance, fullPayment:fullPayment, partialPayment:partialPayment}, function(res){			
				if( res == true ){
					location.href='modifyInvoice.php';
				}else{
					msg = "Something went wrong! Try again later";
					$('#desire_message .modal-body p').html(msg);
					$('#desire_message').modal('show');
				}
			});
		}
		
		
	});

	$(document).on('click', '#updateBill', function(){		
		customername = $('#customername').val();
		mobile = $('#mobile').val();
		openingBalance = $('#openingBalance').val();
		fullPayment = $('#fullPayment').val();		
		partialPayment = $('#partialPayment').val();
		oldInvoiceId = $(this).attr('data-id');
		totalItemsInBills = $('.addbillingrow').attr('data-id');
		returnStatus = $('#returnStatus').is(":checked");
		if( returnStatus == true ){
			returnStatus = 1;
		}else{
			returnStatus = 0;
		}
		billingInfo = [];		
		billTotal = 0;
		billFinalTotal = 0;
		billTotalQty = 0;
		for( i=1; i<=totalItemsInBills; i++ ){
			if( $('#billingproduct_'+i).val() ){
				billingInfo[i] = [0, 0, $('#billingproduct_'+i).val(), $('#billingproduct_'+i).attr('hiddenid'), $('#billingqty_'+i).val(), $('#billingprice_'+i).val(), $('#billingprice_'+i).attr('actual-price'), $('#billinggstprice_'+i).val(), $('#billingwithgstprice_'+i).val(), $('#billingactualprice_'+i).val(), $('#billingdiscount_'+i).val(), $('#billingchoosenqty_'+i).val()];
				billTotal = parseFloat(billTotal) + parseFloat($('#billingprice_'+i).val());
				billFinalTotal = parseFloat(billFinalTotal) + parseFloat($('#billingwithgstprice_'+i).val());
				billTotalQty = parseInt(billTotalQty) + parseInt($('#billingqty_'+i).val());
			}	
		}
		billingInfos = JSON.stringify(billingInfo);
		if( confirm("Are you sure?") ){
			$.post('processing.php', {returnStatus:returnStatus, customername:customername, mobile:mobile, updateBillingInfos:billingInfos, oldInvoiceId:oldInvoiceId, billTotal:billTotal, billTotalQty:billTotalQty, billFinalTotal:billFinalTotal, openingBalance:openingBalance, fullPayment:fullPayment, partialPayment:partialPayment}, function(res){			
				if( res == true ){
					location.href='invoice.php?invoice='+oldInvoiceId;
				}else{
					msg = "Something went wrong! Try again later";
					$('#desire_message .modal-body p').html(msg);
					$('#desire_message').modal('show');
				}
			});
		}
	});


	// Pending Clearance
	$(document).on('click', '#partialPaymentUpdate', function(){		
		refId = $(this).attr('data-id');
		clearance_transaction = $(this).attr('data-transaction');
		actualAmount = $('#actualAmount').val();
		pendingAmount = $('#pendingAmount').val();
		payingAmount = $('#payingAmount').val();
		pendingStatus = $('#pendingStatus').val();
		
		
		if( confirm("Are you sure?") ){
			$.post('processing.php', {clearance_refId:refId, clearance_actualAmount:actualAmount, clearance_pendingAmount:pendingAmount, clearance_payingAmount:payingAmount, clearance_transaction:clearance_transaction, clearance_pendingStatus:pendingStatus}, function(res){			
				if( res == true ){
					location.href='bills.php';
				}else{
					msg = "Something went wrong! Try again later";
					$('#desire_message .modal-body p').html(msg);
					$('#desire_message').modal('show');
				}
			});
		}
	});


	$(document).on('click', '#cancelBill', function(){		
		cancelInvoiceId = $(this).attr('data-id');
		
		if( confirm("Are you sure?") ){
			$.post('processing.php', {cancelInvoiceId:cancelInvoiceId}, function(res){			
				if( res == true ){
					location.href='billing.php';
				}else{
					msg = "Something went wrong! Try again later";
					$('#desire_message .modal-body p').html(msg);
					$('#desire_message').modal('show');
				}
			});
		}
		
		
	});
	//Final Billing ends
	$(document).on('click', '.qtyinputfield', function(){	
	   $(this).select();
	});
	
	
	$(document).keypress(function(e) {
		if(e.which == 13) {
			$('.addbillingrow').trigger('click');
			cusRow = $('.addbillingrow').attr('data-id');
			$('#billingproduct_'+cusRow).focus();
		}
	});
	
	$(document).keyup(function (e) {
		if (e.keyCode == 46) {
		    $('.removebillingrow').trigger('click');
		}
	});

	
	
	
});