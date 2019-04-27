<?php
/**
* @Theme Name	:	Rambopro
* @file         :	index-theme-introdunction-top.php
* @license      :	license.txt
* @filesource   :	wp-content/themes/rambopro/index-theme-introdunction-top.php
*/
$rambo_pro_theme_options = theme_data_setup();
$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), $rambo_pro_theme_options );
?>
<!-- Purchase Now Section -->
<?php
$oldData = get_option( 'rambo_pro_theme_options');
if(isset($oldData['site_intro_descritpion']) || isset($oldData['site_intro_descritpion'])){?>
        
<div class="purchase_main_content">
	    <div class="container">	
				
				<div class="row-fluid purchase_now_content">
				
					<?php if( $current_options['site_intro_descritpion'] != '' ) { ?>
						<div class="span8">	
							<h1><?php echo $current_options['site_intro_descritpion']; ?></h1>
						</div>
					<?php } ?>
					
					<?php if($current_options['site_intro_button_text']!='') { ?>
						<div class="span4">
							<a class="purchase_now_btn" href="<?php if($current_options['site_intro_button_link']!='') { echo $current_options['site_intro_button_link']; } else { echo "#"; } ?>" <?php if($current_options['intro_button_target']==true) { echo  "target='_blank'"; } ?> ><?php echo $current_options['site_intro_button_text']; ?></a>
						</div>
					<?php } ?>
					
				</div>
			
		</div>	
</div>
<?php 
} elseif(is_active_sidebar('site-intro-area') && get_option( 'rambo_pro_theme_options' ) != null) {  ?>
	
  	<div class="purchase_main_content">
	    <div class="container">
	 
		<?php
		
			echo '<div class="row purchase_now_content">';
			
				dynamic_sidebar( 'site-intro-area' );
				
			echo '</div>';
				
		?>
				
	
	    </div>
    </div>
	

<?php } else {?>


<div class="purchase_main_content">
	    <div class="container">	
				
				<div class="row-fluid purchase_now_content">
				
					<?php if( $current_options['site_intro_descritpion'] != '' ) { ?>
						<div class="span8">	
							<h1><?php echo $current_options['site_intro_descritpion']; ?></h1>
						</div>
					<?php } ?>
					
					<?php if($current_options['site_intro_button_text']!='') { ?>
						<div class="span4">
							<a class="purchase_now_btn" href="<?php if($current_options['site_intro_button_link']!='') { echo $current_options['site_intro_button_link']; } else { echo "#"; } ?>" <?php if($current_options['intro_button_target']==true) { echo  "target='_blank'"; } ?> ><?php echo $current_options['site_intro_button_text']; ?></a>
						</div>
					<?php } ?>
					
				</div>
			
		</div>	
</div>


<?php } ?>


<!-- /Purchase Now Section -->