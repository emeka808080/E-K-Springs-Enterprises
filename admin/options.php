<?php
$redux_url = '';
if( class_exists('ReduxFramework') ){
	$redux_url = ReduxFramework::$_url;
}

$logo_url 					= get_template_directory_uri() . '/images/logo.png'; 
$favicon_url 				= get_template_directory_uri() . '/images/favicon.ico';

$color_image_folder = get_template_directory_uri() . '/admin/assets/images/colors/';
$list_colors = array('default','yellow','yellow-2','yellow-3','yellow-4');
$preset_colors_options = array();
foreach( $list_colors as $color ){
	$preset_colors_options[$color] = array(
					'alt'      => $color
					,'img'     => $color_image_folder . $color . '.jpg'
					,'presets' => druco_get_preset_color_options( $color )
	);
}

$product_attribute_taxonomies = array();
if( class_exists('WooCommerce') ){
	$attributes = wc_get_attribute_taxonomies();

	if( !empty($attributes) ){
		foreach( $attributes as $attr ){
			$product_attribute_taxonomies[ wc_attribute_taxonomy_name( $attr->attribute_name ) ] = $attr->attribute_label;
		}
	}
}

$family_fonts = array(
	"Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif"
	,"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif"
	,"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif"
	,"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive"
	,"Courier, monospace"                                   => "Courier, monospace"
	,"Garamond, serif"                                      => "Garamond, serif"
	,"Georgia, serif"                                       => "Georgia, serif"
	,"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif"
	,"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace"
	,"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"
	,"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif"
	,"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif"
	,"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif"
	,"Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif"
	,"'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif"
	,"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif"
	,"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif"
	,"CustomFont"                          					=> "CustomFont"
);

$header_layout_options = array();
$header_image_folder = get_template_directory_uri() . '/admin/assets/images/headers/';
for( $i = 1; $i <= 6; $i++ ){
	$header_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Header Layout %s', 'druco'), $i)
		,'img' => $header_image_folder . 'header_v'.$i.'.jpg'
	);
}

$loading_screen_options = array();
$loading_image_folder = get_template_directory_uri() . '/images/loading/';
for( $i = 1; $i <= 10; $i++ ){
	$loading_screen_options[$i] = array(
		'alt'  => sprintf(esc_html__('Loading Image %s', 'druco'), $i)
		,'img' => $loading_image_folder . 'loading_'.$i.'.svg'
	);
}

$footer_block_options = druco_get_footer_block_options();

$breadcrumb_layout_options = array();
$breadcrumb_image_folder = get_template_directory_uri() . '/admin/assets/images/breadcrumbs/';
for( $i = 1; $i <= 3; $i++ ){
	$breadcrumb_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'druco'), $i)
		,'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.jpg'
	);
}

$sidebar_options = array();
$default_sidebars = druco_get_list_sidebars();
if( is_array($default_sidebars) ){
	foreach( $default_sidebars as $key => $_sidebar ){
		$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
	}
}

$product_loading_image = get_template_directory_uri() . '/images/prod_loading.gif';

$mailchimp_forms = array();
$args = array(
	'post_type'			=> 'mc4wp-form'
	,'post_status'		=> 'publish'
	,'posts_per_page'	=> -1
);
$forms = new WP_Query( $args );
if( !empty( $forms->posts ) && is_array( $forms->posts ) ) {
	foreach( $forms->posts as $p ) {
		$mailchimp_forms[$p->ID] = $p->post_title;
	}
}

$option_fields = array();

