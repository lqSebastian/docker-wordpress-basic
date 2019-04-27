<?php
/**
 * slider section for the homepage.
 */
		$rambo_pro_theme_options = theme_data_setup();
		$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
		
		$current_options = get_option( 'rambo_pro_theme_options');

		if(isset($current_options['slider_post'])){	
		if(is_numeric ($current_options['slider_post']))
		{
		$slider_post = isset($current_options['slider_post'])?   get_the_post_thumbnail_url($current_options['slider_post']) : WEBRITI_TEMPLATE_DIR_URI . '/images/slider.jpg';
		}else{$slider_post = isset($current_options['slider_post'])?   $current_options['slider_post'] : WEBRITI_TEMPLATE_DIR_URI . '/images/slider.jpg';
		}
		}else
		{
		$slider_post = WEBRITI_TEMPLATE_DIR_URI . '/images/slider.jpg';
		}
		
		
		if(isset($current_options['slider_post'])){	
		if(is_numeric ($current_options['slider_post']))
		{
		   $slider_title = get_the_title( $current_options['slider_post'] );
		}
		else
		{
		$slider_title = isset($current_options['slider_title'])?   $current_options['slider_title'] : 'Responsive WP theme';
		}
		}else
		{
		$slider_title = isset($current_options['slider_title'])?   $current_options['slider_title'] : 'Responsive WP theme';
		}		
		
		if(isset($current_options['slider_post'])){	
		if(is_numeric ($current_options['slider_post']))
		{
		
		$slider_text=apply_filters('get_the_content', get_post_field('post_content', $current_options['slider_post']));
		
		}else{$slider_text = isset($current_options['slider_text'])?   $current_options['slider_text'] : 'We are a group of passionate designers and developers who really love creating awesome WordPress themes & giving support.';
		}
		}else
		{
		$slider_text = isset($current_options['slider_text'])?   $current_options['slider_text'] : 'We are a group of passionate designers and developers who really love creating awesome WordPress themes & giving support.';
		}
		
		$home_banner_enabled = isset($current_options['home_banner_enabled'])? $current_options['home_banner_enabled']:true;
		if (  $home_banner_enabled == true ) {
			
			
		$rambo_pro_theme_options = theme_data_setup();
		$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
		
		?>
		
	<!-- Slider with Thumbnails -->
<div class="main_slider">
	<div class="carousel-inner">
		<!-- Carousel items -->
		<div id="post-<?php the_ID(); ?>" class="item active">
			<img  class="banner_img webrit_slides" src="<?php if($slider_post) { echo $slider_post; } ?>">
			<div class="container slider_con">
				<?php if($slider_title) { ?>
				<h2><?php echo $slider_title; ?></h2>
				<?php } if($slider_text) { ?>
				<h5 class="slide-title">
				<span>
				<?php echo $slider_text;  ?>
				</span>
				</h5>
				<?php } ?>
				<?php if($current_options['slider_readmore_text']!=''){ ?>
							<a class="slide-btn" href="<?php echo esc_url($current_options['readmore_text_link']); ?>" <?php if(
							$current_options['readmore_target'] == true) { echo "target='_blank'"; } ?> class="flex-btn"><?php echo esc_html($current_options['slider_readmore_text']); ?></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>