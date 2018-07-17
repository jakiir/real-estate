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
	if(!empty($user) && $user->roles[0] != 'administrator' && !empty($user) && $user->roles[0] != 'company_admin'){
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
			<h2 class="page-title-body">Management Company</h2>
			<?php
			//$company_users = get_users( 'orderby=nicename&role=company_admin' );
			
			$args1 = array(
			 'role' => 'company_admin',
			 'orderby' => 'user_nicename',
			 'order' => 'ASC'
			);
			 $company_users = get_users($args1);
			?>
				<div class="panel-body table-responsive">

					<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="devTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Company Name</th>
								<th>Email Address</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if(!empty($company_users)) {
						$inc=1;
						foreach($company_users as $company_user){
						?>
							<tr>
								<td><?php echo $inc; ?></td>
								<td><?php echo esc_html( $company_user->display_name ); ?></td>
								<td><?php echo esc_html( $company_user->user_email ); ?></td>
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
		$('#devTable').DataTable({
			"iDisplayLength": 10
		});
	});
</script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/main.js"></script>
<?php //get_footer();
