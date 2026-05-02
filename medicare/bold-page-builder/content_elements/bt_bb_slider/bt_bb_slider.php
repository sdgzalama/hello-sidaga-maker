<?php

class bt_bb_slider extends BT_BB_Element {
	
	public $auto_play = '';

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'images'    			=> '',
			'height'    			=> '',
			'show_dots'     		=> '',
			'animation' 			=> '',
			'slides_to_show' 		=> '',
			'auto_play' 			=> '',
			'publish_datetime'		=> '',
			'expiry_datetime'		=> '',
			'responsive'      		=> ''
		) ), $atts, $this->shortcode ) );
		
		$publish_datetime = sanitize_text_field( $publish_datetime );
		$expiry_datetime = sanitize_text_field( $expiry_datetime );
		
		$slider_class = array( 'slick-slider' );
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
		
	
		if ( $height != '' ) {
			$class[] = $this->prefix . 'height' . '_' . $height;
		}	
		
		$data_slick = ' ' . 'data-slick=\'{ "lazyLoad": "progressive", "cssEase": "ease-out", "speed": "300", "prevArrow": "&lt;button type=\"button\" class=\"slick-prev\"&gt;", "nextArrow": "&lt;button type=\"button\" class=\"slick-next\"&gt;"';
		
		if ( $animation == 'fade' ) {
			$data_slick .= ', "fade": true';
			$slider_class[] = 'fade';
			$slides_to_show = 1;
		}
		
		if ( $height != 'keep-height' ) {
			$data_slick .= ', "adaptiveHeight": true';
		}
		
		if ( $show_dots != 'hide' ) {
			$data_slick .= ', "dots": true' ;
		}
		
		if ( $slides_to_show > 1 ) {
			$data_slick .= ',"slidesToShow": ' . intval( $slides_to_show );
			$class[] = $this->prefix . 'multiple_slides';
		}
		
		if ( $auto_play != '' ) {
			$data_slick .= ',"autoplay": true, "autoplaySpeed": ' . intval( $auto_play );
		}
		
		if ( is_rtl() ) {
			$data_slick .= ', "rtl": true' ;
		}
		
		if ( $slides_to_show > 1 ) {
			$data_slick .= ', "responsive": [';
			if ( $slides_to_show > 1 ) {
				$data_slick .= '{ "breakpoint": 480, "settings": { "slidesToShow": 1, "slidesToScroll": 1 } }';	
			}
			if ( $slides_to_show > 2 ) {
				$data_slick .= ',{ "breakpoint": 768, "settings": { "slidesToShow": 2, "slidesToScroll": 2 } }';	
			}
			if ( $slides_to_show > 3 ) {
				$data_slick .= ',{ "breakpoint": 920, "settings": { "slidesToShow": 3, "slidesToScroll": 3 } }';	
			}
			if ( $slides_to_show > 4 ) {
				$data_slick .= ',{ "breakpoint": 1024, "settings": { "slidesToShow": 3, "slidesToScroll": 3 } }';	
			}				
			$data_slick .= ']';
		}
		
		$data_slick = $data_slick . '}\' ';
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$output = '';
		

		if ( $images != '' ) {
			$image_array = explode( ',', $images );			
			foreach( $image_array as $image ) {		
				$alt		= '';
				$title		= '';
				$image_src	= get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_slider/placeholder.png';
				
				if ( is_numeric( $image ) ) {
					$post_image = get_post( $image );
					if ( is_object( $post_image ) ) {						
						$caption = get_post( $image )->post_excerpt;
						$image = wp_get_attachment_image_src( $image, 'full' );
						$image_src = isset($image[0]) ? $image[0] : $image_src;
						
						$alt = get_post_meta( $post_image->ID, '_wp_attachment_image_alt', true );
						if ( $alt == '' ) {
							$alt = $post_image->post_title;
						}
						$title = $post_image->post_title;
						if ( $title != '' ) {
							$title = ' title="' . esc_attr( $title ) . '"';	
						}
					}
				}
				if ( $height == 'auto' || $height == 'keep-height' ) {
					$output .= '<div class="bt_bb_slider_item"><img src="' . esc_url_raw( $image_src ) . '" alt="' . esc_attr( $alt ) . '" ' . ( $title ) . '></div>';
				} else {
					$output .= '<div class="bt_bb_slider_item" style="background-image:url(\'' . esc_url_raw( $image_src ) . '\')"></div>';
				}
				
			}
		}

		$output = '<div' . ( $id_attr ) . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . ( $style_attr ) . '><div class="' . esc_attr( implode( ' ', $slider_class ) ) . '" ' . ( $data_slick ) . '>' . ( $output ) . '</div></div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;

	}

	function map_shortcode() {
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Image Slider', 'medicare' ), 'description' => esc_html__( 'Slider with images', 'medicare' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'images', 'type' => 'attach_images', 'heading' => esc_html__( 'Images', 'medicare' ) ),
				array( 'param_name' => 'height', 'type' => 'dropdown', 'heading' => esc_html__( 'Height', 'medicare' ),
					'value' => array(
						esc_html__( 'Auto', 'medicare' ) => 'auto',
						esc_html__( 'Keep height', 'medicare' ) => 'keep-height',
						esc_html__( 'Half screen', 'medicare' ) => 'half_screen',
						esc_html__( 'Full screen', 'medicare' ) => 'full_screen'
					)
				),
				array( 'param_name' => 'animation', 'type' => 'dropdown', 'heading' => esc_html__( 'Animation', 'medicare' ), 'description' => esc_html__( 'If fade is selected, number of slides to show will be 1', 'medicare' ),
					'value' => array(
						esc_html__( 'Default', 'medicare' ) => 'slide',
						esc_html__( 'Fade', 'medicare' ) => 'fade'
					)
				),
				array( 'param_name' => 'show_dots', 'type' => 'dropdown', 'heading' => esc_html__( 'Dots navigation', 'medicare' ),
					'value' => array(
						esc_html__( 'Bottom', 'medicare' ) => 'bottom',
						esc_html__( 'Hide', 'medicare' ) => 'hide'
					)
				),
				array( 'param_name' => 'slides_to_show', 'type' => 'textfield', 'preview' => true, 'default' => 1, 'heading' => esc_html__( 'Number of slides to show', 'medicare' ), 'description' => esc_html__( 'e.g. 3', 'medicare' ) ),
				array( 'param_name' => 'auto_play', 'type' => 'textfield', 'heading' => esc_html__( 'Autoplay interval (ms)', 'medicare' ), 'description' => esc_html__( 'e.g. 2000', 'medicare' ) ),
				array( 'param_name' => 'publish_datetime', 'type' => 'datetime-local', 'heading' => esc_html__( 'Publish date', 'medicare' ), 'description' => esc_html__( 'Please, fill both the date and time', 'medicare' ), 'group' => esc_html__( 'Custom', 'medicare' ), 'weight' => 998 ),
				array( 'param_name' => 'expiry_datetime', 'type' => 'datetime-local', 'heading' => esc_html__( 'Expiry date', 'medicare' ), 'description' => esc_html__( 'Please, fill both the date and time', 'medicare' ), 'group' => esc_html__( 'Custom', 'medicare' ), 'weight' => 999 ),
			)
		) );
	}
}