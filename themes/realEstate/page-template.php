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
				      	<?php
							global $wpdb;
							$user_id = get_current_user_id();							
							$table_template = $wpdb->prefix . 'template';
							$get_share_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE user_id=$user_id AND shared_template=1", OBJECT );						
						?>
				      	<div class="row" style="padding: 6px;">			      	
					        <div class="col-xs-6">
					          <div class="panel panel-default">
					            <div class="panel-heading">
					              <h1 class="panel-title">Shared Templates</h1>
					            </div>
					            <select name="sharedTemplates" id="sharedTemplates" class="rounded multiselect1" size="10" style="background:#fff;color:#000;width:100%;">
									<?php
										if(!empty($get_share_templages)){
										foreach($get_share_templages as $template){
									?>
										<option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
										<?php } } ?>									
								</select>					            
					          </div>
							  
							  <a data-toggle="modal" data-target="#addTempleteModal" href="javascript:void(0)" class="btn btn-success" style="color:#fff;">
									<i class="fa fa-btn fa-paper-plane"></i>Add
							   </a>													
								<div class="modal fade" id="addTempleteModal" tabindex="-1" role="dialog" aria-labelledby="addTempleteModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="addTempleteModalLabel">Add Template</h4>
											</div>
											<div class="modal-body">
												<form class="submit_all_std_form">
													<div class="form-group">
														<label for="recipient-name" class="control-label">Template Name:</label>
														<input type="text" class="form-control" id="template-name" placeholder="Item one" value="">
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<a href="javascript:void(0)" class="btn btn-success add_templete" style="color:#fff;">
													<i class="fa fa-btn fa-paper-plane"></i>Add Template
												</a>
											</div>
										</div>
									</div>
								</div>							  
					        </div>
				       
					        <div class="col-xs-6">
					          <div class="panel panel-default">
					            <div class="panel-heading">
					              <h1 class="panel-title">Your Templates</h1>
					            </div>
								<?php 
									$get_your_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE user_id=$user_id AND your_template=1 ORDER BY created_time ASC", OBJECT );
								?>
					            <select name="yourTemplates" id="yourTemplates" class="rounded multiselect2" size="10" style="background:#fff;color:#000;width:100%;">
									<?php
										if(!empty($get_your_templages)){
										foreach($get_your_templages as $template){
									?>
										<option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
										<?php } } ?>							
								</select>								
					          </div>								
								<button type="button" class="btn btn-success copy">Copy</button>
								<button type="button" class="btn btn-warning remove">Remove</button>
								<!--<button type="button" class="btn btn-primary addAll">Add all</button>								
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
		$('.add_templete').on('click', function(){
			var template_name = $('#template-name').val();
			if (template_name == null || template_name == "") {   
				$('#template-name-error').remove();
				$('#template-name').after('<label id="template-name-error" class="error" style="color:red;" for="template-name">This field is required.</label>');
				return false;
			}
			
			var selecte_share = $('select.multiselect1');
			var form_data = new FormData(); 			
			form_data.append('action', 'addTemplateItem');
			form_data.append('template_name', template_name);			
			
			$.ajax({
			  url: '<?php echo admin_url('admin-ajax.php'); ?>',
			  type: 'post',
			  contentType: false,
			  processData: false,
			  data: form_data,          
			  success: function (data) {
				var parsedJson = $.parseJSON(data);				
				if(parsedJson.success == true){
					var options_item = '<option value="'+parsedJson.template_id+'">'+template_name+'</option>';
					selecte_share.append(options_item);
					$('#template-name-error').remove();
					$('#template-name-success').remove();
					$('#template-name').after('<label id="template-name-success" class="success" style="color:green;" for="template-name">'+parsedJson.mess+'</label>');
					$('#addTempleteModal').modal('hide');
				} else {
					$('#template-name-error').remove();
					$('#template-name-success').remove();
					$('#template-name').after('<label id="template-name-error" class="error" style="color:red;" for="template-name">'+parsedJson.mess+'</label>');
				}
			  },
			  error: function (errorThrown) {
				alert(errorThrown);
			  }
			});
			
		});
		$('.copy').on('click', function() {			
			var selected_item = $('select.multiselect1 option:selected');
			if(!selected_item.length){
				alert('Please select share template item.');
				return false;
			}
			var form_data = new FormData();    
			var template_id = selected_item.val();			
			form_data.append('action', 'copyTemplate');
			form_data.append('template_id', template_id);			
			
			$.ajax({
			  url: '<?php echo admin_url('admin-ajax.php'); ?>',
			  type: 'post',
			  contentType: false,
			  processData: false,
			  data: form_data,          
			  success: function (data) {
				var parsedJson = $.parseJSON(data);				
				if(parsedJson.success == true){
					var options = selected_item.sort().clone();
					$('select.multiselect2').append(options);
				} else {
					alert(parsedJson.mess);
				}
			  },
			  error: function (errorThrown) {
				alert(errorThrown);
			  }
			});
			
			
		});
		$('.addAll').on('click', function() {
		    var options = $('select.multiselect1 option').sort().clone();
		    $('select.multiselect2').append(options);
		});
		$('.remove').on('click', function() {
			
			var selected_item = $('select.multiselect2 option:selected');
			if(!selected_item.length){
				alert('Please select your template item.');
				return false;
			}
			var form_data = new FormData();    
			var template_id = selected_item.val();
			console.log(template_id);
			form_data.append('action', 'removeTemplate');
			form_data.append('template_id', template_id);			
			
			$.ajax({
			  url: '<?php echo admin_url('admin-ajax.php'); ?>',
			  type: 'post',
			  contentType: false,
			  processData: false,
			  data: form_data,          
			  success: function (data) {
				var parsedJson = $.parseJSON(data);				
				if(parsedJson.success == true){
					selected_item.remove();
				} else {
					alert(parsedJson.mess);
				}
			  },
			  error: function (errorThrown) {
				alert(errorThrown);
			  }
			});
			
		    
		});
		$('.removeAll').on('click', function() {
		    $('select.multiselect2').empty();
		});
		
		$('.editSelected').on('click', function() {
		    var yourTemplates = $('#yourTemplates');
			var selected_template = yourTemplates.find('option:selected'); //Selected Templates			
			var selVal = selected_template.val();
			if(!selected_template.length){
				alert('Please select at list one item.');
				return false;
			}
			window.location.href = "<?php echo home_url('/edit-template/?item='); ?>"+selVal;
		});
		
	});
</script>
<?php get_footer();
