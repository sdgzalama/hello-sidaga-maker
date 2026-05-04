<?php

class bt_bb_timetable extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
		'columns'				=> '',
		'events'				=> '',
		'category'				=> '',
		'disable_event_url' 	=> '',
		'text_align'			=> '',
		'text_align_vertical'	=> '',
		'show_title'			=> '',
		'show_time'				=> '',
		'show_subtitle'			=> '',
		'show_description'		=> '',
		'show_event_head'		=> '',
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );
		
		
		if ( file_exists( plugin_dir_url( '' ) . 'mp-timetable/mp-timetable.php' ) ) {
			require_once( 'mp-timetable.php' );
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
		
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		
		// Events (check if some event doesn't have time) //
		$events_num_input = count(explode(", ", $events));
		$show_shortcode = 1;
		
		if ( ! function_exists( 'get_all_events()' ) ) {
			
			if(class_exists('mp_timetable\classes\models\Events')){
			
				$e = new mp_timetable\classes\models\Events;
				
				$event = $e->get_all_events();
				
				$events_data_all = '';
				
				foreach ($event as $key => $data) {
					$events_data_all = $e->get( 'events' )->get_events_data( array( 'column' => 'event_id', 'id' => $data->ID ) );
				}
				
				$events_num_get = count($events_data_all);
				
				if($events_num_input > $events_num_get)
				{
					$show_shortcode = 0;
				}
			}
		}
		
		
		if($show_shortcode != 0)
		{
			$category2 = "";
		
			$columns2 = preg_replace('/\s+/', '', $columns);
			$events2 = preg_replace('/\s+/', '', $events);
			$category2 = preg_replace('/\s+/', '', $category);
			
			
			$shortcode_txt = '[mp-timetable col="' . rtrim($columns2,',') . '" events="' . rtrim($events2,',') . '"';
			if ($category2 != "")
			{
				$shortcode_txt .= ' event_categ="' . rtrim($category2,',') . '"';
			}
			
			if ($show_title != "")
			{
				$shortcode_txt .= ' title="' . esc_attr( $show_title ) . '"';
			}
			
			if ($show_time != "")
			{
				$shortcode_txt .= ' time="' . esc_attr( $show_time ) . '"';
			}
			
			if ($show_subtitle != "")
			{
				$shortcode_txt .= ' sub-title="' . esc_attr( $show_subtitle ) . '"';
			}
			
			if ($show_description != "")
			{
				$shortcode_txt .= ' description="' . esc_attr( $show_description ) . '"';
			}
			
			if ($show_event_head != "")
			{
				$shortcode_txt .= ' user="' . esc_attr( $show_event_head ) . '"';
			}
			
			$shortcode_txt .= ' row_height="60" font_size="" increment="1" view="none" label="All Events" hide_label="1" hide_hrs="0" hide_empty_rows="1" group="0" disable_event_url="' . esc_attr( $disable_event_url ) . '" text_align="' . esc_attr( $text_align ) . '" text_align_vertical="' . esc_attr( $text_align_vertical ) . '" id="" custom_class="" responsive="1"]';
			
			
			$shortcode = do_shortcode( $shortcode_txt );
			
			$output = $shortcode;
		}
		else {
			$output = '<div><p>Timetable error - there\'s one event without time definied. Please go to Dashboard - Timetable and check if all the events have the time properly set.</p></div>';
		}

		$output = '<div' . ( $id_attr ) . ' class="' . implode( ' ', $class ) . '"' . ( $style_attr ) . '>' . ( $output ) . '</div>';
		
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );


		return $output;

	}
	

	function map_shortcode() {
		
		$columns_for_show = array();
		$events_for_show = array();
		$category_for_show = array();
		
		// Columns //
		if ( ! function_exists( 'get_all_column' ) ) {
			
			if(class_exists('mp_timetable\classes\models\Column')){
			
				$c = new mp_timetable\classes\models\Column;
				
				$columns = $c->get_all_column();
				
				$colums_data = array();
				$columns_array = array();
				
				foreach ($columns as $key => $data) {
					$colums_data['ID'] = $data->ID;
					$colums_data['post_title'] = $data->post_title;
					
					$columns_array[] = $colums_data;
				}
				
				foreach ($columns_array as $key => $data) {
					$columns_for_show[ $data['post_title'] ] = $data[ 'ID' ] . ",";
				}
			}
		}
		
		
		// Events and Categories //
		if ( ! function_exists( 'get_all_events()' ) ) {
			
			if(class_exists('mp_timetable\classes\models\Events')){
			
				$e = new mp_timetable\classes\models\Events;
				
				$events = $e->get_all_events();
				
				$events_data = array();
				$events_array = array();
				
				foreach ($events as $key => $data) {
					$events_data['ID'] = $data->ID;
					$events_data['post_title'] = $data->post_title;
					
					$events_array[] = $events_data;
				}
				
				$events_for_show = array();
				$i = 1;
				foreach ($events_array as $key => $data) {
					$events_for_show[ $i . " " . $data[ 'post_title' ] ] = $data[ 'ID' ] . ",";
					$i++;
				}
				
				
				// Category //
				
					if ( ! function_exists( 'get_terms()' ) ) {
				$category = get_terms( 'mp-event_category', 'orderby=count&hide_empty=0' );
				
				$category_data = array();
				$category_array = array();
				
				foreach ($category as $key => $data) {
					$category_data['term_id'] = $data->term_id;
					$category_data['name'] = $data->name;
					
					$category_array[] = $category_data;
				}
				
				$category_for_show = array();
				$i = 1;
				foreach ($category_array as $key => $data) {
					$category_for_show[ $i . " " . $data[ 'name' ] ] = $data[ 'term_id' ] . ",";
					$i++;
				}
			}
			}
		}
		
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Time Table', 'medicare' ), 'description' => esc_html__( 'Shows the timetable content from the Timetable plugin.', 'medicare' ), 'icon' => 'bt_bb_icon_bt_bb_timetable',
			'params' => array(
				array( 'param_name' => 'columns', 'type' => 'checkbox_group', 'heading' => esc_html__( 'Choose columns', 'medicare' ), 'preview' => true,
				'value' => $columns_for_show ),
				array( 'param_name' => 'events', 'type' => 'checkbox_group', 'heading' => esc_html__( 'Choose events', 'medicare' ), 'preview' => true,
				'value' => $events_for_show ),
				array( 'param_name' => 'category', 'type' => 'checkbox_group', 'heading' => esc_html__( 'Choose category', 'medicare' ), 'preview' => true,
				'value' => $category_for_show ),
				array( 'param_name' => 'disable_event_url', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'medicare' ) => 'disable_event_url' ), 'heading' => esc_html__( 'Disable event url', 'medicare' ), 'preview' => true
				),
				array( 'param_name' => 'text_align', 'type' => 'dropdown', 'heading' => esc_html__( 'Text align', 'medicare' ),
					'value' => array(
						esc_html__( 'Center', 'medicare' ) => 'center',
						esc_html__( 'Left', 'medicare' ) => 'left',
						esc_html__( 'Right', 'medicare' ) => 'right'
					)
				),
				array( 'param_name' => 'text_align_vertical', 'type' => 'dropdown', 'heading' => esc_html__( 'Text align vertical', 'medicare' ),
					'value' => array(
						esc_html__( 'Default', 'medicare' ) => 'default',
						esc_html__( 'Top', 'medicare' ) => 'top',
						esc_html__( 'Middle', 'medicare' ) => 'middle',
						esc_html__( 'Bottom', 'medicare' ) => 'bottom'
					)
				),
				array( 'param_name' => 'show_title', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'medicare' ) => 'show_title' ), 'heading' => esc_html__( 'Show title', 'medicare' ), 'preview' => true
				),
				array( 'param_name' => 'show_time', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'medicare' ) => 'show_time' ), 'heading' => esc_html__( 'Show time', 'medicare' ), 'preview' => true
				),
				array( 'param_name' => 'show_subtitle', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'medicare' ) => 'show_subtitle' ), 'heading' => esc_html__( 'Show subtitle', 'medicare' ), 'preview' => true
				),
				array( 'param_name' => 'show_description', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'medicare' ) => 'show_description' ), 'heading' => esc_html__( 'Show description', 'medicare' ), 'preview' => true
				),
				array( 'param_name' => 'show_event_head', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'medicare' ) => 'show_event_head' ), 'heading' => esc_html__( 'Show event head', 'medicare' ), 'preview' => true
				)
			)
		) );
	}
}