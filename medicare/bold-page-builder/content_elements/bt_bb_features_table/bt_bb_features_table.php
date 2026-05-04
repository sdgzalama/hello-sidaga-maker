<?php

class bt_bb_features_table extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'title'        => '',		
			'table'        => '',
			'color_scheme' => '',
			'responsive'   => ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );
		
		if ( file_exists( get_template_directory_uri() . '/bold-page-builder/content_elements_misc/misc.php' ) ) {
			require_once( 'misc.php' );
		}

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
		
		if ( $color_scheme != '' ) {
			$class[] = $this->prefix . 'color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme );
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$output = '<div class="' . esc_attr( $this->shortcode . '_title' ) . '">' . $title . '</div>';
		
		$output = "";
		
		$title_arr = explode(";", $title);
		
		$table_start = '<table>';
		$output .= $table_start;

		if ( !empty($title_arr) ){
			$title = '<thead><tr>';
			foreach ( $title_arr as $text ) {
				$title .= '<th>' . $text . '</th>';
			}
			$title .= '</tr></thead><tbody>';
			$output .= $title;
		}
		
		$table = str_replace("\n", ";#", $table);
		
		$table = str_replace("&", "amp", $table);
		
		if ( strpos($table, 'ampamp;') !== false ) {
			$table = str_replace("ampamp;", "*a*m*p*", $table);
		}
		
		$table_arr = explode(";", $table);

		if ( !empty($table_arr) ) { 
			$table_content = '<tr>';
			foreach ( $table_arr as $text ) {
				if (substr( $text, 0, 1 ) === "#") {
					$table_content .= '</tr><tr>';
					$text = substr($text, strlen("#"));
				}
				
				$text = str_replace("*a*m*p*", "&amp;", $text);
				
				if ( strpos($text, '*a*m*p*') !== false ) {
					$text = str_replace("*a*m*p*", "&amp;", $text);
				}
				
				if ( trim($text) == "*yes*" || trim($text) == "*no*" ) {
					if ( trim($text) == "*yes*" )
					{
						$table_content .= '<td><span class="bt_bb_features_table_yes"></span></td>';
					}
					else
					{
						$table_content .= '<td><span class="bt_bb_features_table_no"></span></td>';
					}
				}
				else {
					$table_content .= '<td>' . $text . '</td>';
				}
			}
			$table_content .= '</tr></tbody></table>';
			
			$output .= $table_content;
		}

		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . '>' . ( $output ) . '</div>';
		
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );


		return $output;

	}

	function map_shortcode() {
		
		if ( ! function_exists( 'bt_bb_get_color_scheme_param_array' ) ) {
			function bt_bb_get_color_scheme_param_array() {
				$color_scheme_arr = array( esc_html__( 'Inherit', 'medicare' ) => '' );

				$color_scheme_arr_temp = bt_bb_get_color_scheme_array();

				if ( $color_scheme_arr_temp[0] != '' ) {
					foreach( $color_scheme_arr_temp as $item ) {
						if ( $item != '' ) {
							$item_arr = explode( ';', $item, 4 );
							if ( count( $item_arr ) == 4 ) {
								$color_scheme_arr[ $item_arr[1] ] = $item_arr[0];
							} else {
								$color_scheme_arr[ $item_arr[0] ] = $item_arr[0];
							}
						}
					}
				}
				return $color_scheme_arr;
			}
		}
		
		if ( ! function_exists( 'bt_bb_get_color_scheme_array' ) ) {
			function bt_bb_get_color_scheme_array() {

				$options = get_option( 'bt_bb_settings' );
				$color_schemes = $options['color_schemes'];
				$color_scheme_arr = explode( PHP_EOL, $color_schemes );

				$color_scheme_arr = apply_filters( 'bt_bb_color_scheme_arr', $color_scheme_arr );

				return $color_scheme_arr;
			}
		}
				
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();			
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Features Table', 'medicare' ), 'description' => esc_html__( 'Table that describes the features', 'medicare' ), 'icon' => 'bt_bb_icon_bt_bb_price_list',
			'params' => array(
				array( 'param_name' => 'title', 'type' => 'textarea', 'heading' => esc_html__( 'Table header', 'medicare' ) ),
				array( 'param_name' => 'table', 'type' => 'textarea', 'heading' => esc_html__( 'Table', 'medicare' ) ),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'medicare' ), 'value' => $color_scheme_arr, 'preview' => true ),			
			)
		) );
	}
}