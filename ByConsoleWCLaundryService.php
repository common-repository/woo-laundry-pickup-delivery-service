<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly /** 

/*

* Plugin Name: Laundry pickup & delivery Service for WooCommerce

* Plugin URI: https://plugins.byconsole.com/product/laundry-pickup-delivery-plugin-for-woocommerce/ 

* Description: Turn your WC store as a door to door laundry service provider website. On checkout page this plugin ask for pickup date and time as well delivery date and time for laundry service, once these infos are provided it lead to normal WC checkout process. In order detail page and new notification email it include the chosen pickup and delivery date-time(Need to have Woocommerce installed first). Read product blog to know about various <a href="https://blog.byconsole.com/" target="_blank">HOW TOs</a> . 

* Version: 1.0.3

* Author: ByConsole 

* Author URI: https://byconsole.com 

* Text Domain: woo-laundry-pickup-delivery-service

* Domain Path: /languages

* License: GPL2 

*/ 

	include('inc/byconsolewclaundryservice_admin.php');
	
	require_once('inc/byconsolewclaundryservice_holiday-setting.php');
	require_once('class/ByconsoleWooLaundry.php');
	

	//checkout page.......

	

	function byconsolewclaundry_checkout_field( $checkout ){

	

	global $woocommerce;

	

	$byconsolewclaundry_plugin_url = plugins_url();

	?>

	<div id="byconsolewclaundry_checkout_field">

	<div class="byconsolewclaundry_pickup_details_container">

	

	<h4><?php esc_html_e('CHOOSE YOUR PICKUP DATE & TIME','woo-laundry-pickup-delivery-service'); ?></h4><hr style="height: 2px;background-color: #4169e1;" />

	<?php

	/****************** Pickup Details  *****************/
	woocommerce_form_field( 'byconsolewclaundry_pickup_date', array(

	'type'          => 'text',

	'class'         => array('byconsolewclaundry_pickup_date'),

	'label'         => __('Select date','woo-laundry-pickup-delivery-service'),

	'placeholder'   => __('Select date','woo-laundry-pickup-delivery-service'),

	'required'      => true,
	
	'custom_attributes'		=>array('readonly'=>'readonly'),
	
	'autocomplete'      => false,

	

	));

	

	

	woocommerce_form_field( 'byconsolewclaundry_pickup_time', array(

	'type'          => 'text',

	'class'         => array('byconsolewclaundry_pickup_time'),

	'label'         => __('Select time','woo-laundry-pickup-delivery-service'),

	'placeholder'   => __('Select time','woo-laundry-pickup-delivery-service'),

	'readonly'		=>'true',
	
	'autocomplete'      => false,
	
	'required'      => true,

	));

	

	

	/***************** Delivery Section **********************/

	

	?>
    
    </div>

	<div style="clear:both;"></div>
    
	<div class="byconsolewclaundry_delivery_details_container">

	<h4><?php esc_html_e('CHOOSE YOUR DELIVERY DATE & TIME','woo-laundry-pickup-delivery-service'); ?></h4><hr style="height: 2px;background-color: #4169e1;" />

	
	<?php
	
	woocommerce_form_field( 'byconsolewclaundry_delivery_date', array(

	'type'          => 'text',

	'class'         => array('byconsolewclaundry_delivery_date'),

	'label'         => __('Select date','woo-laundry-pickup-delivery-service'),

	'placeholder'   => __('Select date','woo-laundry-pickup-delivery-service'),

	'required'      => true,

	'custom_attributes'		=>array('readonly'=>'readonly'),
	
	'autocomplete'      => false,

	));

	

	

	woocommerce_form_field( 'byconsolewclaundry_delivery_time', array(

	'type'          => 'text',

	'class'         => array('byconsolewclaundry_delivery_time'),

	'label'         => __('Select time','woo-laundry-pickup-delivery-service'),

	'placeholder'   => __('Select time','woo-laundry-pickup-delivery-service'),

	'required'      => true,
	
	'autocomplete'      => false,	

	));
	
	?>

	</div>
	
    </div>	
	<?php
	}
	
	add_action( 'woocommerce_before_checkout_billing_form', 'byconsolewclaundry_checkout_field' );
	
		function byconsolewclaundry_next_and_prev_button_function()
			{
			?>
            
             <input type="button" name="byconsolewclaundry_next_button_on_address_filed" id="byconsolewclaundry_next_button_on_address_filed" value="<?php esc_html_e('NEXT','woo-laundry-pickup-delivery-service');?>" style="float:right;background: #ffa500; color: #fff; border-radius: 5px; clear:both; "/>

			<input type="button" name="byconsolewclaundry_prev_button_on_address_filed" id="byconsolewclaundry_prev_button_on_address_filed" value="<?php esc_html_e('Prev','woo-laundry-pickup-delivery-service');?>" style="float:left;background: #ffa500; color: #fff; border-radius: 5px; clear:both; display:none; "/>
            
			<?php
				
			}

		add_action('woocommerce_after_checkout_form','byconsolewclaundry_next_and_prev_button_function');

	

