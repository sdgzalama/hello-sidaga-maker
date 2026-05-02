<?php

class bt_bb_video extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'video'            => '',
			'disable_controls' => '',
			'responsive'       => ''
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		if ( $disable_controls != '' ) {
			$class[] = $this->prefix . 'disable_controls' . '_' . $disable_controls;
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		
		
		$output = '[video src="' . esc_attr( $video ) . '"]';
		
		$output = '<div' . ( $id_attr ) . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . ( $style_attr ) . '><div class="bt-video-container">' . do_shortcode( $output ) . '</div></div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;

	}

	function map_shortcode() {
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Video', 'medicare' ), 'description' => esc_html__( 'Video player', 'medicare' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'video', 'type' => 'textfield', 'heading' => esc_html__( 'Video', 'medicare' ) ),
				array( 'param_name' => 'disable_controls', 'type' => 'dropdown', 'heading' => esc_html__( 'Disable player controls', 'medicare' ),
				'value' => array(
					esc_html__( 'No', 'medicare' ) => 'no',
					esc_html__( 'Yes', 'medicare' ) => 'yes'
				),
				'description' => esc_html__( 'Useful when embedded video has its own controls, e.g. Vimeo', 'medicare' ) )
			)
		) );
	}
}