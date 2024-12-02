<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AR_Medical_Cosmetic
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> data-theme="ar_medical" class="scroll-smooth">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>

	<meta name="google-site-verification" content="pDV_MT7q0ICikOdZhHtl6UTLthEyPkBYNK4l0qbXC2E" />
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="drawer">
		<input id="mobile-menu" type="checkbox" class="drawer-toggle" />

		<div class="drawer-content">
			<div class="drawer drawer-end">
				<input id="mini-cart" type="checkbox" class="drawer-toggle" />
				<div class="drawer-content">

					<header id="masthead" class="site-header">
						<div class="grid grid-cols-3 bg-base-100 container mx-auto max-w-6xl py-4">
							<div class="flex flex-row items-center">
								<!-- Mobile Menu Button -->
								<label for="mobile-menu" class="btn btn-ghost lg:hidden">
									<i class="fa fa-light fa-bars fa-2x"></i>
								</label>
								<!-- Site Logo -->
								<div class="site-logo relative hidden md:block">
									<a href="<?php echo get_home_url(); ?>">
										<?php
										$custom_logo_id = get_theme_mod('custom_logo');
										$logo = wp_get_attachment_image_src($custom_logo_id, 'full');

										if (has_custom_logo()) {
											echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="site-logo-img">';
										} else {
											echo '<h1>' . get_bloginfo('name') . '</h1>';
										}
										?>
									</a>
								</div>
							</div>


							<a class="h-12 flex justify-center md:hidden" href="<?php echo get_home_url(); ?>">
								<?php
								$custom_logo_id = get_theme_mod('custom_logo');
								$logo = wp_get_attachment_image_src($custom_logo_id, 'full');

								if (has_custom_logo()) {
									echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="site-logo-img">';
								} else {
									echo '<h1>' . get_bloginfo('name') . '</h1>';
								}
								?>
							</a>


							<div class="flex-col items-center justify-center hidden lg:flex">
								<!-- Search Bar Desktop -->
								<form role="search" method="get" id="product-search-form"
									class="search-form items-center justify-center space-x-0 w-full">
									<label for="search-query"
										class=" input input-primary input-text rounded-none flex items-center without-ring">
										<input type="text" class="grow"
											placeholder="<?php _e('Search products...', 'ar-medical'); ?>" name="s"
											autocomplete="off" id="search-query" />
										<i id="search-icon" class="fa fa-search"></i>
										<div id="loading-icon" class="hidden loading loading-spinner size-5"></div>
									</label>
								</form>

								<div class="relative w-full">
									<div class="hidden absolute top-0 max-w-xl bg-white z-[60] input-box w-full"
										id="search-results">
									</div>
								</div>

							</div>
							<!-- Phone number in top bar -->
							<?php $phone_number_1 = get_field('phone_number_1', 'options'); ?>
							<div class="flex flex-row items-center justify-end md:col-span-2 lg:col-span-1">
								<!-- Phone Number -->
								<a class="hidden md:flex items-center btn btn-ghost hover:text-primary"
									href="tel:<?php echo phonenr($phone_number_1); ?>">
									<i class="fa fa-phone fa-2x mr-[1px]"></i>
									<?php echo phonenr($phone_number_1); ?>
								</a>
								<!-- User Icon with User Menu -->
								<div class=" hidden md:block relative group">
									<label tabindex="0" class="btn btn-ghost">
										<img src="<?php echo get_template_directory_uri(); ?>/images/svg/user.svg"
											alt="user">
									</label>
									<?php if (is_user_logged_in()):
										$args = array(
											'theme_location' => 'user-menu',
											'container' => 'ul',
											'menu_class' => 'user-menu menu z-50 absolute right-0 w-52 bg-base-100 border border-gray-200 rounded-box shadow-lg invisible group-hover:visible transition-opacity duration-300 p-2',
										);
										wp_nav_menu($args);

									else:
										// Ensure WooCommerce is active
										if (class_exists('WooCommerce')) {
											$my_account_url = wc_get_page_permalink('myaccount');
											?>
											<ul
												class="menu z-50 absolute right-0 w-52 bg-base-100 border border-gray-200 rounded-none shadow-lg invisible group-hover:visible transition-opacity duration-300 p-2">
												<li>
													<a href="<?php echo esc_url($my_account_url); ?>" class="btn btn-primary">
														<?php _e('Login', 'ar-medical'); ?>
													</a>
												</li>
												<div class="divider my-1"></div>
												<p class="text-center text-base font-medium mb-2">
													<?php _e('Dont have an account?', 'ar-medical'); ?>
												</p>

												<li>
													<a href="<?php echo esc_url($my_account_url) . '?action=register'; ?>"
														class="btn btn-outline rounded-none">
														<?php _e('Signup', 'ar-medical'); ?>
													</a>
												</li>
											</ul>
											<?php
										}
									endif; ?>
								</div>
								<!-- Search Button -->
								<button id="toggle-search-form" class="btn btn-ghost btn-sm size-12 lg:hidden">
									<img src="<?php echo get_template_directory_uri(); ?>/images/svg/search.svg"
										alt="search">
								</button>

								<!-- Heart Icon for Favorites -->
								<a href="<?php echo esc_url(home_url('/wishlist')); ?>"
									class="btn btn-ghost btn-md hidden md:flex size-auto relative">
									<img src="<?php echo get_template_directory_uri(); ?>/images/svg/favorite.svg"
										alt="fav">
									<?php echo do_shortcode("[ti_wishlist_products_counter]"); ?>
								</a>

								<label for="mini-cart"
									class="hidden md:flex btn btn-ghost relative items-center justify-center">
									<img src="<?php echo get_template_directory_uri(); ?>/images/svg/cart.svg"
										alt="cart">
									<span
										class="cart-count cart-count-header"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
								</label>
							</div>
						</div>

						<!-- Search box mobile -->
						<form role="search" method="get" id="product-search-form-mobile"
							class="hidden mx-auto w-11/12 search-form flex items-center justify-center space-x-0 bg-white z-50">
							<label for="search-query"
								class=" input input-primary input-text rounded-none flex items-center gap-2 mb-0 without-ring">
								<input type="text" class="grow"
									placeholder="<?php _e('Search products...', 'ar-medical'); ?>" name="s"
									autocomplete="off" id="search-query-mobile" />
								<i id="search-icon-mobile" class="fa fa-search"></i>
								<div id="loading-icon-mobile" class="hidden loading loading-spinner size-5"></div>
							</label>
						</form>

						<div class="relative w-full">
							<div class="hidden absolute top-0 bg-white z-[60] input-box w-full"
								id="search-results-mobile">
							</div>
						</div>


						<div id="primary-menu" class="main-menu w-full bg-white hidden lg:block z-30">
							<nav id="site-navigation" class="main-navigation container mx-auto max-w-6xl">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'menu_id' => 'primary-menu',
										'menu_class' => 'flex w-full',
									)
								);
								?>
							</nav><!-- #site-navigation -->
						</div>
					</header><!-- #masthead -->