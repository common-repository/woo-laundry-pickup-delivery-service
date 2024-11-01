jQuery(document).on('click','#del_pickup_bycwoospd',function(e){

var alert_confirmation = confirm("If any order was placed for this location in past, would not be able to show this location any more on order details section.");

	if (alert_confirmation == true) {

		var plickup_location_to_remove=jQuery(this).attr("class");
		
		//alert('fieldset.'+plickup_location_to_remove);

		jQuery('fieldset.'+plickup_location_to_remove).remove();

	} else {		


	}


	});
	
jQuery(document).on('click','#del_delivery_bycwoospd',function(e){

var alert_confirmation = confirm("If any order was placed for this location in past, would not be able to show this location any more on order details section.");

	if (alert_confirmation == true) {

		var delivery_location_to_remove=jQuery(this).attr("class");
		
		//alert('fieldset.'+delivery_location_to_remove);

		jQuery('fieldset.'+delivery_location_to_remove).remove();

	} else {		


	}


	});	