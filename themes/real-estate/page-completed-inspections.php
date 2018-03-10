<?php
get_header(); ?>
<?php 
	if (!is_user_logged_in()) {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/dataTables.bootstrap.min.js"></script>
<style>
	#profilePicRemover{
		position: absolute;
		top: 2px;
		right: 22px;
	}
	label.error{color:red;}
</style>
<!-- BLOG -->
<section id="blog" class="container">
	<div class="panel panel-primary">						
		<div class="panel-heading">
		  <h1 class="panel-title"><?php the_title(); ?></h1>
		</div>
		<?php
			global $wpdb;
			$user_id = get_current_user_id();
			$table_inspection = $wpdb->prefix . 'inspection';
			$inspectionReportDetail = $wpdb->prefix . 'inspectionreportdetail';
			$user = wp_get_current_user();
			if(!empty($user) && $user->roles[0] == 'administrator'){
				$get_inspection = $wpdb->get_results( "SELECT ins.id,ins.template_id,ins.report_identification,ins.prepared_for,ins.inpection_date,ird.id as ird_id FROM $table_inspection as ins JOIN $inspectionReportDetail as ird ON ird.inspectionId=ins.id", OBJECT );
			} else {
				$get_inspection = $wpdb->get_results( "SELECT ins.id,ins.template_id,ins.report_identification,ins.prepared_for,ins.inpection_date,ird.id as ird_id FROM $table_inspection as ins JOIN $inspectionReportDetail as ird ON ird.inspectionId=ins.id WHERE ins.user_id=$user_id", OBJECT );
			}
		?>
		<div class="panel-body">
			<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="devTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Report Id</th>
						<th>Prepared For</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if(!empty($get_inspection)) {
						$inc=1;
						foreach($get_inspection as $inspection){
					?>
						<tr>
							<td><input type="checkbox" onClick="eachSelect(this)" name="report_box[]" data-report="<?php echo $inspection->id; ?>" data-saved="<?php echo $inspection->ird_id; ?>" value="<?php echo $inspection->template_id; ?>"/></td>
							<td><a target="_blank" href="<?php echo home_url('/form-viewer/?item='.$inspection->template_id.'&report='.$inspection->id.'&saved='.$inspection->ird_id); ?>" title=""><?php echo $inspection->report_identification; ?></a></td>
							<td><?php echo $inspection->prepared_for; ?></td>
							<td><?php echo $inspection->inpection_date; ?></td>
						</tr>
					<?php $inc++; }} ?>
				</tbody>
			</table>
			<div class="table- table-hover-">
				<div class="form-group">
					<label class="col-md-2 control-label" for="date_range">
						Date Range : 
					</label>
					<div class="col-md-4">					
						<input class="form-control datepicker" type="text" name="date_range" id="date_range" value="">
					</div>
					<label class="col-md-2 control-label" for="date_range">
						To : 
					</label>
					<div class="col-md-4">					
						<input class="form-control datepicker" type="text" name="dateTo" id="dateTo" value="">
					</div>
				</div>
				<br/>
				<br/>
				<div class="form-group">
					<label class="col-md-2 control-label"></label>
					<div class="col-md-4">						
						<button type="button" class="btn btn-primary checkBoxSlected" disabled="disabled">Print</button>
					</div>
					<label class="col-md-2 control-label"></label>
					<div class="col-md-4">					
						<button type="button" class="btn btn-primary checkBoxSlected" data-toggle="modal" data-target="#shareFormView" disabled="disabled"><i class="fa fa-share"></i> Share</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	<!-- /BLOG -->
	
	<!-- Modal -->
<div id="shareFormView" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Share form</h4>
      </div>
      <div class="modal-body">
		<form action="#" id="shareForm">
			<p><input class="form-control required" type="email" name="agentEmailAddress" id="agentEmailAddress" value=""></p>
			<p class="msg_show"></p>
			<p><button type="submit" class="btn btn-primary checkBoxSlected" disabled="disabled"><i class="fa fa-share"></i> Share</button></p>
		</form>
      </div>
    </div>

  </div>
</div>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/dataTables.bootstrap.min.css">	
<script type="text/javascript">
$(document).ready(function() {
    $('#devTable').DataTable({
		"iDisplayLength": 5
	});
	$('.datepicker').datetimepicker({
		viewMode: 'years',
		format: 'MM/DD/YYYY'
	});
	$("#shareForm").validate();
	$(document).on("click", ":submit", function(e) {
			$('.msg_show').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
			var formValid = $("#shareForm").valid();
			var thisForm = $(this);
			
			var checkboxesaa = document.querySelectorAll('input[name="report_box[]"]:checked');

            var getSelected = [];
			var getSelectedReport = [];
			var getSelectedSaved = [];
            for(var i=0, n=checkboxesaa.length;i<n;i++) {
                getSelected.push(checkboxesaa[i].value);
				getSelectedReport.push(checkboxesaa[i].getAttribute("data-report"));
				getSelectedSaved.push(checkboxesaa[i].getAttribute("data-saved"));
            }
            if(getSelected.length == 0){
				$('.msg_show').html('<span style="color:red">Please, select minimum 1 template!</span>');
                return false;
            }
			
			if (formValid === true) {
				var agentEmailAddress = jQuery('#agentEmailAddress').val();
				
				var form_data = new FormData();
				
				form_data.append('action', 'send_agent_email');
				form_data.append('getSelected', getSelected);				
				form_data.append('getSelectedReport', getSelectedReport);
				form_data.append('getSelectedSaved', getSelectedSaved);
				form_data.append('agentEmailAddress', agentEmailAddress);
				$.ajax({					
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					contentType: false,
					processData: false,
					data : form_data,					
					success: function (data) {
					  var parsedJson = $.parseJSON(data);
						console.log(parsedJson);
					  if(parsedJson.success == true){						  
						  $('.msg_show').html('');
						  $('.msg_show').html('<span style="color:green">'+parsedJson.mess+'</span>');
						  location.reload();
					  } else {
						  $('.msg_show').html('');
						 $('.msg_show').html('<span style="color:red">'+parsedJson.mess+'</span>');
					  }
					},
					error: function (errorThrown) {
						$('.msg_show').html('');
						$('.msg_show').html('<span style="color:red">'+errorThrown+'</span>');						
					}
				});
			}			
			return false;
			
		});
	
});

function eachSelect(source){
	var checkedboxesCount = document.querySelectorAll('input[name="report_box[]"]:checked').length;
	if(checkedboxesCount > 0){
		$('.checkBoxSlected').prop('disabled',false);
	} else {
		$('.checkBoxSlected').prop('disabled',true);
	}
}

</script>
<?php get_footer();
