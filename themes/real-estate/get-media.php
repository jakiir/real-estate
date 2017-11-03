<?php
/**
 * Template Name: Get Media
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header('form-builder'); ?>

<?php 
	$author_id = '';
	if (is_user_logged_in()) $author_id = get_current_user_id(); 
	$args = array(
		'post_type' => 'attachment',
		'post_status' => 'inheret',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'author' => $author_id    
	);
	$the_query = get_posts( $args );
	if ( !empty($the_query) ):
		echo json_encode($the_query);				
    endif;
	//print_r($the_query);
?>

<?php //get_footer(); ?>
