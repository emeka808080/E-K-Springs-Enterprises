<?php 
	$druco_theme_options = druco_get_theme_options();
	$has_vertical_menu = $druco_theme_options['ts_header_layout'] == 'v6' && has_nav_menu( 'vertical' );
?>
<div class="clear"></div>
</div><!-- #main .wrapper -->
<div class="clear"></div>
	<?php if( !is_page_template('page-templates/blank-page-template.php') && $druco_theme_options['ts_footer_block'] ): ?>
	<footer id="colophon" class="footer-container footer-area">
		<div class="container">
			<?php druco_get_footer_content( $druco_theme_options['ts_footer_block'] ); ?>
		</div>
	</footer>
	<?php endif; ?>
</div><!-- #page -->

<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>

	<!-- Group Header Button -->
	<div id="group-icon-header" class="ts-floating-sidebar">
		<div class="overlay"></div>
		<div class="ts-sidebar-content <?php echo esc_attr( $has_vertical_menu ? '' : 'no-tab' ); ?>">
		
			<div class="sidebar-content">
				
				<ul class="tab-mobile-menu">
					<li id="main-menu" class="active"><span><?php esc_html_e('Menu', 'druco'); ?></span></li>
					<?php if( $has_vertical_menu ): ?>
						<li id="vertical-menu"><span><?php echo druco_get_vertical_menu_heading(); ?></span></li>
					<?php endif; ?>
				</ul>
				
				<h6 class="menu-title"><span><?php esc_html_e('Menu', 'druco'); ?></span></h6>
				
				<div class="mobile-menu-wrapper ts-menu tab-menu-mobile">
					<div class="menu-main-mobile">
						<?php 
						if( has_nav_menu( 'mobile' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'mobile', 'walker' => new Druco_Walker_Nav_Menu() ) );
						}else if( has_nav_menu( 'primary' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary', 'walker' => new Druco_Walker_Nav_Menu() ) );
						}
						else{
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu' ) );
						}
						?>
					</div>
				</div>
				
				<?php if( $has_vertical_menu ): ?>
					<div class="mobile-menu-wrapper ts-menu tab-vertical-menu">
						<div class="vertical-menu-wrapper">			
							<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Druco_Walker_Nav_Menu() ) ); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<div class="group-button-header">
					<?php if( $druco_theme_options['ts_enable_tiny_account'] || $druco_theme_options['ts_header_currency'] || $druco_theme_options['ts_header_language'] ): ?>
					
					<div class="meta-bottom">
						<?php if( $druco_theme_options['ts_enable_tiny_account'] ): ?>
						<div class="my-account-wrapper">
							<?php echo druco_tiny_account(false); ?>
						</div>	
						<?php endif; ?>
						
						<?php if( $druco_theme_options['ts_header_currency'] || $druco_theme_options['ts_header_language'] ): ?>
						<div class="language-currency">
							
							<?php if( $druco_theme_options['ts_header_language'] ): ?>
							<div class="header-language"><?php druco_wpml_language_selector(); ?></div>
							<?php endif; ?>
							
							<?php if( $druco_theme_options['ts_header_currency'] ): ?>
							<div class="header-currency"><?php druco_woocommerce_multilingual_currency_switcher(); ?></div>
							<?php endif; ?>
							
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					
					<?php if ( !in_array($druco_theme_options['ts_header_layout'], array('v3')) && $druco_theme_options['ts_header_contact_info'] ): ?>
						<div class="meta-bottom">
						<div class="header-contact-info has-icon"><?php echo wp_kses($druco_theme_options['ts_header_contact_info'], 'druco_header_text'); ?></div>
						</div>
					<?php endif; ?>
					
				</div>
				
			</div>	
		</div>
	</div>
	
	<?php if( $druco_theme_options['ts_enable_mobile_app_style'] ): ?>

		<!-- Mobile Group Button -->
		<div id="ts-mobile-button-bottom">
			<!-- Menu Icon -->
			<div class="ts-mobile-icon-toggle">
				<span class="icon"></span>
			</div>
			
			<!-- Home Icon -->
			<div class="mobile-button-home">
				<a href="<?php echo esc_url( home_url('/') ) ?>">
					<span class="icon"></span>
				</a>
			</div>
			
			<!-- Myaccount Icon -->
			<?php if( $druco_theme_options['ts_enable_tiny_account'] ): ?>
			<div class="my-account-wrapper">
				<?php echo druco_tiny_account(false); ?>
			</div>
			<?php endif; ?>
			
			<!-- Wishlist Icon -->
			<?php if( class_exists('YITH_WCWL') && $druco_theme_options['ts_enable_tiny_wishlist'] ): ?>
				<div class="my-wishlist-wrapper"><?php echo druco_tini_wishlist(); ?></div>
			<?php endif; ?>
			
			<!-- Cart Icon -->
			<?php if( $druco_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
			<div class="shopping-cart-wrapper mobile-cart">
				<?php echo druco_tiny_cart(true, false); ?>
			</div>
			<?php endif; ?>
		</div>
		
	<?php endif; ?>
		
<?php endif; ?>

<!-- Search Sidebar -->
<?php if( $druco_theme_options['ts_enable_search'] ): ?>
	
	<div id="ts-search-sidebar" class="ts-floating-sidebar">
		<div class="overlay"></div>
		<div class="ts-sidebar-content">
			<span class="close"></span>
			
			<div class="ts-search-by-category woocommerce">
				<h2 class="title"><?php esc_html_e('Search for products', 'druco'); ?></h2>
				<?php get_search_form(); ?>
				<div class="ts-search-result-container"></div>
			</div>
		</div>
	</div>

<?php endif; ?>

<!-- Shopping Cart Floating Sidebar -->
<?php if( class_exists('WooCommerce') && $druco_theme_options['ts_enable_tiny_shopping_cart'] && $druco_theme_options['ts_shopping_cart_sidebar'] && !is_cart() && !is_checkout() ): ?>
<div id="ts-shopping-cart-sidebar" class="ts-floating-sidebar">
	<div class="overlay"></div>
	<div class="ts-sidebar-content">
		<span class="close"></span>
		<div class="ts-tiny-cart-wrapper"></div>
	</div>
</div>
<?php endif; ?>

<?php 
if( ( !wp_is_mobile() && $druco_theme_options['ts_back_to_top_button'] ) || ( wp_is_mobile() && $druco_theme_options['ts_back_to_top_button_on_mobile'] ) ): 
?>
<div id="to-top" class="scroll-button">
	<a class="scroll-button" href="javascript:void(0)" title="<?php esc_attr_e('Back to Top', 'druco'); ?>"><?php esc_html_e('Back to Top', 'druco'); ?></a>
</div>
<?php endif; ?>

<?php 
wp_footer(); ?>
</body>
</html>