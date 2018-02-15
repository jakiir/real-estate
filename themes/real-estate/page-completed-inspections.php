<?php
get_header(); ?>
<?php 
	if (!is_user_logged_in()) {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
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
			$get_inspection = $wpdb->get_results( "SELECT * FROM $table_inspection WHERE user_id=$user_id", OBJECT );
		?>
		<!--<div class="panel-body">
			<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
		</div>-->
		<table class="table table-hover" id="dev-table">
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
						<td><?php echo $inc; ?></td>
						<td><a target="_blank" href="<?php echo home_url('/form-viewer/?item='.$inspection->template_id.'&report='.$inspection->id); ?>" title=""><?php echo $inspection->report_identification; ?></a></td>
						<td><?php echo $inspection->prepared_for; ?></td>
						<td><?php echo $inspection->inpection_date; ?></td>
					</tr>
				<?php $inc++; }} ?>
			</tbody>
		</table>
	</div>
</section>
	<!-- /BLOG -->
<script type="text/javascript">
</script>
<?php get_footer();
