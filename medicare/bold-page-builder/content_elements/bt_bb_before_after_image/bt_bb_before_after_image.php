<?php

class bt_bb_before_after_image extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'before_image'	=> '',		
			'after_image'	=> '',
			'headline'      => '',
			'subheadline' => '',
			'smaler_subheadline'   => '',
			'before_text'          => '',
			'after_text'          => ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );
		
		$content_elements_misc_path_js	= get_template_directory_uri() . '/bold-page-builder/content_elements_misc/js/';
		$content_elements_misc_path_css	= get_template_directory_uri() . '/bold-page-builder/content_elements_misc/css/';
		
		wp_enqueue_script( 
			'jquery.twentytwenty',
			$content_elements_misc_path_js . 'jquery.twentytwenty.js',
			array( 'jquery' ),
			'',
			true
		);
		
		wp_enqueue_script( 
			'jquery.event.move',
			$content_elements_misc_path_js . 'jquery.event.move.js',
			array( 'jquery' ),
			'',
			true
		);
		
		wp_enqueue_script( 
			'imagesloaded.pkgd.min.js',
			$content_elements_misc_path_js . 'imagesloaded.pkgd.min.js',
			array( 'jquery' ),
			'',
			true
		);
		
		wp_enqueue_style( 
			'bt_bb_before_after', 
			$content_elements_misc_path_css . 'bt_bb_before_after.css', 
			array(), 
			false, 
			'screen' 
		);
		
		
		$headline = html_entity_decode( $headline ) ;
		$subheadline = html_entity_decode( $subheadline ) ;
		$smaler_subheadline = html_entity_decode( $smaler_subheadline ) ;

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
		
		$alt_before = '';
		$alt_after = '';
		$size = 'full';
		
		if ( $before_image != '' && is_numeric( $before_image ) ) {
			$post_image = get_post( $before_image );
			if ( $post_image == '' ) return;
		
			$before_image = wp_get_attachment_image_src( $before_image, $size );
			$before_image = $before_image[0];
			if ( $alt_before == '' ) {
				$alt_before = $before_image;
			}
		}
		
		if ( $after_image != '' && is_numeric( $after_image ) ) {
			$post_image = get_post( $after_image );
			if ( $post_image == '' ) return;
		
			$after_image = wp_get_attachment_image_src( $after_image, $size );
			$after_image = $after_image[0];
			if ( $alt_after == '' ) {
				$alt_after = $after_image;
			}
		}
		
		if ( $headline != '' ) {
			$class[] = $this->prefix . 'headline';
			$headline = '<span class="' . esc_attr( $this->shortcode . '_headline' ) . '">' . wp_kses_post( $headline ) . '</span>';
		}
		
		if ( $subheadline != '' ) {
			$class[] = $this->prefix . 'subheadline';
			$subheadline = '<span class="' . esc_attr( $this->shortcode . '_subheadline' ) . '">' . wp_kses_post( $subheadline ) . '</span>';
		}
		
		if ( $smaler_subheadline != '' ) {
			$class[] = $this->prefix . 'smaler_subheadline';
			$smaler_subheadline = '<span class="' . esc_attr( $this->shortcode . '_smaler_subheadline' ) . '">' . wp_kses_post( $smaler_subheadline ) . '</span>';
		}
		
		if ( $before_text != '' ) {
			$class[] = $this->prefix . 'before_text';
			$before_text = '<span class="' . esc_attr( $this->shortcode . '_before_text' ) . '">' . wp_kses_post( $before_text ) . '</span>';
		}
		
		if ( $after_text != '' ) {
			$class[] = $this->prefix . 'after_text';
			$after_text = '<span class="' . esc_attr( $this->shortcode . '_after_text' ) . '">' . wp_kses_post( $after_text ) . '</span>';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
                $container_id = "container" . rand(1, 1000);
		
		$output = '<div class="' . esc_attr( $this->shortcode . '_title bt_bb_before_after_image-container twentytwenty-container' ) . '" id="' . esc_attr( $container_id ) . '"><img src="' . esc_url_raw( $before_image ) . '" /><img class="bt_bb_before_after_image-before_copy" src="' . esc_url_raw( $before_image ) . '" /><img src="' . esc_url_raw( $after_image ) . '" /></div>';
		
		if ( $headline != '' || $subheadline != '' || $smaler_subheadline != '' ) $output .= '<div class="bt_bb_before_after_image_block">' . wp_kses_post( $headline . $subheadline . $smaler_subheadline ) . '</div>';
		
		if ( $before_text != '') $output .= '<div class="bt_bb_before_after_image_before_txt_holder">' . wp_kses_post( $before_text ) . '</div>';
		
		if ( $after_text != '') $output .= '<div class="bt_bb_before_after_image_after_txt_holder">' . wp_kses_post( $after_text ) . '</div>';
		

		$output = '<div' . ( $id_attr ) . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . ( $style_attr ) . '>' . ( $output ) . '</div>';
		
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );


		return $output;

	}

	function map_shortcode() {			
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Before/After Image', 'medicare' ), 'description' => esc_html__( 'Compare two images', 'medicare' ), 'icon' => 'bt_bb_icon_bt_bb_before_after_image',
			'params' => array(
				array( 'param_name' => 'before_image', 'type' => 'attach_image', 'heading' => esc_html__( 'Before image', 'medicare' ), 'preview' => true ),
				array( 'param_name' => 'after_image', 'type' => 'attach_image', 'heading' => esc_html__( 'After image', 'medicare' ), 'preview' => true ),
				array( 'param_name' => 'headline', 'type' => 'textfield', 'heading' => esc_html__( 'Headline', 'medicare' ), 'preview' => true, 'preview_strong' => true ),
				array( 'param_name' => 'subheadline', 'type' => 'textfield', 'heading' => esc_html__( 'Subheadline', 'medicare' ), 'preview' => true, 'preview_strong' => true ),
				array( 'param_name' => 'smaler_subheadline', 'type' => 'textfield', 'heading' => esc_html__( 'Smaller text', 'medicare' ), 'preview' => true, 'preview_strong' => true ),
				array( 'param_name' => 'before_text', 'type' => 'textfield', 'heading' => esc_html__( 'Before text', 'medicare' ), 'preview' => true, 'preview_strong' => true ),
				array( 'param_name' => 'after_text', 'type' => 'textfield', 'heading' => esc_html__( 'After text', 'medicare' ), 'preview' => true, 'preview_strong' => true )			
			)
		) );
	}
}