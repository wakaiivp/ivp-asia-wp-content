<?php
/**
 * Template Name: no-header
 *
 * @package Weluka
 * @since Weluka Theme 00 1.0
 * 　
 */

global $weluka_themename;
?>


 
<?php
if ( have_posts() ) :
	get_template_part( 'content', get_post_format() );
else:
	get_template_part( 'content', 'none' );

endif;
?>
