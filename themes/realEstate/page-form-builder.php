<?php
/**
 * Template Name: Form Builder 
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

get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/form-builder-style.css">
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.1/jquery.rateyo.min.css">
<!-- PAGE HEADER -->
<section id="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h1><?php the_title(); ?></h1>
					<span class="st-border"></span>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /PAGE HEADER -->

<!-- BLOG -->
	<section id="blog">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						
			      		<div class="panel-heading">
			              <h1 class="panel-title">Edit Template</h1>
			            </div>
						
					    <div id="stage1" class="build-wrap"></div>
						
					    <form class="render-wrap"></form>
					    <button id="edit-form">Edit Form</button>
					    <!--<div class="action-buttons">
					      <h2>Actions</h2>
					      <button id="showData" type="button">Show Data</button>
					      <button id="clearFields" type="button">Clear All Fields</button>
					      <button id="getData" type="button">Get Data</button>
					      <button id="getXML" type="button">Get XML Data</button>
					      <button id="getJSON" type="button">Get JSON Data</button>
					      <button id="getJS" type="button">Get JS Data</button>
					      <button id="setData" type="button">Set Data</button>
					      <button id="addField" type="button">Add Field</button>
					      <button id="removeField" type="button">Remove Field</button>
					      <button id="testSubmit" type="submit">Test Submit</button>
					      <button id="resetDemo" type="button">Reset Demo</button>
					    </div>-->

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /BLOG -->



<?php get_footer();
