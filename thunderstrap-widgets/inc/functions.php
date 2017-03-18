<?php

/**
 * Functions file.
 *
 * Helper functions for generating Bootstrap 4 widgets.
 *
 * @link       https://github.com/radixmo/thunderstrap-widgets
 * @since      0.0.1
 *
 * @package    Thunderstrap_Widgets
 * @subpackage Thunderstrap_Widgets/includes
 * @author     Len Johnson <radixmo@gmail.com>
 */

function thunderstrap_colors($set = 'bg') {
	$colors = array(
		'alert' => array(
  			'alert-success', 'alert-info', 'alert-warning', 'alert-danger'),

		'bg'    => array(
			'bg-primary', 'bg-default', 'bg-success', 'bg-info', 'bg-warning', 
			'bg-danger', 'bg-inverse' , 'bg-faded'),

		'badge' => array(
			'badge-default', 'badge-primary', 'badge-success', 'badge-info', 
			'badge-warning', 'badge-danger'),

		'btn'   => array(
			'btn-primary', 'btn-secondary', 'btn-success', 'btn-info', 'btn-warning', 
			'btn-danger', 'btn-link', 'btn-outline-primary', 'btn-outline-secondary', 
			'btn-outline-success', 'btn-outline-info', 'btn-outline-warning', 'btn-outline-danger'),

		'card'  => array(
			'card-primary', 'card-success', 'card-info', 'card-warning', 'card-danger', 
			'card-outline-primary', 'card-outline-secondary', 'card-outline-success', 
			'card-outline-info', 'card-outline-warning', 'card-outline-danger'),

		// https://v4-alpha.getbootstrap.com/utilities/colors/
		// Note that the .text-white class has no link styling.
		'text'  => thunderstrap_text(),
	);

	return $colors[$set];
}

function thunderstrap_text($property = 'color') {
	$text = array (
		'color'     => array( 'text-muted', 'text-primary', 'text-success', 'text-info', 
			'text-warning', 'text-danger', 'text-white' ),
		
		'alignment' => array ( 'text-justify', 'text-left', 'text-center', 'text-right' ),

		'transform' => array ( 'text-lowercase', 'text-uppercase', 'text-capitalize' ),

		'font_style' => array ( 'font-weight-bold', 'font-weight-normal', 'font-italic' ),
	);

	return $text[$property];
}

function thunderstrap_widget_parts() {
	return $widget_parts = array( 'headline', 'content', 'background', 'linktext', 'url', 'button', 'button_size' ); 
}

function thunderstrap_btn_sizes() {
	return $btn_sizes = array( 'btn-lg', 'btn-sm' );
}

function thunderstrap_input_text_e($val, $fieldname, $value) {
	$title = ucwords($val);
	if ($val == "linktext") {			
		$title = "Button Text";
	} elseif ($val == "url") {			
		$title = "Button Link URL";
	} elseif ($val == "button") {			
		$title = "Button Style";
	}
	$str = '<p>' . __( $title, "thunderstrap-widgets" ) . ': ';
	$str .= '<input class="widefat" name="' . $fieldname . '" type="text"';
	$str .= ' value="' . esc_attr( $value ) . '" /></p>';

	return $str;
}

function thunderstrap_textarea_e($val, $fieldname, $value) {
	$str = '<p>' . __( ucwords($val), "thunderstrap-widgets" ) . ': ';
	$str .= '<textarea class="widefat"	name="' . $fieldname . '" >';
	$str .= esc_textarea( $value ) . '</textarea></p>';

	return $str;
}

function thunderstrap_select_e($val, $fieldname, $type = 'bg', $value) {
	$str = '<p>' . __( ucwords($val), "thunderstrap-widgets" ) . ': ';
	$str .= '<select name="' . $fieldname . '">';
	if($type == "btn-size")	{
		$btn_sizes = thunderstrap_btn_sizes();
		foreach ($btn_sizes as $val) {
			$selected = ($value == $val) ? 'selected' : '';
		    $str .= '<option value="' . $val . '" ' .$selected . '>' . $val . '</option>';
		}
	} else {
		$bg_colors = thunderstrap_colors($type);
		foreach ($bg_colors as $val) {
			$selected = ($value == $val) ? 'selected' : '';
		    $str .= '<option value="' . $val . '" ' .$selected . '>' . $val . '</option>';
		}
	}
	$str .= '</select></p>';

	return $str;
}
