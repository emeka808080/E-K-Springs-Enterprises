<?php 
if( !function_exists('ts_get_portfolio_items_content') ){
	return;
}

global $post;
$theme_options = druco_get_theme_options();
$cat_list = get_the_terms($post, 'ts_portfolio_cat');
$cat_ids = array();

if( is_array($cat_list) ){
	foreach( $cat_list as $cat ){
		$cat_ids[] = $cat->term_id;
	}
}

$args = array(
		'post_type' 		=> $post->post_type
		,'post__not_in' 	=> array($post->ID)
		,'posts_per_page' 	=> 5
	);

if( !empty($cat_ids) ){
	$args['tax_query'] = array(
		array(
			'taxonomy'	=> 'ts_portfolio_cat'
			,'field'	=> 'term_id'
			,'terms'	=> $cat_ids
		)
	);
}

$classes = array('ts-portfolio-wrapper related-portfolios loading');
$classes[] = 'ts-slider';
$classes[] = 'show-nav'; 

$data_attr = array();
$data_attr[] = 'data-nav="0"';
$data_attr[] = 'data-autoplay="1"';
$data_attr[] = 'data-columns="3"';


$posts = new WP_Query($args);

if( $posts->have_posts() ){	
	$atts = array(
				'show_title'		=> 1
				,'show_author'		=> 1
				,'show_date'		=> 1
				,'show_categories'	=> 0
				,'show_like_icon'	=> 0
				,'show_load_more'	=> 0
				,'show_filter_bar'	=> 0
				,'original_image'	=> 0
				,'layouts'			=> 'slider'
			);
			
	$atts = apply_filters('druco_related_portfolios_atts', $atts);
	
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', apply_filters('druco_related_protfolios_data_attr',$data_attr) ); ?>>
		<header class="shortcode-heading-wrapper">
			<h2 class="shortcode-title">
				<?php esc_html_e('Related works', 'druco'); ?>
			</h2>
		</header>
		<div class="portfolio-wrapper-content">
			<?php 
			ts_get_portfolio_items_content($atts, $posts); 
			?>
		</div>
	</div>
	<?php
}
wp_reset_postdata();
?>