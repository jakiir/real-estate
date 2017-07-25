<?php
/**
 * Template Name: Add Template Page 
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
			              <h1 class="panel-title">Add Template</h1>
			            </div>
				      	
				      	<div class="row" style="padding: 6px;">			      	
					        <div class="col-xs-6">
					          <div class="panel panel-default">
					            <div class="panel-heading">
					              <h1 class="panel-title">Shared Templates</h1>
					            </div>
					            <select name="sharedTemplates" id="sharedTemplates" class="rounded multiselect1" size="10" style="background:#fff;color:#000;width:100%;">
									<option value="template-one" selected="selected">Item One</option>
									<option value="template-two">Item Two</option>
									<option value="template-three">Item Three</option>								
								</select>					            
					          </div>
					        </div>
				       
					        <div class="col-xs-6">
					          <div class="panel panel-default">
					            <div class="panel-heading">
					              <h1 class="panel-title">Your Templates</h1>
					            </div>
					            <select name="yourTemplates" id="yourTemplates" class="rounded multiselect2" size="10" style="background:#fff;color:#000;width:100%;">
									<option value="template-one" selected="selected">Item One</option>
									<option value="template-two">Item Two</option>
									<option value="template-three">Item Three</option>								
								</select>								
					          </div>
								<button type="button" class="btn btn-success add">Copy</button>
								<!--<button type="button" class="btn btn-primary addAll">Add all</button>
								<button type="button" class="btn btn-warning remove">Remove</button>
								<button type="button" class="btn btn-danger removeAll">Remove all</button>-->
								<button type="button" class="btn btn-primary editSelected">Edit</button>
					        </div>
				        </div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /BLOG -->
<script type="text/javascript">
	jQuery(function($){
		$('.add').on('click', function() {
		    var options = $('select.multiselect1 option:selected').sort().clone();
		    $('select.multiselect2').append(options);
		});
		$('.addAll').on('click', function() {
		    var options = $('select.multiselect1 option').sort().clone();
		    $('select.multiselect2').append(options);
		});
		$('.remove').on('click', function() {
		    $('select.multiselect2 option:selected').remove();
		});
		$('.removeAll').on('click', function() {
		    $('select.multiselect2').empty();
		});
		
		$('.editSelected').on('click', function() {
		    var yourTemplates = $('#yourTemplates');
			var selected_template = yourTemplates.find('option:selected'); //Selected Templates
			var selVal = selected_template.val();
			window.location.href = "<?php echo home_url('/edit-template/?item='); ?>"+selVal;
		});
		
	});
</script>
<?php get_footer();
