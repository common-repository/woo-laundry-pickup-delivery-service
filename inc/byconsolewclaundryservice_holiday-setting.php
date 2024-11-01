<?php
function byclaundryservice_admin_holiday_settings_form()
{?>

			<div class="wrap">

			<h1>Woocommerce Laundry holiday setting</h1>

			<form method="post" class="form_theme_panal" action="options.php">

				<?php

					settings_fields("byclaundryserviceholidayoptions");

					do_settings_sections("byclaundryservice-holiday-availability-options");      

					submit_button(); 

				?>          

			</form>

			</div>

<?php

}

	
function byclaundryservice_general_holiday_option()

{
	/************************************************/
	
	$bycwclaundryservice_general_holiday = get_option('bycwclaundryservice_general_holiday');

	if(empty($bycwclaundryservice_general_holiday)){

		$bycwclaundryservice_general_holiday=array();

		}


	echo '<div class="bycwclaundryservice_general_holidays">';
	
	$Sunday 	=	__('Sunday','byconsolewclaundryservice');
	$Monday		=	__('Monday','byconsolewclaundryservice');
	$Tuesday	=	__('Tuesday','byconsolewclaundryservice');
	$Wednesday	=	__('Wednesday','byconsolewclaundryservice');
	$Thursday	=	__('Thursday','byconsolewclaundryservice');
	$Friday		=	__('Friday','byconsolewclaundryservice');
	$Saturday	=	__('Saturday','byconsolewclaundryservice');



	if(in_array('0',$bycwclaundryservice_general_holiday)){

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="0" checked><span style="padding-right:20px;">'.$Sunday.'</span>';	}else{

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="0"><span style="padding-right:20px;">'.$Sunday.'</span>';

		}


	if(in_array('1',$bycwclaundryservice_general_holiday)){

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="1" checked><span style="padding-right:20px;">'.$Monday.'</span>';	}else{

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="1"><span style="padding-right:20px;">'.$Monday.'</span>';

		}


	if(in_array('2',$bycwclaundryservice_general_holiday)){

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="2" checked><span style="padding-right:20px;">'.$Tuesday.'</span>';	}else{

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="2"><span style="padding-right:20px;">'.$Tuesday.'</span>';

		}


	if(in_array('3',$bycwclaundryservice_general_holiday)){

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="3" checked><span style="padding-right:20px;">'.$Wednesday.'</span>';	}else{

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="3"><span style="padding-right:20px;">'.$Wednesday.'</span>';

		}


	if(in_array('4',$bycwclaundryservice_general_holiday)){

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="4" checked><span style="padding-right:20px;">'.$Thursday.'</span>';	}else{

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="4"><span style="padding-right:20px;">'.$Thursday.'</span>';

		}


	if(in_array('5',$bycwclaundryservice_general_holiday)){

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="5" checked><span style="padding-right:20px;">'.$Friday.'</span>';	}else{

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="5"><span style="padding-right:20px;">'.$Friday.'</span>';

		}


	if(in_array('6',$bycwclaundryservice_general_holiday)){

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="6" checked><span style="padding-right:20px;">'.$Saturday.'</span>';	}else{

		echo '<input type="checkbox" name="bycwclaundryservice_general_holiday[]" id="bycwclaundryservice_general_holiday" value="6"><span style="padding-right:20px;">'.$Saturday.'</span>';

		}

   echo '</div>';


	
	/*************************************************/

?>


    
<p><span style="color:#f00">Need separate closing days for pickup and delivery service? Please consider <a href="https://www.plugins.byconsole.com/product/laundry-pickup-delivery-plugin-for-woocommerce/" target="_blank">pro version</a> then.</span></p>

<?php

 } 
 
function byclaundryservice_admin_national_holiday_date_setting(){?>

<script>

jQuery(document).ready(function() {
	//alert('National');

jQuery("#byclaundryservice_admin_national_holiday_date").multiDatesPicker({

numberOfMonths: 4,

showButtonPanel: true,

changeMonth: true,

changeYear: false,

dateFormat: 'dd-mm'

});

} );

</script>

<input type="text" id="byclaundryservice_admin_national_holiday_date" name="byclaundryservice_admin_national_holiday_date" readonly="readonly" value="<?php printf(get_option('byclaundryservice_admin_national_holiday_date')); ?>" style=" padding:7px; width:40%;"><span class="calendar_opentext">Click on text box to open calendar and select your national holidays </span><span style="color:#f00">(This feature is available on <a href="https://www.plugins.byconsole.com/product/laundry-pickup-delivery-plugin-for-woocommerce/" target="_blank">pro version</a>)</span>

<?php }	