/*** General Tab ***/
$option_fields['general'] = array(
	array(
		'id'        => 'section-logo-favicon'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Logo - Favicon', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_logo'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Logo', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select an image file for the main logo', 'druco' )
		,'readonly' => false
		,'default'  => array( 'url' => $logo_url )
	)
	,array(
		'id'        => 'ts_logo_mobile'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Mobile Logo', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on mobile', 'druco' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_sticky'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Sticky Logo', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on sticky header', 'druco' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'druco' )
		,'default'  => '150'
	)
	,array(
		'id'        => 'ts_device_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width on Device', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'druco' )
		,'default'  => '120'
	)
	,array(
		'id'        => 'ts_favicon'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Favicon', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a PNG, GIF or ICO image', 'druco' )
		,'readonly' => false
		,'default'  => array( 'url' => $favicon_url )
	)
	,array(
		'id'        => 'ts_text_logo'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Text Logo', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Druco'
	)

	,array(
		'id'        => 'section-layout-style'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Layout Style', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Layout Fullwidth', 'druco' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_header_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Layout Fullwidth', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_main_content_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Main Content Layout Fullwidth', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_footer_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Footer Layout Fullwidth', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_layout_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout Style', 'druco' )
		,'subtitle' => esc_html__( 'You can override this option for the individual page', 'druco' )
		,'desc'     => ''
		,'options'  => array(
			'boxed' 	=> 'Boxed'
			,'wide' 	=> 'Wide'
		)
		,'default'  => 'wide'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '0' )
	)
	
	,array(
		'id'        => 'section-rtl'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Right To Left', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_rtl'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Right To Left', 'druco' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-smooth-scroll'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Smooth Scroll', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_smooth_scroll'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Smooth Scroll', 'druco' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-back-to-top-button'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Back To Top Button', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_back_to_top_button'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_back_to_top_button_on_mobile'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button On Mobile', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'section-page-not-found'
		,'type'     => 'section'
		,'title'    => esc_html__( '404 Page', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array( 
		'id'       	=> 'ts_404_page' 
		,'type'     => 'select' 
		,'title'    => esc_html__( '404 Page', 'druco' ) 
		,'subtitle' => esc_html__( 'Select the page which displays the 404 page', 'druco' ) 
		,'desc'     => ''
		,'data'     => 'pages'
		,'default'	=> ''
	)
	
	,array(
		'id'        => 'section-loading-screen'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Loading Screen', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_loading_screen'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Loading Screen', 'druco' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_loading_image'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Loading Image', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $loading_screen_options
		,'default'  => '1'
	)
	,array(
		'id'        => 'ts_custom_loading_image'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Custom Loading Image', 'druco' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'       	=> 'ts_display_loading_screen_in'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Display Loading Screen In', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'all-pages' 		=> esc_html__( 'All Pages', 'druco' )
			,'homepage-only' 	=> esc_html__( 'Homepage Only', 'druco' )
			,'specific-pages' 	=> esc_html__( 'Specific Pages', 'druco' )
		)
		,'default'  => 'all-pages'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_loading_screen_exclude_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Exclude Pages', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'all-pages' )
	)
	,array(
		'id'       	=> 'ts_loading_screen_specific_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Specific Pages', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'specific-pages' )
	)
);

/*** Color Scheme Tab ***/
$option_fields['color-scheme'] = array(
	array(
		'id'          => 'ts_color_scheme'
		,'type'       => 'image_select'
		,'presets'    => true
		,'full_width' => false
		,'title'      => esc_html__( 'Select Color Scheme of Theme', 'druco' )
		,'subtitle'   => ''
		,'desc'       => ''
		,'options'    => $preset_colors_options
		,'default'    => 'default'
		,'class'      => ''
	)
	,array(
		'id'        => 'section-general-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'General Colors', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-primary-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Primary Colors', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_primary_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Primary Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color_in_bg_primary'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color In Background Primary Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-main-content-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Main Content Colors', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_main_content_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Main Content Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_special_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#848484'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Heading Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#d43811'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_color_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Color Hover', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_blockquote_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Blockquote Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_blockquote_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Blockquote Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f3f3f3'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_tags_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Tags Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_tags_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Tags Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f3f3f3'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_tags_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Tags Hover Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_tags_hover_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Tags Hover Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ebebeb'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-input-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Input Colors', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_input_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ebebeb'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Button Colors', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_button_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_text_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_background_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_border_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Border Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_special_button_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Button Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_special_button_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Button Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_special_button_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Button Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_special_button_text_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Button Text Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_special_button_background_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Button Background Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_special_button_border_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Button Border Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-breadcrumb-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Breadcrumb Colors', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_breadcrumb_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ebebeb'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_link_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Link Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#848484'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'        => 'section-header-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Colors', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_header_top_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_top_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#233f92'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_top_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#233f92'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_top_link_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Link Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_top_strong_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Top Strong Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_middle_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Middle Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_middle_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Middle Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_middle_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Middle Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ebebeb'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_middle_link_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Middle Link Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_icon_count_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Icon Count Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_icon_count_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Icon Count Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_bottom_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Bottom Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_bottom_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Bottom Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_bottom_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Bottom Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ebebeb'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_bottom_link_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Bottom Link Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_search_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_search_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Search Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f8f8f8'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_vertical_menu_heading_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Vertical Menu/Attribute Search Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_vertical_menu_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Vertical Menu/Attribute Search Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_dropdown_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Dropdown Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_dropdown_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Dropdown Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_dropdown_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Dropdown Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_dropdown_link_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Dropdown Link Hover Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'        => 'section-footer-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Footer Colors', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_footer_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#aaaaaa'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Heading Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#181818'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'        => 'section-product-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Colors', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_product_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Price Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#233f92'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_sale_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Sale Price Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#868686'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_rating_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Rating Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c3c3c3'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_rating_fill_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Rating Fill Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffd200'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-product-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Group Buttons on Product Thumbnail', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f0f0f0'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color Hover', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_background_hover_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-product-label-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Label Colors', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_sale_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_sale_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#d43811'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffb91f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#d1cfcf'
			,'alpha'	=> 1
		)
	)	
	,array(
		'id'      => 'info-mobile-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Mobile Colors', 'druco' )
		,'desc'   => ''
	)	
	,array(
		'id'       => 'ts_product_group_button_fixed_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile Fixed Bottom Bar Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_group_button_fixed_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile Fixed Bottom Bar Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_group_button_fixed_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Mobile Fixed Bottom Bar Border Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Background Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Text Color', 'druco' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#202020'
			,'alpha'	=> 1
		)
	)
);

