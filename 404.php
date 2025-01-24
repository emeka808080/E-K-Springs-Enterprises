<?php 
get_header();

$theme_options = druco_get_theme_options();
$classes = array();
$classes[] = 'show_breadcrumb_' . $theme_options['ts_breadcrumb_layout'];

druco_breadcrumbs_title(true, false, '');
?>
	<div class="page-container <?php echo esc_attr(implode(' ', $classes)); ?>">
		<div id="main-content" class="ts-col-24">	
			<div id="primary" class="site-content">
				<article>
				
					<div class="not-found">
						<i class="lnr lnr-sad"></i>
						<h1><?php esc_html_e('404. Page not found.', 'druco'); ?></h1>
						<p><?php esc_html_e('Sorry, we couldn’t find the page you where looking for. We suggest that you return to homepage.', 'druco'); ?></p>
						<a href="<?php echo esc_url( home_url('/') ) ?>" class="button"><?php esc_html_e('Go To Homepage', 'druco'); ?></a>
					</div>
					
				</article>
			</div>
		</div>
	</div>
<?php
get_footer();