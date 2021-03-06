<?php
/**
 * Post Content Template
 *
 * This template is the default page content template. It is used to display the content of the
 * `single.php` template file, contextually, as well as in archive lists or search results.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */
 global $woo_options;
 
 $title_before = '<h1 class="title">';
 $title_after = '</h1>';
 
 if ( ! is_single() ) {
 
 	$title_before = '<h2 class="title">';
 	$title_after = '</h2>';
 
	$title_before = $title_before . '<a href="' . get_permalink( get_the_ID() ) . '" rel="bookmark" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
	$title_after = '</a>' . $title_after;
 
 }
 
 $page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );
 
 woo_post_before();
?>
<article <?php post_class(); ?>>
<div class="post-thumb">
<?php
	woo_post_inside_before();	
	if ( $woo_options['woo_post_content'] != 'content' AND !is_singular() )
		woo_image( 'width='.$woo_options['woo_thumb_w'].'&height='.$woo_options['woo_thumb_h'].'&class=thumbnail '.$woo_options['woo_thumb_align'] );
?>
</div>
<div class="post-content">
	<header>
		<?php the_title( $title_before, $title_after ); ?>
	</header>
<?php
	$post_info = '<span>' . __( 'Posted on', 'woothemes' ) . '</span> [post_date] ' . ' [post_edit]';
	printf( '<div class="post-meta">%s</div>' . "\n", apply_filters( 'woo_filter_post_meta', $post_info ) );	
?>
	<section class="entry">
	    <?php
	    	 the_excerpt(); 
	    ?>
	</section><!-- /.entry -->
	<div class="fix"></div>
<?php
	woo_post_inside_after();
?>
</div>
<div class="fix"></div>
</article><!-- /.post -->
<?php
	woo_post_after();
	$comm = $woo_options[ 'woo_comments' ];
	if ( ( $comm == 'post' || $comm == 'both' ) && is_single() ) { comments_template(); }
?>