//Checkout field process.......

		function byconsolewclaundry_checkout_field_process() {
			
			$ByconsoleWooLaundry = new ByconsoleWooLaundry();
			$ByconsoleWooLaundry_date_format = $ByconsoleWooLaundry->get_wooolaundry_settings('byclaundryservice_date_format');

		// Pickup Field Blank	

		if ( ! empty( $_POST['byconsolewclaundry_pickup_date'] ) ) {
			
			$byconsolewclaundry_pickup_date_input=sanitize_text_field($_POST['byconsolewclaundry_pickup_date']);
			
			$mdy = $ByconsoleWooLaundry->get_m_d_y($byconsolewclaundry_pickup_date_input);
			
			if(!wp_checkdate($mdy['m'],$mdy['d'],$mdy['y'],$byconsolewclaundry_pickup_date_input)){
				
				wc_add_notice('Please provide proper pickup date', 'error' );
			
			}

			}else{
					
				wc_add_notice('Please select a pickup date', 'error' );
					
				}
		if(!empty($_POST['byconsolewclaundry_pickup_time'])){
			
			$byconsolewclaundry_pickup_time_input=sanitize_text_field($_POST['byconsolewclaundry_pickup_time']);
			
			//$byconsolewclaundry_pickup_time_input_array=explode(':',$byconsolewclaundry_pickup_time_input);
			
			if(strtotime($byconsolewclaundry_pickup_time_input)===false){
				wc_add_notice('Please select a valid pickup time', 'error' );
				}else{
				$byconsolewclaundry_pickup_start_time=get_option('byclaundryservice_pickup_time_slot_by_start');
				$byconsolewclaundry_pickup_end_time=get_option('byclaundryservice_pickup_time_slot_by_end');
				
				if(strtotime($byconsolewclaundry_pickup_time_input) >= strtotime($byconsolewclaundry_pickup_start_time) && strtotime($byconsolewclaundry_pickup_time_input) <= strtotime($byconsolewclaundry_pickup_end_time)){
					}else{
						wc_add_notice('Select a pickup time in allowable range'.$byconsolewclaundry_pickup_time_input.' // '.$byconsolewclaundry_pickup_start_time.' // '.$byconsolewclaundry_pickup_end_time, 'error' );
						}
				
				}

		}else{
			wc_add_notice('Select your pickup time', 'error' );
			}
		
		
	

		// Delivery Field Blank	

		if ( ! empty( $_POST['byconsolewclaundry_delivery_date'] ) ) {
			
			$byconsolewclaundry_delivery_date_input=sanitize_text_field($_POST['byconsolewclaundry_delivery_date']);
			
			$mdy = $ByconsoleWooLaundry->get_m_d_y($byconsolewclaundry_delivery_date_input);
			
			if(!wp_checkdate($mdy['m'],$mdy['d'],$mdy['y'],$byconsolewclaundry_delivery_date_input)){
				
				wc_add_notice('Please provide proper delivery date', 'error' );
			
			}

			}else{
					
				wc_add_notice('Please select a delivery date', 'error' );
					
				}
		
		if(!empty($_POST['byconsolewclaundry_delivery_time'])){
			
			$byconsolewclaundry_delivery_time_input=sanitize_text_field($_POST['byconsolewclaundry_delivery_time']);
			
			//$byconsolewclaundry_delivery_time_input_array=explode(':',$byconsolewclaundry_delivery_time_input);
			
			if(strtotime($byconsolewclaundry_delivery_time_input)===false){
				wc_add_notice('Please select a valid delivery time', 'error' );
				}else{
				$byconsolewclaundry_delivery_start_time=get_option('byclaundryservice_delivery_time_slot_by_start');
				$byconsolewclaundry_delivery_end_time=get_option('byclaundryservice_delivery_time_slot_by_end');
				
				if(strtotime($byconsolewclaundry_delivery_time_input) >= strtotime($byconsolewclaundry_delivery_start_time) && strtotime($byconsolewclaundry_delivery_time_input) <= strtotime($byconsolewclaundry_delivery_end_time)){
					}else{
						wc_add_notice('Select a delivery time in allowable range', 'error' );
						}
				
				}

		}else{
			wc_add_notice('Select your delivery time', 'error' );
			}

	}
	
	

	add_action('woocommerce_checkout_process', 'byconsolewclaundry_checkout_field_process');
	//Save the order meta with field value
	function byconsolewclaundry_checkout_field_update_order_meta( $order_id ) {
		
		$ByconsoleWooLaundery = new ByconsoleWooLaundry();

		// Pickup Data save
		if ( ! empty( $_POST['byconsolewclaundry_pickup_date'] ) ) {
			
			update_post_meta( $order_id, 'byconsolewclaundry_pickup_date', $ByconsoleWooLaundery->set_default_date_format(sanitize_text_field($_POST['byconsolewclaundry_pickup_date'])));
		}
		
		if ( ! empty( $_POST['byconsolewclaundry_pickup_time'] ) ) {
			update_post_meta( $order_id, 'byconsolewclaundry_pickup_time', sanitize_text_field($_POST['byconsolewclaundry_pickup_time']));	
			}

	

		// Delivery Data save	
	if ( ! empty( $_POST['byconsolewclaundry_delivery_date'] ) ) {
			update_post_meta( $order_id, 'byconsolewclaundry_delivery_date', $ByconsoleWooLaundery->set_default_date_format(sanitize_text_field($_POST['byconsolewclaundry_delivery_date'])));
			}

		
		if ( ! empty( $_POST['byconsolewclaundry_delivery_time'] ) ) {
			update_post_meta( $order_id, 'byconsolewclaundry_delivery_time', sanitize_text_field($_POST['byconsolewclaundry_delivery_time']));	
			}
			}
			
			

	add_action( 'woocommerce_checkout_update_order_meta', 'byconsolewclaundry_checkout_field_update_order_meta' );

	//remove coupan notice

	add_action( 'woocommerce_before_checkout_form', 'remove_checkout_coupon_form', 9 );
	function remove_checkout_coupon_form(){

	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

		
	}
	
	

	function byconsolewclaundry_checkout_field_display_user_order_meta($order){
		
		$ByconsoleWooLaundery = new ByconsoleWooLaundry();

		$byconsolewclaundry_pickup_date = $ByconsoleWooLaundery->get_formated_date_from_default_format(get_post_meta( $order->get_id(), 'byconsolewclaundry_pickup_date', true ));

		$byconsolewclaundry_pickup_time = get_post_meta( $order->get_id(), 'byconsolewclaundry_pickup_time', true );

		$byconsolewclaundry_delivery_date = $ByconsoleWooLaundery->get_formated_date_from_default_format(get_post_meta( $order->get_id(), 'byconsolewclaundry_delivery_date', true ));

		$byconsolewclaundry_delivery_time= get_post_meta( $order->get_id(), 'byconsolewclaundry_delivery_time', true );

		$byconsolewclaundry_pickup_date_time_details = '';

		$byconsolewclaundry_delivery_date_time_details = '';

		if($byconsolewclaundry_pickup_date !=''){ $byconsolewclaundry_pickup_date_time_details .= $byconsolewclaundry_pickup_date.'&nbsp;@&nbsp;';}

		if($byconsolewclaundry_pickup_time !=''){ $byconsolewclaundry_pickup_date_time_details .= $byconsolewclaundry_pickup_time;}	

		if($byconsolewclaundry_delivery_date !=''){ $byconsolewclaundry_delivery_date_time_details .= $byconsolewclaundry_delivery_date.'&nbsp;@&nbsp;';}

		if($byconsolewclaundry_delivery_time !=''){ $byconsolewclaundry_delivery_date_time_details .= $byconsolewclaundry_delivery_time;}		

		//echo '<hr/>';
		echo '<p style="color:#ff5800"> <b>'.esc_html_e('Pickup date/time','woo-laundry-pickup-delivery-service').'</b> '.esc_html($byconsolewclaundry_pickup_date_time_details).'</p>';

		echo '<p style="color:#ff5800"> <b>'.esc_html_e('Delivery date/time','woo-laundry-pickup-delivery-service').'</b> '.esc_html($byconsolewclaundry_delivery_date_time_details).'</p>';
		//echo '<hr/>';

	}

	add_action( 'woocommerce_order_details_after_order_table', 'byconsolewclaundry_checkout_field_display_user_order_meta', 10, 1 );

	function byconsolewclaundry_checkout_field_display_admin_order_meta($order){
		
		$ByconsoleWooLaundry = new ByconsoleWooLaundry();

		$byconsolewclaundry_pickup_date = $ByconsoleWooLaundry->get_formated_date_from_default_format(get_post_meta( $order->get_id(), 'byconsolewclaundry_pickup_date', true ));

		$byconsolewclaundry_pickup_time = get_post_meta( $order->get_id(), 'byconsolewclaundry_pickup_time', true );

		$byconsolewclaundry_delivery_date = $ByconsoleWooLaundry->get_formated_date_from_default_format(get_post_meta( $order->get_id(), 'byconsolewclaundry_delivery_date', true ));

		$byconsolewclaundry_delivery_time = get_post_meta( $order->get_id(), 'byconsolewclaundry_delivery_time', true );  

		//pickup

		 $byconsolewclaundry_pickup_date_time_details = '';

		if($byconsolewclaundry_pickup_date !=''){ $byconsolewclaundry_pickup_date_time_details .= $byconsolewclaundry_pickup_date.'&nbsp;@&nbsp;';}

		if($byconsolewclaundry_pickup_time !=''){ $byconsolewclaundry_pickup_date_time_details .= $byconsolewclaundry_pickup_time;}	

		//Delivery

		$byconsolewclaundry_delivery_date_time_details = '';

		if($byconsolewclaundry_delivery_date !=''){ $byconsolewclaundry_delivery_date_time_details .= $byconsolewclaundry_delivery_date.'&nbsp;@&nbsp;';}

		if($byconsolewclaundry_delivery_time !=''){ $byconsolewclaundry_delivery_date_time_details .= $byconsolewclaundry_delivery_time;}	
	
		//echo '<hr/>';
		echo '<p style="color:#ff5800"> <b>'.esc_html_e('Pickup date/time','woo-laundry-pickup-delivery-service').'</b> '.esc_html($byconsolewclaundry_pickup_date_time_details).'</p>';

		echo '<p style="color:#ff5800"> <b>'.esc_html_e('Delivery date/time','woo-laundry-pickup-delivery-service').'</b> '.esc_html($byconsolewclaundry_delivery_date_time_details).'</p>';
		//echo '<hr/>';

	}

	add_action( 'woocommerce_admin_order_data_after_shipping_address', 'byconsolewclaundry_checkout_field_display_admin_order_meta', 10, 1 );

	function byconsolewclaundry_woocommerce_email_after_order_table($order){
		
	$ByconsoleWooLaundry = new ByconsoleWooLaundry();	

	$byconsolewclaundry_delivery_date = $ByconsoleWooLaundry->get_formated_date_from_default_format(get_post_meta( $order->get_id(), 'byconsolewclaundry_delivery_date', true ));

	$byconsolewclaundry_delivery_time = get_post_meta( $order->get_id(), 'byconsolewclaundry_delivery_time', true );

	$byconsolewclaundry_pickup_date = $ByconsoleWooLaundry->get_formated_date_from_default_format(get_post_meta( $order->get_id(), 'byconsolewclaundry_pickup_date', true ));

	$byconsolewclaundry_pickup_time = get_post_meta( $order->get_id(), 'byconsolewclaundry_pickup_time', true );

	$byconsolewclaundry_pickup_date_time_details = '';

	$byconsolewclaundry_delivery_date_time_details = '';

	if($byconsolewclaundry_pickup_date !=''){ $byconsolewclaundry_pickup_date_time_details .= $byconsolewclaundry_pickup_date;}

	if($byconsolewclaundry_pickup_date !=''){ $byconsolewclaundry_pickup_date_time_details .= $byconsolewclaundry_pickup_time;}	

	if($byconsolewclaundry_delivery_date !=''){ $byconsolewclaundry_delivery_date_time_details .= $byconsolewclaundry_delivery_date;}

	if($byconsolewclaundry_delivery_time !=''){ $byconsolewclaundry_delivery_date_time_details .= $byconsolewclaundry_delivery_time;}

	    echo '<p style="color:#ff5800"> <b>'.esc_html_e('Pickup date/time','woo-laundry-pickup-delivery-service').'</b> '.esc_html($byconsolewclaundry_pickup_date_time_details).'</p>';

		echo '<p style="color:#ff5800"> <b>'.esc_html_e('Delivery date/time','woo-laundry-pickup-delivery-service').'</b> '.esc_html($byconsolewclaundry_delivery_date_time_details).'</p>';

	}

	add_action( "woocommerce_email_after_order_table", "byconsolewclaundry_woocommerce_email_after_order_table", 10, 1);

	function byconsolewclaundry_redirect_checkout_add_cart( $byconsolewclaundry_url ) {

		$byconsolewclaundry_url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); 

		return $byconsolewclaundry_url;

	} 

	add_filter( 'woocommerce_add_to_cart_redirect', 'byconsolewclaundry_redirect_checkout_add_cart' );

	function byconsolewclaundry_custom_order_button_text() {

	 return  __( 'Pay for delivery', 'woocommerce' ); 

	}

	add_filter( 'woocommerce_order_button_text', 'byconsolewclaundry_custom_order_button_text' ); 

	function byconsolewclaundry_footer_script(){
		
		/**************************/
$bycwclaundryservice_general_holiday=get_option('bycwclaundryservice_general_holiday');
?>

	<script>

	jQuery(document).ready(function(){
		
	$bycwclaundryservice_general_holiday = [
<?php
$stat_i=1;
if(!empty($bycwclaundryservice_general_holiday)){
$day_i=count($bycwclaundryservice_general_holiday);
foreach($bycwclaundryservice_general_holiday as $bycwclaundryservice_general_holiday_single)
{
echo trim($bycwclaundryservice_general_holiday_single);
//handle the last comma(,)
if($stat_i<$day_i){
echo ',';
}
$stat_i++;
}
}
?>
];  


<?php

$ByconsoleWooLaundry = new ByconsoleWooLaundry();

$byclaundry_date_format = $ByconsoleWooLaundry->get_wooolaundry_settings('byclaundryservice_date_format');

if($byclaundry_date_format==1){ ?>

	var byc_laundry_date_format='dd-mm-yy';

<?php }else if($byclaundry_date_format==2){ ?>

	var byc_laundry_date_format='D,d-m-yy';

<?php }else if($byclaundry_date_format==3){ ?>

	var byc_laundry_date_format='mm-dd-yy';

<?php }else if($byclaundry_date_format==4){ ?>

	var byc_laundry_date_format='dd/mm/yy';	

<?php }else if($byclaundry_date_format==5){ ?>

	var byc_laundry_date_format='mm/dd/yy';

<?php }else{ ?>

	var byc_laundry_date_format='dd-mm-yy';

<?php } ?>

	woospd_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	
	 jQuery("#byconsolewclaundry_pickup_date").datepicker({

						beforeShowDay  : function(date){ return BycCheckHoliDay(date)},

						minDate: new Date(),

						maxDate: "14+D",

						//dateFormat:"dd-mm-yy",
						dateFormat:byc_laundry_date_format,

						onSelect: function(date,obj){ return check_pickup_availability_options(date,obj)}

					});

	 jQuery("#byconsolewclaundry_delivery_date").datepicker({

						beforeShowDay  : function(date){ return BycCheckHoliDay(date)},

						minDate: new Date(),

						maxDate: "7+D",

						//dateFormat:"dd-mm-yy",
						dateFormat:byc_laundry_date_format,

						onSelect: function(date,obj){ return check_delivery_availability_options(date,obj)}

					});

		function check_pickup_availability_options(date,obj){

			jQuery('input#byconsolewclaundry_pickup_time').empty();

			//alert(date);

			var byclaundry_service_curtime= new Date().toLocaleTimeString("en-US", { hour12: false, hour: "numeric", minute: "numeric"});

			var byclaundry_selected_calendar_date = jQuery("#byconsolewclaundry_pickup_date").datepicker('getDate');	

			var wooLaundry_selected_calendar_date = jQuery("#byconsolewclaundry_pickup_date").val();

			var byclaundry_selected_date_day=jQuery.datepicker.formatDate('D', byclaundry_selected_calendar_date);

			//alert(wooSPD_selected_calendar_date);

			var today = new Date();

			var dd = today.getDate();

			var mm = today.getMonth()+1;

			var yyyy = today.getFullYear();

			if(dd<10){

				dd='0'+dd;

			} 

			if(mm<10){

				mm='0'+mm;

			}

			

			var todays_date_format = mm+'/'+dd+'/'+yyyy;

			var current_date=dd+'-'+mm+'-'+yyyy;

			//alert(current_date);

			var byc_oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds

			var byc_todays_date_val = new Date(todays_date_format);
			
			/*******************/
			
<?php if($byclaundry_date_format==1){ ?>

	//var byc_laundry_date_format='dd-mm-yy';

	var select_date=wooLaundry_selected_calendar_date.split('-');

	var date_string=select_date[1]+'/'+select_date[0]+'/'+select_date[2]

<?php }else if($byclaundry_date_format==2){ ?>

	var select_date=wooLaundry_selected_calendar_date.split(',');
	
	wooLaundry_selected_calendar_date = select_date=select_date[1];
	
	var select_date=select_date[1].split('-');

	var date_string=select_date[1]+'/'+select_date[0]+'/'+select_date[2]

<?php }else if($byclaundry_date_format==3){ ?>

	var date_string = wooLaundry_selected_calendar_date;

<?php }else if($byclaundry_date_format==4){ ?>

	var select_date=wooLaundry_selected_calendar_date.split('/');

	var date_string=select_date[1]+'/'+select_date[0]+'/'+select_date[2]	

<?php }else if($byclaundry_date_format==5){ ?>

	var date_string = wooLaundry_selected_calendar_date;

<?php }else{ ?>

	//var byc_laundry_date_format='dd-mm-yy';
	console.log("Issue with date format. Try by changing date fromat.");
	
<?php } ?>

			/*******************/

			//var byc_cal_pick_date_val = new Date(date);

			var byc_cal_pick_date_val =byclaundry_selected_calendar_date;

			var bycwoolaundry_diffDays = Math.round(Math.abs((byc_todays_date_val.getTime() - byc_cal_pick_date_val.getTime())/(byc_oneDay)));

			var bycwoolaundry_diffDays_add_oneday=bycwoolaundry_diffDays+1;

			//alert(bycspd_diffDays_add_oneday);

			jQuery("input#byconsolewclaundry_delivery_date").datepicker('option','minDate',bycwoolaundry_diffDays_add_oneday);

			// ajax time populated

		var byclaundryservices_curtime= new Date().toLocaleTimeString("en-US", { hour12: false, hour: "numeric", minute: "numeric"});

		var byclaundryservices_cur_minute= new Date().toLocaleTimeString("en-US", { hour12: false, minute: "numeric"});

		var byclaundryservices_current_date= new Date();

		var byclaundryservices_cur_minute= byclaundryservices_curtime.split(' ');

		byclaundryservices_cur_minute=byclaundryservices_cur_minute[0].split(':');

		byclaundryservices_cur_minute=byclaundryservices_current_date.getMinutes();

		var byclaundryservices_cur_hour= new Date().toLocaleTimeString("en-US", { hour12: false, hour: "numeric"});			

		byclaundryservices_cur_hour=byclaundryservices_cur_hour[0].split(':');

		byclaundryservices_cur_hour=byclaundryservices_current_date.getHours();

		//var byclaundrservice_pickup_start_time='<?php //echo get_option('byclaundryservice_pickup_time_slot_by_start') ?>';
		var byclaundrservice_pickup_start_time='<?php echo $ByconsoleWooLaundry->get_wooolaundry_settings('byclaundryservice_pickup_time_slot_by_start'); ?>';

		//var byclaundrservice_pickup_end_time='<?php //echo get_option('byclaundryservice_pickup_time_slot_by_end') ?>';
		var byclaundrservice_pickup_end_time='<?php echo $ByconsoleWooLaundry->get_wooolaundry_settings('byclaundryservice_pickup_time_slot_by_end'); ?>';

		//jQuery('input#byconsolewclaundry_pickup_time').empty();

		//jQuery('#byconsolewclaundry_pickup_time').empty();	
		
		/************************/
		<?php if($byclaundry_date_format==1){ ?>

		var byclaundry_current_date_format=dd+'-'+mm+'-'+yyyy;

		<?php }else if($byclaundry_date_format==3){ ?>
	
		var byclaundry_current_date_format=mm+'-'+dd+'-'+yyyy;

		<?php }else if($byclaundry_date_format==4){ ?>

		var byclaundry_current_date_format=dd+'/'+mm+'/'+yyyy;	

		<?php }else if($byclaundry_date_format==5){ ?>

		var byclaundry_current_date_format=mm+'/'+dd+'/'+yyyy;

		<?php }else{ ?>

		var byclaundry_current_date_format=dd+'-'+mm+'-'+yyyy;

		<?php } ?>

		/************************/

		//if(current_date==wooLaundry_selected_calendar_date){
		if(byclaundry_current_date_format==wooLaundry_selected_calendar_date){	
		
		
		 byclaundryservices_start_time_updated=ByConsoleWCLaundryServiceStartTimeByInterval(byclaundryservices_cur_hour,byclaundryservices_cur_minute);
		 

		if(jQuery('#byconsolewclaundry_pickup_time').hasClass('ui-timepicker-input')){

			jQuery('#byconsolewclaundry_pickup_time').timepicker('remove');

			jQuery('#byconsolewclaundry_pickup_time').val(' ');

			}		
			<?php 
			/*
			* since 1.0.2
			*/
			?>
		if(byclaundryservices_start_time_updated >= byclaundrservice_pickup_end_time){
			
			//jQuery('#byconsolewclaundry_pickup_time').val('');
			jQuery('#byconsolewclaundry_pickup_time').addClass('pickup_time_over_for_today');
			jQuery('#byconsolewclaundry_pickup_time').attr('disabled',true);
			jQuery('#byconsolewclaundry_pickup_time').attr('placeholder','We are closed for today, please select another date.');
			
			}else{
				
				//jQuery('#byconsolewclaundry_pickup_time').val(' ');
				jQuery('#byconsolewclaundry_pickup_time').attr('disabled',false);
				jQuery('#byconsolewclaundry_pickup_time').attr('placeholder','Select a time for pickup');
				
				if(jQuery('#byconsolewclaundry_pickup_time').hasClass('pickup_time_over_for_today')){
					jQuery('#byconsolewclaundry_pickup_time').removeClass('pickup_time_over_for_today');
					}
				
				jQuery('#byconsolewclaundry_pickup_time').timepicker({ 
				
				"minTime": byclaundryservices_start_time_updated,

				"maxTime": byclaundrservice_pickup_end_time,

				"step": "15",

				"timeFormat": "H:i",

				"disableTextInput": "true",

				"disableTouchKeyboard": "true",

				"scrollDefault": "now",

				"selectOnBlur": "true"

				});
				
				}

		}else {

		//jQuery('#byconsolewclaundry_pickup_time').empty();	
		
		jQuery('#byconsolewclaundry_pickup_time').attr('disabled',false);
				jQuery('#byconsolewclaundry_pickup_time').attr('placeholder','Select a time for pickup');
				
				if(jQuery('#byconsolewclaundry_pickup_time').hasClass('pickup_time_over_for_today')){
					jQuery('#byconsolewclaundry_pickup_time').removeClass('pickup_time_over_for_today');
					}

		

		if(jQuery('#byconsolewclaundry_pickup_time').hasClass('ui-timepicker-input')){

			jQuery('#byconsolewclaundry_pickup_time').timepicker('remove');

			jQuery('#byconsolewclaundry_pickup_time').val(' ');

			}

		jQuery('#byconsolewclaundry_pickup_time').timepicker({ 

		"minTime": byclaundrservice_pickup_start_time,

		"maxTime": byclaundrservice_pickup_end_time,

		"step": "15",

		"timeFormat": "H:i",

		"disableTextInput": "true",

		"disableTouchKeyboard": "true",

		"scrollDefault": "now",

		"selectOnBlur": "true"

		});

		}//if(current_date==woospd_selected_calendar_date)

		}	

  		function ByConsoleWCLaundryServiceStartTimeByInterval(byclaundryservices_cur_hour,byclaundryservices_cur_minute){

				//alert('in function ByConsoleWooODTStartTimeByInterval cur_hour,cur_minute is as: '+cur_hour+','+cur_minute);

				if(parseInt(byclaundryservices_cur_minute) >= 0 && parseInt(byclaundryservices_cur_minute) < 15){

				var start_minute=15;

				}else if(parseInt(byclaundryservices_cur_minute) >= 15 && parseInt(byclaundryservices_cur_minute) < 30){

				var start_minute=30;

				}else if(parseInt(byclaundryservices_cur_minute) >= 30 && parseInt(byclaundryservices_cur_minute) < 45){

				var start_minute=45;

				}else if(parseInt(byclaundryservices_cur_minute) >= 45 && parseInt(byclaundryservices_cur_minute) <= 59){

				var start_minute=59;

				}else{

				//alert('There is an issue please report to shop admin');

				}
				if(start_minute==59){

				var next_hour=parseInt(byclaundryservices_cur_hour)+1;

				if(next_hour<10){

				next_hour='0'+next_hour;

				}
				var byclaundryservices_start_time_updated=next_hour+":"+"00";

				}else{

				if(byclaundryservices_cur_hour<10){

				byclaundryservices_cur_hour='0'+byclaundryservices_cur_hour;

				}

				var byclaundryservices_start_time_updated=byclaundryservices_cur_hour+":"+start_minute;

				}

				//alert('byclaundryservices_start_time_updated: '+byclaundryservices_start_time_updated);

				return byclaundryservices_start_time_updated;

				} 	
		function check_delivery_availability_options(date,obj){

			var curtime= new Date().toLocaleTimeString("en-US", { hour12: false, hour: "numeric", minute: "numeric"});

			var woospd_selected_calendar_date = jQuery("#byconsolewclaundry_delivery_date").datepicker('getDate');

			var woospd_selected_date_day=jQuery.datepicker.formatDate('D', woospd_selected_calendar_date);

			var wooSPD_selected_calendar_date = jQuery("#byconsolewclaundry_delivery_date").val();

			// ajax time populated

			var byclaundrservice_delivery_start_time='<?php echo get_option('byclaundryservice_delivery_time_slot_by_start') ?>';

			var byclaundrservice_delivery_end_time='<?php echo get_option('byclaundryservice_delivery_time_slot_by_end') ?>';

			if(jQuery('#byconsolewclaundry_delivery_time').hasClass('ui-timepicker-input')){

			jQuery('#byconsolewclaundry_delivery_time').timepicker('remove');

			jQuery('#byconsolewclaundry_delivery_time').val(' ');

			//alert('Delivery..........');

			}
		jQuery('#byconsolewclaundry_delivery_time').timepicker({ 

		"minTime": byclaundrservice_delivery_start_time,

		"maxTime": byclaundrservice_delivery_end_time,

		"step": "15",

		"timeFormat": "H:i",

		"disableTextInput": "true",

		"disableTouchKeyboard": "true",

		"scrollDefault": "now",

		"selectOnBlur": "true"

		});

		}

		jQuery(".woocommerce-billing-fields__field-wrapper").css("display","none");

		jQuery("#order_review_heading").css("display","none");

		jQuery(".woocommerce-checkout-review-order").css("display","none");

		jQuery(".woocommerce-shipping-fields").css("display","none");

		jQuery(".woocommerce-additional-fields").css("display","none");
	jQuery("#byconsolewclaundry_next_button_on_address_filed").click(function(){
		var byconsolelaundry_delivery_date=jQuery("#byconsolewclaundry_delivery_date").val();

		var byconsolelaundry_delivery_time=jQuery("#byconsolewclaundry_delivery_time").val();

		var byconsolelaundry_pickup_date=jQuery("#byconsolewclaundry_pickup_date").val();

		var byconsolelaundry_pickup_time=jQuery("#byconsolewclaundry_pickup_time").val();

		if(byconsolelaundry_pickup_date=='' ){

				jQuery("#byconsolewclaundry_pickup_date").addClass("erroractive");

		}else if(byconsolelaundry_pickup_time==''){

			jQuery("#byconsolewclaundry_pickup_time").addClass("erroractive");

		}else if(byconsolelaundry_delivery_date=='' ){

			jQuery('#byconsolewclaundry_delivery_date').addClass("erroractive");

		}else if (byconsolelaundry_delivery_time=='' ){

			jQuery("#byconsolewclaundry_delivery_time").addClass("erroractive");

		}else {

		jQuery("#byconsolewclaundry_prev_button_on_address_filed").css("display","block");

		jQuery(".woocommerce-billing-fields__field-wrapper").css("display","block");

		jQuery("#order_review_heading").css("display","block");

		jQuery(".woocommerce-checkout-review-order").css("display","block");

		jQuery(".woocommerce-shipping-fields").css("display","block");

		jQuery(".woocommerce-additional-fields").css("display","block");

		jQuery(".byconsolewclaundry_loading_image").css("display","block");

		jQuery(".byconsolewclaundry_pickup_details_container").css("display","none");

		jQuery(".byconsolewclaundry_delivery_details_container").css("display","none");

		jQuery("#byconsolewclaundry_next_button_on_address_filed").css("display","none");

		}
		////////////////////////////////////////////////////////////////////////////

		var byconsolewclaundry_pickup_date = jQuery('#byconsolewclaundry_pickup_date').val();	

		var byconsolewclaundry_pickup_time = jQuery('#byconsolewclaundry_pickup_time').val();	

		var byconsolewclaundry_delivery_date = jQuery('#byconsolewclaundry_delivery_date').val();	

		var byconsolewclaundry_delivery_time = jQuery('byconsolewclaundry_delivery_time').val();	

		jQuery('#cart_pickup_datetime').html(byconsolewclaundry_pickup_date + '&nbsp;/&nbsp;' +byconsolewclaundry_pickup_time);

		jQuery('#cart_delivery_datetime').html(byconsolewclaundry_delivery_date + '&nbsp;/&nbsp;' +byconsolewclaundry_delivery_time);

	});
	
	jQuery("#byconsolewclaundry_prev_button_on_address_filed").click(function(){
		
		jQuery(".woocommerce-billing-fields").css("display","block");
		
		jQuery(".woocommerce-billing-fields__field-wrapper").css("display","none");

		jQuery(".byconsolewclaundry_pickup_details_container").css("display","block");
		
		jQuery(".byconsolewclaundry_delivery_details_container").css("display","block");

		jQuery(".woocommerce-shipping-fields").css("display","none");
		
		jQuery(".woocommerce-additional-fields").css("display","none");
		
		jQuery("#order_review_heading").css("display","none");
		
		jQuery(".woocommerce-checkout-review-order").css("display","none");

		jQuery("#byconsolewclaundry_prev_button_on_address_filed").css("display","none");
		
		jQuery("#byconsolewclaundry_next_button_on_address_filed").css("display","block");

		});	

	});
	
	function BycCheckHoliDay( date ){
		//console.log(date);
var $return=true;
var $returnclass ="available";
//alert(date);

$checkdate = jQuery.datepicker.formatDate("mm/dd/yy", date);
$checkday	= jQuery.datepicker.formatDate("D", date);
//alert($checkday+' | '+date.getDay());
//alert(date.getDay());
$checkdaynum=date.getDay();
//var day = date.getDay();

if(jQuery.inArray($checkdaynum,$bycwclaundryservice_general_holiday)!=-1){
$return = false;
$returnclass= "unavailable bycwclaundryservice_general_holiday_weekly_closing_day";
//alert($checkday+'||<?php //echo $allowable_pickup_days_js_array;?>');
//alert('in condition 1');
}

//function return value

return [$return,$returnclass];

	} // end of BycCheckHoliday

	</script>

    <style>

    .woocommerce-billing-fields h3{ display:none;}

	#customer_details{ width:100%;}

	.erroractive{border: 1px solid #f44336e6 !important;}

    </style>

	<?php

	}

	add_action('wp_footer','byconsolewclaundry_footer_script',9999);

	add_filter( 'add_to_cart_text', 'byconsolewoowbpdextended_custom_single_add_to_cart_text' );               

	 // < 2.1

	add_filter( 'woocommerce_product_single_add_to_cart_text', 'byconsolewoowbpdextended_custom_single_add_to_cart_text' ); 

	// 2.1 +

	function byconsolewoowbpdextended_custom_single_add_to_cart_text() {

    return __( 'Add to Basket', 'woocommerce' );

	}

	add_filter( 'add_to_cart_text', 'byconsolewoowbpdextended_custom_product_add_to_cart_text' );            

	// < 2.1

	add_filter( 'woocommerce_product_add_to_cart_text', 'byconsolewoowbpdextended_custom_product_add_to_cart_text' ); 

	 // 2.1 +

	function byconsolewoowbpdextended_custom_product_add_to_cart_text() {

    return __( 'Add to Basket', 'woocommerce' );

	}

	//include('inc/byconsolewclaundryservice_get_state_list_by_country_using_ajax.php');

	//include('inc/byconsolewclaundryservice_get_time_slot_list_by_date_using_ajax.php');

	function byconsolewoolaundry_add_scripts() {

	wp_enqueue_script('jquery-ui-datepicker');

	wp_register_script('byconsolewoolaundry_script_2', plugins_url('js/jquery.timepicker.min.js', __FILE__), array('jquery'),'1.12', true);

	wp_register_script('byconsolewoolaundry_script_3', plugins_url('js/byconsolewoolaundry.js', __FILE__), array('jquery'),'1.12', true);

	wp_enqueue_script('byconsolewoolaundry_script_2');

	wp_enqueue_script('byconsolewoolaundry_script_3');

	}

	add_action( 'wp_enqueue_scripts', 'byconsolewoolaundry_add_scripts' ); 

	function byconsolewoolaundry_admin_script(){

	wp_register_script( 'byconsolewoolaundry-admin-script', plugins_url( 'js/byconsolewoolaudry-admin-script.js' , __FILE__ ),array('jquery'),'1.12', true );

wp_register_script( 'byconsolewcloundryservice-admin-script-11', plugins_url( 'js/jquery-ui.js' , __FILE__ ),array('jquery'),'1.12', true );	

wp_register_script( 'byconsolewcloundryservice-admin-script-10', plugins_url( 'js/jquery-ui.multidatespicker.js' , __FILE__ ),array('jquery'),'1.12', true );
	

	wp_enqueue_script( 'byconsolewoolaundry-admin-script');
	
	wp_enqueue_script( 'byconsolewcloundryservice-admin-script-11');

	wp_enqueue_script( 'byconsolewcloundryservice-admin-script-10');

	}

	
	add_action('admin_enqueue_scripts', 'byconsolewoolaundry_admin_script');

	//add styles

	function byconsolewoolaundry_add_styles() {

	wp_enqueue_style('byconsolewoolaundry_stylesheet', plugins_url('css/jquery-ui.min.css', __FILE__));

	wp_enqueue_style('byconsolewoolaundry_stylesheet_2', plugins_url('css/jquery-ui.theme.min.css', __FILE__));

	wp_enqueue_style('byconsolewoolaundry_stylesheet_3', plugins_url('css/jquery-ui.structure.min.css', __FILE__));

	wp_enqueue_style('byconsolewoolaundry_stylesheet_4', plugins_url('css/jquery.timepicker.css', __FILE__));
	
	// since 1.0.2
	wp_enqueue_style('byconsolewoolaundry_stylesheet_5', plugins_url('css/style.css', __FILE__));

	}

	add_action( 'wp_enqueue_scripts', 'byconsolewoolaundry_add_styles' ); 
//Holiday setting....css for admin

	function byconsolewcloundryservice_add_styles_admin() {

	wp_enqueue_style( 'byconsolewcloundryservice_custom_admin_css_33',plugins_url('css/adminjquery-ui.css', __FILE__) );

	}

	add_action( 'admin_enqueue_scripts', 'byconsolewcloundryservice_add_styles_admin' ); 
	
?>