<?php
add_action('admin_menu','byclaundryservice_add_plugin_menu');

global $byclaundryservice_admin_settings_holidays;

function byclaundryservice_add_plugin_menu(){

	add_menu_page( 'WCLaundry Service', 'WCLaundry Service', 'manage_options', 'byclaundryservice_settings', 'byclaundryservice_admin_general_settings_form');	

$byconsolewoospd_admin_settings_holidays=add_submenu_page('byclaundryservice_settings', 'Holiday settings','Holiday settings', 'manage_options', 'byconsolewoospd_holiday_settings', 'byclaundryservice_admin_holiday_settings_form');
	}

function byclaundryservice_admin_general_settings_form(){ ?>

			<div class="wrap">

			<h1><?php esc_html_e('WooCommerce Laundry pickup & delivery Service Settings','woo-laundry-pickup-delivery-service'); ?></h1>

			<div class="" style="width:65%; float:left;">

			<form method="post" class="form_theme_panal" action="options.php">

				<?php

					settings_fields("byclaundryservice");

					do_settings_sections("byclaundryservice-options");      

					submit_button(); 

				?>          

			</form>
            
            </div>

			<div class="" style="width:25%; float:right;background: #cccccc8c;padding: 10px;border: 1px solid #ffa500;border-radius: 5px;">
            
            

            <input type="button" value="<?php esc_html_e('Get Pro version','woo-laundry-pickup-delivery-service');?>" onClick="getproFunction()"  id="byclaundryservice_get_pro_version" style="background-color: #ffa500;
    color: #fff;
    display: inline-block;
    text-transform: uppercase;
    padding: 10px 5px;
    border-radius: 5px;
    box-shadow: 0 17px 10px -10px rgba(0, 0, 0, 0.4);
    cursor: pointer;
    float:left;
    transition: all ease-in-out 300ms;
    border: 0px;"/>

            <input type="button" value="<?php esc_html_e('Read HOW TO','woo-laundry-pickup-delivery-service');?>" onClick="readBlog()"  id="byclaundryservice_get_pro_version" style="background-color: #ffa500;
    color: #fff;
    display: inline-block;
    text-transform: uppercase;
    padding: 10px 5px;
    border-radius: 5px;
    box-shadow: 0 17px 10px -10px rgba(0, 0, 0, 0.4);
    cursor: pointer;
    float:right;
    transition: all ease-in-out 300ms;
    border: 0px;"/>

<style>

#byclaundryservice_get_pro_version:hover{background-color:#fff !important; color:#ffa500 !important; border:1px solid #ffa500;}*/

 
</style>

<div class="" style="margin: 60px 0px 20px 0px;">

<ul>

    <li style="font-size: 14px;"><?php echo __('Laundry Pickup & Delivery Pro Plugin for WooCommerce allow you to :','woo-laundry-pickup-delivery-service');?><li>
    <li><?php esc_html_e('1) Set up minimum days you need between a laundry pickup and delivery date. Allow customers to select dates by retaining that minimum days required for servicing.','woo-laundry-pickup-delivery-service');?></li>
    <li><?php esc_html_e('2) Optionally allow same day laundry serviceing by retaining minimum hours required for serviceing.','woo-laundry-pickup-delivery-service');?></li>
    <li><?php esc_html_e('3) Create pickup & delivery service routine separately for a complete week and that will be repeated on each week.','woo-laundry-pickup-delivery-service');?></li>
    <li><?php esc_html_e('4) Create pickup and delivery slot for each of seven days.','woo-laundry-pickup-delivery-service');?></li>
     <li><?php esc_html_e('5) Can limit number of pickup / delivery per time slot.','woo-laundry-pickup-delivery-service');?></li>
     <li><?php esc_html_e('6) Weekly close day for pickup as well as delivery service separately.','woo-laundry-pickup-delivery-service');?></li>
     <li><?php esc_html_e('7) Category based minimum service days.','woo-laundry-pickup-delivery-service');?></li>
     <li><?php esc_html_e('8) Checkout steps got a graphical representation like progress bar.','woo-laundry-pickup-delivery-service');?></li>
     <li><?php esc_html_e('9) Soap stocking features.','woo-laundry-pickup-delivery-service');?></li>
     <li><?php esc_html_e('10) Search by zip code(shortcode).','woo-laundry-pickup-delivery-service');?></li>
             
</ul>

            </div>

            <input type="button" value="<?php esc_html_e('Get Pro version','woo-laundry-pickup-delivery-service');?>" onClick="getproFunction()"  id="byclaundryservice_get_pro_version" style="background-color: #ffa500;
    color: #fff;
    display: inline-block;
    text-transform: uppercase;
    padding: 10px 5px;
    border-radius: 5px;
    box-shadow: 0 17px 10px -10px rgba(0, 0, 0, 0.4);
    cursor: pointer;
    float:left;
    transition: all ease-in-out 300ms;
    border: 0px;"/>

            <input type="button" value="<?php esc_html_e('Read HOW TO','woo-laundry-pickup-delivery-service');?>" onClick="readBlog()"  id="byclaundryservice_get_pro_version" style="background-color: #ffa500;
    color: #fff;
    display: inline-block;
    text-transform: uppercase;
    padding: 10px 5px;
    border-radius: 5px;
    box-shadow: 0 17px 10px -10px rgba(0, 0, 0, 0.4);
    cursor: pointer;
    float:right;
    transition: all ease-in-out 300ms;
    border: 0px;"/>
            <script>

            function getproFunction() {

            window.open("https://www.plugins.byconsole.com/product/laundry-pickup-delivery-plugin-for-woocommerce/");

            }

			function readBlog() {

            window.open("https://blog.byconsole.com/");

            }

            </script>
            
            </div>

			</div>

		<?php
	}	

