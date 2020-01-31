<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
<footer id="site-footer" role="contentinfo" class="header-footer-group">
		<div class="container">			
			<p>
				<a class="footer-logo" href="<?php echo site_url(); ?>" title="Dastjar Supporting your bussiness to grow">
					<img src="<?php echo site_url(); ?>/wp-content/uploads/2019/12/dastjar.png" alt="Dastjar Supporting your bussiness to grow" title="Dastjar Supporting your bussiness to grow" />
				</a>	
			</a>	
				<div class="row">
						<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<?php dynamic_sidebar('Services Menu'); ?>
						</div>
						<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<?php dynamic_sidebar('Contact Menu'); ?>
						</div>
						<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<?php dynamic_sidebar('Download Menu'); ?>
						</div>
						<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<?php dynamic_sidebar('Social Icon'); ?>
						</div>
				</div>
				<div class="row-copyright">
					<div class="row">
						<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div class="footer-credits">
							<p class="footer-copyright">&copy;
									<?php
								echo date_i18n(
									/* translators: Copyright date format, see https://secure.php.net/date */
									_x( 'Y', 'copyright date format', 'twentytwenty' )
								);
								?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php bloginfo( 'name' ); ?>
									</a> </p>
							<!-- .footer-copyright --> 
							
							<!--p class="powered-by-wordpress"> <a href="<?php //echo esc_url( __( 'https://wordpress.org/', 'twentytwenty' ) ); ?>">
									<?php //_e( 'Powered by WordPress', 'twentytwenty' ); ?>
									</a> </p--> 
							<!-- .powered-by-wordpress --> 
							
					</div>
						</div>
						<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right">
							<a href="#" title="" id="scroll" style="display: none;"><i class="fas fa-chevron-up"></i></a>
						</div>
					</div>				
				</div>
				<!-- .footer-credits --> 
				<!-- .to-the-top --> 
		</div>
		<!-- .section-inner --> 
</footer>
<!-- #site-footer --> 
<script language="javascript" type="text/javascript">
	// Loader
	
	 jQuery("body").prepend('<div class="loader">Loading...</div>');
			jQuery(document).ready(function() {
					jQuery(".loader").remove();
			});
	
	// Sticky
	
	 jQuery(window).scroll(function() {
	 		if(jQuery(this).scrollTop()>5) {
	 				jQuery( "body" ).addClass("fixed-me");
	 		} else {
	 				jQuery( "body" ).removeClass("fixed-me");
	 		}
	 });
	
	// Back to Top
	
	jQuery(document).ready(function(){ 
			jQuery(window).scroll(function(){ 
					if (jQuery(this).scrollTop() > 100) { 
							jQuery('#scroll').fadeIn(); 
					} else { 
							jQuery('#scroll').fadeOut(); 
					} 
			}); 
			jQuery('#scroll').click(function(){ 
					jQuery("html, body").animate({ scrollTop: 0 }, 600); 
					return false; 
			}); 
	});	 
</script>
<?php wp_footer(); ?>
</body></html>