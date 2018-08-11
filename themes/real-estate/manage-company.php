<?php
/**
 * Template Name: Management Company
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
<?php 
	if (!is_user_logged_in()) {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
	$user = wp_get_current_user();
	if((!empty($user) && $user->roles[0] != 'administrator') && (!empty($user) && $user->roles[0] != 'company_admin')){
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/moment.min.js"></script>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery-ui-1.10.0.custom.min.css" />
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-ui.js"></script>
<!-- BLOG -->

<article class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box perform-inspection-box">
			<h2 class="page-title-body" style="display:block;">Company Management &nbsp; &nbsp; <a href="<?php echo home_url('/company-registration/'); ?>" class="btn-taptap"><i class="fa fa-plus-square"></i> Add</a></h2>
			
				<div class="panel-body table-responsive">
					<h4>Company Admin List</h4>
					<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="companyManage">
						<thead>
							<tr>
								<th>#</th>
								<th>Company Name</th>
								<th>Email Address</th>
								<th>Parent Users</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
											
						if(!empty($user) && $user->roles[0] == 'company_admin'){
							$company_args = array(
							 'role' => 'company_admin',
							 'orderby' => 'user_nicename',
							 'order' => 'ASC',
							 'meta_query' => array(
								array(
									'key' => 'parrent_user',
									'value' => $user->ID,
									'compare' => 'EXISTS',
								),
							  )
							);
						} else {
							$company_args = array(
								 'role' => 'company_admin',
								 'orderby' => 'user_nicename',
								 'order' => 'ASC'
							);
						}
						$company_users = get_users($company_args);
						
						if(!empty($company_users)) {
						$inc=1;
						foreach($company_users as $company_user){
							$user_id = $company_user->ID;
							$parrent_user_id = get_the_author_meta( 'parrent_user', $user_id );	
							$company_name = get_user_meta( $user_id, 'company_name', true );
							if(empty($company_name)){
								$company_name = get_user_meta( $parrent_user_id, 'company_name', true );
							}
						?>
							<tr>
								<td><?php echo $inc; ?></td>
								<td><?php echo esc_html( $company_name ); ?></td>
								<td><?php echo esc_html( $company_user->user_email ); ?></td>
								<td><?php if(!empty($parrent_user_id)){ 
								$parrent_user=get_userdata($parrent_user_id);
								echo esc_html( $parrent_user->display_name ) . ' [' . esc_html( $parrent_user->user_login ) . ']'; } else { echo '--'; } ?></td>
								<td><a href="?company-trash=<?php echo safe_b64encode($user_id); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a></td>
							</tr>
						<?php $inc++; }} ?>
						</tbody>
					</table>
					<h4>Inspector List</h4>
					<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="inspectionManage">
						<thead>
							<tr>
								<th>#</th>
								<th>Company Name</th>
								<th>Email Address</th>
								<th>Parent Users</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$ins_args = array(
								 'role' => 'inspector',
								 'orderby' => 'user_nicename',
								 'order' => 'ASC' 
							);
							if(!empty($user) && $user->roles[0] == 'company_admin'){
								$ins_args = array(
									 'role' => 'inspector',
									 'orderby' => 'user_nicename',
									 'order' => 'ASC',
									 'meta_query' => array(
										array(
											'key' => 'parrent_user',
											'value' => $user->ID,
											'compare' => 'EXISTS',
										),
									  ) 
								);
							}
						$inspection_users = get_users($ins_args);						
						if(!empty($inspection_users)) {
						$inc=1;
						foreach($inspection_users as $inspection_user){
							$user_id = $inspection_user->ID;
							$parrent_user_id = get_the_author_meta( 'parrent_user', $user_id );	
							$company_name = get_user_meta( $user_id, 'company_name', true );
							if(empty($company_name)){
								$company_name = get_user_meta( $parrent_user_id, 'company_name', true );
							}
						?>
							<tr>
								<td><?php echo $inc; ?></td>
								<td><?php echo esc_html( $company_name ); ?></td>
								<td><?php echo esc_html( $inspection_user->user_email ); ?></td>
								<td><?php if(!empty($parrent_user_id)){
								$parrent_user=get_userdata($parrent_user_id);
								echo esc_html( $parrent_user->display_name ) . ' [' . esc_html( $parrent_user->user_login ) . ']'; } else { echo '--'; } ?></td>
								<td><a href="?inspector-trash=<?php echo safe_b64encode($user_id); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a></td>
							</tr>
						<?php $inc++; }} ?>
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		$('#companyManage').DataTable({
			"iDisplayLength": 10
		});
		
		$('#inspectionManage').DataTable({
			"iDisplayLength": 10
		});
	});
</script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/main.js"></script>
<?php //get_footer();
