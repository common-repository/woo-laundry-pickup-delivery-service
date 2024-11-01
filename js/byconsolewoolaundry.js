jQuery(document).ready(function(){

	jQuery("#byconsolewooopd_calculate_distance_between_two_location_button").click(function(){



		setTimeout(function(){ 
		
		var byconsolewooopd_pickup_date = jQuery('#byconsolewooopd_pickup_date').val();	
		var byconsolewooopd_pickup_time = jQuery('input[name=byconsolewooopd_pickup_time]:checked').val();	
		var byconsolewooopd_delivery_date = jQuery('#byconsolewooopd_delivery_date').val();	
		var byconsolewooopd_delivery_time = jQuery('input[name=byconsolewooopd_delivery_time]:checked').val();	
		
		jQuery('#cart_pickup_datetime').html(byconsolewooopd_pickup_date + '&nbsp;&nbsp;<br /><br />' +byconsolewooopd_pickup_time);
		
		jQuery('#cart_delivery_datetime').html(byconsolewooopd_delivery_date + '&nbsp;&nbsp;<br /><br />' +byconsolewooopd_delivery_time);
 }, 4000);
		


	});	

 });