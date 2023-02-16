$(document).ready(function(){
	
	function isValidInput(string){
		trimmedText = $.trim(string);
		if( trimmedText.length>0 ){
			return trimmedText;
		}else{
			return false;
		}
	}
	
	$('.update').click(function(){		
		newcategory_id = $(this).attr('data-id');		
		$('.loading_'+newcategory_id).html("<img src='images/loading.gif'> Please wait");
		newcategory_value = $('#editcategory_'+newcategory_id).val();
		newcategory_filtered = isValidInput(newcategory_value);		
		if(  newcategory_filtered == false ){
			alert("Provide Valid Category");
		}else{
			$.post("processing.php", {updatecreatecategory:newcategory_filtered, update_categoryid:newcategory_id}, function(res){
				$('.loading_'+newcategory_id).html('');
				if( res == true ){
					$('.loading_'+newcategory_id).html("<span class='text-success'><span class='glyphicon glyphicon-ok'> Updated</span></span>");
					$('#name_'+newcategory_id).text(newcategory_filtered);
				}else{
					$('.loading_'+newcategory_id).html("<span class='text-danger'><span class='glyphicon glyphicon-remove'> Failed! Try again later!</span></span>");			
				}	
			});
		}
	});
	$('.updatemoderator').click(function(){		
		newcategory_id = $(this).attr('data-id');		
		$('.loading_'+newcategory_id).html("<img src='images/loading.gif'> Please wait");
		newusername_value = $('#editusername_'+newcategory_id).val();
		newpassword_value = $('#editpassword_'+newcategory_id).val();
		newname_value = $('#editname_'+newcategory_id).val();
		$.post("processing.php", {newusername_value:newusername_value, newpassword_value:newpassword_value, newname_value:newname_value}, function(res){
			$('.loading_'+newcategory_id).html('');
			if( res == true ){
				$('.loading_'+newcategory_id).html("<span class='text-success'><span class='glyphicon glyphicon-ok'> Updated</span></span>");
				$('#username_'+newcategory_id).text(newusername_value);
				$('#password_'+newcategory_id).text(newpassword_value);
				$('#name_'+newcategory_id).text(newname_value);
			}else{
				$('.loading_'+newcategory_id).html("<span class='text-danger'><span class='glyphicon glyphicon-remove'> Failed! Try again later!</span></span>");			
			}	
		});
	});
	$('.changestatus').click(function(){		
		category_statusid = $(this).attr('data-id');	
		category_statusstate = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {category_statusstate:category_statusstate, category_statusid:category_statusid}, function(res){
				if( res == true ){
					alert("Status changed");
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	$('.mchangestatus').click(function(){		
		category_statusid = $(this).attr('data-id');	
		category_statusstate = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {mcategory_statusstate:category_statusstate, mcategory_statusid:category_statusid}, function(res){
				if( res == true ){
					alert("Status changed");
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	$(document).on('click', '.update_stock', function(){		
		
		updateexistedstock_id = $(this).attr('data-id');		
		$('.loadingustock_'+updateexistedstock_id).html("<img src='images/loading.gif'> Please wait");
		updatestock_stock = $('#editstock_title_'+updateexistedstock_id).val();
		updatestock_price = $('#editstock_actualprice_'+updateexistedstock_id).val();

	
		if(  updatestock_stock!="" && updatestock_stock!="" && updatestock_price!="" ){
			
			$.post("processing.php", {updatestock_productid:updateexistedstock_id, updatestock_price:updatestock_price, updatestock_stock:updatestock_stock}, function(res){
				$('.loadingustock_'+updateexistedstock_id).html('');
				let result = JSON.parse(res);
				if(  result.stock == true ){
					$('.loadingustock_'+updateexistedstock_id).html("<span class='text-success'><span class='glyphicon glyphicon-ok'> Updated</span></span>");
					$('#name_'+updateexistedstock_id).text(updatestock_stock);
					$('#actualprice_'+updateexistedstock_id).text(updatestock_price);
				}else{
					$('.loadingustock_'+updateexistedstock_id).html("<span class='text-danger'><span class='glyphicon glyphicon-remove'> Failed! Try again later!</span></span>");			
				}	
			});
		}else{
			alert();
		}
	});

	$(document).on('click', '.update_quantity', function(){		
		
		updateexistedstock_id = $(this).attr('data-id');		
		$('.loadingustock_'+updateexistedstock_id).html("<img src='images/loading.gif'> Please wait");
		update_quantity = $('#editstock_quantity_'+updateexistedstock_id).val();

	
		if(  update_quantity!="" ){
			
			$.post("processing.php", {update_quantity:update_quantity, update_qtyid:updateexistedstock_id}, function(res){
				$('.loadingustock_'+updateexistedstock_id).html('');
				let result = JSON.parse(res);
				if(  result.stock == true ){
					$('.loadingustock_'+updateexistedstock_id).html("<span class='text-success'><span class='glyphicon glyphicon-ok'> Updated</span></span>");
					$('#qty_'+updateexistedstock_id).text(update_quantity);
				}else{
					$('.loadingustock_'+updateexistedstock_id).html("<span class='text-danger'><span class='glyphicon glyphicon-remove'> Failed! Try again later!</span></span>");			
				}	
			});
		}else{
			alert();
		}
	});
	
	
	$('.inactivateitem').click(function(){		
		listitem_inactivateid = $(this).attr('data-id');		
		listitem_inactivate_name = $(this).attr('data-name');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {listitem_inactivateid:listitem_inactivateid, listitemstate_inactivateid:0, listitem_inactivate_name:listitem_inactivate_name}, function(res){
				if( res == true ){
					alert("Inactivated");
					$('#row_'+listitem_inactivateid).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	$('.activateitem').click(function(){		
		listitem_activateid = $(this).attr('data-id');	
		listitem_inactivate_name = $(this).attr('data-name');	
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {listitem_activateid:listitem_activateid, listitemstate_activateid:1, listitem_inactivate_name:listitem_inactivate_name}, function(res){
				if( res == true ){
					alert("Item Activated Again");
					$('#row_'+listitem_activateid).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	function gstCalculation_edit(jid){
		gst = parseInt($('#editstock_gst_'+jid).val()) || 0;	
		gst_itemprice = parseFloat($('#editstock_mrp_'+jid).val()) || 0;
		$('#editstock_gst_'+jid).val(gst);	
		$('#editstock_mrp_'+jid).val(gst_itemprice);		
		gst_gstpercentage = gst+100; 
		gst_price = ( gst_itemprice * gst ) / gst_gstpercentage;		
		$('#editstock_gstprice_'+jid).val( gst_price.toFixed(2) );
	}
	
	
	$('.editchangegst').keyup(function(){		
		selid = $(this).attr('data-id');		
		gstCalculation_edit(selid);
	});
	$('.editchangegsttype').change(function(){
		selid1 = $(this).attr('data-id');		
		$('#editstock_gst_'+selid1).val(0);
		$('#editstock_gstprice_'+selid1).val(0);
	});

	
	
	
});