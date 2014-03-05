<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
<title><?php wp_title(''); ?></title>
<?php woo_meta(); ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />
<?php wp_head(); ?>
<?php woo_head(); ?>
<!--[if IE]>
<link rel="stylesheet" href="http://blogs.jeffersonhospital.org/atjeff/wp-content/themes/canvas-5.2.4/custom-ie.css" type="text/css" />
<![endif]-->
</head>
<body <?php body_class(); ?>>
<?php woo_top(); ?>
	<div id="header-links">
		<a href="http://www.jeffersonhospital.org"><span>Patient Care &amp; </span>Clinical Services</a> <a href="http://www.jefferson.edu">Education &amp; Research</a>
	</div>
<div id="wrapper">

	<div id="inner-wrapper">

	<?php woo_header_before(); ?>

	<header id="header" class="col-full">

		<?php woo_header_inside(); ?>

	</header>
	<?php woo_header_after(); ?>