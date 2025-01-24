<?php 
get_header();

global $post;
setup_postdata($post);

$theme_options = druco_get_theme_options();

$show_breadcrumb = apply_filters('druco_show_breadcrumb_on_single_portfolio', true);

$container_classes = array();
if( $show_breadcrumb ){
	$container_classes[] = 'show_breadcrumb_' . $theme_options['ts_breadcrumb_layout'];
}

$video_url = get_post_meta($post->ID, 'ts_video_url', true);

$thumbnail_style = $theme_options['ts_portfolio_thumbnail_style'];

$classes = array();
$classes[] = $theme_options['ts_portfolio_layout'];
$classes[] = $thumbnail_style;

$is_slider = false;
if( $thumbnail_style == 'slider' ){
	$is_slider = true;
} 

druco_breadcrumbs_title($show_breadcrumb, false, '');
?>
<div id="content" class="page-container container-post <?php echo esc_attr(implode(' ', $container_classes)) ?>">
	
	<!-- main-content -->
	<div id="main-content" class="ts-col-24">
		<article class="single single-post single-portfolio <?php echo esc_attr(implode(' ', $classes)) ?>">
		
			<!-- Portfolio Title -->
			<?php if( $theme_options['ts_portfolio_layout'] == 'top-thumbnail' && $theme_options['ts_portfolio_title'] ): ?>
				<header class="entry-header">					
					<h3 class="entry-title"><?php the_title() ?></h3>
				</header>
			<?php endif; ?>
			
			<!-- Blog Thumbnail -->
			<?php if( $theme_options['ts_portfolio_thumbnail'] ): ?>
			<div class="entry-format <?php echo esc_attr($is_slider?'nav-bottom nav-margin':''); ?>">
				<div class="thumbnail nav-middle <?php echo esc_attr($is_slider?'gallery loading':''); ?>">
					<figure>
					<?php 
						$gallery = get_post_meta($post->ID, 'ts_gallery', true);
						if( $gallery ){
							$gallery_ids = explode(',', $gallery);
						}
						else{
							$gallery_ids = array();
						}
						
						if( is_array($gallery_ids) && has_post_thumbnail() ){
							array_unshift($gallery_ids, get_post_thumbnail_id());
						}
						foreach( $gallery_ids as $gallery_id ){
							echo wp_get_attachment_image( $gallery_id, 'full', false );
						}	
					?>
					</figure>
					<?php 
					if( $video_url ){
						echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
					}
					?>
					
				</div>
				
			</div>	
			<?php endif; ?>

			<div class="entry-content">
			
				<div class="entry-meta-top">
					<!-- Portfolio Date -->
					<?php if( $theme_options['ts_portfolio_date'] ): ?>
					<span class="date-time">
						<?php echo get_the_time( get_option('date_format') ); ?>
					</span>
					<?php endif; ?>
					
					<!-- Portfolio Author -->
					<?php if( $theme_options['ts_portfolio_author'] ): ?>
					<span class="vcard author">
						<span><?php esc_html_e('BY', 'druco'); ?></span>
						<?php the_author_posts_link(); ?>
					</span>
					<?php endif; ?>
					
					<!-- Portfolio Categories -->
					<?php
					$categories_list = get_the_term_list($post->ID, 'ts_portfolio_cat', '', ', ', '');
					if ( $categories_list && $theme_options['ts_portfolio_categories'] ):
					?>
					<div class="cats-portfolio">
						<span><?php esc_html_e('IN', 'druco') ?></span>
						<span class="cat-links"><?php echo wp_kses( $categories_list, 'druco_link' ); ?></span>
					</div>
					<?php endif; ?>
					
					<!-- Portfolio Likes -->
					<?php if( $theme_options['ts_portfolio_likes'] ): ?>
						<?php
						global $ts_portfolios;
						$like_num = 0;
						$already_like = false;
						if( is_a($ts_portfolios, 'TS_Portfolios') && method_exists($ts_portfolios, 'get_like') ){
							$like_num = $ts_portfolios->get_like($post->ID);
							$already_like = $ts_portfolios->user_already_like($post->ID);
						}
						?>
						<div class="portfolio-like">
							<span class="ic-like <?php echo esc_attr($already_like?'already-like':''); ?>" data-post_id="<?php echo esc_attr($post->ID) ?>"></span>
							<span class="like-num" data-single="<?php esc_attr_e('Like', 'druco'); ?>" data-plural="<?php esc_attr_e('Likes', 'druco'); ?>">
								<?php echo esc_html( sprintf( _n( '%s like', '%s likes', $like_num, 'druco' ), $like_num ) ); ?>
							</span>
						</div>
					<?php endif; ?>

				</div>

				<!-- Portfolio Title -->
				<?php if( $theme_options['ts_portfolio_layout'] != 'top-thumbnail' && $theme_options['ts_portfolio_title'] ): ?>
					<header class="entry-header">
						<h3 class="entry-title"><?php the_title() ?></h3>
					</header>
				<?php endif; ?>
				
				<!-- Portfolio Content -->
				<?php if( $theme_options['ts_portfolio_content'] ): ?>
					<div class="portfolio-content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
				
				<div class="meta-content">
					
					<!-- Portfolio Client -->
					<?php $client = get_post_meta($post->ID, 'ts_client', true); ?>
					<?php if( $theme_options['ts_portfolio_client'] && $client ): ?>
					<div class="portfolio-info">
						<span><?php esc_html_e('Client:', 'druco') ?></span>
						<span class="client"><?php echo esc_html($client); ?></span>
					</div>
					<?php endif; ?>
					
					<!-- Portfolio Year -->
					<?php $year = get_post_meta($post->ID, 'ts_year', true); ?>
					<?php if( $theme_options['ts_portfolio_year'] && $year ): ?>
					<div class="portfolio-info">
						<span><?php esc_html_e('Year:', 'druco') ?></span>
						<span class="year"><?php echo esc_html($year); ?></span>
					</div>
					<?php endif; ?>
					
					<!-- Portfolio Custom Field -->
					<?php if( $theme_options['ts_portfolio_custom_field'] ): ?>
					<div class="portfolio-info">
						<span><?php echo esc_html($theme_options['ts_portfolio_custom_field_title']); ?>:</span>
						<div class="custom-field">
							<?php echo do_shortcode( $theme_options['ts_portfolio_custom_field_content'] ) ?>
						</div>
					</div>
					<?php endif; ?>
					
					<!-- Portfolio Sharing -->
					<?php if( $theme_options['ts_portfolio_sharing'] && function_exists('ts_template_social_sharing') ): ?>
					<div class="social-sharing portfolio-info">
						<span><?php esc_html_e('Share:', 'druco'); ?></span>
						<?php ts_template_social_sharing(); ?>
					</div>
					<?php endif; ?>
					
					<!-- Portfolio URL -->
					<?php if( $theme_options['ts_portfolio_url'] ):
					$portfolio_url = get_post_meta($post->ID, 'ts_portfolio_url', true);
					if( $portfolio_url == '' ){
						$portfolio_url = get_the_permalink();
					}
					?>
					<div class="portfolio-info">
						<span><?php esc_html_e('Link:', 'druco') ?></span>
						<a href="<?php echo esc_url($portfolio_url); ?>" class="portfolio-url"><?php echo esc_url($portfolio_url); ?></a>
					</div>
					<?php endif; ?>
					
				</div>
						
			</div>
			
			<!-- Related Posts-->
			<?php 
			if( $theme_options['ts_portfolio_related_posts'] ){
				get_template_part('templates/related-portfolios');
			}
			?>
		</article>
	</div><!-- end main-content -->
	
</div>
<?php get_footer(); ?>