<?php
get_header(); ?>
<?php 
	if (!is_user_logged_in()) {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
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
							<td><input type="checkbox" name="report_box_<?php echo $inspection->id; ?>"/></td>
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
						<button type="button" class="btn btn-primary">Print</button>
					</div>
					<label class="col-md-2 control-label"></label>
					<div class="col-md-4">					
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shareFormView"><i class="fas fa-share"></i> Share</button>
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
			<p><input class="form-control" type="email" name="dateTo" id="dateTo" value=""></p>
			<p><button type="button" class="btn btn-primary"><i class="fas fa-share"></i> Share</button></p>
		</form>
      </div>
    </div>

  </div>
</div>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/dataTables.bootstrap.min.css">	
<script type="text/javascript">
$(document).ready(function() {
	$("#shareForm").validate();
    $('#devTable').DataTable({
		"iDisplayLength": 5
	});
	$('.datepicker').datetimepicker({
		viewMode: 'years',
		format: 'MM/DD/YYYY'
	});
} );
</script>
<?php get_footer();
