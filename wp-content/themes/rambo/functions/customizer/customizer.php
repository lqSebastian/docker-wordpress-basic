<?php
/** Rambo default service content data ***/
if ( ! function_exists( 'rambo_service_default_customize_register' ) ) :
	function rambo_service_default_customize_register( $wp_customize ){
		
		$ServiceOldData = get_option('rambo_feature_page_widget');
			$the_sidebars = wp_get_sidebars_widgets();
			$rambo_service_content = $wp_customize->get_setting( 'rambo_pro_theme_options[rambo_service_content]' );
			if(!empty($the_sidebars['sidebar-service'])){
					$pro_service_data = array();
					foreach ($the_sidebars['sidebar-service'] as $data) {
						$widget_data = explode('-',$data);
						$data  = $widget_data[1];
						if($widget_data[0] == 'rambo_feature_page_widget'){
							$options = get_option( 'widget_rambo_feature_page_widget' );
							$pro_service_data[] = array(
							'icon_value' => isset($options[$widget_data[1]]['icon'])? $options[$widget_data[1]]['icon'] : '',
							'image_url'  => isset($options[$widget_data[1]]['selected_page'])? get_the_post_thumbnail_url($options[$widget_data[1]]['selected_page']) :'',
							'title'      => isset($options[$widget_data[1]]['selected_page'])? get_the_title( $options[$widget_data[1]]['selected_page'] ) : '',
							'text'       => isset($options[$widget_data[1]]['selected_page'])? get_post_field('post_content', $options[$widget_data[1]]['selected_page']) : '',
							'color'		 => '#f22853',
							'button_text' => isset($options[$widget_data[1]]['buttontext'])? $options[$widget_data[1]]['buttontext'] : '',
							'link'       => isset($options[$widget_data[1]]['servicelink'])? $options[$widget_data[1]]['servicelink'] : '',
							'open_new_tab' => isset($options[$widget_data[1]]['target']) ? $options[$widget_data[1]]['target'] : '',
							'id'         => 'customizer_repeater_56d7ea7f40b56',
							
							);
						}
						
					}
					
					$rambo_service_content->default = json_encode($pro_service_data);
		} else if($ServiceOldData==''){
			 //Run this code section if user Install direct pro new theme (This is the default service data)
				$rambo_service_content_control = $wp_customize->get_setting( 'rambo_pro_theme_options[rambo_service_content]' );
				if ( !empty( $rambo_service_content_control ) ) {
					$rambo_service_content_control->default = json_encode( array(
						array(
						'icon_value' => 'fa fa-camera',
						'image_url'  => '',
						'title'      => esc_html__( 'Incredibly Flexible', 'rambo' ),
						'text'       => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
						'color'		 => '#f22853',
						'button_text' => 'Read More',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'choice'    => 'customizer_repeater_icon',
						'id'         => 'customizer_repeater_56d7ea7f40b56',
						),
						array(
						'icon_value' => 'fa fa-cogs',
						'image_url'  => '',
						'title'      => esc_html__( 'fa fa-cogst', 'rambo' ),
						'text'       => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
						'color'		 => '#6dc82b',
						'button_text' => 'Read More',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'choice'    => 'customizer_repeater_icon',
						'id'         => 'customizer_repeater_56d7ea7f40b66',
						),
						array(
						'icon_value' => 'fa fa-user',
						'image_url'  => '',
						'title'      => esc_html__( 'Easy To Use', 'rambo' ),
						'text'       => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
						'color'		 => '#fe8000',
						'button_text' => 'Read More',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'choice'    => 'customizer_repeater_icon',
						'id'         => 'customizer_repeater_56d7ea7f40b86',
						),
						array(
						'icon_value' => 'fa fa-desktop',
						'image_url'  => '',
						'title'      => esc_html__( 'Responsive Design', 'rambo' ),
						'text'       => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
						'color'		 => '#1abac8',
						'button_text' => 'Read More',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'choice'    => 'customizer_repeater_icon',
						'id'         => 'customizer_repeater_56d7ea7f40b86',
						),
						
					) );

				}
		 }
	}
	
add_action( 'customize_register', 'rambo_service_default_customize_register' );
	
endif;