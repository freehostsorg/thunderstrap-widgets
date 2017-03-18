<?php

/**
 * The file defines the jumbotron widget class
 *
 * A class definition that extends WP_Widget.
 *
 * @link       https://github.com/radixmo/thunderstrap-widgets
 * @since      0.0.1
 *
 * @package    Thunderstrap_Widgets
 * @subpackage Thunderstrap_Widgets/includes
 */

/**
 * Jumbotron widget class.
 *
 * Manages user settings for Jumbotron displayed in WordPress frontend..
 *
 * @since      0.0.1
 * @package    Thunderstrap_Widgets
 * @subpackage Thunderstrap_Widgets/includes
 * @author     Len Johnson <radixmo@gmail.com>
 */
class Thunderstrap_Jumbotron extends WP_Widget {

	function __construct() {
		$widget_ops = array(
		'classname' => 'thunderstrap_jumbotron_class',
		'description' => 'Add a Bootstrap Jumbotron callout.' );
		parent::__construct( 'thunderstrap_jumbotron', 'Thunderstrap Jumbotron', $widget_ops );
	}

	function form( $instance ) {
		$widget_parts = thunderstrap_widget_parts(); 
		$defaults     = '';
		foreach($widget_parts as $val) {
			$defaults[$val] = '';
		}
		$instance     = wp_parse_args( (array) $instance, $defaults );
		foreach ($widget_parts as $val) {
			${$val} = $instance[$val];

		    // print form to screen
			if ($val == "content") {
				echo thunderstrap_textarea_e( $val, $this->get_field_name( $val ), ${$val} );
			} elseif ($val == "background") {
				echo thunderstrap_select_e( 'Background Color', $this->get_field_name( $val ), $type = 'bg', ${$val} );
			} elseif ($val == "button") {
				echo thunderstrap_select_e( 'Button Style', $this->get_field_name( $val ), $type = 'btn', ${$val} );
			} elseif ($val == "button_size") {
				echo thunderstrap_select_e( 'Button Size', $this->get_field_name( $val ), $type = 'btn-size', ${$val} );
			} else {
				echo thunderstrap_input_text_e( $val, $this->get_field_name( $val ), ${$val} );
			}
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance     = $old_instance;
		$widget_parts = thunderstrap_widget_parts(); 
		foreach($widget_parts as $val) {
			if ($val == "content") {
				$instance['content'] = wp_kses( $new_instance['content'] );
			} else {
				$instance[$val] = sanitize_text_field( $new_instance[$val] );
			}
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		$headline    = ( empty( $instance['headline'] ) ) ? '&nbsp;' : $instance['headline'];
		$content     = ( empty( $instance['content'] ) ) ? '&nbsp;' : $instance['content'];
		$background  = ( empty( $instance['background'] ) ) ? 'bg-primary' : $instance['background'];
		$linktext    = ( empty( $instance['linktext'] ) ) ? '&nbsp;' : $instance['linktext'];
		$url         = ( empty( $instance['url'] ) ) ? '&nbsp;' : $instance['url'];
		$text        = ($background == "bg-faded") ? '' : 'text-white';
		$button      = ( empty( $instance['button'] ) ) ? 'bg-success' : $instance['button'];
		$button_size = ( empty( $instance['button_size'] ) ) ? 'btn-lg' : $instance['button_size'];

		$str = '<div class="textwidget">';
		// https://v4-alpha.getbootstrap.com/components/jumbotron/
		$str .= '<div class="jumbotron jumbotron-fluid ' . esc_html( $background ) . ' ' . esc_html( $text ) . '">';
		$str .= '<div class="container">';
		$str .= '<h1 class="display-4">' . esc_html( $headline ) . '</h1>';
		$str .= '<p class="lead">' . esc_html( $content ) . '</p>';
		if ( $linktext !== "&nbsp;" && $url !== "&nbsp;" ):
		$str .= '<p><a class="btn ' . esc_html( $button ) . ' ' . esc_html( $button_size ) .'" href="' . esc_html( $url ) . '" role="button">' . esc_html( $linktext ) . '</a></p>';
		endif;
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</div>';

		echo $str;

		echo $after_widget;
	}
}