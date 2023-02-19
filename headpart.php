<!DOCTYPE html>
<html>
<head>
	<title>JVK Enterprises Billing Software</title>	
	<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
	
	<link rel='stylesheet' href='css/jquery-ui.min.css'></link>
	<link rel='stylesheet' href='css/jquery-ui.structure.min.css'></link>
	<link rel='stylesheet' href='css/jquery-ui.theme.min.css'></link>	
	<link rel="stylesheet" href="css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="css/bootstrap-theme.min.css"></link>
	
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/create.js"></script>
	<script src="js/update.js"></script>
	<script src="js/delete.js"></script>
	<script src="js/billing.js"></script>
	
	<link rel='stylesheet' href='css/desireit.css'></link>
	
	<script type='text/javascript' src='js/jquery-ui.min.js'></script>
	<script>
	
		$( function() {
			$( document ).tooltip({
			  position: {
				my: "center bottom-20",
				at: "center top",
				using: function( position, feedback ) {
				  $( this ).css( position );
				  $( "<div>" )
					.addClass( "arrow" )
					.addClass( feedback.vertical )
					.addClass( feedback.horizontal )
					.appendTo( this );
				}
			  }
			});
			
			 $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
			 
			 
		});
 	</script>
  
  	<script>
		$(function() {   
			var activecategories = <?php include("dynamic_categories.php"); ?>;
			
			$( ".categories_dropdown" ).autocomplete({
			   source: activecategories,
				select: function( event, ui ) {
					$( this ).val( ui.item.label );
					$( this ).attr( 'hiddenid',ui.item.id );
					
					$.post("dynamic_stock.php", {getstock:ui.item.id}, function(res){
						var activestocklist = $.parseJSON(res);	
						if( activestocklist.length>0 ){
							$( ".stock_dropdown" ).autocomplete({
							   source: activestocklist,
								select: function( event, ui ) {
									$( this ).val( ui.item.label );
									$( this ).attr( 'hiddenid',ui.item.id );
									$('#stock_qty').val(ui.item.qty);
									$('#stock_price').val(ui.item.price);
									$('.newqty_formblock').show();
									$('#stock_qty').attr("readonly", "readonly");
									$('#stock_price').attr("readonly", "readonly");
								},
								minLength:2	
							});		
						}
						
					});
				},
				minLength:2	
			});	
			
			
			
		});
	</script>
	
	
	<script>
		$(function() {   
			var customersinformation = <?php include("dynamic_customers.php"); ?>;
			
			$( ".customers_dropdown" ).autocomplete({
			   source: customersinformation,
				select: function( event, ui ) {
					$( '#mobile' ).val( ui.item.mobile );
					$( '#state' ).val( ui.item.state );
					$( '#city' ).val( ui.item.city );
					$( '#gstno' ).val( ui.item.gst );
					$( '#pincode' ).val( ui.item.pincode );
					$( '#state' ).val( ui.item.state );
					$( '#address' ).val( ui.item.address );
					$( this ).val( ui.item.label );
					$( this ).attr( 'hiddenid',ui.item.id );
					$('#vehicle').focus();
				},
				minLength:2	
			});	
			
			
			
		});
	</script>
	
	
	<script>
		$(function() {   
			var activecategories2 = <?php include("onlystock.php"); ?>;			
			var selector = 'input.stock_dropdown_billing';
			$(document).on('keydown.autocomplete', selector, function() {
				$( this).autocomplete({
				    source: activecategories2,
				    mustMatch: false,
					select: function( event, ui ) {
						workingRow = $(this).attr('data-id');						
						$( this ).val( ui.item.label );
						$( this ).attr( 'hiddenid',ui.item.id );
						$('#billingqty_'+workingRow).attr('avail-qty', ui.item.qty);
						$('#billingchoosenqty_'+workingRow).val(ui.item.qty);
						$('#billingavailqty_'+workingRow).val(ui.item.qty);
						$('#billingchoosenqty_'+workingRow).val(ui.item.qty);
						$('#billingqty_'+workingRow).val(1);
						$('#billingactualprice_'+workingRow).val(ui.item.price);
						$('#billingprice_'+workingRow).val(ui.item.price);
						$('#billinggstprice_'+workingRow).val(ui.item.gstprice);
						$('#billingwithgstprice_'+workingRow).val(ui.item.price);
						$('#billingactualprice_'+workingRow).attr("actual-price", ui.item.price);
						$('#billingprice_'+workingRow).attr("actual-price", ui.item.price);
						$('#billingprice_'+workingRow).attr("actual-gst", ui.item.gst);
						$('#billingprice_'+workingRow).attr("actual-gstprice", ui.item.gstprice);
						//$('.addbillingrow').trigger('click');
						thisRow = $(this).attr('data-id');
						$('#billingqty_'+thisRow).focus().select();
					},
					minLength:1
				});	
			});	


			var measuresList = <?php include("dynamic_measures.php"); ?>;			
			var selector_billingchoosenqty = 'input.billingchoosenqty';
			$(document).on('keydown.autocomplete', selector_billingchoosenqty, function() {
				$( this).autocomplete({
				    source: measuresList,
				    mustMatch: false,
					select: function( event, ui ) {
						workingRow = $(this).attr('data-id');						
						$( this ).val( ui.item.label );
						$( this ).attr( 'hiddenid',ui.item.id );						
					},
					minLength:1
				});	
			});	
			
			
			$(document).keyup(function(e) {
				if (e.keyCode == 27) {
					$('.modal.in').modal('hide');
				}
			});

			
		});
		
		


	</script>
	
	
  <link rel="stylesheet" href="css/jqueryui_desireit.css"></link>
  <style>
	@media screen and (max-width:250px){
		.justnavhead{
			padding:0;
			margin:0;
			background:red !important;
		}
		.justnav{
			background:green;
			width:100%
		}
		.navbar-nav>li{
			width:100% !important;
		}
		.justnav>li{
			clear:both !important;
			float:none !important;
			display:block !important;
		}	
		.justnav>li>a{
			display:block !important;
			color:red !important;
			width:100% !important;
		}
	}
  </style>
	
</head>
<body>
	<div class='container-fluid'>
		<div class='col-md-2 logo'>
		JVK Enterprises
		</div>
		<div class='clearfix'></div>
		
