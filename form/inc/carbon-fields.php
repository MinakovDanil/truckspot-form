<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'form_carbon');
function form_carbon()
{

	// Страница параметры по умолчанию
	Container::make('theme_options', __('Form Options'))
		->set_page_menu_position(23)
		->add_tab(__('Fake phone and email'), array(
			Field::make('textarea', 'frm_fake_phone', __('Phones'))
				->set_rows(15)
				->set_width(50)
				->set_help_text('Enter each choice on a new line.'),
			Field::make('textarea', 'frm_last_phone', __('Prohibit the last 7 digits in phone '))
				->set_rows(15)
				->set_width(50)
				->set_help_text('Enter each choice on a new line.'),
			Field::make('textarea', 'frm_fake_email', __('Emails'))
				->set_rows(15)
				->set_width(100)
				->set_help_text('Enter each choice on a new line.'),
		))
		->add_tab(__('SID'), array(
			Field::make('complex', 'frm_correct_sid', __('Correct SIDs'))
				->add_fields(array(
					Field::make('text', 'sid', __('sid'))
				))
		))
		->add_tab(__('Form vehicles'), array(
			Field::make('complex', 'form_vehicles', __('Vehicles'))
				->add_fields(array(
					Field::make('text', 'make', __('Make'))
						->set_width(40),
					Field::make('complex', 'models', __('Models'))
						->set_required(true)
						->set_layout('tabbed-horizontal')
						->set_width(60)
						->add_fields(array(
							Field::make('text', 'model', ('')),
						))
				))
		));


	// Leads
	Container::make('post_meta', 'Leads')
		->where('post_type', '=', 'leads')
		->add_tab(__('Main'), array(
			Field::make('text', 'lead_campid', __('campid'))->set_width(33),
			Field::make('text', 'lead_sid', __('sid'))->set_width(33),
			Field::make('text', 'lead_ssid', __('ssid'))->set_width(33),
			Field::make('text', 'lead_email', __('email'))->set_width(33),
			Field::make('text', 'lead_firstname', __('firstname'))->set_width(33),
			Field::make('text', 'lead_lastname', __('lastname'))->set_width(33),
			Field::make('text', 'lead_phone1', __('phone1'))->set_width(33),
			Field::make('text', 'lead_origincity', __('origincity'))->set_width(33),
			Field::make('text', 'lead_originstate', __('originstate'))->set_width(33),
			Field::make('text', 'lead_originzip', __('originzip'))->set_width(33),
			Field::make('text', 'lead_movedate', __('movedate'))->set_width(33),
			Field::make('text', 'lead_customer_notes', __('customerNotes'))->set_width(33),
			Field::make('text', 'lead_movingcity', __('movingcity'))->set_width(33),
			Field::make('text', 'lead_movingstate', __('movingstate'))->set_width(33),
			Field::make('text', 'lead_movingzip', __('movingzip'))->set_width(33),
		))
		->add_tab(__('UTM'), array(
			Field::make('text', 'lead_utm_source', __('utm_source')),
			Field::make('text', 'lead_utm_medium', __('utm_medium')),
			Field::make('text', 'lead_utm_campaign', __('utm_campaign')),
			Field::make('text', 'lead_utm_content', __('utm_content')),
			Field::make('text', 'lead_utm_term', __('utm_term')),
		))
		->add_tab(__('Vehicle1'), array(
			Field::make('text', 'lead_vehicletype1', __('vehicletype1'))->set_width(33),
			Field::make('text', 'lead_vehiclemake1', __('vehiclemake1'))->set_width(33),
			Field::make('text', 'lead_vehiclemodel1', __('vehiclemodel1'))->set_width(33),
			Field::make('text', 'lead_vehicleyear1', __('vehicleyear1'))->set_width(33),
			Field::make('text', 'lead_trailertype1', __('trailertype1'))->set_width(33),
			Field::make('text', 'lead_doesnotrun1', __('doesnotrun1'))->set_width(33),
			Field::make('text', 'lead_modifed1', __('modifed1'))->set_width(33),
			Field::make('text', 'lead_istrailer1', __('istrailer1'))->set_width(33),
			Field::make('text', 'lead_length1', __('length1'))->set_width(33),
			Field::make('text', 'lead_width1', __('width1'))->set_width(33),
			Field::make('text', 'lead_height1', __('height1'))->set_width(33),
			Field::make('text', 'lead_weigth1', __('weigth1'))->set_width(33),
		))
		->add_tab(__('Vehicle2'), array(
			Field::make('text', 'lead_vehicletype2', __('vehicletype2'))->set_width(33),
			Field::make('text', 'lead_vehiclemake2', __('vehiclemake2'))->set_width(33),
			Field::make('text', 'lead_vehiclemodel2', __('vehiclemodel2'))->set_width(33),
			Field::make('text', 'lead_vehicleyear2', __('vehicleyear2'))->set_width(33),
			Field::make('text', 'lead_trailertype2', __('trailertype2'))->set_width(33),
			Field::make('text', 'lead_doesnotrun2', __('doesnotrun2'))->set_width(33),
			Field::make('text', 'lead_modifed2', __('modifed2'))->set_width(33),
			Field::make('text', 'lead_istrailer2', __('istrailer2'))->set_width(33),
			Field::make('text', 'lead_length2', __('length2'))->set_width(33),
			Field::make('text', 'lead_width2', __('width2'))->set_width(33),
			Field::make('text', 'lead_height2', __('height2'))->set_width(33),
			Field::make('text', 'lead_weigth2', __('weigth2'))->set_width(33),
		))
		->add_tab(__('Vehicle3'), array(
			Field::make('text', 'lead_vehicletype3', __('vehicletype3'))->set_width(33),
			Field::make('text', 'lead_vehiclemake3', __('vehiclemake3'))->set_width(33),
			Field::make('text', 'lead_vehiclemodel3', __('vehiclemodel3'))->set_width(33),
			Field::make('text', 'lead_vehicleyear3', __('vehicleyear3'))->set_width(33),
			Field::make('text', 'lead_trailertype3', __('trailertype3'))->set_width(33),
			Field::make('text', 'lead_doesnotrun3', __('doesnotrun3'))->set_width(33),
			Field::make('text', 'lead_modifed3', __('modifed3'))->set_width(33),
			Field::make('text', 'lead_istrailer3', __('istrailer3'))->set_width(33),
			Field::make('text', 'lead_length3', __('length3'))->set_width(33),
			Field::make('text', 'lead_width3', __('width3'))->set_width(33),
			Field::make('text', 'lead_height3', __('height3'))->set_width(33),
			Field::make('text', 'lead_weigth3', __('weigth3'))->set_width(33),
		))
		->add_tab(__('Vehicle4'), array(
			Field::make('text', 'lead_vehicletype4', __('vehicletype4'))->set_width(33),
			Field::make('text', 'lead_vehiclemake4', __('vehiclemake4'))->set_width(33),
			Field::make('text', 'lead_vehiclemodel4', __('vehiclemodel4'))->set_width(33),
			Field::make('text', 'lead_vehicleyear4', __('vehicleyear4'))->set_width(33),
			Field::make('text', 'lead_trailertype4', __('trailertype4'))->set_width(33),
			Field::make('text', 'lead_doesnotrun4', __('doesnotrun4'))->set_width(33),
			Field::make('text', 'lead_modifed4', __('modifed4'))->set_width(33),
			Field::make('text', 'lead_istrailer4', __('istrailer4'))->set_width(33),
			Field::make('text', 'lead_length4', __('length4'))->set_width(33),
			Field::make('text', 'lead_width4', __('width4'))->set_width(33),
			Field::make('text', 'lead_height4', __('height4'))->set_width(33),
			Field::make('text', 'lead_weigth4', __('weigth4'))->set_width(33),
		))
		->add_tab(__('Vehicle5'), array(
			Field::make('text', 'lead_vehicletype5', __('vehicletype5'))->set_width(33),
			Field::make('text', 'lead_vehiclemake5', __('vehiclemake5'))->set_width(33),
			Field::make('text', 'lead_vehiclemodel5', __('vehiclemodel5'))->set_width(33),
			Field::make('text', 'lead_vehicleyear5', __('vehicleyear5'))->set_width(33),
			Field::make('text', 'lead_trailertype5', __('trailertype5'))->set_width(33),
			Field::make('text', 'lead_doesnotrun5', __('doesnotrun5'))->set_width(33),
			Field::make('text', 'lead_modifed5', __('modifed5'))->set_width(33),
			Field::make('text', 'lead_istrailer5', __('istrailer5'))->set_width(33),
			Field::make('text', 'lead_length5', __('length5'))->set_width(33),
			Field::make('text', 'lead_width5', __('width5'))->set_width(33),
			Field::make('text', 'lead_height5', __('height5'))->set_width(33),
			Field::make('text', 'lead_weigth5', __('weigth5'))->set_width(33),
		))
		->add_tab(__('Vehicle6'), array(
			Field::make('text', 'lead_vehicletype6', __('vehicletype6'))->set_width(33),
			Field::make('text', 'lead_vehiclemake6', __('vehiclemake6'))->set_width(33),
			Field::make('text', 'lead_vehiclemodel6', __('vehiclemodel6'))->set_width(33),
			Field::make('text', 'lead_vehicleyear6', __('vehicleyear6'))->set_width(33),
			Field::make('text', 'lead_trailertype6', __('trailertype6'))->set_width(33),
			Field::make('text', 'lead_doesnotrun6', __('doesnotrun6'))->set_width(33),
			Field::make('text', 'lead_modifed6', __('modifed6'))->set_width(33),
			Field::make('text', 'lead_istrailer6', __('istrailer6'))->set_width(33),
			Field::make('text', 'lead_length6', __('length6'))->set_width(33),
			Field::make('text', 'lead_width6', __('width6'))->set_width(33),
			Field::make('text', 'lead_height6', __('height6'))->set_width(33),
			Field::make('text', 'lead_weigth6', __('weigth6'))->set_width(33),
		));
}
