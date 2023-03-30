<?php
/**
 * Template Name: Домашняя страница
 * Template Post Type: page
 *
 * @package Futuramia
 * @since 1.0.0
 */
global $globalOptions, $class_header;
$class_header = 'site-header--absolute';
$fields = get_fields();

get_header();
?>

<?php echo get_template_part('template-parts/promo'); ?>
<?php echo get_template_part('template-parts/about-park'); ?>
<?php echo get_template_part('template-parts/attractions'); ?>
<?php echo get_template_part('template-parts/programs'); ?>
<?php // echo get_template_part('template-parts/calculator'); ?>
<?php echo get_template_part('template-parts/reviews'); ?>
<?php echo get_template_part('template-parts/bonus'); ?>
<?php echo get_template_part('template-parts/social'); ?>
<?php echo get_template_part('template-parts/contact'); ?>

<?php get_footer();