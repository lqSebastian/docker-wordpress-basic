<?php
function rambo_site_intro_customizer( $wp_customize ) {
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;
	
/* Site Intro Panel */
	$wp_customize->add_section( 'site_intro_settings' , array(
			'title'      => __('Call to action top settings', 'rambo'),
			'panel'  => 'section_settings',
			'priority'   => 515,
		) );
		
		
			$wp_customize->add_setting(
			'rambo_pro_theme_options[site_intro_descritpion]',
			array(
				'default' => __('Rambo is a clean and fully responsive Template.','rambo'),
				'capability'     => 'edit_theme_options',
				'type' => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				
				'transport' => $selective_refresh ? 'postMessage' : 'refresh',
				)
			);	
				

			$wp_customize->add_control('rambo_pro_theme_options[site_intro_descritpion]',array(
			'label'   => __('Description','rambo'),
			'section' => 'site_intro_settings',
			 'type' => 'text',)  );	

			 
			$wp_customize ->add_setting (
			'rambo_pro_theme_options[site_intro_button_text]',
			array( 
			'default' => __('Purchase Now','rambo'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
			) 
			);

			$wp_customize->add_control (
			'rambo_pro_theme_options[site_intro_button_text]',
			array (  
			'label' => __('Button Text','rambo'),
			'section' => 'site_intro_settings',
			'type' => 'text',
			) );
			
			$wp_customize ->add_setting (
			'rambo_pro_theme_options[site_intro_button_link]',
			array( 
			'default' => '#',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
			) );

			$wp_customize->add_control (
			'rambo_pro_theme_options[site_intro_button_link]',
			array (  
			'label' => __('Button Link','rambo'),
			'section' => 'site_intro_settings',
			'type' => 'text',
			) );

			$wp_customize->add_setting(
				'rambo_pro_theme_options[intro_button_target]',
				array('capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'type' => 'option',
				'default'=> true ,
				));

			$wp_customize->add_control(
				'rambo_pro_theme_options[intro_button_target]',
				array(
					'type' => 'checkbox',
					'label' => __('Open link in new tab','rambo'),
					'section' => 'site_intro_settings',
				)
			);
}
add_action( 'customize_register', 'rambo_site_intro_customizer' );

/**
 * Add selective refresh for service title section controls.
 */
function rambo_register_callout_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[site_intro_descritpion]', array(
		'selector'            => '.purchase_main_content .span8 h1',
		'settings'            => 'rambo_pro_theme_options[site_intro_descritpion]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[site_intro_button_text]', array(
		'selector'            => '.purchase_main_content .span4 a',
		'settings'            => 'rambo_pro_theme_options[site_intro_button_text]',
	
	) );
}
add_action( 'customize_register', 'rambo_register_callout_section_partials' );
?>