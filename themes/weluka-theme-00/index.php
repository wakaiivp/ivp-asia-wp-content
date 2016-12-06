<?php
/**
 * The main template file.
 * blog tyle home or archive
 *
 * @package Weluka
 * @since Weluka Theme 00 1.0
 * @update
 * ver1.1
 * 　
 */

if( check_weluka_plugin() !== "" ) return;

get_header();
global $weluka_themename, $welukaThemeOptions, $welukaBuilder; //v1.0.8 theme, builder add

if( isset( $_GET['mode'] ) && $_GET['mode'] === 'cp' ) {
	get_template_part( 'content', 'color' );

}elseif ( is_404() ) {
	get_template_part( 'content', 'none' );

} else {

	if( is_home() ) :
	else :
?>
    <?php //v1.0.7 sp-pad delete ?>
	<h2 class="page-title">
<?php
		if ( is_search() ) :
			printf( __( 'Search Results for: %s', $weluka_themename ), '<span>' . get_search_query() . '</span>' );
	
		elseif ( is_tag() ) :
			single_tag_title();
	
		elseif ( is_tax() || is_category() ) :
			single_term_title();
	
		elseif ( is_author() ) :
			printf( __( 'Author: %s', $weluka_themename ), '<span class="vcard">' . get_the_author() . '</span>' );

		elseif ( is_day() ) :
			printf( __( 'Day: %s', $weluka_themename ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			printf( __( 'Month: %s', $weluka_themename ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', $weluka_themename ) ) . '</span>' );

		elseif ( is_year() ) :
			printf( __( 'Year: %s', $weluka_themename ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', $weluka_themename ) ) . '</span>' );

		else :
			_e( 'Archives', $weluka_themename );

		endif;
?>
	</h2>
<?php
	endif;

	if ( have_posts() ) :
		//v1.1 add
		$_pagingTypeConst	= 'WelukaThemeOptions::ARCHIVE_PAGING_TYPE';
		$_pagingType = 1;
		if ( defined ( $_pagingTypeConst ) ) {
			if( isset($welukaThemeOptions[WelukaThemeOptions::ARCHIVE_PAGING_TYPE]) && strlen( $welukaThemeOptions[WelukaThemeOptions::ARCHIVE_PAGING_TYPE] ) > 0 ) {
				 $_pagingType = (int) $welukaThemeOptions[WelukaThemeOptions::ARCHIVE_PAGING_TYPE];
			}
		}
		if( $_pagingType === 2 ) {
			$_url = Weluka::get_instance()->get_current_url();
?> 
			<div class="weluka-jscroll" data-url="<?php echo $_url; ?>">
<?php  }
		//v1.1 addend
?>
		<article class="archive-list sp-pad clearfix">
			<?php get_template_part( 'content', 'archive' ); ?>
		</article>
<?php
		weluka_pagination();
	   	//v1.1 add
		if( $_pagingType === 2 ) : ?> 
			</div><!-- /.weluka-jscroll -->
		<?php endif;
		//v1.1 addend
	else:
		get_template_part( 'content', 'none' );
	endif;
} //404 endif
get_footer();
?>
