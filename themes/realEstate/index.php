<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<!-- SLIDER -->
	<section id="slider">
		<div id="home-carousel" class="carousel slide" data-ride="carousel">			
			<div class="carousel-inner">
				<div class="item active" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/slider/01.jpg)">
					<div class="carousel-caption container">
						<div class="row">
							<div class="col-sm-7">
								<h1>You are entire </h1>
								<h2>creative world</h2>
								<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor. Aenean sollicitudin, lorem quis bibendum auctor.</p>
							</div>
						</div>
					</div>					
				</div>
				<div class="item" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/slider/02.jpg)">
					<div class="carousel-caption container">
						<div class="row">
							<div class="col-sm-7">
								<h1>You are entire </h1>
								<h2>creative world</h2>
								<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor. Aenean sollicitudin, lorem quis bibendum auctor.</p>
							</div>
						</div>
					</div>					
				</div>
				<div class="item" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/slider/03.jpg)">
					<div class="carousel-caption container">
						<div class="row">
							<div class="col-sm-7">
								<h1>You are entire </h1>
								<h2>creative world</h2>
								<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor. Aenean sollicitudin, lorem quis bibendum auctor.</p>
							</div>
						</div>
					</div>					
				</div>
				<div class="item" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/slider/04.jpg)">
					<div class="carousel-caption container">
						<div class="row">
							<div class="col-sm-7">
								<h1>You are entire </h1>
								<h2>creative world</h2>
								<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor. Aenean sollicitudin, lorem quis bibendum auctor.</p>
							</div>
						</div>
					</div>					
				</div>
				<a class="home-carousel-left" href="#home-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
				<a class="home-carousel-right" href="#home-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
			</div>		
		</div> <!--/#home-carousel--> 
    </section>
	<!-- /SLIDER -->

	
	<!-- SERVICES -->
	<section id="services">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Services</h1>
						<span class="st-border"></span>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-desktop"></i> Web Design</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta libero autem, magni veritatis, optio dolor.</p>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-cogs"></i> Web Developement</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta libero autem, magni veritatis, optio dolor.</p>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-code"></i> Custom Development</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta libero autem, magni veritatis, optio dolor.</p>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-dashboard"></i> Super Fast Web</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta libero autem, magni veritatis, optio dolor.</p>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-life-ring"></i> Friendly Support</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta libero autem, magni veritatis, optio dolor.</p>
				</div>

				<div class="col-md-4 col-sm-6 st-service">
					<h2><i class="fa fa-weixin"></i> Live Support</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta libero autem, magni veritatis, optio dolor.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- /SERVICES -->


	<!-- OUR WORKS -->
	<section id="our-works">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Out Works</h1>
						<span class="st-border"></span>
					</div>
				</div>

				<div class="portfolio-wrapper" >
					<div class="col-md-12">
						<ul class="filter">  			
							<li><a class="active" href="#" data-filter="*">All</a></li>	
							<li><a href="#" data-filter=".wordpress">WordPress</a></li>
							<li><a href="#" data-filter=".html">HTML</a></li>
							<li><a href="#" data-filter=".graphic">graphic</a></li>
							<li><a href="#" data-filter=".php">PHP</a></li>
							<li><a href="#" data-filter=".bootstrap">bootstrap</a></li>
						</ul><!--/#portfolio-filter-->
					</div>
					
					<div class="portfolio-items">
						
						<div class="col-md-4 col-sm-6 work-grid wordpress graphic">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-1.jpg" alt="">
								<div class="portfolio-overlay">
									<a href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-1.jpg"><i class="fa fa-camera-retro"></i></a>
									<h5>Web Development</h5>
									<p>Design, Develop</p>
								</div>
							</div>	
						</div>
						
						<div class="col-md-4 col-sm-6 work-grid html php bootstrap">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-2.jpg" alt="">
								<div class="portfolio-overlay">
									<a href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-2.jpg"><i class="fa fa-camera-retro"></i></a>
									<h5>Web Development</h5>
									<p>Design, Develop</p>
								</div>
							</div>	
						</div>
						
						<div class="col-md-4 col-sm-6 work-grid wordpress graphic">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-3.jpg" alt="">
								<div class="portfolio-overlay">
									<a href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-3.jpg"><i class="fa fa-camera-retro"></i></a>
									<h5>Web Development</h5>
									<p>Design, Develop</p>
								</div>
							</div>	
						</div>
						
						<div class="col-md-4 col-sm-6 work-grid html php bootstrap">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-4.jpg" alt="">
								<div class="portfolio-overlay">
									<a href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-4.jpg"><i class="fa fa-camera-retro"></i></a>
									<h5>Web Development</h5>
									<p>Design, Develop</p>
								</div>
							</div>	
						</div>
						
						<div class="col-md-4 col-sm-6 work-grid wordpress graphic php">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-5.jpg" alt="">
								<div class="portfolio-overlay">
									<a href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-5.jpg"><i class="fa fa-camera-retro"></i></a>
									<h5>Web Development</h5>
									<p>Design, Develop</p>
								</div>
							</div>	
						</div>
						
						<div class="col-md-4 col-sm-6 work-grid html bootstrap graphic">
							<div class="portfolio-content">
								<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-6.jpg" alt="">
								<div class="portfolio-overlay">
									<a href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/works/portfolio-6.jpg"><i class="fa fa-camera-retro"></i></a>
									<h5>Web Development</h5>
									<p>Design, Develop</p>
								</div>
							</div>	
						</div>
						
					</div>				
				</div>

			</div>
		</div>
	</section>
	<!-- /OUR WORKS -->

	
	<!-- PRICING -->
	<section id="pricing">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Pricing</h1>
						<span class="st-border"></span>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="st-pricing text-center">
						<h5>Basic</h5>
						<h3>$39</h3>
						<div class="st-border"></div>
						<ul>
							<li>Free Download</li>
							<li>1000+ Softwear</li>
							<li>Full Access</li>
							<li>Free Update</li>
							<li>Live Support</li>
						</ul>
						<a href="" class="btn btn-send">Sign Up</a>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="st-pricing text-center">
						<h5>Silver</h5>
						<h3>$89</h3>
						<div class="st-border"></div>
						<ul>
							<li>Free Download</li>
							<li>1000+ Softwear</li>
							<li>Full Access</li>
							<li>Free Update</li>
							<li>Live Support</li>
						</ul>
						<a href="" class="btn btn-send">Sign Up</a>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="st-pricing text-center">
						<h5>Gold</h5>
						<h3>$209</h3>
						<div class="st-border"></div>
						<ul>
							<li>Free Download</li>
							<li>1000+ Softwear</li>
							<li>Full Access</li>
							<li>Free Update</li>
							<li>Live Support</li>
						</ul>
						<a href="" class="btn btn-send">Sign Up</a>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!-- /PRICING -->


	<!-- OUR TEAM -->
	<section id="our-team">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Our Team</h1>
						<span class="st-border"></span>
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/members/team1.jpg" alt="">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-google-plus"></i></a>
								<a href=""><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Khalil Uddin</h4>
							<span>Designer</span>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/members/team2.jpg" alt="">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-google-plus"></i></a>
								<a href=""><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Rubel Miah</h4>
							<span>Lead Developer</span>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/members/team1.jpg" alt="">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-google-plus"></i></a>
								<a href=""><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Shamim Shohag</h4>
							<span>Developer</span>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/members/team2.jpg" alt="">
							<div class="member-social">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-google-plus"></i></a>
								<a href=""><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Zubayer Rahman</h4>
							<span>Marketer</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /OUR TEAM -->


	<!-- ABOUT US -->
	<section id="about-us">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<div class="about-us text-center">
						<h4>Morem ipsum dolor sit amet.</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum aliquid obcaecati deleniti minus quisquam quis magnam reprehenderit quaerat molestias rerum, excepturi autem fugiat corporis quidem a ipsum quos beatae! Ut!</p>
						<a href="" class="btn btn-send">View More</a>
					</div>
				</div>
				<div class="col-sm-6 our-office">
					<div id="office-carousel" class="carousel slide" data-ride="carousel">			
						<div class="carousel-inner">
							<div class="item active">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/office/04.jpg" alt="">
							</div>
							<div class="item">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/office/02.jpg" alt="">			
							</div>
							<div class="item">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/office/03.jpg" alt="">			
							</div>
							
							<a class="office-carousel-left" href="#office-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
							<a class="office-carousel-right" href="#office-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
						</div>		
					</div> <!--/#office-carousel--> 
				</div>
			</div>
		</div>
	</section>
	<!-- /ABOUT US -->
	
	<!-- TESTIMONIAL -->
	<section id="testimonial">
		<div class="container">
			<div class="row">
				<div class="overlay"></div>
				<div class="col-md-8 col-md-offset-2 col-sm-12">
					<div class="st-testimonials">

						<div class="item active text-center">
							<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dolore nesciunt natus ullam possimus quas obcaecati suscipit voluptate facilis cum"</p>
							<div class="st-border"></div>
							<div class="client-info">
								<h5>Tom Roof</h5>
								<span>CEO of Domain.com</span>
							</div>
						</div>

						<div class="item text-center">
							<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dolore nesciunt natus ullam possimus quas obcaecati suscipit voluptate facilis cumconsectetur adipisicing elit. Amet dolore"</p>
							<div class="st-border"></div>
							<div class="client-info">
								<h5>Mustafiz</h5>
								<span>CEO of Domain.com</span>
							</div>
						</div>

						<div class="item text-center">
							<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem autem possimus laborum, ducimus vel rerum asperiores delectus, suscipit voluptate mollitia, ullam perspiciatis voluptates!"</p>
							<div class="st-border"></div>
							<div class="client-info">
								<h5>Sean Hynes</h5>
								<span>CEO of Domain.com</span>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /TESTIMONIAL -->



	<!-- FUN FACTS -->
	<section id="fun-facts">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3><i class="fa fa-thumbs-o-up"></i> <span class="st-counter">365</span></h3>
						<p>Happy Clients</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3><i class="fa fa-briefcase fa-6"></i> <span class="st-counter">73987</span></h3>
						<p>Completed Projects</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3><i class="fa fa-coffee"></i> <span class="st-counter">297345</span></h3>
						<p>Cups of Coffee</p>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="fun-fact text-center">
						<h3><i class="fa fa-code"></i> <span class="st-counter">9823686</span></h3>
						<p>Lines of Code</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /FUN FACTS -->

	
	<!-- CONTACT -->
	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1>Contact us</h1>
						<span class="st-border"></span>
					</div>
				</div>
				<div class="col-sm-4 contact-info">
					<p class="contact-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae voluptatum dolorum, possimus tenetur pariatur officia, quo commodi autem doloribus vero rerum aspernatur quidem temporibus.</p>
					<p class="st-address"><i class="fa fa-map-marker"></i> <strong>E71 8th Ave, New York NY 21001, US</strong></p>
					<p class="st-phone"><i class="fa fa-mobile"></i> <strong>+00 123-456-789</strong></p>
					<p class="st-email"><i class="fa fa-envelope-o"></i> <strong>email@yourdomain.com</strong></p>
					<p class="st-website"><i class="fa fa-globe"></i> <strong>www.yourdomain.com</strong></p>
				
				</div>
				<div class="col-sm-7 col-sm-offset-1">
					<form action="php/send-contact.php" class="contact-form" name="contact-form" method="post">
						<div class="row">
							<div class="col-sm-6">
								<input type="text" name="name" required="required" placeholder="Name*">
							</div>
							<div class="col-sm-6">
								<input type="email" name="email" required="required" placeholder="Email*">
							</div>
							<div class="col-sm-6">
								<input type="text" name="subject" placeholder="Subject">
							</div>
							<div class="col-sm-6">
								<input type="text" name="website" placeholder="Website">
							</div>
							<div class="col-sm-12">
								<textarea name="message" required="required" cols="30" rows="7" placeholder="Message*"></textarea>
							</div>
							<div class="col-sm-12">
								<input type="submit" name="submit" value="Send Message" class="btn btn-send">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- /CONTACT -->

<?php get_footer();
