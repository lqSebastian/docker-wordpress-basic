<?php
function rambo_theme_color_customizer( $wp_customize ) {

//Theme color
class WP_color_Customize_Control extends WP_Customize_Control {
public $type = 'new_menu';

       function render_content()
       
	   {
	   echo '<h3>'.__('Predefined Colors','rambo').'</h3>';
		  $name = '_customize-color-radio-' . $this->id; 
		  foreach($this->choices as $key => $value ) {
            ?>
               <label>
				<input type="radio" disabled value="<?php echo $key; ?>" name="<?php echo esc_attr( $name ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" <?php if($this->value() == $key){ echo 'checked="checked"'; } ?>>
				<img <?php if($this->value() == $key){ echo 'class="color_scheem_active"'; } ?> src="<?php echo get_template_directory_uri(); ?>/images/bg-patterns/<?php echo $value; ?>" alt="<?php echo esc_attr( $value ); ?>" />
				</label>
				
            <?php
		  }
		  ?>
		  <script>
			jQuery(document).ready(function($) {
				$("#customize-control-rambo_pro_theme_options-rambopro_stylesheet label img").click(function(){
					$("#customize-control-rambo_pro_theme_options-rambopro_stylesheet label img").removeClass("color_scheem_active");
					$(this).addClass("color_scheem_active");
				});
			});
		  </script>
		  <?php
       }

}
/* Header Section */
	$wp_customize->add_section( 'header_image' , array(
		'title'      => __('Theme style setting', 'rambo'),
		'priority'   => 10,
   	) );
	$wp_customize->add_setting(
	'rambo_pro_theme_options[rambopro_stylesheet]', array(
        'default'        => 'default.css',
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    
	$wp_customize->add_control(new WP_color_Customize_Control($wp_customize,'rambo_pro_theme_options[rambopro_stylesheet]',
	array(
        'label'   => __('Predefined Colors', 'rambo'),
        'section' => 'header_image',
		'type' => 'radio',
		'choices' => array(
			'default.css' => 'default.png',
            'blue.css' => 'blue.png',
            'green.css' => 'green.png',
			'orange.css'=>'orange.png',
			'pink.css'=>'pink.png',
    )
	
	)));
	
	
	$wp_customize->add_setting(
    'rambo_pro_theme_options[theme_color_enable]',
    array(
        'default' => false,
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'rambo_pro_theme_options[theme_color_enable]',
    array(
        'label' => __('Enable custom color skin','rambo'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
	);
	
	$wp_customize->add_setting(
	'rambo_pro_theme_options[theme_color]', array(
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'default' => '#31A3DD',
	'type' => 'option',
    ));
	
	$wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'rambo_pro_theme_options[theme_color]', 
	array(
		'label'      => __('Skin Color', 'rambo' ),
		'section'    => 'header_image',
		'settings'   => 'rambo_pro_theme_options[theme_color]',
	) ) );
	
	
	$wp_customize->add_setting(
    'rambo_pro_theme_options[layout_selector]',
    array(
        'default' => __('wide','rambo'),
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		
    )
	);

	$wp_customize->add_control(
    'rambo_pro_theme_options[layout_selector]',
    array(
        'type' => 'select',
        'label' => __('Theme Layout','rambo'),
        'section' => 'header_image',
		'choices' => array('wide'=>'wide', 'boxed'=>'boxed'),
	));
	
	
	}
	add_action( 'customize_register', 'rambo_theme_color_customizer' );
	?>