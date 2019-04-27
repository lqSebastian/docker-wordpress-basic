<?php
function rambo_shop_customizer( $wp_customize ) {
	
	// Upgrade to pro message
	class rambo_Customize_shop_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php _e('Want to sell products? ','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
		<?php
		}
	}
	

	//Shop panel
	$wp_customize->add_section( 'shop_section_settings' , array(
	'title'      => __('Shop settings', 'rambo'),
	'panel'  => 'section_settings',
	'priority'   => 519,
    ) );
	
	
	// Upgrade to Pro Label
		$wp_customize->add_setting( 'rambo_pro_theme_options[shop_upgrade_message]', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new rambo_Customize_shop_upgrade(
			$wp_customize,
			'rambo_pro_theme_options[shop_upgrade_message]',
				array(
					'label'					=> __('Upgrade to Pro','rambo'),
					'section'				=> 'shop_section_settings',
					'settings'				=> 'rambo_pro_theme_options[shop_upgrade_message]',
				)
			)
		);
	
	// enable project section
	$wp_customize->add_setting('rambo_pro_theme_options[home_shop_enable]',array(
	'default' => false,
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option'
	) );
	
	$wp_customize->add_control('rambo_pro_theme_options[home_shop_enable]',array(
	'label' => __('Hide Shop section','rambo'),
	'section' => 'shop_section_settings',
	'type' => 'checkbox','input_attrs' => array( 'disabled' =>'disabled' ),
	) );
	
	// add section to manage Testimonial Title
	$wp_customize->add_setting(
    'rambo_pro_theme_options[home_shop_title]',
    array(
        'default' => __("Our Product","rambo"),
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		)
	);	
	$wp_customize->add_control( 'rambo_pro_theme_options[home_shop_title]',array(
    'label'   => __('Title','rambo'),
    'section' => 'shop_section_settings',
	 'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ))  );	
	 
	 
	 $wp_customize->add_setting(
    'rambo_pro_theme_options[home_shop_desciption]',
    array(
        'default' => 'Check out our product',
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		)
	);	
	$wp_customize->add_control( 'rambo_pro_theme_options[home_shop_desciption]',array(
    'label'   => __('Description','rambo'),
    'section' => 'shop_section_settings',
	 'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ))  );
	 
	 
	 //link
	class WP_shop_section_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
    
    <?php _e( 'To have access to a shop section please install and configure', 'rambo' ); ?>
    </br></br><a href="https://wordpress.org/plugins/woocommerce/" class="button"  target="_blank"><?php _e( 'WooCommerce Plugin', 'rambo' ); ?></a>
    <?php
   
    }
}
	 
	 
	 $wp_customize->add_setting(
	    'shop_section',
	    array(
	        'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
	    )	
	);
	
	$wp_customize->add_control( new WP_shop_section_Customize_Control( $wp_customize, 'shop_section', array(	
			'section' => 'shop_section_settings',
	    ))
	);
	 
}
	add_action( 'customize_register', 'rambo_shop_customizer' );
	
	
	/**
 * Add selective refresh for Front page section section controls.
 */
function rambo_pro_register_home_shop_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[home_shop_title]', array(
		'selector'            => '.additional_section_two .featured_port_title h1',
		'settings'            => 'rambo_pro_theme_options[home_shop_title]',
	
	) );
	
$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[home_shop_desciption]', array(
		'selector'            => '.additional_section_two .featured_port_title p',
		'settings'            => 'rambo_pro_theme_options[home_shop_desciption]',
	
	) );

}

add_action( 'customize_register', 'rambo_pro_register_home_shop_section_partials' );
?>