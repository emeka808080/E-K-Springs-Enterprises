<?php
if( !isset($data) ){
	$data = druco_get_theme_options();
}

update_option('ts_load_dynamic_style', 0);

$default_options = array(
				'ts_layout_fullwidth'			=> 0
				,'ts_logo_width'				=> "150"
				,'ts_device_logo_width'			=> "120"
				,'ts_custom_font_ttf'			=> array( 'url' => '' )
		);
		
foreach( $default_options as $option_name => $value ){
	if( isset($data[$option_name]) ){
		$default_options[$option_name] = $data[$option_name];
	}
}

extract($default_options);
		
$default_colors = array(
				'ts_primary_color'											=> '#ffb91f'
				,'ts_text_color_in_bg_primary'								=> '#202020'
				,'ts_main_content_background_color'							=> '#ffffff'
				,'ts_text_color'											=> '#202020'
				,'ts_special_text_color'									=> '#848484'
				,'ts_heading_color'											=> '#202020'
				,'ts_link_color'											=> '#d43811'
				,'ts_link_color_hover'										=> '#ffb91f'
				,'ts_blockquote_color'										=> '#202020'
				,'ts_blockquote_background_color'							=> '#f3f3f3'
				,'ts_tags_color'											=> '#202020'
				,'ts_tags_background_color'									=> '#f3f3f3'
				,'ts_tags_hover_color'										=> '#202020'
				,'ts_tags_hover_background_color'							=> '#ffb91f'
				,'ts_border_color'											=> '#ebebeb'
				,'ts_input_text_color'										=> '#202020'
				,'ts_input_background_color'								=> '#ffffff'
				,'ts_input_border_color'									=> '#ebebeb'
				
				,'ts_button_text_color'										=> '#202020'
				,'ts_button_background_color'								=> '#ffb91f'
				,'ts_button_border_color'									=> '#ffb91f'
				,'ts_button_text_hover_color'								=> '#ffb91f'
				,'ts_button_background_hover_color'							=> '#202020'
				,'ts_button_border_hover_color'								=> '#202020'
				,'ts_special_button_text_color'								=> '#ffb91f'
				,'ts_special_button_background_color'						=> '#202020'
				,'ts_special_button_border_color'							=> '#202020'
				,'ts_special_button_text_hover_color'						=> '#202020'
				,'ts_special_button_background_hover_color'					=> '#ffb91f'
				,'ts_special_button_border_hover_color'						=> '#ffb91f'
				
				,'ts_breadcrumb_background_color'							=> '#ebebeb'
				,'ts_breadcrumb_text_color'									=> '#202020'
				,'ts_breadcrumb_link_color'									=> '#848484'
				
				,'ts_header_top_text_color'									=> '#ffffff'
				,'ts_header_top_background_color'							=> '#233f92'
				,'ts_header_top_border_color'								=> '#233f92'
				,'ts_header_top_link_hover_color'							=> '#ffb91f'
				,'ts_header_top_strong_color'								=> '#ffb91f'
				,'ts_header_middle_text_color'								=> '#202020'
				,'ts_header_middle_background_color'						=> '#ffffff'
				,'ts_header_middle_border_color'							=> '#ebebeb'
				,'ts_header_middle_link_hover_color'						=> '#ffb91f'
				,'ts_header_icon_count_background_color'					=> '#ffb91f'
				,'ts_header_icon_count_text_color'							=> '#202020'
				,'ts_header_bottom_text_color'								=> '#202020'
				,'ts_header_bottom_background_color'						=> '#ffffff'
				,'ts_header_bottom_border_color'							=> '#ebebeb'
				,'ts_header_bottom_link_hover_color'						=> '#ffb91f'
				,'ts_header_search_color'									=> '#202020'
				,'ts_header_search_background_color'						=> '#f8f8f8'
				,'ts_header_dropdown_color'									=> '#202020'
				,'ts_vertical_menu_heading_background_color'				=> '#202020'
				,'ts_vertical_menu_heading_color'							=> '#ffffff'
				,'ts_header_dropdown_background_color'						=> '#ffffff'
				,'ts_header_dropdown_border_color'							=> '#ffb91f'
				,'ts_header_dropdown_link_hover_color'						=> '#ffb91f'
				
				,'ts_footer_text_color'										=> '#aaaaaa'
				,'ts_footer_heading_color'									=> '#ffffff'
				,'ts_footer_background_color'								=> '#000000'
				,'ts_footer_border_color'									=> '#181818'
				
				,'ts_product_background_color'								=> '#ffffff'
				,'ts_product_text_color'									=> '#202020'
				,'ts_product_price_color'									=> '#233f92'
				,'ts_product_sale_price_color'								=> '#868686'
				,'ts_rating_color'											=> '#c3c3c3'
				,'ts_rating_fill_color'										=> '#ffd200'
				
				,'ts_product_button_thumbnail_text_color'					=> '#202020'
				,'ts_product_button_thumbnail_background_color'				=> '#f0f0f0'
				,'ts_product_button_thumbnail_background_hover_color'		=> '#ffb91f'
				,'ts_product_button_thumbnail_text_hover'					=> '#202020'
				
				,'ts_product_sale_label_text_color'							=> '#ffffff'
				,'ts_product_sale_label_background_color'					=> '#d43811'
				,'ts_product_new_label_text_color'							=> '#ffffff'
				,'ts_product_new_label_background_color'					=> '#202020'
				,'ts_product_feature_label_text_color'						=> '#202020'
				,'ts_product_feature_label_background_color'				=> '#ffb91f'
				,'ts_product_outstock_label_text_color'						=> '#ffffff'
				,'ts_product_outstock_label_background_color'				=> '#d1cfcf'
				
				,'ts_product_group_button_fixed_background_color'			=> '#202020'
				,'ts_product_group_button_fixed_color'						=> '#ffffff'
				,'ts_product_group_button_fixed_border_color'				=> '#202020'
				,'ts_menu_mobile_background_color'							=> '#ffffff'
				,'ts_menu_mobile_text_color'								=> '#202020'				
);

$data = apply_filters('druco_custom_style_data', $data);

foreach( $default_colors as $option_name => $default_color ){
	if( isset($data[$option_name]['rgba']) ){
		$default_colors[$option_name] = $data[$option_name]['rgba'];
	}
	else if( isset($data[$option_name]['color']) ){
		$default_colors[$option_name] = $data[$option_name]['color'];
	}
}

extract( $default_colors );

/* Parse font option. Ex: if option name is ts_body_font, we will have variables below:
* ts_body_font (font-family)
* ts_body_font_weight
* ts_body_font_style
* ts_body_font_size
* ts_body_font_line_height
* ts_body_font_letter_spacing
*/
$font_option_names = array(
							'ts_body_font',
							'ts_body_font_semi',
							'ts_blockquote_font',
							'ts_heading_font',
							'ts_menu_font',
							'ts_vertical_menu_font',
							'ts_vertical_sub_menu_font',
							);
$font_size_option_names = array( 
							'ts_h1_font', 
							'ts_h2_font', 
							'ts_h3_font', 
							'ts_h4_font', 
							'ts_h5_font', 
							'ts_h6_font',
							'ts_product_name_font',
							'ts_product_price_font',
							'ts_button_font',
							'ts_h1_ipad_font', 
							'ts_h2_ipad_font', 
							'ts_h3_ipad_font', 
							'ts_h4_ipad_font',
							'ts_h5_ipad_font',
							'ts_h6_ipad_font',
							'ts_vertical_menu_ipad_font',
							'ts_button_ipad_font',
							);
