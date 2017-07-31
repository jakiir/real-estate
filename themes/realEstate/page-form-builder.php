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
<style>
	.form-builder .btn-group{display:none;}
	label.error{color:red;}
</style>
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
			              <h1 class="panel-title">Create Form</h1>
			            </div>
						<div class="panel-body">
							<div class="form-group">
								<div id="build-wrap" class="build-wrap1"></div>							
								<form class="render-wrap">
									<input type="hidden" name="template_id" id="template_id" value="<?php echo (isset($_GET['item']) ? $_GET['item'] : ''); ?>">
								</form>
								<button id="edit-form">Edit Form</button>	
							</div>							
							<div class="action-buttons form-group">
								<button id="getJSON1" type="button" class="btn btn-primary">Save</button>
								<button id="clearFields" type="button" class="btn btn-danger">Clear All Fields</button>
								
							  <!--<button id="showData" type="button">Show Data</button>
							  <button id="clearFields" type="button">Clear All Fields</button>
							  <button id="getData" type="button">Get Data</button>
							  <button id="getXML" type="button">Get XML Data</button>
							  <button id="getJSON2" type="button">Get JSON Data</button>
							  <button id="getJS" type="button">Get JS Data</button>
							  <button id="setData" type="button">Set Data</button>
							  <button id="addField" type="button">Add Field</button>
							  <button id="removeField" type="button">Remove Field</button>
							  <button id="testSubmit" type="submit">Test Submit</button>
							  <button id="resetDemo" type="button">Reset Demo</button>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /BLOG -->



<?php get_footer(); ?>
<?php 
 global $wpdb;
 $template_detail = $wpdb->prefix . 'template_detail';
 $template_id = !empty($_GET['item']) ? $_GET['item'] : '';
 $get_templages = $wpdb->get_results( "SELECT * FROM $template_detail WHERE template_id=$template_id", OBJECT );
?>
<script type="text/javascript">
	//jQuery(function($) {
	  var fbTemplate = document.getElementById('build-wrap');
	
		options = {
		  formData: '<?php echo $get_templages[0]->field_text_html; ?>',
		  controlPosition: 'left',
		  disableFields: ['autocomplete', 'hidden'],
		  controlOrder: [
			'text',
			'paragraph',
			'checkbox-group',
			'file',
			'textarea',
			'instruction-text',
			'group-box',
			'standard-report-fields',
			'page-break',
		  ],
		   inputSets: [
			
				{
				  label: 'Instruction Text',
				  name: 'instruction-text',
				  className: 'icon-textarea',
				  fields: [
				  {
					type: 'header',
					subtype: 'h2',
					label: 'Instructions',
					className: 'header'
				  },
				  {
					type: 'paragraph',
					label: 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.',
				  }
				]
				},
				{
				  label: 'Group Box',
				  name: 'group-box',				  
				  fields: [
						{
						  type: 'checkbox-group',
						  label: 'Group Box',						  
						  values: [{
							label: 'not selected',
							value: 'not-selected',
							selected: false
						  }, {
							label: 'selected',
							value: 'selected',
							selected: true
						  }, {
							label: 'indeterminate',
							value: 'indeterminate',
							selected: false
						  }, {
							label: 'disabled',
							value: 'disabled',
							selected: false
						  }]
						}
					]
				},
			  {
				label: 'Standard Report Fields',
				name: 'standard-report-fields', // optional - one will be generated from the label if name not supplied
				showHeader: true, // optional - Use the label as the header for this set of inputs
				fields: [
						{
						  type: 'text',
						  label: 'Report Name',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Prepared For',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Prepared By',
						  className: 'form-control'
						},
						{
						  type: 'date',
						  label: 'Date',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Company',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Business License',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'City',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'State',
						  className: 'form-control'
						},
						{
						  type: 'number',
						  label: 'Zip',
						  className: 'form-control'
						}
					  ]
				  },
				 {
				  label: 'Page Break',
				  name: 'page-break',
				  fields: [
				  {
					type: 'br',					
					label: 'Page Break',
					className: 'page-break'
				  },
				  {
					type: 'paragraph',
					label: 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.',
				  }
				]
				},
			  ]
		};
		
		var formBuilder = $(fbTemplate).formBuilder(options);
	 
	document.getElementById('getJSON1').addEventListener('click', function() {
		var form_data = new FormData();
		var template_id = jQuery('#template_id').val();
		var formJsonData = JSON.stringify(JSON.parse(formBuilder.actions.getData('json', true)));
		form_data.append('action', 'saveDynamicForm');
		form_data.append('template_id', template_id);
		form_data.append('formJsonData', formJsonData);
		
		$.ajax({					
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,					
			success: function (data) {
			  var parsedJson = $.parseJSON(data);
			  console.log(parsedJson);
			  if(parsedJson.success == true){
				  alert(parsedJson.mess);
				  //window.location.href = "<?php echo home_url('/form-builder/?item='); ?>"+template_id;
			  } else {
				alert(parsedJson.mess);
			  }
			},
			error: function (errorThrown) {
				alert(errorThrown);
			}
		});
		
		//console.log(JSON.stringify(JSON.parse(formBuilder.actions.getData('json', true))));
	});
	document.getElementById('clearFields').onclick = function() {
		formBuilder.actions.clearFields();
	};
	  
	/*document.getElementById('getXML').addEventListener('click', function() {
		alert(formBuilder.actions.getData('xml'));
	});
	
	document.getElementById('getJS').addEventListener('click', function() {
		alert('check console');
		console.log(formBuilder.actions.getData());
	});*/

</script>
