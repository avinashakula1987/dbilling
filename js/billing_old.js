$(document).ready(function(){
	function addNewBillRow(itemIdinBill){
		return "<div class='row billrow_"+itemIdinBill+"'><div class='form-group col-md-2'><input type='text' id='billingcategory_"+itemIdinBill+"' data-id='"+itemIdinBill+"' class='form-control categories_dropdown_billing' placeholder='Category' /></div><div class='form-group col-md-4'><input type='text' id='billingproduct_"+itemIdinBill+"' data-id='"+itemIdinBill+"' class='form-control stock_dropdown_billing' placeholder='Product' /></div><div class='form-group col-md-1'><input type='text' id='billingqty_"+itemIdinBill+"' data-id='"+itemIdinBill+"' class='form-control billingqty qtyinputfield' placeholder='Qty' /></div><div class='form-group col-md-2'><input type='text' id='billingprice_"+itemIdinBill+"' data-id='"+itemIdinBill+"' class='form-control billingprice' placeholder='Price' /></div><div class='form-group col-md-1'><input type='text' id='billinggstprice_"+itemIdinBill+"' readonly data-id='"+itemIdinBill+"' class='form-control billinggstprice' placeholder='GST' /></div><div class='form-group col-md-2'><input type='text' id='billingwithgstprice_"+itemIdinBill+"' data-id='"+itemIdinBill+"' class='form-control billingwithgstprice' placeholder='Total' /></div></div>";
	}
	function remNewBillRow(itemIdinBill){
		newBillRows = parseInt(itemIdinBill) - 1;
		if( itemIdinBill>1 ){
			$('.billrow_'+itemIdinBill).hide();
			$('.addbillingrow').attr('data-id', newBillRows);
		}else if( itemIdinBill==1 ){
			alert("Atleast one item required for Billing !");
		}		
	}
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
	
	
	
	
	$(document).on('keyup', '.billingqty', function(){
		billing_selected_qty = $(this).val();
		if( billing_selected_qty<1 ){
			billing_selected_qty = 1;
		}else{
			billing_selected_qty = parseInt(billing_selected_qty);
		}
		billing_available_qty = $(this).attr('avail-qty');
		billing_rowid = $(this).attr('data-id');
		billing_rowprice = parseFloat($('#billingprice_'+billing_rowid).attr('actual-price'));
		billing_rowgstprice = parseFloat($('#billinggstprice_'+billing_rowid).val());
		
		billing_rowtotal = billing_selected_qty * billing_rowprice;
		billing_gsttotal = billing_selected_qty * billing_rowgstprice;
		$('#billingprice_'+billing_rowid).val(billing_rowtotal.toFixed(2));
		finalIndividualTotal = billing_rowtotal+billing_gsttotal;
		$('#billingwithgstprice_'+billing_rowid).val(finalIndividualTotal.toFixed(2));
	});
	
	
	//Final Billing starts
	$(document).on('click', '#createBill', function(){		
		customername = $('#customername').val();
		mobile = $('#mobile').val();
		totalItemsInBills = $('.addbillingrow').attr('data-id');
		billingInfo = [];		
		billTotal = 0;
		billFinalTotal = 0;
		billTotalQty = 0;
		for( i=1; i<=totalItemsInBills; i++ ){
			billingInfo[i] = [$('#billingcategory_'+i).val(), $('#billingcategory_'+i).attr('hiddenid'), $('#billingproduct_'+i).val(), $('#billingproduct_'+i).attr('hiddenid'), $('#billingqty_'+i).val(), $('#billingprice_'+i).val(), $('#billingprice_'+i).attr('actual-price'), $('#billinggstprice_'+i).val(), $('#billingwithgstprice_'+i).val()];
			billTotal = parseFloat(billTotal) + parseFloat($('#billingprice_'+i).val());
			billFinalTotal = parseFloat(billFinalTotal) + parseFloat($('#billingwithgstprice_'+i).val());
			billTotalQty = parseInt(billTotalQty) + parseInt($('#billingqty_'+i).val());
		}
		
		
		billingInfos = JSON.stringify(billingInfo);
		
		if( confirm("Are you sure?") ){
			$.post('processing.php', {customername:customername, mobile:mobile, billingInfos:billingInfos, billTotal:billTotal, billTotalQty:billTotalQty, billFinalTotal:billFinalTotal}, function(res){			
				if( res == true ){
					location.href='modifyInvoice.php';
				}else{
					alert("Something went wrong! Try again later");
				}
			});
		}
		
		
	});
	$(document).on('click', '#updateBill', function(){		
		customername = $('#customername').val();
		mobile = $('#mobile').val();
		oldInvoiceId = $(this).attr('data-id');
		totalItemsInBills = $('.addbillingrow').attr('data-id');
		billingInfo = [];		
		billTotal = 0;
		billFinalTotal = 0;
		billTotalQty = 0;
		for( i=1; i<=totalItemsInBills; i++ ){
			billingInfo[i] = [$('#billingcategory_'+i).val(), $('#billingcategory_'+i).attr('hiddenid'), $('#billingproduct_'+i).val(), $('#billingproduct_'+i).attr('hiddenid'), $('#billingqty_'+i).val(), $('#billingprice_'+i).val(), $('#billingprice_'+i).attr('actual-price'), $('#billinggstprice_'+i).val(), $('#billingwithgstprice_'+i).val()];
			billTotal = parseFloat(billTotal) + parseFloat($('#billingprice_'+i).val());
			billFinalTotal = parseFloat(billFinalTotal) + parseFloat($('#billingwithgstprice_'+i).val());
			billTotalQty = parseInt(billTotalQty) + parseInt($('#billingqty_'+i).val());
		}
		billingInfos = JSON.stringify(billingInfo);
		if( confirm("Are you sure?") ){
			$.post('processing.php', {customername:customername, mobile:mobile, updateBillingInfos:billingInfos, oldInvoiceId:oldInvoiceId, billTotal:billTotal, billTotalQty:billTotalQty, billFinalTotal:billFinalTotal}, function(res){			
				if( res == true ){
					location.href='invoice.php?invoice='+oldInvoiceId;
				}else{
					alert("Something went wrong! Try again later");
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
					alert("Something went wrong! Try again later");
				}
			});
		}
		
		
	});
	//Final Billing ends
	$(document).on('click', '.qtyinputfield', function(){	
	   $(this).select();
	});

	
	
	
});