$font_option_names = array_merge($font_option_names, $font_size_option_names);
foreach( $font_option_names as $option_name ){
	$default = array(
		$option_name 						=> 'inherit'
		,$option_name . '_weight' 			=> 'normal'
		,$option_name . '_style' 			=> 'normal'
		,$option_name . '_size' 			=> 'inherit'
		,$option_name . '_line_height' 		=> 'inherit'
		,$option_name . '_letter_spacing' 	=> 'inherit'
	);
	if( is_array($data[$option_name]) ){
		if( !empty($data[$option_name]['font-family']) ){
			$default[$option_name] = $data[$option_name]['font-family'];
		}
		if( !empty($data[$option_name]['font-weight']) ){
			$default[$option_name . '_weight'] = $data[$option_name]['font-weight'];
		}
		if( !empty($data[$option_name]['font-style']) ){
			$default[$option_name . '_style'] = $data[$option_name]['font-style'];
		}
		if( !empty($data[$option_name]['font-size']) ){
			$default[$option_name . '_size'] = $data[$option_name]['font-size'];
		}
		if( !empty($data[$option_name]['line-height']) ){
			$default[$option_name . '_line_height'] = $data[$option_name]['line-height'];
		}
		if( !empty($data[$option_name]['letter-spacing']) ){
			$default[$option_name . '_letter_spacing'] = $data[$option_name]['letter-spacing'];
		}
	}
	extract( $default );
}
?>	
	
	/*
		I. CUSTOM FONT FAMILY
		II. CUSTOM FONT SIZE
		III. CUSTOM COLOR
	*/
	header .logo img{
		width: <?php echo absint($ts_device_logo_width); ?>px;
	}
	@media only screen and (min-width: 1200px){
		header .logo img{
			width: <?php echo absint($ts_logo_width); ?>px;
		}
	}
	
	/*--------------------------------------------------------
		I. CUSTOM FONT FAMILY
	---------------------------------------------------------*/
	html,
	label,
	body,
	input,
	textarea,
	keygen,
	select,
	button,
	body .font-body,
	blockquote cite,
	blockquote .entry-meta-middle,
	.product-name,
	h3.product-name,
	.product-name h3,
	.yith-wfbt-item .product-name,
	.woocommerce-shipping-fields h3,
	.ts-tiny-cart-wrapper .cart_list li .product-name,
	.woocommerce .ts-tiny-cart-wrapper .product-name,
	.woocommerce table.shop_table td.product-name{
		font-family: <?php echo esc_html($ts_body_font); ?>;
		font-style: <?php echo esc_html($ts_body_font_style); ?>;
		font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
	}
	strong,
	h1,h2,h3,
	h4,h5,h6,
	.h1,.h2,.h3,
	.h4,.h5,.h6,
	.comment-meta .author,
	.comments-area .add-comment .comments-count,
	.hightlight,
	.availability-bar .sold,
	.header-contact-info,
	.attribute-search-heading,
	.vertical-menu-heading,
	.counter-wrapper .number-wrapper,
	.yith-wfbt-submit-block .total_price,
	.summary .quantity > label,
	.ts-product-category-wrapper.style-2.woocommerce .product .category-name h3,
	.woocommerce div.product .summary > .price,
	div.product .summary .availability-bar .sold > span:first-child,
	.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li,
	.single-portfolio .meta-content .portfolio-info > span:first-child,
	.ts-product-category-wrapper.style-3 .product .category-name > h3,
	.woocommerce div.product .woocommerce-tabs ul.tabs,
	#review_form_wrapper .comment-reply-title,
	html body > h1{
		font-family: <?php echo esc_html($ts_heading_font); ?>;
		font-style: <?php echo esc_html($ts_heading_font_style); ?>;
		font-weight: <?php echo esc_html($ts_heading_font_weight); ?>;
	}
	.ts-testimonial-wrapper blockquote .author,
	.ts-portfolio-wrapper a.like,
	.single-portfolio .portfolio-like,
	.price, 
	.products .meta-wrapper > .price,
	.woocommerce-grouped-product-list-item__price,
	.wishlist_table li .item-details table.item-details-table .amount.woocommerce-Price-amount,
	.woocommerce table.shop_table .amount.woocommerce-Price-amount,
	.column-tabs .list-categories ul.tabs li,
	.ts-product-category-wrapper.style-3 .product .category-name > .count,
	#group-icon-header .tab-mobile-menu li,
	.cart_list li .subtotal,
	.ts-tiny-cart-wrapper .total > span.amount,
	.widget_shopping_cart .total .amount, 
	.elementor-widget-wp-widget-woocommerce_widget_cart .total .amount,
	.ts-tiny-cart-wrapper .total > span.total-title, 
	.widget_shopping_cart .total-title, 
	.woocommerce .widget_shopping_cart .total strong, 
	.woocommerce.widget_shopping_cart .total strong, 
	.elementor-widget-wp-widget-woocommerce_widget_cart .total strong,
	.header-note,
	ul.filter-bar,
	.button,
	a.button,
	button,
	.ts-button,
	input[type^="submit"],
	.shopping-cart p.buttons a,
	a.wp-block-button__link,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce-page a.button,
	.woocommerce-page button.button,
	.woocommerce-page input.button,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce-page a.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce-page input.button.alt,
	.woocommerce #respond input#submit, 
	.yith-woocompare-widget a.clear-all,
	.yith-woocompare-widget a.compare,
	.elementor-button-wrapper .elementor-button,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare,
	div.product .summary .meta-content > div > span:first-child,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.woocommerce-account .woocommerce-MyAccount-navigation ul li,
	.ts-portfolio-wrapper .portfolio-meta .heading-title,
	div.button a,
	input[type="submit"].dokan-btn, 
	a.dokan-btn, 
	.dokan-btn,
	.entry-author .author-info .author,
	.entry-author .author-info .role,
	.wishlist_table .product-add-to-cart a,
	body .woocommerce table.compare-list .add-to-cart td a,
	.woocommerce .woocommerce-error .button,
	.woocommerce .woocommerce-info .button,
	.woocommerce .woocommerce-message .button,
	.woocommerce-page .woocommerce-error .button,
	.woocommerce-page .woocommerce-info .button,
	.woocommerce-page .woocommerce-message .button{
		font-family: <?php echo esc_html($ts_body_font_semi); ?>;
		font-style: <?php echo esc_html($ts_body_font_semi_style); ?>;
		font-weight: <?php echo esc_html($ts_body_font_semi_weight); ?>;
	}
	body blockquote{
		font-family: <?php echo esc_html($ts_blockquote_font); ?>;
		font-style: <?php echo esc_html($ts_blockquote_font_style); ?>;
		font-weight: <?php echo esc_html($ts_blockquote_font_weight); ?>;
	}
	.ts-header nav > ul.menu > li > a, 
	.ts-header nav > ul > li > a{
		font-family: <?php echo esc_html($ts_menu_font); ?>;
		font-style: <?php echo esc_html($ts_menu_font_style); ?>;
		font-weight: <?php echo esc_html($ts_menu_font_weight); ?>;
	}
	/*--------------------------------------------------------
		II. CUSTOM FONT SIZE
	---------------------------------------------------------*/
	html,
	body,
	html body > h1,
	.woocommerce-shipping-fields h3,
	.product-group-button .button-tooltip,
	.shortcode-heading-wrapper .counter-wrapper .ref-wrapper{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
		line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_body_font_letter_spacing); ?>
	}
	.ts-testimonial-wrapper blockquote{
		font-size: <?php echo esc_html($ts_body_font_size); ?> !important;
		line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_body_font_letter_spacing); ?>
	}
	.counter-wrapper .ref-wrapper,
	.column-tabs .list-categories ul.tabs li,
	.ts-product-filter-by-attribute select,
	.attribute-search-wrapper .ts-product-filter-by-attribute select,
	.ts-list-of-product-categories-wrapper.columns-1 .list-categories ul li,
	.single-portfolio .portfolio-content,
	.single-post > .entry-content > .content-wrapper,
	.ts-product-category-wrapper.style-3 .product .category-name > .count{
		font-size: <?php echo esc_html( absint($ts_body_font_size) + 1 ) . 'px'; ?>;
	}
	.ts-megamenu .ts-list-of-product-categories-wrapper.columns-1 .list-categories ul li{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
	}
	.meta-wrapper .counter-wrapper .ref-wrapper{
		font-size: <?php echo esc_html( absint($ts_body_font_size) - 3 ) . 'px'; ?>;
	}
	select,
	textarea,
	html input[type="search"],
	html input[type="text"],
	html input[type="email"],
	html input[type="password"],
	html input[type="date"],
	html input[type="number"],
	html input[type="tel"],
	.woocommerce .quantity input.qty, 
	.quantity input.qty,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	body .select2-container--default .select2-selection--single,
	body .select2-dropdown,
	body .select2-container--default .select2-selection--single,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	.woocommerce form .form-row.woocommerce-validated .select2-container,
	.woocommerce form .form-row.woocommerce-validated input.input-text,
	.woocommerce form .form-row.woocommerce-validated select,
	body .select2-container--default .select2-selection--multiple,
	body .select2-container--default .select2-selection--single .select2-selection__rendered{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
	}
	::-webkit-input-placeholder{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
	}
	:-moz-placeholder{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
	}
	::-moz-placeholder{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
	}
	:-ms-input-placeholder{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
	}
	a.button,
	button, 
	input[type^="submit"], 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,  
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,  
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	.woocommerce #respond input#submit, 
	.woocommerce #respond input#submit.loading,
	.woocommerce a.button.loading,
	.woocommerce button.button.loading,
	.woocommerce input.button.loading,
	.elementor-button-wrapper .elementor-button,
	.shopping-cart p.buttons a,
	a.wp-block-button__link,
	.wp-block-search .wp-block-search__button,
	input[type="submit"].dokan-btn, 
	.wishlist_table .product-add-to-cart a,
	a.dokan-btn, 
	.dokan-btn,
	#comments .wcpr-filter-button,
	.yith-woocompare-widget a.clear-all,
	.yith-woocompare-widget a.compare,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare,
	body table.compare-list .add-to-cart td a:not(.unstyled_button),
	.ts-header nav > ul.menu > li.button > a, 
	.ts-header nav > ul > li.button > a,
	#ts-search-sidebar.full-width .ts-search-result-container .view-all-wrapper a{
		font-size: <?php echo esc_html($ts_button_font_size); ?>;
	}
	body blockquote{
		font-size: <?php echo esc_html($ts_blockquote_font_size); ?>;
	}
	.ts-header nav > ul.menu > li > a, 
	.ts-header nav > ul > li > a{
		font-size: <?php echo esc_html($ts_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_menu_font_letter_spacing); ?>;
	}
	.ts-header .vertical-menu-wrapper .vertical-menu ul.menu > li > a,
	.ts-header .vertical-menu-wrapper .vertical-menu ul.sub-menu > li > a{
		font-size: <?php echo esc_html($ts_vertical_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_vertical_menu_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_vertical_menu_font_letter_spacing); ?>;
	}
	.ts-header nav > ul.menu li ul.sub-menu{
		font-size: <?php echo esc_html($ts_vertical_sub_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_vertical_sub_menu_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_vertical_sub_menu_font_letter_spacing); ?>;
	}
	.vertical-menu-heading,
	.attribute-search-heading{
		font-size: <?php echo esc_html( absint($ts_vertical_menu_font_size) + 2 ) . 'px'; ?>;
		letter-spacing: <?php echo esc_html($ts_vertical_menu_font_letter_spacing); ?>;
	}
	.ts-product-category-wrapper.style-3 .product .category-name > h3{
		font-size: <?php echo esc_html( absint($ts_h1_font_size) - 3 ) . 'px'; ?>;
	}
	/*** Heading ***/
	h1, .h1,
	.h1 .elementor-heading-title,
	.entry-header header > .entry-title,
	.shortcode-heading-wrapper .banner-bg .counter-wrapper .number-wrapper,
	.shortcode-heading-wrapper .banner-bg .counter-wrapper .dots{
		font-size: <?php echo esc_html($ts_h1_font_size); ?>;
		line-height: <?php echo esc_html($ts_h1_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_h1_font_letter_spacing); ?>;
	}
	h2, .h2,
	.h2 .elementor-heading-title,
	.breadcrumb-title-wrapper .page-title,
	.woocommerce-billing-fields > h3,
	.yith-wfbt-section > h3,
	.yith-wfbt-submit-block .total_price,
	body.error404 .not-found h1,
	.counter-wrapper .number-wrapper,
	.counter-wrapper .dots,
	.ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .number-wrapper, 
	.ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .dots,
	.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li,
	.single-portfolio .entry-header .entry-title,
	.ts-shortcode .shortcode-heading-wrapper .shortcode-title{
		font-size: <?php echo esc_html($ts_h2_font_size); ?>;
		line-height: <?php echo esc_html($ts_h2_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_h2_font_letter_spacing); ?>;
	}
	h3, .h3, 
	.h3 .elementor-heading-title,
	.list-posts article .entry-title,
	.theme-title .heading-title, 
	.comments-title .heading-title,
	#comment-wrapper .heading-title,
	.comments-area .add-comment .comments-count,
	#commentform .form-submit,
	.woocommerce div.product .summary .product_title,
	.woocommerce div.product .summary p.price, 
	.woocommerce div.product .summary span.price,
	.layout-fullwidth .elementor-widget .elementor-widget-container > h5,
	.main-content-fullwidth .elementor-widget .elementor-widget-container > h5,
	#reviews .woocommerce-Reviews-title,
	.cart-collaterals .cart_totals > h2,
	.ts-product-filter-by-attribute > h2{
		font-size: <?php echo esc_html($ts_h3_font_size); ?>;
		line-height: <?php echo esc_html($ts_h3_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_h3_font_letter_spacing); ?>;
	}
	h4, .h4,
	.h4 .elementor-heading-title,
	.blog-template .widget-container .widget-title-wrapper .widget-title,
	.blog-template .widget-container .widget-title-wrapper .widgettitle,
	.single-post .widget-container .widget-title-wrapper .widget-title,
	.single-post .widget-container .widget-title-wrapper .widgettitle,
	.shortcode-heading-wrapper .counter-wrapper .number-wrapper,
	.shortcode-heading-wrapper .counter-wrapper .dots,
	.ts-list-of-product-categories-wrapper h3.heading-title,
	.woocommerce div.product .woocommerce-tabs ul.tabs,
	.ts-product-filter-by-attribute.horizontal > h2,
	#review_form_wrapper .comment-reply-title,
	.yith-wfbt-submit-block .total_price_label,
	.commentlist li #comment-wrapper .heading-title,
	.widget-container .wp-block-group h2{
		font-size: <?php echo esc_html($ts_h4_font_size); ?>;
		line-height: <?php echo esc_html($ts_h4_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_h4_font_letter_spacing); ?>;
	}
	h5, .h5,
	.h5 .elementor-heading-title,
	.woocommerce-account .woocommerce-MyAccount-navigation ul li,
	.ts-portfolio-wrapper .portfolio-meta .heading-title,
	.woocommerce-account .addresses .title h3, 
	.woocommerce-account .addresses h2, 
	.woocommerce-customer-details .addresses h2,
	.ts-blogs article .entry-title,
	.columns-2 .list-posts article .entry-title,
	.related-portfolios .heading-title,
	.ts-portfolio-wrapper.ts-slider .heading-title,
	.ts-blogs-widget-wrapper .heading-title,
	.ts-blogs-widget-wrapper .post-title{
		font-size: <?php echo esc_html($ts_h5_font_size); ?>;
		line-height: <?php echo esc_html($ts_h5_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_h5_font_letter_spacing); ?>;
	}
	h6, .h6,
	.h6 .elementor-heading-title,
	.ts-team-members .team-info .name,
	.widget-container .widget-title-wrapper .widget-title,
	.widget-container .widget-title-wrapper .widgettitle,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	#ts-search-sidebar .ts-search-by-category > h2,
	div.product .summary #reviews .woocommerce-Reviews-title,
	.woocommerce div.product .summary #review_form_wrapper .comment-reply-title,
	.meta-wrapper .counter-wrapper .number-wrapper,
	.meta-wrapper .counter-wrapper .dots,
	.comment-meta .author{
		font-size: <?php echo esc_html($ts_h6_font_size); ?>;
		line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
		letter-spacing: <?php echo esc_html($ts_h6_font_letter_spacing); ?>;
	}
	.ts-product-category-wrapper.title-left .shortcode-heading-wrapper .shortcode-title{
		font-size: <?php echo esc_html( absint($ts_h2_font_size) + 4 ) . 'px'; ?>;
	}
	.header-contact-info{
		font-size: <?php echo esc_html( absint($ts_h4_font_size) - 2 ) . 'px'; ?>;
	}
	.product-name, 
	h3.product-name, 
	.product-name h3{
		font-size: <?php echo esc_html($ts_product_name_font_size); ?>;
	}
	.price, 
	.products .meta-wrapper > .price,
	.woocommerce-grouped-product-list-item__price,
	.woocommerce table.shop_table .product-price .amount,
	.woocommerce table.shop_table .product-subtotal .amount,
	.cart-collaterals .cart_totals table .cart-subtotal .amount,
	.cart-collaterals .cart_totals table .order-total .amount{
		font-size: <?php echo esc_html($ts_product_price_font_size); ?>;
	}
	.ts-product-brand-wrapper .meta-wrapper h3,
	.woocommerce .product .category-name h3,
	.ts-shortcode .shortcode-heading-wrapper .sub-title{
		font-size: <?php echo esc_html( absint($ts_product_name_font_size) + 2 ) . 'px'; ?>;
	}
	
	@media only screen and (max-width: 1600px){
		.ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .number-wrapper, 
		.ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .dots{
			font-size: <?php echo esc_html($ts_h3_font_size); ?>;
		}
	}
	@media only screen and (max-width: 1279px){
		h1, .h1,
		.h1 .elementor-heading-title,
		.entry-header header > .entry-title,
		.shortcode-heading-wrapper .banner-bg .counter-wrapper .number-wrapper,
		.shortcode-heading-wrapper .banner-bg .counter-wrapper .dots{
			font-size: <?php echo esc_html($ts_h1_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h1_ipad_font_line_height); ?>;
			letter-spacing: <?php echo esc_html($ts_h1_ipad_font_letter_spacing); ?>;
		}
		h2, .h2,
		.h2 .elementor-heading-title,
		.breadcrumb-title-wrapper .page-title,
		.woocommerce-billing-fields > h3,
		.yith-wfbt-section > h3,
		body.error404 .not-found h1,
		.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li,
		.ts-product-category-wrapper.style-3 .product .category-name > h3,
		.single-portfolio .entry-header .entry-title,
		.ts-product-category-wrapper.title-left .shortcode-heading-wrapper .shortcode-title,
		.ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .number-wrapper, 
		.ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .dots,
		.ts-shortcode .shortcode-heading-wrapper .shortcode-title{
			font-size: <?php echo esc_html($ts_h2_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h2_ipad_font_line_height); ?>;
			letter-spacing: <?php echo esc_html($ts_h2_ipad_font_letter_spacing); ?>;
		}
		h3, .h3, 
		.h3 .elementor-heading-title,
		.list-posts article .entry-title,
		.theme-title .heading-title, 
		.comments-title .heading-title,
		#comment-wrapper .heading-title,
		.comments-area .add-comment .comments-count,
		#commentform .form-submit,
		.woocommerce div.product .summary .product_title,
		.woocommerce div.product .summary p.price, 
		.woocommerce div.product .summary span.price,
		.layout-fullwidth .elementor-widget .elementor-widget-container > h5,
		.main-content-fullwidth .elementor-widget .elementor-widget-container > h5,
		.elementor-col-50 .ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .number-wrapper, 
		.elementor-col-50 .ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .dots,
		#reviews .woocommerce-Reviews-title,
		.cart-collaterals .cart_totals > h2,
		.yith-wfbt-submit-block .total_price,
		.ts-product-filter-by-attribute > h2{
			font-size: <?php echo esc_html($ts_h3_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h3_ipad_font_line_height); ?>;
			letter-spacing: <?php echo esc_html($ts_h3_ipad_font_letter_spacing); ?>;
		}
		h4, .h4,
		.h4 .elementor-heading-title,
		.ts-blogs article .entry-title,
		.columns-2 .list-posts article .entry-title,
		.blog-template .widget-container .widget-title-wrapper .widget-title,
		.blog-template .widget-container .widget-title-wrapper .widgettitle,
		.single-post .widget-container .widget-title-wrapper .widget-title,
		.single-post .widget-container .widget-title-wrapper .widgettitle,
		.ts-list-of-product-categories-wrapper h3.heading-title,
		#review_form_wrapper .comment-reply-title,
		.ts-product-filter-by-attribute.horizontal > h2,
		.commentlist li #comment-wrapper .heading-title,
		.widget-container .wp-block-group h2{
			font-size: <?php echo esc_html($ts_h4_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h4_ipad_font_line_height); ?>;
			letter-spacing: <?php echo esc_html($ts_h4_ipad_font_letter_spacing); ?>;
		}
		h5, .h5,
		.h5 .elementor-heading-title,
		.related-portfolios .heading-title,
		.ts-portfolio-wrapper .portfolio-meta .heading-title,
		.woocommerce div.product .woocommerce-tabs ul.tabs,
		.woocommerce-account .addresses .title h3, 
		.woocommerce-account .addresses h2, 
		.woocommerce-customer-details .addresses h2,
		.ts-portfolio-wrapper.ts-slider .heading-title,
		.ts-blogs-widget-wrapper .heading-title,
		.ts-blogs-widget-wrapper .post-title{
			font-size: <?php echo esc_html($ts_h5_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h5_ipad_font_line_height); ?>;
			letter-spacing: <?php echo esc_html($ts_h5_ipad_font_letter_spacing); ?>;
		}
		h6, .h6,
		.h6 .elementor-heading-title,
		.ts-team-members .team-info .name,
		.widget-container .widget-title-wrapper .widget-title,
		.widget-container .widget-title-wrapper .widgettitle,
		.woocommerce-account .woocommerce-MyAccount-navigation ul li,
		.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
		#ts-search-sidebar .ts-search-by-category > h2,
		.yith-wfbt-submit-block .total_price_label,
		.comment-meta .author{
			font-size: <?php echo esc_html($ts_h6_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h6_ipad_font_line_height); ?>;
			letter-spacing: <?php echo esc_html($ts_h6_ipad_font_letter_spacing); ?>;
		}
		.ts-product-filter-by-attribute select,
		.attribute-search-wrapper .ts-product-filter-by-attribute select,
		.ts-list-of-product-categories-wrapper.columns-1 .list-categories ul li,
		.ts-product-category-wrapper.style-3 .product .category-name > .count{
			font-size: <?php echo esc_html($ts_body_font_size); ?>;
		}
		.header-contact-info{
			font-size: <?php echo esc_html($ts_h6_ipad_font_size); ?>;
		}
		a.button,
		button, 
		input[type^="submit"], 
		.woocommerce a.button, 
		.woocommerce button.button, 
		.woocommerce input.button,  
		.woocommerce a.button.alt, 
		.woocommerce button.button.alt, 
		.woocommerce input.button.alt,  
		.woocommerce a.button.disabled, 
		.woocommerce a.button:disabled, 
		.woocommerce a.button:disabled[disabled], 
		.woocommerce button.button.disabled, 
		.woocommerce button.button:disabled, 
		.woocommerce button.button:disabled[disabled], 
		.woocommerce input.button.disabled, 
		.woocommerce input.button:disabled, 
		.woocommerce input.button:disabled[disabled],
		.woocommerce #respond input#submit, 
		.woocommerce #respond input#submit.loading,
		.woocommerce a.button.loading,
		.woocommerce button.button.loading,
		.woocommerce input.button.loading,
		.elementor-button-wrapper .elementor-button,
		.shopping-cart p.buttons a,
		a.wp-block-button__link,
		.wp-block-search .wp-block-search__button,
		input[type="submit"].dokan-btn, 
		.wishlist_table .product-add-to-cart a,
		a.dokan-btn, 
		.dokan-btn,
		#comments .wcpr-filter-button,
		.yith-woocompare-widget a.clear-all,
		.yith-woocompare-widget a.compare,
		.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
		.elementor-widget-wp-widget-yith-woocompare-widget a.compare,
		body table.compare-list .add-to-cart td a:not(.unstyled_button),
		.ts-header nav > ul.menu > li.button > a, 
		.ts-header nav > ul > li.button > a,
		#ts-search-sidebar.full-width .ts-search-result-container .view-all-wrapper a{
			font-size: <?php echo esc_html($ts_button_ipad_font_size); ?>;
		}
		.ts-header .vertical-menu-wrapper .vertical-menu ul.menu > li > a,
		.ts-header .vertical-menu-wrapper .vertical-menu ul.sub-menu > li > a{
			font-size: <?php echo esc_html($ts_vertical_menu_ipad_font_size); ?>;
		}
		.column-tabs .list-categories ul.tabs li{
			font-size: <?php echo esc_html($ts_body_font_size); ?>;
		}
	}
	@media only screen and (max-width: 991px){
		.elementor-col-50 .ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .number-wrapper, 
		.elementor-col-50 .ts-product.columns-1.layout-grid .meta-wrapper .counter-wrapper .dots{
			font-size: <?php echo esc_html($ts_h4_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h4_ipad_font_line_height); ?>;
			letter-spacing: <?php echo esc_html($ts_h4_ipad_font_letter_spacing); ?>;
		}
	}
	@media only screen and (max-width: 767px){
		.ts-product-in-product-type-tab-wrapper .column-tabs ul.tabs li{
			font-size: <?php echo esc_html($ts_h3_ipad_font_size); ?>;
		}
	}
	/*--------------------------------------------------------
		III. CUSTOM COLOR
	---------------------------------------------------------*/
	/*** Background Content Color ***/
	body #main,
	body.dokan-store #main:before,
	#cboxLoadedContent,
	form.checkout div.create-account,
	.ts-popup-modal .popup-container,
	#yith-wcwl-popup-message,
	.dataTables_wrapper,
	body > .compare-list,
	div.product .single-navigation a .product-info,
	.single-navigation > div .product-info:before,
	.archive.ajax-pagination .woocommerce > .products:after,
	.dropdown-container ul.cart_list li.loading:before,
	.thumbnail-wrapper .button-in.wishlist > a.loading:before,
	.meta-wrapper .button-in.wishlist > a.loading:before,
	.wishlist_table .product-add-to-cart a.add_to_cart.loading:before,
	body .woocommerce table.compare-list .add-to-cart td a.loading:before,
	.woocommerce a.button.loading:before,
	.woocommerce button.button.loading:before,
	.woocommerce input.button.loading:before,
	div.blockUI.blockOverlay:before,
	.woocommerce .blockUI.blockOverlay:before,
	.ts-floating-sidebar .ts-sidebar-content,
	.mobile-menu-wrapper ul.sub-menu,
	.ts-team-members .team-info,
	.mobile-menu-wrapper li.active .ts-menu-drop-icon.active,
	.woocommerce .woocommerce-ordering .orderby ul:before,
	.product-per-page-form ul.perpage ul:before,
	.ts-product.list .products:before,
	.ts-product.list .products:after,
	.woocommerce.main-products.list:before,
	.woocommerce.main-products.list:after{
		background-color: <?php echo esc_html($ts_main_content_background_color); ?>;
	}
	@media only screen and (max-width: 767px){
		body.woocommerce.archive #left-sidebar,
		body.woocommerce.archive #right-sidebar{
			background-color: <?php echo esc_html($ts_main_content_background_color); ?>;
		}
	}
	<?php if( strpos($ts_main_content_background_color, 'rgba') !== false ): ?>
	.more-less-buttons > a.more-button:after {
		background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0,<?php echo esc_html(str_replace('1)', '0)', esc_html($ts_main_content_background_color))); ?>),to(<?php echo esc_html($ts_main_content_background_color); ?>));
		background-image: -o-linear-gradient(linear,left top,left bottom,color-stop(0,<?php echo esc_html(str_replace('1)', '0)', esc_html($ts_main_content_background_color))); ?>),to(<?php echo esc_html($ts_main_content_background_color); ?>));
		background-image: linear-gradient(to bottom,<?php echo esc_html(str_replace('1)', '0)', esc_html($ts_main_content_background_color))); ?> 0,<?php echo esc_html($ts_main_content_background_color); ?> 100%);
	}
	.ts-team-members .team-info{
		background-color: <?php echo esc_html(str_replace('1)', '0.9)', esc_html($ts_main_content_background_color))); ?>;
	}
	<?php endif; ?>
	.social-icons .ts-tooltip,
	.ts-portfolio-wrapper a.like,
	.single-portfolio .portfolio-like,
	.tags-link a,
	.wp-block-tag-cloud a,
	.tagcloud a{
		background-color: <?php echo esc_html($ts_tags_background_color); ?>;
		color: <?php echo esc_html($ts_tags_color); ?>;
	}
	.social-icons .ts-tooltip:before{
		color: <?php echo esc_html($ts_tags_background_color); ?>;
	}
	.ts-portfolio-wrapper .item-wrapper a.like:hover,
	.tags-link a:hover,
	.wp-block-tag-cloud a:hover,
	.tagcloud a:hover{
		background-color: #ffb91f;
		color: #202020;
		background-color: <?php echo esc_html($ts_tags_hover_background_color); ?>;
		color: <?php echo esc_html($ts_tags_hover_color); ?>;
	}
	.has-post-thumbnail .entry-meta-top .date-time,
	.has-post-thumbnail .entry-meta-top .date-time,
	.ts-portfolio-wrapper .item-wrapper .portfolio-thumbnail + .portfolio-meta .date-time{
		background-color: <?php echo esc_html($ts_main_content_background_color); ?>;
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	.entry-author,
	body blockquote{
		background-color: <?php echo esc_html($ts_blockquote_background_color); ?>;
		color: <?php echo esc_html($ts_blockquote_color); ?>;
	}
	/*** Body Text Color ***/
	body,
	body table.compare-list,
	body .ts-header .dropdown-container,
	.wcml_currency_switcher > ul, 
	.wpml-ls-legacy-dropdown ul.wpml-ls-sub-menu,
	.wpml-ls-item-legacy-dropdown-click ul.wpml-ls-sub-menu,
	body.header-transparent.header-text-light .dropdown-container,
	body.header-transparent.header-text-light .header-currency ul,
	body.header-transparent.header-text-light .wpml-ls-legacy-dropdown .wpml-ls-sub-menu, 
	body.header-transparent.header-text-light .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu, 
	footer#colophon .wcml_currency_switcher > ul, 
	footer#colophon .wpml-ls-legacy-dropdown ul.wpml-ls-sub-menu, 
	footer#colophon .wpml-ls-item-legacy-dropdown-click ul.wpml-ls-sub-menu,
	.entry-meta-top .author a,
	.entry-meta-middle .author a,
	.comment-meta .date-time,
	.woocommerce #reviews ol.commentlist li .woocommerce-review__author,
	.gridlist-toggle > span:hover,
	.gridlist-toggle > span.active,
	#ivole-histogramTable tr.ivole-histogramRow,
	body table.compare-list tr.remove td > a,
	.button-text:not(.ts-banner):not(.elementor-widget-button),
	.elementor-widget-button.button-text .elementor-button,
	.elementor-widget-button.button-text .elementor-button:hover,
	.post-nav-links > a, 
	.post-nav-links > span,
	.woocommerce .woocommerce-error .button,
	.woocommerce .woocommerce-info .button,
	.woocommerce .woocommerce-message .button,
	.woocommerce-page .woocommerce-error .button,
	.woocommerce-page .woocommerce-info .button,
	.woocommerce-page .woocommerce-message .button{
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	.cats-portfolio a,
	.ts-portfolio-wrapper .portfolio-meta .cats-portfolio a,
	.ts-social-sharing ul li a:hover,
	.entry-meta-top .cats-link{
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	.ul-style li:before,
	.entry-meta-top,
	.entry-author .author-info p,
	.widget_rss .rss-date,
	ul.product_list_widget li .product-brands,
	ul.product_list_widget li .product-brands a,
	ul.product_list_widget li .product-categories,
	ul.product_list_widget li .product-categories a,
	.woocommerce ul.product_list_widget li .product-brands a,
	.woocommerce ul.product_list_widget li .product-categories a,
	body.search.search-no-results .alert, 
	.woocommerce.archive #primary > .woocommerce-info,
	.ts-testimonial-wrapper.text-light blockquote .content,
	.ts-team-members .team-info .member-role,
	.woocommerce form .form-row label,
	.products .product .product-brands,
	.products .product .product-categories,
	.products .meta-wrapper .short-description,
	.ts-testimonial-wrapper blockquote,
	.woocommerce div.product form.cart .variations .label .ts-value,
	.lost_password a,
	.ts-product-filter-by-attribute select,
	.attribute-search-wrapper .ts-product-filter-by-attribute select,
	.widget-container ul li .count, 
	.elementor-widget[data-widget_type*="wp-widget-"] ul li .count,
	.woocommerce .widget_rating_filter ul li a,
	.ts-product-brand-wrapper .meta-wrapper h3 .count,
	.my-account-wrapper .dropdown-container .form-content .login-remember label,
	.ts-product-category-wrapper.woocommerce.style-2 .product .count,
	.list-posts article .entry-summary, 
	.ts-blogs article .entry-summary{
		color: <?php echo esc_html($ts_special_text_color); ?>;
	}
	a,
	.elementor-widget-text-editor table a,
	.woocommerce-error a:not(.button), 
	.woocommerce-info a:not(.button), 
	.woocommerce-message a:not(.button){
		color: <?php echo esc_html($ts_link_color); ?>;
	}
	a:hover,
	.lost_password a:hover,
	.elementor-widget-text-editor table a:hover,
	.woocommerce-error a:not(.button):hover, 
	.woocommerce-info a:not(.button):hover, 
	.woocommerce-message a:not(.button):hover,
	.portfolio-info .cat-links a:hover,
	.widget_categories > ul li > a:hover,
	.widget_archive li > a:hover,
	.widget_nav_menu li > a:hover,
	.widget_pages li > a:hover,
	.widget_meta li > a:hover,
	.widget_recent_comments li > a:hover,
	.widget_recent_entries li > a:hover,
	.widget_rss li > a:hover,
	.ts-blogs-widget .entry-content a:hover,
	.entry-meta-top .author a:hover,
	ul.product_list_widget li a:not(.button):hover, 
	.product .meta-wrapper .product-name a:hover,
	.woocommerce div.product div.summary .yith-wcwl-add-to-wishlist a:hover,
	.product .meta-wrapper .product-categories a:hover,
	.product .meta-wrapper a:not(.button):not(.elementor-button):hover,
	ul.product_list_widget li .product-brands a:hover,
	ul.product_list_widget li .product-categories a:hover,
	.woocommerce ul.product_list_widget li .product-brands a:hover,
	.woocommerce ul.product_list_widget li .product-categories a:hover,
	.woocommerce ul.cart_list li a:hover, 
	.store-cat-stack-dokan ul li:hover > a,
	.ts-header .vertical-menu-wrapper .vertical-menu ul.menu > li:hover > a,
	.ts-header .vertical-menu-wrapper .vertical-menu ul.sub-menu > li:hover > a,
	.vertical-menu > ul >  li:hover > .ts-menu-drop-icon:after,
	.woocommerce ul.product_list_widget li a:not(.button):hover,
	.elementor-widget-button.button-text .elementor-button:hover,
	.product-category:hover .meta-wrapper a:not(.button):not(.elementor-button),
	.woocommerce-product-rating .woocommerce-review-link:hover,
	.woocommerce div.product .summary .woocommerce-product-rating .woocommerce-review-link:hover,
	.widget_categories > ul li.current-cat > a,
	.woocommerce div.product .summary .product-brands a:hover,
	.woocommerce div.product .summary .cat-links a:hover,
	.woocommerce div.product .summary .tag-links a:hover,
	.ts-product-category-wrapper .product:not(.product-category) .category-name a:hover,
	.woocommerce.yith-wfbt-section .yith-wfbt-form .yith-wfbt-items a:hover,
	.elementor-widget[data-widget_type*="wp-widget-"] ul li a:not(.button):hover,
	.summary .single-product-buttons .yith-wcwl-add-to-wishlist a:hover,
	.summary .single-product-buttons a.compare:hover,
	.comments-area .add-comment > a:hover,
	.commentlist li.comment .comment-actions a:hover,
	.woocommerce ul.product_list_widget li a.title:hover,
	.product-per-page-form ul.perpage .perpage-current > span:last-child:hover,
	.woocommerce .woocommerce-ordering .orderby-current:hover,
	.woocommerce .woocommerce-ordering ul li a:hover, 
	.product-per-page-form ul.perpage ul li a:hover{
		color: <?php echo esc_html($ts_link_color_hover); ?>;
	}
	/*** Primary Color ***/
	#to-top a,
	.filter-widget-area-button > a,
	.dropdown-container .theme-title span, 
	.header-bottom .header-contact-info,
	.search-table .search-button,
	.woocommerce-product-search button[type="submit"],
	.column-tabs .list-categories ul.tabs li:hover,
	.column-tabs .list-categories ul.tabs li.current,
	.ts-product-deals-wrapper .counter-wrapper,
	.woocommerce div.product .summary .counter-wrapper,
	#group-icon-header .tab-mobile-menu li.active,
	#group-icon-header .no-tab .menu-title,
	.no-tab .mobile-menu-wrapper nav > ul > li.active > .ts-menu-drop-icon.active,
	.ts-blogs.related .swiper .swiper-button-prev:hover,
	.ts-blogs.related .swiper .swiper-button-next:hover,
	.group-button-header > .meta-bottom:last-child,
	.ts-product-video-button:hover,
	.ts-product-360-button:hover,
	.ts-pagination ul li a:hover,
	.ts-pagination ul li span.current,
	.pagination-wrap ul.pagination > li > a:hover,
	.pagination-wrap ul.pagination > li > span.current,
	.dokan-pagination-container .dokan-pagination li a:hover,
	.woocommerce nav.woocommerce-pagination ul li a:hover, 
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.post-nav-links > .current, 
	.post-nav-links > a:hover, 
	.post-nav-links > a:focus,
	.ts-list-of-product-categories-wrapper.has-border .list-categories ul li a:hover{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	#to-top a:hover,
	.search-table .search-button:hover,
	.woocommerce-product-search button[type="submit"]:hover{
		background-color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
		color: <?php echo esc_html($ts_primary_color); ?>;
	}
	<?php if( strpos($ts_text_color_in_bg_primary, 'rgba') !== false ): ?>
	.search-table .search-button:after{
		border-color: <?php echo esc_html(str_replace('1)', '0.3)', esc_html($ts_text_color_in_bg_primary))); ?>;
		border-top-color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}
	<?php endif; ?>
	<?php if( strpos($ts_primary_color, 'rgba') !== false ): ?>
	.search-table .search-button:hover:after{
		border-color: <?php echo esc_html(str_replace('1)', '0.3)', esc_html($ts_primary_color))); ?>;
		border-top-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	<?php endif; ?>
	<?php if( strpos($ts_primary_color, 'rgba') !== false ): ?>
	#primary > .list-categories{
		background: <?php echo esc_html(str_replace('1)', '0.15)', esc_html($ts_primary_color))); ?>;
	}
	<?php endif; ?>
	body #cboxClose:hover,
	.ts-floating-sidebar .close:hover,
	.ts-popup-modal .close:hover,
	.cart_list li a.remove:hover,
	.woocommerce .widget_shopping_cart .cart_list li a.remove:hover, 
	.woocommerce.widget_shopping_cart .cart_list li a.remove:hover,
	body table.compare-list .remove td a .remove:hover,
	.woocommerce-cart .woocommerce .cart-collaterals, 
	.woocommerce-checkout #order_review,
	.woocommerce > form.checkout #order_review_heading,
	.ts-product-deals-wrapper.style-2 .content-wrapper:before,
	#page div.product .woocommerce-tabs ul.tabs li:after,
	.woocommerce-account .woocommerce-MyAccount-navigation ul li:after,
	.woocommerce table.shop_table .product-remove a:hover,
	.woocommerce-account .addresses .title .edit:hover,
	.border-primary .products .product:not(.product-category) .product-wrapper,
	.ts-list-of-product-categories-wrapper.has-border .list-categories ul li a:hover,
	.list-posts article.sticky .entry-content,
	#primary > .list-categories,
	.ts-product-video-button:hover,
	.ts-product-360-button:hover,
	.style-tabs-vertical:not(.style-tabs-vertical-banner) .column-tabs .list-categories ul.tabs li:hover,
	.style-tabs-vertical:not(.style-tabs-vertical-banner) .column-tabs .list-categories ul.tabs li.current{
		border-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.primary-color,
	body.error404 .not-found > i,
	body #cboxClose:hover,
	.ts-floating-sidebar .close:hover,
	.ts-popup-modal .close:hover,
	.cart_list li a.remove:hover,
	.woocommerce .widget_shopping_cart .cart_list li a.remove:hover, 
	.woocommerce.widget_shopping_cart .cart_list li a.remove:hover,
	body table.compare-list .remove td a .remove:hover,
	.woocommerce #reviews ol.commentlist li .woocommerce-review__published-date,
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a,
	.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
	.shortcode-heading-wrapper .banner-bg .counter-wrapper .number-wrapper,
	.shortcode-heading-wrapper .banner-bg .counter-wrapper .dots,
	.woocommerce table.shop_table .product-remove a:hover,
	.woocommerce-account .addresses .title .edit:hover,
	blockquote:before,
	.column-tabs ul.tabs li.current,
	.column-tabs ul.tabs li:hover,
	.header-v6 .header-store-notice i,
	.ts-list-of-product-categories-wrapper .list-categories ul li a:hover{
		color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.woocommerce table.shop_table .product-remove a:hover,
	.ts-tiny-cart-wrapper .cart_list li .cart-item-wrapper .remove:hover,
	body.search.search-no-results .alert:before,
	.woocommerce.archive #primary > .woocommerce-info:before{
		color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	.availability-bar .progress-bar > span{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	/*** Button Color ***/
	a.button,
	button, 
	input[type^="submit"], 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,  
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,  
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	.woocommerce #respond input#submit, 
	.woocommerce #respond input#submit.loading,
	.woocommerce a.button.loading,
	.woocommerce button.button.loading,
	.woocommerce input.button.loading,
	.elementor-button-wrapper .elementor-button,
	.shopping-cart p.buttons a,
	a.wp-block-button__link,
	.wp-block-search .wp-block-search__button,
	input[type="submit"].dokan-btn, 
	.wishlist_table .product-add-to-cart a,
	.woocommerce div.product .summary form.cart .button,
	.dropdown-container .dropdown-footer .button,
	.ts-product-filter-by-attribute input[type="submit"],
	a.dokan-btn, 
	.dokan-btn,
	#comments .wcpr-filter-button,
	.yith-woocompare-widget a.clear-all,
	.yith-woocompare-widget a.compare,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare,
	.product-hover-vertical-style-2 .list .product-wrapper .product-group-button-meta .loop-add-to-cart .button,
	body.product-hover-vertical-style-2 .product-wrapper .product-group-button-meta .loop-add-to-cart .button:hover,
	body table.compare-list .add-to-cart td a:not(.unstyled_button),
	#ts-search-sidebar.full-width .ts-search-result-container .view-all-wrapper a{
		background: <?php echo esc_html($ts_button_background_color); ?>;
		border-color: <?php echo esc_html($ts_button_border_color); ?>;
		color: <?php echo esc_html($ts_button_text_color); ?>;
	}
	a.button:hover,
	button:hover, 
	input[type^="submit"]:hover, 
	.woocommerce a.button:hover, 
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover,  
	.woocommerce a.button.alt:hover, 
	.woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover,  
	.woocommerce a.button.disabled:hover, 
	.woocommerce a.button:disabled:hover, 
	.woocommerce a.button:disabled[disabled]:hover, 
	.woocommerce button.button.disabled:hover, 
	.woocommerce button.button:disabled:hover, 
	.woocommerce button.button:disabled[disabled]:hover, 
	.woocommerce input.button.disabled:hover, 
	.woocommerce input.button:disabled:hover, 
	.woocommerce input.button:disabled[disabled]:hover,
	.woocommerce #respond input#submit:hover, 
	.woocommerce #respond input#submit.loading:hover,
	.woocommerce a.button.loading:hover,
	.woocommerce button.button.loading:hover,
	.woocommerce input.button.loading:hover,
	.elementor-button-wrapper .elementor-button:hover,
	.shopping-cart p.buttons a:hover,
	a.wp-block-button__link:hover,
	.wp-block-search .wp-block-search__button:hover,
	input[type="submit"].dokan-btn:hover, 
	.wishlist_table .product-add-to-cart a:hover,
	.woocommerce div.product .summary form.cart .button:hover,
	a.dokan-btn:hover, 
	.dokan-btn:hover,
	#comments .wcpr-filter-button:hover,
	.yith-woocompare-widget a.clear-all:hover,
	.yith-woocompare-widget a.compare:hover,
	.elementor-widget-wp-widget-yith-woocompare-widget a.clear-all:hover,
	.elementor-widget-wp-widget-yith-woocompare-widget a.compare:hover,
	.product-hover-vertical-style-2 .list .product-wrapper .product-group-button-meta .loop-add-to-cart .button:hover,
	body table.compare-list .add-to-cart td a:not(.unstyled_button):hover,
	.woocommerce div.product .summary .ts-buy-now-button:hover,
	#ts-search-sidebar.full-width .ts-search-result-container .view-all-wrapper a:hover{
		color: <?php echo esc_html($ts_button_text_hover_color); ?>;
		background: <?php echo esc_html($ts_button_background_hover_color); ?>;
		border-color: <?php echo esc_html($ts_button_border_hover_color); ?>;
	}
	.is-style-outline>.wp-block-button__link:not(.has-background), 
	.wp-block-button__link.is-style-outline:not(.has-background){
		border-color: <?php echo esc_html($ts_button_border_color); ?>;
		color: <?php echo esc_html($ts_button_border_color); ?>;
	}
	.woocommerce table.shop_table.cart td.actions .button.empty-cart-button:hover{
		border-color: <?php echo esc_html($ts_button_text_hover_color); ?>;
		color: <?php echo esc_html($ts_button_text_hover_color); ?>;
	}
	.ts-header nav > ul.menu > li.button > a, 
	.ts-header nav > ul > li.button > a{
		background: <?php echo esc_html($ts_button_background_color); ?> !important;
		border-color: <?php echo esc_html($ts_button_border_color); ?> !important;
		color: <?php echo esc_html($ts_button_text_color); ?> !important;
	}
	.ts-header nav > ul > li.button > a:hover,
	.ts-header nav > ul.menu > li.button > a:hover,
	.ts-product-filter-by-attribute input[type="submit"]:hover{
		color: <?php echo esc_html($ts_button_text_hover_color); ?> !important;
		background: <?php echo esc_html($ts_button_background_hover_color); ?> !important;
		border-color: <?php echo esc_html($ts_button_border_hover_color); ?> !important;
	}
	.yith-woocompare-widget a.clear-all,
	.elementor-widget-wp-widget-woocommerce_widget_cart .buttons a:not(.checkout), 
	.woocommerce .widget_shopping_cart .buttons a:not(.checkout), 
	.woocommerce.widget_shopping_cart .buttons a:not(.checkout),
	.add-to-cart-popup-content .action .view-cart,
	.dropdown-container .dropdown-footer .button.view-cart,
	.woocommerce .yith-wfbt-submit-block .yith-wfbt-submit-button,
	.product-hover-vertical-style-2 .product-wrapper .product-group-button-meta .loop-add-to-cart .button{
		background: <?php echo esc_html($ts_special_button_background_color); ?>;
		border-color: <?php echo esc_html($ts_special_button_border_color); ?>;
		color: <?php echo esc_html($ts_special_button_text_color); ?>;
	}
	.add-to-cart-popup-content .action .view-cart:hover,
	.woocommerce .yith-wfbt-submit-block .yith-wfbt-submit-button:hover,
	.product-hover-vertical-style-2 .product-wrapper .product-group-button-meta .loop-add-to-cart .button:hover{
		background: <?php echo esc_html($ts_special_button_background_hover_color); ?>;
		border-color: <?php echo esc_html($ts_special_button_border_hover_color); ?>;
		color: <?php echo esc_html($ts_special_button_text_hover_color); ?>;
	}
	.yith-woocompare-widget a.compare:hover,
	.elementor-widget-wp-widget-woocommerce_widget_cart .buttons a:hover, 
	.woocommerce .widget_shopping_cart .buttons a:hover, 
	.woocommerce.widget_shopping_cart .buttons a:hover,
	.dropdown-container .dropdown-footer .button:hover{
		color: <?php echo esc_html($ts_button_border_color); ?>;
		background: transparent;
		border-color: <?php echo esc_html($ts_button_border_color); ?>;
	}
	.yith-woocompare-widget a.clear-all:hover,
	.elementor-widget-wp-widget-woocommerce_widget_cart .buttons a:not(.checkout):hover, 
	.woocommerce .widget_shopping_cart .buttons a:not(.checkout):hover, 
	.woocommerce.widget_shopping_cart .buttons a:not(.checkout):hover,
	.dropdown-container .dropdown-footer .button.view-cart:hover{
		color: <?php echo esc_html($ts_special_button_border_color); ?>;
		background: transparent;
		border-color: <?php echo esc_html($ts_special_button_border_color); ?>;
	}
	<?php if( strpos($ts_button_text_color, 'rgba') !== false ): ?>
	.load-more-wrapper .button.loading:before,
	.ts-shop-load-more .button.loading:before,
	.woocommerce .ts-shop-load-more .button.loading:before{
		border-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_text_color))); ?>;
		border-top-color: <?php echo esc_html($ts_button_text_hover_color); ?>;
	}
	<?php endif; ?>
	<?php if( strpos($ts_button_text_hover_color, 'rgba') !== false ): ?>
	.load-more-wrapper .button.loading:hover:before,
	.ts-shop-load-more .button.loading:hover:before,
	.woocommerce .ts-shop-load-more .button.loading:hover:before{
		border-color: <?php echo esc_html(str_replace('1)', '0.5)', esc_html($ts_button_text_hover_color))); ?>;
		border-top-color: <?php echo esc_html($ts_button_text_hover_color); ?>;
	}
	<?php endif; ?>
	
	/*** Border Color ***/
	*,
	*:before,
	*:after,
	.select2-container--open .select2-dropdown,
	body .select2-container--open .select2-dropdown--above,
	body .select2-container--open .select2-dropdown--below,
	.entry-author .author-avatar img,
	.woocommerce table.shop_table .product-remove a,
	.woocommerce #reviews #comments ol.commentlist li,
	html .woocommerce > form.checkout input[type^="checkbox"],
	body #cboxClose,
	.ts-floating-sidebar .close,
	.ts-popup-modal .close,
	.cart_list li a.remove,
	.woocommerce .widget_shopping_cart .cart_list li a.remove, 
	.woocommerce.widget_shopping_cart .cart_list li a.remove,
	.woocommerce div.product form.cart table.group_table td,
	.wishlist_table.images_grid li .item-details table.item-details-table td, 
	.wishlist_table.mobile li .item-details table.item-details-table td, 
	.wishlist_table.modern_grid li .item-details table.item-details-table td,
	.wishlist_table.mobile li table.additional-info td,
	#primary > .list-categories .product-category > .product-wrapper > a > img{
		border-color: <?php echo esc_html($ts_border_color); ?>;
	}

	/*** Input Color ***/
	select,
	textarea,
	html input[type="search"],
	html input[type="text"],
	html input[type="email"],
	html input[type="password"],
	html input[type="date"],
	html input[type="number"],
	html input[type="tel"],
	.woocommerce .quantity input.qty, 
	.quantity input.qty,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	body .select2-container--default .select2-selection--single,
	body .select2-dropdown,
	body .select2-container--default .select2-selection--single,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	.woocommerce form .form-row.woocommerce-validated .select2-container,
	.woocommerce form .form-row.woocommerce-validated input.input-text,
	.woocommerce form .form-row.woocommerce-validated select,
	body .select2-container--default .select2-selection--multiple,
	body .select2-container--default .select2-selection--single .select2-selection__rendered{
		background-color: <?php echo esc_html($ts_input_background_color); ?>;
		color: <?php echo esc_html($ts_input_text_color); ?>;
		border-color: <?php echo esc_html($ts_input_border_color); ?>;
	}
	input:-webkit-autofill, 
	input:-webkit-autofill:hover, 
	input:-webkit-autofill:focus{
		-webkit-box-shadow: 0 0 0 50px <?php echo esc_html($ts_input_background_color); ?> inset !important; 
	}
	body .select2-container--default .select2-selection--single .select2-selection__placeholder{
		color: <?php echo esc_html($ts_input_text_color); ?>;
	}
	
	/*** Heading Text Color ***/
	h1,h2,h3,h4,h5,h6,
	.h1,.h2,.h3,.h4,.h5,.h6,
	dt,
	label ,
	p > label,
	fieldset div > label,
	blockquote,
	blockquote .author,
	table thead th,
	.wpcf7 p,
	.woocommerce > form > fieldset legend,
	.woocommerce table.shop_table th,
	html input:focus:invalid:focus, 
	html select:focus:invalid:focus,
	#yith-wcwl-popup-message,
	table#wp-calendar thead th,
	html body > h1,
	.woocommerce table.shop_attributes th,
	.column-tabs ul.tabs li,
	.ts-banner.text-under-image .box-content .description,
	.ts-banner.text-under-image .box-content h2,
	.ts-banner.text-under-image .box-content h6,
	.ts-banner.text-under-image.style-arrow .ts-banner-button a,
	body table.compare-list th,
	body table.compare-list tr.title th,
	body table.compare-list tr.image th,
	body table.compare-list tr.price th{
		color: <?php echo esc_html($ts_heading_color); ?>;
	}

	/*** Breadcrumbs Color ***/
	.breadcrumb-title-wrapper.breadcrumb-v1 .breadcrumbs:before{
		background-color: <?php echo esc_html($ts_breadcrumb_background_color); ?>;
	}
	.breadcrumb-title-wrapper .page-title,
	.breadcrumb-title-wrapper .breadcrumbs{
		color: <?php echo esc_html($ts_breadcrumb_text_color); ?>;
	}
	.breadcrumb-title-wrapper .breadcrumbs a,
	.breadcrumb-title-wrapper .brn_arrow,
	.breadcrumb-title-wrapper .breadcrumbs-container > span:not(.current){
		color: <?php echo esc_html($ts_breadcrumb_link_color); ?>;
	}
	
	/*** Header Color ***/
	.header-top{
		background-color: <?php echo esc_html($ts_header_top_background_color); ?>;
		border-color: <?php echo esc_html($ts_header_top_border_color); ?>;
		color: <?php echo esc_html($ts_header_top_text_color); ?>;
	}
	.header-middle{
		background-color: <?php echo esc_html($ts_header_middle_background_color); ?>;
		border-color: <?php echo esc_html($ts_header_middle_border_color); ?>;
		color: <?php echo esc_html($ts_header_middle_text_color); ?>;
	}
	.header-bottom{
		background-color: <?php echo esc_html($ts_header_bottom_background_color); ?>;
		border-color: <?php echo esc_html($ts_header_bottom_border_color); ?>;
		color: <?php echo esc_html($ts_header_bottom_text_color); ?>;
	}
	.ts-search-by-category > form{
		color: <?php echo esc_html($ts_header_search_color); ?>;
		background-color: <?php echo esc_html($ts_header_search_background_color); ?>;
	}
	.ts-search-by-category .search-table .search-field input[type="text"]{
		color: <?php echo esc_html($ts_header_search_color); ?>;
	}
	.vertical-menu-heading,
	.attribute-search-heading{
		background-color: <?php echo esc_html($ts_vertical_menu_heading_background_color); ?>;
		color: <?php echo esc_html($ts_vertical_menu_heading_color); ?>;
	}
	.header-top strong{
		color: <?php echo esc_html($ts_header_top_strong_color); ?>;
	}
	.header-top a:hover,
	.header-top .search-icon a:hover, 
	.header-top .my-account-wrapper a:hover,
	.header-top .my-wishlist-wrapper a:hover,
	.header-top .shopping-cart-wrapper a:hover,
	.header-top .search-button.search-icon:hover .icon:before, 
	.header-top .my-wishlist-wrapper:hover .tini-wishlist:before, 
	.header-top .shopping-cart-wrapper:hover .cart-control .ic-cart:before, 
	.header-top .ts-tiny-account-wrapper:hover .account-control>a:before,
	.header-top ul.menu li a:hover,
	.header-top .wpml-ls-legacy-dropdown a:hover,
	.header-top .wpml-ls-legacy-dropdown a:focus,
	.header-top .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover>a, 
	.header-top .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover>a{
		color: <?php echo esc_html($ts_header_top_link_hover_color); ?>;
	}
	.header-top nav > ul.menu > li.current-menu-item:before,
	.header-top nav > ul.menu > li.current-menu-parent:before,
	.header-top nav > ul.menu > li.current-menu-item > .ts-menu-drop-icon,
	.header-top nav > ul.menu > li.current-menu-parent > .ts-menu-drop-icon,
	.header-top nav > ul.menu > li.current-menu-item > a,
	.header-top nav > ul.menu > li.current-menu-parent > a,
	.header-top ul.sub-menu > li.current-menu-item:before,
	.header-top ul.sub-menu > li.current-menu-parent:before,
	.header-top ul.sub-menu > li.current-menu-item > .ts-menu-drop-icon,
	.header-top ul.sub-menu > li.current-menu-parent > .ts-menu-drop-icon,
	.header-top ul.sub-menu > li.current-menu-item > a,
	.header-top ul.sub-menu > li.current-menu-parent > a,
	.header-top ul.sub-menu .ts-megamenu-container li.current-menu-item > a{
		color: <?php echo esc_html($ts_header_top_link_hover_color); ?> !important;
	}
	.header-middle a:hover,
	.header-middle .search-icon a:hover, 
	.header-middle .my-account-wrapper a:hover,
	.header-middle .my-wishlist-wrapper a:hover,
	.header-middle .shopping-cart-wrapper a:hover,
	.header-middle .search-button.search-icon:hover .icon:before, 
	.header-middle .my-wishlist-wrapper:hover .tini-wishlist:before, 
	.header-middle .shopping-cart-wrapper:hover .cart-control .ic-cart:before, 
	.header-middle .ts-tiny-account-wrapper:hover .account-control>a:before,
	.header-middle .icon-menu-sticky-header .icon:hover,
	.header-middle ul.menu li a:hover,
	.ts-header .header-middle .menu-wrapper .ts-menu a:not(.button):not(.elementor-button):hover,
	.header-middle .wpml-ls-legacy-dropdown a:hover,
	.header-middle .wpml-ls-legacy-dropdown a:focus,
	.header-middle .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover>a, 
	.header-middle .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover>a{
		color: <?php echo esc_html($ts_header_middle_link_hover_color); ?>;
	}
	.header-middle nav > ul.menu > li.current-menu-item:before,
	.header-middle nav > ul.menu > li.current-menu-parent:before,
	.header-middle nav > ul.menu > li.current-menu-item > .ts-menu-drop-icon,
	.header-middle nav > ul.menu > li.current-menu-parent > .ts-menu-drop-icon,
	.header-middle nav > ul.menu > li.current-menu-item > a,
	.header-middle nav > ul.menu > li.current-menu-parent > a,
	.header-middle ul.sub-menu > li.current-menu-item:before,
	.header-middle ul.sub-menu > li.current-menu-parent:before,
	.header-middle ul.sub-menu > li.current-menu-item > .ts-menu-drop-icon,
	.header-middle ul.sub-menu > li.current-menu-parent > .ts-menu-drop-icon,
	.header-middle ul.sub-menu > li.current-menu-item > a,
	.header-middle ul.sub-menu > li.current-menu-parent > a,
	.header-middle ul.sub-menu .ts-megamenu-container li.current-menu-item > a{
		color: <?php echo esc_html($ts_header_middle_link_hover_color); ?> !important;
	}
	.header-bottom a:hover,
	.header-bottom .search-icon a:hover, 
	.header-bottom .my-account-wrapper a:hover,
	.header-bottom .my-wishlist-wrapper a:hover,
	.header-bottom .shopping-cart-wrapper a:hover,
	.header-bottom .search-button.search-icon:hover .icon:before, 
	.header-bottom .my-wishlist-wrapper:hover .tini-wishlist:before, 
	.header-bottom .shopping-cart-wrapper:hover .cart-control .ic-cart:before, 
	.header-bottom .ts-tiny-account-wrapper:hover .account-control>a:before,
	.header-bottom ul.menu li a:hover,
	.ts-header .header-bottom .menu-wrapper .ts-menu a:not(.button):not(.elementor-button):hover,
	.header-bottom .wpml-ls-legacy-dropdown a:hover,
	.header-bottom .wpml-ls-legacy-dropdown a:focus,
	.header-bottom .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover>a, 
	.header-bottom .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover>a{
		color: <?php echo esc_html($ts_header_bottom_link_hover_color); ?>;
	}
	.header-bottom nav > ul.menu > li.current-menu-item:before,
	.header-bottom nav > ul.menu > li.current-menu-parent:before,
	.header-bottom nav > ul.menu > li.current-menu-item > .ts-menu-drop-icon,
	.header-bottom nav > ul.menu > li.current-menu-parent > .ts-menu-drop-icon,
	.header-bottom nav > ul.menu > li.current-menu-item > a,
	.header-bottom nav > ul.menu > li.current-menu-parent > a,
	.header-bottom ul.sub-menu > li.current-menu-item:before,
	.header-bottom ul.sub-menu > li.current-menu-parent:before,
	.header-bottom ul.sub-menu > li.current-menu-item > .ts-menu-drop-icon,
	.header-bottom ul.sub-menu > li.current-menu-parent > .ts-menu-drop-icon,
	.header-bottom ul.sub-menu > li.current-menu-item > a,
	.header-bottom ul.sub-menu > li.current-menu-parent > a,
	.header-bottom ul.sub-menu .ts-megamenu-container li.current-menu-item > a{
		color: <?php echo esc_html($ts_header_bottom_link_hover_color); ?> !important;
	}
	.ts-product-filter-by-attribute:before,
	.ts-header .vertical-menu-wrapper > .vertical-menu:before,
	body > .ts-search-result-container,
	.shopping-cart-wrapper .dropdown-container:before, 
	.my-account-wrapper .dropdown-container:before, 
	.header-language .wpml-ls-sub-menu:before, 
	.ts-language-switcher .wpml-ls-sub-menu:before,
	.ts-currency-switcher ul:before, 
	.header-currency ul:before{
		background-color: <?php echo esc_html($ts_header_dropdown_background_color); ?>;
	}
	.ts-header .vertical-menu-wrapper > .vertical-menu:before,
	.shopping-cart-wrapper .dropdown-container, 
	.my-account-wrapper .dropdown-container, 
	.header-language .wpml-ls-sub-menu, 
	.ts-language-switcher .wpml-ls-sub-menu,
	.ts-currency-switcher ul, 
	.header-currency ul,
	.shopping-cart-wrapper .dropdown-container a:not(.button), 
	.my-account-wrapper .dropdown-container a:not(.button), 
	.header-language .wpml-ls-sub-menu a:not(.button), 
	.ts-language-switcher .wpml-ls-sub-menu a:not(.button),
	.ts-currency-switcher ul a:not(.button), 
	.header-currency ul a:not(.button){
		color: <?php echo esc_html($ts_header_dropdown_color); ?>;
	}
	.my-wishlist-wrapper .tini-wishlist .count-number,
	.shopping-cart-wrapper .cart-control .cart-number{
		background: <?php echo esc_html($ts_header_icon_count_background_color); ?>;
		color: <?php echo esc_html($ts_header_icon_count_text_color); ?>;
	}
	.shopping-cart-wrapper .dropdown-container a:not(.button):hover, 
	.my-account-wrapper .ts-tiny-account-wrapper .dropdown-container a:not(.button):hover, 
	.header-language .wpml-ls-sub-menu a:not(.button):hover, 
	.ts-language-switcher .wpml-ls-sub-menu a:not(.button):hover,
	.ts-currency-switcher ul a:not(.button):hover, 
	.header-currency ul a:not(.button):hover{
		color: <?php echo esc_html($ts_header_dropdown_link_hover_color); ?>;
	}
	.shopping-cart-wrapper .dropdown-container:before,
	.my-account-wrapper .dropdown-container:before,
	.wcml_currency_switcher > ul:before, 
	.wpml-ls-legacy-dropdown ul.wpml-ls-sub-menu:before,
	.wpml-ls-item-legacy-dropdown-click ul.wpml-ls-sub-menu:before{
		border-color: <?php echo esc_html($ts_header_dropdown_border_color); ?>;
	}
	#ts-mobile-button-bottom{
		background: <?php echo esc_html($ts_product_group_button_fixed_background_color); ?>;
		border-color: <?php echo esc_html($ts_product_group_button_fixed_border_color); ?>;
	}
	#ts-mobile-button-bottom > div .icon:before, 
	#ts-mobile-button-bottom .my-wishlist-wrapper .tini-wishlist:before, 
	#ts-mobile-button-bottom .shopping-cart-wrapper .cart-control .ic-cart:before, 
	#ts-mobile-button-bottom .ts-tiny-account-wrapper .account-control>a:before{
		color: <?php echo esc_html($ts_product_group_button_fixed_color); ?>;
	}
	#ts-mobile-button-bottom .my-wishlist-wrapper .tini-wishlist .count-number,
	#ts-mobile-button-bottom .shopping-cart-wrapper .cart-control .cart-number{
		background: <?php echo esc_html($ts_product_group_button_fixed_color); ?>;
		border-color: <?php echo esc_html($ts_product_group_button_fixed_color); ?>;
		color: <?php echo esc_html($ts_product_group_button_fixed_background_color); ?>;
	}
	#group-icon-header .ts-sidebar-content{
		background: <?php echo esc_html($ts_menu_mobile_background_color); ?>;
		color: <?php echo esc_html($ts_menu_mobile_text_color); ?>;
	}
	.mobile-menu-wrapper,
	.mobile-menu-wrapper .mobile-menu{
		color: <?php echo esc_html($ts_menu_mobile_text_color); ?>;
	}
	.mobile-menu-wrapper .mobile-menu > ul.menu > li.current-menu-item:before,
	.mobile-menu-wrapper .mobile-menu > ul.menu > li.current-menu-parent:before,
	.mobile-menu-wrapper .mobile-menu > ul.menu > li.current-menu-item > a,
	.mobile-menu-wrapper .mobile-menu > ul.menu > li.current-menu-parent > a,
	.mobile-menu-wrapper .mobile-menu ul.sub-menu > li.current-menu-item:before,
	.mobile-menu-wrapper .mobile-menu ul.sub-menu > li.current-menu-parent:before,
	.mobile-menu-wrapper .mobile-menu ul.sub-menu > li.current-menu-item > a,
	.mobile-menu-wrapper .mobile-menu ul.sub-menu > li.current-menu-parent > a,
	.mobile-menu-wrapper .mobile-menu ul.sub-menu .ts-megamenu-container li.current-menu-item > a{
		color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	
	/*** Footer ***/
	footer#colophon{
		background-color: <?php echo esc_html($ts_footer_background_color); ?>;
		color: <?php echo esc_html($ts_footer_text_color); ?>;
	}
	.footer-container h1,
	.footer-container h2,
	.footer-container h3,
	.footer-container h4,
	.footer-container h5,
	.footer-container h6{
		color: <?php echo esc_html($ts_footer_heading_color); ?>;
	}
	footer#colophon,
	.footer-container *:not(.button):not(.elementor-button){
		border-color: <?php echo esc_html($ts_footer_border_color); ?>;
	}
	.footer-container .elementor-widget-divider{
		--divider-color: <?php echo esc_html($ts_footer_border_color); ?>;
	}

	/*** Product ***/
	.woocommerce .product:not(.product-category) .product-wrapper,
	.product-hover-vertical-style-2 .products .product .product-wrapper:hover .product-group-button-meta{
		background-color: <?php echo esc_html($ts_product_background_color); ?>;
	}
	.product-name,
	h3.product-name,
	.product-name h3,
	.product_list_widget .title,
	ul.product_list_widget li a, 
	.woocommerce ul.cart_list li a, 
	.woocommerce ul.product_list_widget li a{
		color: <?php echo esc_html($ts_product_text_color); ?>;
	}
	.product-group-button > div .button-tooltip,
	.thumbnail-wrapper .product-group-button > div,
	.woocommerce div.product div.images .woocommerce-product-gallery__trigger{
		background-color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
		color: <?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
	}
	.product-group-button > div:hover .button-tooltip,
	.thumbnail-wrapper .product-group-button > div:hover,
	.woocommerce div.product div.images .woocommerce-product-gallery__trigger:hover{
		background-color: <?php echo esc_html($ts_product_button_thumbnail_background_hover_color); ?>;
		color: <?php echo esc_html($ts_product_button_thumbnail_text_hover); ?>;
	}
	.product-group-button > div .button-tooltip:before{
		border-left-color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
	}
	.product-group-button > div:hover .button-tooltip:before{
		border-left-color: <?php echo esc_html($ts_product_button_thumbnail_background_hover_color); ?>;
	}
	body.rtl .product-group-button > div .button-tooltip:before{
		border-left-color: transparent;
		border-right-color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
	}
	body.rtl .product-group-button > div:hover .button-tooltip:before{
		border-left-color: transparent;
		border-right-color: <?php echo esc_html($ts_product_button_thumbnail_background_hover_color); ?>;
	}
	.price, 
	.products .meta-wrapper > .price,
	.woocommerce div.product p.price, 
	.woocommerce div.product span.price,
	.woocommerce-grouped-product-list-item__price,
	.cart_list li .subtotal,
	.ts-tiny-cart-wrapper .total > span.amount,
	.widget_shopping_cart .total .amount, 
	.elementor-widget-wp-widget-woocommerce_widget_cart .total .amount,
	.wishlist_table li .item-details table.item-details-table .amount.woocommerce-Price-amount,
	.woocommerce table.shop_table .amount.woocommerce-Price-amount,
	.woocommerce div.product .summary p.price,
	.woocommerce div.product .summary span.price,
	.yith-wfbt-submit-block .total_price{
		color: <?php echo esc_html($ts_product_price_color); ?>;
	}
	.price del, 
	.products .meta-wrapper > .price del,
	.woocommerce div.product p.price del, 
	.woocommerce div.product span.price del,
	.woocommerce-grouped-product-list-item__price del,
	.woocommerce div.product .summary p.price del,
	.woocommerce div.product .summary span.price del,
	.wishlist_table li .item-details table.item-details-table del .amount.woocommerce-Price-amount,
	.woocommerce table.shop_table td del .amount.woocommerce-Price-amount{
		color: <?php echo esc_html($ts_product_sale_price_color); ?>;
	}
	.star-rating::before,
	.woocommerce .star-rating::before,
	.woocommerce p.stars a,
	.woocommerce p.stars a:hover ~ a,
	.woocommerce p.stars.selected a.active ~ a,
	.ts-testimonial-wrapper .rating:before,
	blockquote .rating:before{
		color: <?php echo esc_html($ts_rating_color); ?> !important;
	}
	.star-rating span, 
	.woocommerce .star-rating span, 
	.product_list_widget .star-rating span,
	.woocommerce p.stars:hover a, 
	.woocommerce p.stars.selected a, 
	.woocommerce .star-rating span:before, 
	.ts-testimonial-wrapper .rating span:before, 
	blockquote .rating span:before{
		color: <?php echo esc_html($ts_rating_fill_color); ?> !important;
	}

	/*** Product Label ***/
	.product_list_widget .product-label .onsale,
	.woocommerce .product .product-label .onsale{
		color: <?php echo esc_html($ts_product_sale_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_sale_label_background_color); ?>;
	}
	.product_list_widget .product-label .new,
	.woocommerce .product .product-label .new{
		color: <?php echo esc_html($ts_product_new_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_new_label_background_color); ?>;
	}
	#dokan-seller-listing-wrap.grid-view .store-content .store-data-container .featured-favourite .featured-label,
	#dokan-seller-listing-wrap.list-view .dokan-seller-wrap .dokan-single-seller .store-wrapper .store-content .store-data-container .featured-favourite .featured-label,
	.product_list_widget .product-label .featured,
	.woocommerce .product .product-label .featured{
		color: <?php echo esc_html($ts_product_feature_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_feature_label_background_color); ?>;
	}
	.product_list_widget .product-label .out-of-stock,
	.woocommerce .product .product-label .out-of-stock{
		color: <?php echo esc_html($ts_product_outstock_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_outstock_label_background_color); ?>;
	}
	
<?php update_option('ts_load_dynamic_style', 1); // uncomment after finished this file ?>	