/*** Typography Tab ***/
$option_fields['typography'] = array(
	array(
		'id'        => 'section-fonts'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Fonts', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       			=> 'ts_body_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font', 'druco' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Outfit'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '15px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '0.4px'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_body_font_semi'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font SemiBold', 'druco' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'line-height'  	=> false
		,'font-size'  		=> false
		,'letter-spacing' 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Outfit'
			,'font-weight' 		=> '600'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_heading_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading Font', 'druco' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'line-height'  	=> false
		,'font-size'  		=> false
		,'letter-spacing' 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Outfit'
			,'font-weight' 		=> '700'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_blockquote_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Blockquote Font', 'druco' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Playfair Display'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '18px'
			,'line-height' 		=> '30px'
			,'font-style'   	=> 'italic'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Menu Font', 'druco' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Outfit'
			,'font-weight' 		=> '600'
			,'font-size'   		=> '14px'
			,'line-height' 		=> '22px'
			,'letter-spacing' 	=> '0.4px'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_vertical_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Vertical Menu Font', 'druco' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Outfit'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '16px'
			,'line-height' 		=> '22px'
			,'letter-spacing' 	=> '0.45px'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_vertical_sub_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Sub Menu Font', 'druco' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Outfit'
			,'font-weight' 		=> '400'
			,'font-size'   		=> '15px'
			,'line-height' 		=> '22px'
			,'letter-spacing' 	=> '0.4px'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'        => 'section-custom-font'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Custom Font', 'druco' )
		,'subtitle' => esc_html__( 'If you get the error message \'Sorry, this file type is not permitted for security reasons\', you can add this line define(\'ALLOW_UNFILTERED_UPLOADS\', true); to the wp-config.php file', 'druco' )
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_custom_font_ttf'
		,'type'     => 'media'
		,'url'      => true
		,'preview'  => false
		,'title'    => esc_html__( 'Custom Font ttf', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Upload the .ttf font file. To use it, you select CustomFont in the Standard Fonts group', 'druco' )
		,'default'  => array( 'url' => '' )
		,'mode'		=> 'application'
	)
	
	,array(
		'id'        => 'section-font-sizes'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Font Sizes', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-font-size-pc'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on PC', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       			=> 'ts_h1_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'H1 Font Size', 'druco' )
		,'subtitle' 		=> ''
		,'class' 			=> 'typography-no-preview'
		,'google'   		=> false
		,'font-family'  	=> false
		,'font-weight'  	=> false
		,'font-style'   	=> false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '48px'
			,'line-height' 		=> '54px'
			,'letter-spacing' 	=> '1.2px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h2_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H2 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '36px'
			,'line-height' 		=> '40px'
			,'letter-spacing' 	=> '0.9px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h3_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H3 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '30px'
			,'line-height' 		=> '36px'
			,'letter-spacing' 	=> '0.75px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h4_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H4 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '24px'
			,'line-height' 		=> '30px'
			,'letter-spacing' 	=> '0.6px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h5_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H5 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '20px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '0.5px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h6_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H6 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '18px'
			,'line-height' 		=> '22px'
			,'letter-spacing' 	=> '0.45px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_button_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Button Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '14px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_product_name_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Product Name Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '15px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_product_price_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Product Price Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '18px'
			,'google'	   => false
		)
	)
	,array(
		'id'      => 'info-font-size-ipad'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on device', 'druco' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_h1_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '36px'
			,'line-height' 		=> '40px'
			,'letter-spacing' 	=> '0.9px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h2_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H2 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '30px'
			,'line-height' 		=> '36px'
			,'letter-spacing' 	=> '0.75px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h3_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H3 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '24px'
			,'line-height' 		=> '30px'
			,'letter-spacing' 	=> '0.6px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h4_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H4 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '20px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '0.5px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h5_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H5 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '18px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '0.45px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h6_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H6 Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'letter-spacing' 	=> true
		,'text-align'  	 	=> false
		,'color'   			=> false
		,'preview'			=> array('always_display' => false)
		,'default'  		=> array(
			'font-family'  		=> ''
			,'font-weight' 		=> ''
			,'font-size'   		=> '16px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '0.45px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_button_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Button Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '13px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_vertical_menu_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Vertical Menu Ipad Font Size', 'druco' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '14px'
			,'google'	   => false
		)
	)
);