function byclaundryservice_pickup_time_slot_by_lundry_service(){

	$byclaundryservice_pickup_time_slot_by_start = get_option('byclaundryservice_pickup_time_slot_by_start');

?>

	<label><?php esc_html_e('Start','woo-laundry-pickup-delivery-service'); ?></label>

	<input type="time" name="byclaundryservice_pickup_time_slot_by_start" id="byclaundryservice_pickup_time_slot_by_start" value="<?php echo $byclaundryservice_pickup_time_slot_by_start;?>" style="padding: 7px;width: 20%;" />

   <?php 

    $byclaundryservice_pickup_time_slot_by_end = get_option('byclaundryservice_pickup_time_slot_by_end');

   ?>

	<label><?php esc_html_e('End','woo-laundry-pickup-delivery-service'); ?></label>

	<input type="time" name="byclaundryservice_pickup_time_slot_by_end" id="byclaundryservice_pickup_time_slot_by_end" value="<?php echo $byclaundryservice_pickup_time_slot_by_end;?>" style="padding: 7px;width: 20%;" />

<?php	

}

function byclaundryservice_delivery_time_slot_by_lundry_service(){

	$byclaundryservice_delivery_time_slot_by_start = get_option('byclaundryservice_delivery_time_slot_by_start');

?>

	<label><?php esc_html_e('Start','woo-laundry-pickup-delivery-service'); ?></label>

	<input type="time" name="byclaundryservice_delivery_time_slot_by_start" id="byclaundryservice_delivery_time_slot_by_start" value="<?php echo $byclaundryservice_delivery_time_slot_by_start;?>" style="padding: 7px;width: 20%;" />

   <?php 

    $byclaundryservice_delivery_time_slot_by_end = get_option('byclaundryservice_delivery_time_slot_by_end');

   ?>

	<label><?php esc_html_e('End','woo-laundry-pickup-delivery-service'); ?></label>

	<input type="time" name="byclaundryservice_delivery_time_slot_by_end" id="byclaundryservice_delivery_time_slot_by_end" value="<?php echo $byclaundryservice_delivery_time_slot_by_end;?>" style="padding: 7px;width: 20%;" />

<?php	

}

/*
* @since    1.0.2
*/
function byclaundryservice_date_format_sections(){



$bycls_date_format_option_val = get_option('byclaundryservice_date_format');



?>



<select name="byclaundryservice_date_format" id="byclaundryservice_date_format" style="width:34%;">



<option value="1" <?php if($bycls_date_format_option_val==1){?>selected="selected"<?php } ?>>DD-MM-YY</option>



<option value="2" <?php if($bycls_date_format_option_val==2){?>selected="selected"<?php } ?>>DAY,DD-MM-YY</option>



<option value="3" <?php if($bycls_date_format_option_val==3){?>selected="selected"<?php } ?>>MM-DD-YY</option>



<option value="4" <?php if($bycls_date_format_option_val==4){?>selected="selected"<?php } ?>>DD/MM/YY</option>



<option value="5" <?php if($bycls_date_format_option_val==5){?>selected="selected"<?php } ?>>MM/DD/YY</option>



</select>



<label><?php echo __('Upon changing the format it will change on order completion page , Email and the orders page at back end.','woo-laundry-pickup-delivery-service');?></label><br />



<span style="color:#a0a5aa">(Eg: 25/12/2022)</span>



<?php



}

add_action('admin_init', 'byclaundryservice_plugin_settings_fields');

function byclaundryservice_plugin_settings_fields()

	{

	add_settings_section("byclaundryservice", "", null, "byclaundryservice-options");

    add_settings_field("byclaundryservice_pickup_time_slot_by_lundry_service", "Pickup time slot :", "byclaundryservice_pickup_time_slot_by_lundry_service", "byclaundryservice-options", "byclaundryservice");

	add_settings_field("byclaundryservice_delivery_time_slot_by_lundry_service", "Delivery time slot :", "byclaundryservice_delivery_time_slot_by_lundry_service", "byclaundryservice-options", "byclaundryservice");
	
	/*
	* @since    1.0.2
	*/
	add_settings_field("byclaundryservice_date_format", "Date Format:", "byclaundryservice_date_format_sections", "byclaundryservice-options", "byclaundryservice");

	
	register_setting("byclaundryservice", "byclaundryservice_pickup_time_slot_by_start");
	
	register_setting("byclaundryservice", "byclaundryservice_pickup_time_slot_by_end");

	register_setting("byclaundryservice", "byclaundryservice_delivery_time_slot_by_start");

	register_setting("byclaundryservice", "byclaundryservice_delivery_time_slot_by_end");
	
	/*
	* @since    1.0.2
	*/
	register_setting("byclaundryservice", "byclaundryservice_date_format");

	}

?>