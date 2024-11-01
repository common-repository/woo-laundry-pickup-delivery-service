<?php

defined( 'ABSPATH' ) OR exit;

/*
* @since 1.0.2
*/

class ByconsoleWooLaundry{

		//get option values for settings related 
		public function get_wooolaundry_settings($option_name){

		$byc_option_value = get_option($option_name);
		
		if(empty($byc_option_value)){

			
			if($option_name=='byclaundryservice_pickup_time_slot_by_start'){

				$byc_option_value = '10:00';

				}

			if($option_name=='byclaundryservice_pickup_time_slot_by_end'){

				$byc_option_value = '15:00';

				}

			if($option_name=='byclaundryservice_delivery_time_slot_by_start'){

				$byc_option_value = '11:00';

				}

			if($option_name=='byclaundryservice_delivery_time_slot_by_end'){

				$byc_option_value = '16:00';

				}

			if($option_name=='byclaundryservice_date_format'){

				$byc_option_value = 4;

				}

			}

		return $byc_option_value;

		}

	public function set_woolaundry_default_setings(){

		global $wpdb;

		if(!get_option('byconsolewoolaundry_free_plugin_activation_date')){		

			$currentActivatedDate = date("m/d/Y");

			update_option('byconsolewooodt_free_plugin_activation_date',$currentActivatedDate);

		}
		

		if(!get_option('byclaundryservice_pickup_time_slot_by_start')){

			update_option('byclaundryservice_pickup_time_slot_by_start','10:00');

		}

		if(!get_option('byclaundryservice_pickup_time_slot_by_end')){

			update_option('byclaundryservice_pickup_time_slot_by_end','15:00');

		}

		if(!get_option('byclaundryservice_delivery_time_slot_by_start')){

			update_option('byclaundryservice_delivery_time_slot_by_start','11:00');

		}

		if(!get_option('byclaundryservice_delivery_time_slot_by_end')){

			update_option('byclaundryservice_delivery_time_slot_by_end','16:00');

		}

		if(!get_option('byclaundryservice_date_format')){

			update_option('byclaundryservice_date_format',4);

		}
		
		if(!get_option('byconsolewoolaundry_free_plugin_admin_access_date')){		

			$adminAccessDate = date("m/d/Y");

			update_option('byconsolewoolaundry_free_plugin_admin_access_date',$adminAccessDate);

		}
		
		
		}


	public function remove_woolaundry_options(){

		delete_option('byconsolewoolaundry_free_plugin_activation_date');

		delete_option('byconsolewoolaundry_free_plugin_admin_access_date');
		
		delete_option('byclaundryservice_pickup_time_slot_by_start');
		
		delete_option('byclaundryservice_pickup_time_slot_by_end');
		
		delete_option('byclaundryservice_delivery_time_slot_by_start');
		
		delete_option('byclaundryservice_delivery_time_slot_by_end');
		
		delete_option('byclaundryservice_date_format');

		}
		
	public function get_formated_date_from_default_format($date_in_default_format){
		
		$byclaundry_date_format = $this->get_wooolaundry_settings('byclaundryservice_date_format');
		$date_string_explode=explode("-",$date_in_default_format);
		if($byclaundry_date_format==1){ 
		$byclaundry_formated_date=$date_in_default_format;
		}elseif($byclaundry_date_format==2){
			$byclaundry_formated_date=date('D,d/m/Y',mktime(0,0,0,$date_string_explode[1],$date_string_explode[0],$date_string_explode[2]));
			}elseif($byclaundry_date_format==3){
				$byclaundry_formated_date=$date_string_explode[1].'-'.$date_string_explode[0].'-'.$date_string_explode[2];
				}elseif($byclaundry_date_format==4){
					$byclaundry_formated_date=$date_string_explode[0].'/'.$date_string_explode[1].'/'.$date_string_explode[2];
					}elseif($byclaundry_date_format==5){
						$byclaundry_formated_date=$date_string_explode[1].'/'.$date_string_explode[0].'/'.$date_string_explode[2];
						}else{
							$byclaundry_formated_date=$date_in_default_format;
							}
		return $byclaundry_formated_date;
		}
		