/*** Header Tab ***/
$option_fields['header'] = array(
	array(
		'id'        => 'section-header-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Options', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_header_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Header Layout', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $header_layout_options
		,'default'  => 'v1'
	)
	,array(
		'id'        => 'ts_header_delivery_note'
		,'type'     => 'textarea'
		,'title'    => esc_html__( 'Header Delivery Note', 'druco' )
		,'subtitle' => esc_html__( 'You can add your delivery note', 'druco' )
		,'validate'	=> 'html'
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_header_note'
		,'type'     => 'textarea'
		,'title'    => esc_html__( 'Header Note', 'druco' )
		,'subtitle' => esc_html__( 'Only available on some header layouts', 'druco' )
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_header_store_notice'
		,'type'     => 'textarea'
		,'title'    => esc_html__( 'Header Store Notice', 'druco' )
		,'subtitle' => esc_html__( 'You can add your store notice', 'druco' )
		,'validate'	=> 'html'
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_header_contact_info'
		,'type'     => 'textarea'
		,'title'    => esc_html__( 'Header Phone Number', 'druco' )
		,'subtitle' => esc_html__( 'You can add your phone number', 'druco' )
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_enable_sticky_header'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Sticky Header', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	,array(
		'id'        => 'ts_enable_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Search', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	,array(
		'id'        => 'ts_search_by_category'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Search By Category', 'druco' )
		,'subtitle' => esc_html__( 'Enable or disable category dropdown in search bar', 'druco' )
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
		,'required'	=> array( 'ts_enable_search', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_enable_tiny_wishlist'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Wishlist', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	,array(
		'id'        => 'ts_header_currency'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Currency', 'druco' )
		,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WooCommerce Multilingual plugin, it may display demo html', 'druco' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	,array(
		'id'        => 'ts_header_language'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Language', 'druco' )
		,'subtitle' => esc_html__( 'Only available on some header layouts. If you don\'t install WPML plugin, it may display demo html', 'druco' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	,array(
		'id'        => 'ts_enable_tiny_account'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'My Account', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	,array(
		'id'        => 'ts_enable_tiny_shopping_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Shopping Cart', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	,array(
		'id'        => 'ts_shopping_cart_sidebar'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Shopping Cart Sidebar', 'druco' )
		,'subtitle' => esc_html__( 'Show shopping cart in sidebar instead of dropdown. You need to update cart after changing', 'druco' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
		,'required'	=> array( 'ts_enable_tiny_shopping_cart', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_show_shopping_cart_after_adding'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Shopping Cart After Adding Product To Cart', 'druco' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products', 'druco' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
		,'required'	=> array( 'ts_shopping_cart_sidebar', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_add_to_cart_effect'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Add To Cart Effect', 'druco' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products. If "Show Shopping Cart After Adding Product To Cart" is enabled, this option will be disabled', 'druco' )
		,'options'  => array(
			'0'				=> esc_html__( 'None', 'druco' )
			,'fly_to_cart'	=> esc_html__( 'Fly To Cart', 'druco' )
			,'show_popup'	=> esc_html__( 'Show Popup', 'druco' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_enable_mobile_app_style'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Mobile App Style Navigation', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
	
	,array(
		'id'        => 'section-attribute-search-form'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product attribute search form', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'		=> 'ts_heading_form_search'
		,'type'		=> 'text'
		,'title'	=> esc_html__( 'Search form heading', 'druco' )
		,'subtitle'	=> ''
		,'desc'     => ''
		,'default'	=> ''
	)
	,array(
		'id'		=> 'ts_attributes_form_search'
		,'type'		=> 'select'
		,'title'	=> esc_html__( 'Product attributes', 'druco' )
		,'subtitle'	=> esc_html__( 'Select attributes which you want to show in form', 'druco' )
		,'desc'		=> ''
		,'multi'    => true
		,'options'	=> $product_attribute_taxonomies
		,'default'  => array()
	)
	
	,array(
		'id'        => 'section-breadcrumb-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Breadcrumb Options', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_breadcrumb_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Breadcrumb Layout', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $breadcrumb_layout_options
		,'default'  => 'v1'
	)
	,array(
		'id'        => 'ts_enable_breadcrumb_background_image'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Breadcrumbs Background Image', 'druco' )
		,'subtitle' => esc_html__( 'You can set background color by going to Color Scheme tab > Breadcrumb Colors section', 'druco' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_bg_breadcrumbs'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Breadcrumbs Background Image', 'druco' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a new image to override the default background image', 'druco' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_breadcrumb_bg_parallax'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Breadcrumbs Background Parallax', 'druco' )
		,'subtitle' => ''
		,'default'  => false
	)
);

/*** Footer Tab ***/
$option_fields['footer'] = array(
	array(
		'id'       	=> 'ts_footer_block'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Footer Block', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $footer_block_options
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
);

/*** Menu Tab ***/
$option_fields['menu'] = array(
	array(
		'id'             => 'ts_menu_thumb_width'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Width', 'druco' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 60, step: 1, default value: 54', 'druco' )
		,'default'       => 54
		,'min'           => 5
		,'step'          => 1
		,'max'           => 60
		,'display_value' => 'text'
	)
	,array(
		'id'             => 'ts_menu_thumb_height'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Height', 'druco' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 60, step: 1, default value: 54', 'druco' )
		,'default'       => 54
		,'min'           => 5
		,'step'          => 1
		,'max'           => 60
		,'display_value' => 'text'
	)
	,array(
		'id'        => 'ts_enable_menu_overlay'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Menu Background Overlay', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'druco' )
		,'off'		=> esc_html__( 'Disable', 'druco' )
	)
);

/*** Blog Tab ***/
$option_fields['blog'] = array(
	array(
		'id'        => 'section-blog'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Layout', 'druco' )
		,'subtitle' => esc_html__( 'This option is available when Front page displays the latest posts', 'druco' )
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'druco')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-1'
	)
	,array(
		'id'       	=> 'ts_blog_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Blog Columns', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			1	=> 1
			,2	=> 2
		)
		,'default'  => '1'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_read_more'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Read More Button', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_excerpt'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_excerpt_strip_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt Strip All Tags', 'druco' )
		,'subtitle' => esc_html__( 'Strip all html tags in Excerpt', 'druco' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_blog_excerpt_max_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Excerpt Max Words', 'druco' )
		,'subtitle' => esc_html__( 'Input -1 to show full excerpt', 'druco' )
		,'desc'     => ''
		,'default'  => '-1'
	)

	,array(
		'id'        => 'section-blog-details'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog Details', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_details_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Details Layout', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'druco')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_blog_details_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_details_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_details_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Content', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Tags', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing - Use ShareThis', 'druco' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'druco')
		,'default'  => true
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Sharing - ShareThis Key', 'druco' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'druco' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_author_box'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author Box', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_navigation'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Navigation', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_related_posts'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Related Posts', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_blog_details_comment_form'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment Form', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
);

/*** Portfolio Details Tab ***/
$option_fields['portfolio-details'] = array(
	array(
		'id'       	=> 'ts_portfolio_page'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Portfolio Page', 'druco' )
		,'subtitle' => esc_html__( 'Select the page which displays the list of portfolios. You also need to add our portfolio shortcode to that page', 'druco' )
		,'desc'     => ''
		,'data'     => 'pages'
		,'default'	=> ''
	)
	,array(
		'id'       	=> 'ts_portfolio_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout', 'druco' )
		,'subtitle' => esc_html__( 'Display thumbnail at the top or left of content', 'druco' )
		,'desc'     => ''
		,'options'  => array(
			'top-thumbnail'		=> esc_html__( 'Top Thumbnail', 'druco' )
			,'left-thumbnail'	=> esc_html__( 'Left Thumbnail', 'druco' )
		)
		,'default'	=> 'left-thumbnail'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_portfolio_thumbnail_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Thumbnail Style', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'slider'	=> esc_html__( 'Slider', 'druco' )
			,'gallery'	=> esc_html__( 'Gallery', 'druco' )
		)
		,'default'	=> 'gallery'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_portfolio_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Thumbnail', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Title', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Author', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Date', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_likes'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Likes', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Content', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_client'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Client', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_year'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Year', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_url'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio URL', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Categories', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Sharing', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_related_posts'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Related Posts', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Custom Field', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field_title'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Portfolio Custom Field Title', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom'
		,'required'	=> array( 'ts_portfolio_custom_field', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Portfolio Custom Field Content', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom content goes here'
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => true
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => true
		)
		,'required'	=> array( 'ts_portfolio_custom_field', 'equals', '1' )
	)
);

/*** WooCommerce Tab ***/
$option_fields['woocommerce'] = array(
	array(
		'id'        => 'section-product-label'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Label', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_label_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Label Style', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'rectangle' 	=> esc_html__( 'Rectangle', 'druco' )
			,'square' 		=> esc_html__( 'Square', 'druco' )
			,'circle' 		=> esc_html__( 'Circle', 'druco' )
		)
		,'default'  => 'rectangle'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_product_show_new_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product New Label', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_product_new_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Text', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'New'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_show_new_label_time'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Time', 'druco' )
		,'subtitle' => esc_html__( 'Number of days which you want to show New label since product is published', 'druco' )
		,'desc'     => ''
		,'default'  => '30'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_sale_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sale Label Text', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sale'
	)
	,array(
		'id'        => 'ts_product_feature_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Feature Label Text', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Hot'
	)
	,array(
		'id'        => 'ts_product_out_of_stock_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Out Of Stock Label Text', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sold out'
	)
	,array(
		'id'       	=> 'ts_show_sale_label_as'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Show Sale Label As', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'text' 		=> esc_html__( 'Text', 'druco' )
			,'number' 	=> esc_html__( 'Number', 'druco' )
			,'percent' 	=> esc_html__( 'Percent', 'druco' )
		)
		,'default'  => 'percent'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'		=> 'section-product-style'
		,'type'		=> 'section'
		,'title'	=> esc_html__( 'Product Style', 'druco' )
		,'subtitle'	=> ''
		,'indent'	=> false
	)
	,array(
		'id'		=> 'ts_product_border'
		,'type'		=>	'switch'
		,'title'	=> esc_html__( 'Product Border', 'druco' )
		,'subtitle'	=> ''
		,'default'	=> true
	)

	,array(
		'id'        => 'section-product-hover'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Hover', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_hover_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Hover Style', 'druco' )
		,'subtitle' => esc_html__( 'Select the style of buttons/icons when hovering on product', 'druco' )
		,'desc'     => ''
		,'options'  => array(
			'hover-vertical-style' 			=> esc_html__( 'Vertical Style', 'druco' )
			,'hover-vertical-style-2' 		=> esc_html__( 'Vertical Style 2', 'druco' )
		)
		,'default'  => 'hover-vertical-style-2'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_effect_product'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Back Product Image', 'druco' )
		,'subtitle' => esc_html__( 'Show another product image on hover. It will show an image from Product Gallery', 'druco' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_product_tooltip'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tooltip', 'druco' )
		,'subtitle' => esc_html__( 'Show tooltip when hovering on buttons/icons on product', 'druco' )
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-lazy-load'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Lazy Load', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_lazy_load'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Lazy Load', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_placeholder_img'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Placeholder Image', 'druco' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => $product_loading_image )
	)
	
	,array(
		'id'        => 'section-quickshop'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Quickshop', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_quickshop'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Quickshop', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)

	,array(
		'id'        => 'section-catalog-mode'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Catalog Mode', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_catalog_mode'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Catalog Mode', 'druco' )
		,'subtitle' => esc_html__( 'Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off', 'druco' )
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-ajax-search'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Ajax Search', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_ajax_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Ajax Search', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_ajax_search_number_result'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number Of Results', 'druco' )
		,'subtitle' => esc_html__( 'Input -1 to show all results', 'druco' )
		,'desc'     => ''
		,'default'  => '4'
	)
);

/*** Shop/Product Category Tab ***/
$option_fields['shop-product-category'] = array(
	array(
		'id'        => 'ts_prod_cat_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Shop/Product Category Layout', 'druco' )
		,'subtitle' => esc_html__( 'Sidebar is only available if Filter Widget Area is disabled', 'druco' )
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'druco')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '1-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_cat_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_grid_list_toggle'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Grid/List Toggle', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'       	=> 'ts_prod_grid_list_toggle_default'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Grid/List Toggle Default', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'grid'		=> esc_html__( 'Grid', 'druco' ),
			'list'		=> esc_html__( 'List', 'druco' )
		)
		,'default'  => 'grid'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array('ts_prod_cat_grid_list_toggle', 'equals', '1')
	)
	,array(
		'id'       	=> 'ts_prod_cat_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Columns', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'3'			=> '3'
			,'4'		=> '4'
			,'5'		=> '5'
			,'6'		=> '6'
		)
		,'default'  => '3'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_per_page'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Products Per Page', 'druco' )
		,'subtitle' => esc_html__( 'Number of products per page', 'druco' )
		,'desc'     => ''
		,'default'  => '30'
	)
	,array(
		'id'       	=> 'ts_prod_cat_loading_type'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Loading Type', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'			=> esc_html__( 'Default', 'druco' )
			,'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'druco' )
			,'load-more-button'	=> esc_html__( 'Load More Button', 'druco' )
			,'ajax-pagination'	=> esc_html__( 'Ajax Pagination', 'druco' )
		)
		,'default'  => 'ajax-pagination'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_collapse_scroll_sidebar'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Collapse And Scroll Widgets In Sidebar', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_cat_per_page_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Products Per Page Dropdown', 'druco' )
		,'subtitle' => esc_html__( 'Allow users to select number of products per page', 'druco' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_onsale_checkbox'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Products On Sale Checkbox', 'druco' )
		,'subtitle' => esc_html__( 'Allow users to view only the discounted products', 'druco' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_filter_widget_area'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Filter Widget Area', 'druco' )
		,'subtitle' => esc_html__( 'Display Filter Widget Area on the Shop/Product Category page. If enabled, sidebar will be removed', 'druco' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat_desc_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Short Description - Limit Words', 'druco' )
		,'subtitle' => esc_html__( 'It is also used for product shortcode', 'druco' )
		,'desc'     => ''
		,'default'  => '8'
	)
	,array(
		'id'        => 'ts_prod_cat_color_swatch'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Swatches', 'druco' )
		,'subtitle' => esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'druco' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_number_color_swatch'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Number Of Color Swatches', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			2	=> 2
			,3	=> 3
			,4	=> 4
			,5	=> 5
			,6	=> 6
		)
		,'default'  => '3'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_color_swatch', 'equals', '1' )
	)
);

