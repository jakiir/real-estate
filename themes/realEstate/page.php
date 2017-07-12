<?php
/**
 * The template for displaying all pages
 *
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
				<div class="col-md-9">
					<div class="single-blog">
						<?php while ( have_posts() ) : the_post(); ?>
						<article>
							<div class="post-thumb"><img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/blog/01.jpg" alt=""></div>
							<h4 class="post-title"><?php the_title(); ?></h4>
							<div class="post-meta text-uppercase">
								<span>Appril 3, 2014</span>
								<span>In <a href="">Design</a></span>
								<span>By <a href="">Admin</a></span>
							</div>
							<div class="post-article"><?php the_content(); ?></div>
							<a href="" class="btn btn-readmore">Read More</a>
						<?php endwhile; // End of the loop. ?>
						</article>
					</div>
					<hr>
				</div>
				<div class="col-md-3">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>
	<!-- /BLOG -->

<?php get_footer();
