$(document).ready(function(){
	
	
	
	$('.del_category').click(function(){		
		newcategory_did = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {deletecategory:newcategory_did}, function(res){
				if( res == true ){
					$('#row_'+newcategory_did).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	$('.del_moderator').click(function(){		
		newcategory_did = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {deletemoderator:newcategory_did}, function(res){
				if( res == true ){
					$('#row_'+newcategory_did).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	
	$('.del_customer').click(function(){		
		delcustomer = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {delcustomer:delcustomer}, function(res){
				if( res == true ){
					$('#row_'+delcustomer).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	$('.del_vehicle').click(function(){		
		delvehicle = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {delvehicle:delvehicle}, function(res){
				if( res == true ){
					$('#row_'+delvehicle).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	$('.del_driver').click(function(){		
		deldriver = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {deldriver:deldriver}, function(res){
				if( res == true ){
					$('#row_'+deldriver).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	
	$('.del_stock').click(function(){		
		listcategory_did = $(this).attr('href');		
		listcategory_did_name = $(this).attr('data-name');	
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {listcategory_did:listcategory_did, listcategory_did_name:listcategory_did_name}, function(res){
				if( res == true ){
					$('#row_'+listcategory_did).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	$('.del_invoice').click(function(){		
		listcategory_did = $(this).attr('href');		
		if(  confirm("Are you sure ?") ){
			$.post("processing.php", {delinvoiceid:listcategory_did}, function(res){
				if( res == true ){
					$('#row_'+listcategory_did).hide();
				}else{
					alert("Something went wrong! Try again later!");
				}	
			});
		}
	});
	
	
});