function byclaundryservice_admin_casual_holiday_date_setting(){

?>

<script>

var dateToday = new Date();

jQuery(document).ready(function() {

jQuery( "#byclaundryservice_admin_casual_holiday_date" ).multiDatesPicker({

numberOfMonths: 4,

showButtonPanel: true,

dateFormat: 'dd-mm-yy'

//minDate: dateToday

});

} );

</script>

<input type="text" id="byclaundryservice_admin_casual_holiday_date" name="byclaundryservice_admin_casual_holiday_date" readonly="readonly" value="<?php printf(get_option('byclaundryservice_admin_casual_holiday_date')); ?>" style="padding:7px; width:40%;" /><span class="calendar_opentext">Click on text box to open calendar </span><span style="color:#f00">(This feature is available on <a href="https://www.plugins.byconsole.com/product/laundry-pickup-delivery-plugin-for-woocommerce/" target="_blank">pro version</a>)</span>   

<?php  }


//Delivery holiday setting

function byclaundryservice_admin_national_holiday_delivery_date_setting(){?>

<script>

jQuery(document).ready(function() {
	//alert('National');

jQuery("#byclaundryservice_admin_national_holiday_delivery_date").multiDatesPicker({

numberOfMonths: 4,

showButtonPanel: true,

changeMonth: true,

changeYear: false,

dateFormat: 'dd-mm'

});

} );

</script>

<input type="text" id="byclaundryservice_admin_national_holiday_delivery_date" name="byclaundryservice_admin_national_holiday_delivery_date" readonly="readonly" value="<?php printf(get_option('byclaundryservice_admin_national_holiday_delivery_date')); ?>" style=" padding:7px; width:40%;"><span class="calendar_opentext">Click on text box to open calendar and select your national holidays </span><span style="color:#f00">(This feature is available on <a href="https://www.plugins.byconsole.com/product/laundry-pickup-delivery-plugin-for-woocommerce/" target="_blank">pro version</a>)</span>

<?php }	

function byclaundryservice_admin_casual_holiday_delivery_date_setting(){

?>

<script>

var dateToday = new Date();

jQuery(document).ready(function() {

jQuery( "#byclaundryservice_admin_casual_holiday_delivery_date" ).multiDatesPicker({

numberOfMonths: 4,

showButtonPanel: true,

dateFormat: 'dd-mm-yy'

//minDate: dateToday

});

} );

</script>

<input type="text" id="byclaundryservice_admin_casual_holiday_delivery_date" name="byclaundryservice_admin_casual_holiday_delivery_date" readonly="readonly" value="<?php printf(get_option('byclaundryservice_admin_casual_holiday_delivery_date')); ?>" style="padding:7px; width:40%;" /><span class="calendar_opentext">Click on text box to open calendar </span><span style="color:#f00">(This feature is available on <a href="https://www.plugins.byconsole.com/product/laundry-pickup-delivery-plugin-for-woocommerce/" target="_blank">pro version</a>)</span>   

<?php  }



 

add_action('admin_init', 'byclaundryservice_holiday_plugin_settings_fields');



function byclaundryservice_holiday_plugin_settings_fields()

	{

	add_settings_section("byclaundryserviceholidayoptions", "All Settings", null, "byclaundryservice-holiday-availability-options");

 

		add_settings_field("byclaundryservice_general_holiday_check", "Closing days : ", "byclaundryservice_general_holiday_option", "byclaundryservice-holiday-availability-options", "byclaundryserviceholidayoptions");

	
		add_settings_field("byclaundryservice_admin_national_holiday_date", "National Holidays Date(Pickup):", "byclaundryservice_admin_national_holiday_date_setting", "byclaundryservice-holiday-availability-options", "byclaundryserviceholidayoptions");
	

		add_settings_field("byclaundryservice_admin_casual_holiday_date", "Casual Holidays Date(Pickup):", "byclaundryservice_admin_casual_holiday_date_setting", "byclaundryservice-holiday-availability-options", "byclaundryserviceholidayoptions");
		
		
		add_settings_field("byclaundryservice_admin_national_holiday_delivery_date", "National Holidays Date(Delivery):", "byclaundryservice_admin_national_holiday_delivery_date_setting", "byclaundryservice-holiday-availability-options", "byclaundryserviceholidayoptions");
	

		add_settings_field("byclaundryservice_admin_casual_holiday_delivery_date", "Casual Holidays Date(Delivery):", "byclaundryservice_admin_casual_holiday_delivery_date_setting", "byclaundryservice-holiday-availability-options", "byclaundryserviceholidayoptions");

	

	register_setting("byclaundryserviceholidayoptions", "bycwclaundryservice_general_holiday");
	
	}

?>