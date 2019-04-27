<?php	
  /**
  * @Theme Name	:	rambo
  * @file         :	home.php
  * @package      :	rambo
  * @author       :	webriti
  * @license      :	license.txt
  * @filesource   :	wp-content/themes/rambo/home.php
  */ 
  
  	if('page' == get_option('show_on_front')){ get_template_part('index');}

	else {get_header();
  
  	/****** get index banner  ********/
  	get_template_part('index', 'banner') ;
  	
  	/****** get top callout  ********/
	get_template_part('index', 'theme-introduction-top');
	
	/****** get index service  ********/
  	get_template_part('index', 'service') ;
	
	/****** get index Projects  ********/
  	get_template_part('index', 'projects') ;
	
	/****** get index blog  ********/
  	echo '<div class="for_mobile">';
	get_template_part('index', 'recentblog') ;
	echo '</div>';
  	
  	/****** get footer section *********/
  	get_footer();
	}

?>