	public function get_m_d_y($date_input){
		
		$ByconsoleWooLaundry_date_format = $this->get_wooolaundry_settings('byclaundryservice_date_format');
		
		if($ByconsoleWooLaundry_date_format == 1){
				
				$byconsolewclaundry_date_input_array=explode('-',$date_input);
				
				$byc_date_array['d'] = $byconsolewclaundry_date_input_array[0];
				$byc_date_array['m'] = $byconsolewclaundry_date_input_array[1];
				$byc_date_array['y'] = $byconsolewclaundry_date_input_array[2];
				
				}elseif($ByconsoleWooLaundry_date_format == 2){
					
					$byconsolewclaundry_date_input_array2=explode(',',$date_input);
					$byconsolewclaundry_date_input_array=explode('-',$byconsolewclaundry_date_input_array2[1]);
					
					$byc_date_array['d'] = $byconsolewclaundry_date_input_array[0];
					$byc_date_array['m'] = $byconsolewclaundry_date_input_array[1];
					$byc_date_array['y'] = $byconsolewclaundry_date_input_array[2];

					
					}elseif($ByconsoleWooLaundry_date_format == 3){
						
						$byconsolewclaundry_date_input_array=explode('-',$date_input);
						
						$byc_date_array['d'] = $byconsolewclaundry_date_input_array[1];
						$byc_date_array['m'] = $byconsolewclaundry_date_input_array[0];
						$byc_date_array['y'] = $byconsolewclaundry_date_input_array[2];

						
						}elseif($ByconsoleWooLaundry_date_format == 4){
							
							$byconsolewclaundry_date_input_array=explode('/',$date_input);
							
							$byc_date_array['d'] = $byconsolewclaundry_date_input_array[0];
							$byc_date_array['m'] = $byconsolewclaundry_date_input_array[1];
							$byc_date_array['y'] = $byconsolewclaundry_date_input_array[2];

							
							}elseif($ByconsoleWooLaundry_date_format == 5){
								
								$byconsolewclaundry_date_input_array=explode('/',$date_input);
							
								$byc_date_array['d'] = $byconsolewclaundry_date_input_array[1];
								$byc_date_array['m'] = $byconsolewclaundry_date_input_array[0];
								$byc_date_array['y'] = $byconsolewclaundry_date_input_array[2];
								
																
								}else{
									
									$byconsolewclaundry_date_input_array=explode('-',$date_input);
								
									$byc_date_array['d'] = $byconsolewclaundry_date_input_array[0];
									$byc_date_array['m'] = $byconsolewclaundry_date_input_array[1];
									$byc_date_array['y'] = $byconsolewclaundry_date_input_array[2];

									
									}
		return $byc_date_array;
		
	}
		
	public function set_default_date_format($date_string){
		//deafulr date format is dd-mm-yyyy for our plugin
		$byclaundry_date_format = $this->get_wooolaundry_settings('byclaundryservice_date_format');
		
		if($byclaundry_date_format==1){ 
		$date_string_explode=explode("-",$date_string);
		$byclaundry_date=$date_string_explode[0].'-'.$date_string_explode[1].'-'.$date_string_explode[2];
		}elseif($byclaundry_date_format==2){
			$date_string_explode2=explode(",",$date_string);
			$date_string_explode=explode("-",$date_string_explode2[1]);
			$byclaundry_date=$date_string_explode[0].'-'.$date_string_explode[1].'-'.$date_string_explode[2];
			}elseif($byclaundry_date_format==3){
				$date_string_explode=explode("-",$date_string);
				$byclaundry_date=$date_string_explode[1].'/'.$date_string_explode[0].'/'.$date_string_explode[2];
				}elseif($byclaundry_date_format==4){
					$date_string_explode=explode("/",$date_string);
					$byclaundry_date=$date_string_explode[0].'-'.$date_string_explode[1].'/'.$date_string_explode[2];	
					}elseif($byclaundry_date_format==5){
						$date_string_explode=explode("/",$date_string);
						$byclaundry_date=$date_string_explode[1].'/'.$date_string_explode[0].'/'.$date_string_explode[2];
						}else{
							$byclaundry_date=$date_string;
							}

		return $byclaundry_date;
		
	}

}

?>