/*** Product Details Tab ***/
$option_fields['product-details'] = array(
	array(
		'id'        => 'ts_prod_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Product Layout', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'druco')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'druco')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_layout_fullwidth'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Layout Fullwidth', 'druco' )
		,'subtitle' => esc_html__( 'Override the Layout Fullwidth option in the General tab', 'druco' )
		,'desc'     => ''
		,'options'  => array(
			'default'	=> esc_html__( 'Default', 'druco' )
			,'0'		=> esc_html__( 'No', 'druco' )
			,'1'		=> esc_html__( 'Yes', 'druco' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_header_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Header Layout Fullwidth', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_prod_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_main_content_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Main Content Layout Fullwidth', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'required'	=> array( 'ts_prod_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_footer_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Footer Layout Fullwidth', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'required'	=> array( 'ts_prod_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_breadcrumb'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Breadcrumb', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_cloudzoom'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Cloud Zoom', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_lightbox'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Lightbox', 'druco' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_attr_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Attribute Dropdown', 'druco' )
		,'subtitle' => esc_html__( 'If you turn it off, the dropdown will be replaced by image or text label', 'druco' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_attr_color_text'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Attribute Text', 'druco' )
		,'subtitle' => esc_html__( 'Show text for the Color attribute instead of color/color image', 'druco' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_attr_dropdown', 'equals', '0' )
	)
	,array(
		'id'        => 'ts_prod_attr_color_variation_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Attribute Variation Thumbnail', 'druco' )
		,'subtitle' => esc_html__( 'Use the variation thumbnail for the Color attribute. The Color slug has to be "color". You need to specify Color for variation (not any)', 'druco' )
		,'default'  => true
		,'required'	=> array( 'ts_prod_attr_color_text', 'equals', '0' )
	)
	,array(
		'id'        => 'ts_prod_next_prev_navigation'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Next/Prev Product Navigation', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'       	=> 'ts_prod_gallery_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Gallery Layout', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'vertical'		=> esc_html__( 'Vertical', 'druco' )
			,'horizontal'	=> esc_html__( 'Horizontal', 'druco' )
		)
		,'default'  => 'vertical'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_title_in_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title In Content', 'druco' )
		,'subtitle' => esc_html__( 'Display the product title in the page content instead of above the breadcrumbs', 'druco' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_availability'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Availability', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_short_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_count_down'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Count Down', 'druco' )
		,'subtitle' => esc_html__( 'You have to activate ThemeSky plugin. If you turn it off, the Product Sold Number will also be hidden', 'druco' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_sold_number'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sold Number', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
		,'required'	=> array( 'ts_prod_count_down', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_ajax_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Ajax Add To Cart', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_prod_add_to_cart', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_buy_now'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Buy Now Button', 'druco' )
		,'subtitle' => esc_html__( 'Only support the simple and variable products', 'druco' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_tag'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tags', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_more_less_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product More/Less Content', 'druco' )
		,'subtitle' => esc_html__( 'Show more/less content in the Description tab', 'druco' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_prod_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing - Use ShareThis', 'druco' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'druco' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sharing - ShareThis Key', 'druco' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'druco' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)

	,array(
		'id'        => 'section-product-tabs'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Tabs', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_tabs'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tabs', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'       	=> 'ts_prod_tabs_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Tabs Position', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'after_summary'				=> esc_html__( 'After Summary', 'druco' )
			,'inside_summary'			=> esc_html__( 'Inside Summary', 'druco' )
		)
		,'default'  => 'after_summary'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_custom_tab'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Custom Tab', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_custom_tab_title'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Custom Tab Title', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom tab'
	)
	,array(
		'id'        => 'ts_prod_custom_tab_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Product Custom Tab Content', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => esc_html__( 'Your custom content goes here. You can add the content for individual product', 'druco' )
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => true
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => true
		)
	)
	
	,array(
		'id'        => 'section-ads-banner'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Ads Banner', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_ads_banner'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Ads Banner', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_ads_banner_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Ads Banner Content', 'druco' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => true
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => true
		)
	)
	
	,array(
		'id'        => 'section-related-up-sell-products'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Related - Up-Sell', 'druco' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_related'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Related Products', 'druco' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
	,array(
		'id'        => 'ts_prod_upsells'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Up-Sell Products', 'druco' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'druco' )
		,'off'		=> esc_html__( 'Hide', 'druco' )
	)
);

/*** Custom Code Tab ***/
$option_fields['custom-code'] = array(
	array(
		'id'        => 'ts_custom_css_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom CSS Code', 'druco' )
		,'subtitle' => ''
		,'mode'     => 'css'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_custom_javascript_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom Javascript Code', 'druco' )
		,'subtitle' => ''
		,'mode'     => 'javascript'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
);