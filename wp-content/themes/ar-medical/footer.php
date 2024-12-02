<?php /* * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials * * @package
AR_Medical_Cosmetic */ ?>

<footer id="colophon" class="site-footer bg-footer text-white py-9">

	<?php $green_phone_number = get_field('green_phone_number', 'options');
	if (!empty($green_phone_number)) { ?>
		<div>
			<a class="fixed right-7 bottom-28 bg-primary rounded-full size-12 flex items-center justify-center z-50"
				href="tel:<?php echo phonenr($green_phone_number); ?>" title="phone">
				<img src="<?php echo get_template_directory_uri(); ?>/images/svg/phone.svg" alt="" width="20" height="20">
			</a>
		</div>
	<?php } ?>

	<div class="container max-w-3xl lg:max-w-6xl mx-auto">

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full pb-12" style="border-bottom: 1px solid #3a3a3a;">
			<div>
				<?php $logo_footer = get_field('logo_footer', 'options');
				if (!empty($logo_footer)) { ?>
					<a class="mb-5 block mx-auto lg:mx-0 w-32" href="<?php echo esc_url(home_url('/')); ?>"
						title="AR Medical Cosmetic">
						<img src="<?php echo $logo_footer['url']; ?>" alt="<?php echo $logo_footer['alt']; ?>"
							width="<?php echo $logo_footer['width']; ?>" height="<?php echo $logo_footer['height']; ?>"
							class="nolazzy">
					</a>
				<?php } ?>

				<p class="text-white text-base text-center md:text-left">
					<?php $description_footer = get_field('description_footer', 'options');
					if (!empty($description_footer)) { ?>
						<?php echo $description_footer; ?>
					<?php } ?>
				</p>
			</div>



			<div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-5 mt-9">

				<?php $phone_label_1 = get_field('phone_label_1', 'options');
				$phone_number_1 = get_field('phone_number_1', 'options');
				if (!empty($phone_number_1) && !empty($phone_label_1)) { ?>
					<a href="tel:<?php echo phonenr($phone_number_1); ?>"
						class="flex items-center justify-center lg:justify-start hover:opacity-70 duration-300">
						<img src="<?php echo get_template_directory_uri(); ?>/images/svg/footer-icon1.svg" alt="vanzari">
						<div class="pl-3">
							<span
								class="block text-white font-normal text-base text-center lg:text-left"><?php echo $phone_label_1; ?></span>
							<span class="text-pink-100 text-2xl font-semibold"><?php echo $phone_number_1; ?></span>
						</div>
					</a>
				<?php } ?>
				<?php $phone_label_2 = get_field('phone_label_2', 'options');
				$phone_number_2 = get_field('phone_number_2', 'options');
				if (!empty($phone_number_2) && !empty($phone_label_2)) { ?>
					<a href="tel:<?php echo phonenr($phone_number_2); ?>"
						class="flex items-center justify-center lg:justify-start hover:opacity-70 duration-300">
						<img src="<?php echo get_template_directory_uri(); ?>/images/svg/footer-icon2.svg" alt="contact">
						<div class="pl-3">
							<span
								class="block text-white font-normal text-base text-center lg:text-left"><?php echo $phone_label_2; ?></span>
							<span class="text-pink-100 text-2xl font-semibold"><?php echo $phone_number_2; ?></span>
						</div>
					</a>
				<?php } ?>
			</div>

			<div>
				<h2 class="text-3xl mb-3 text-center"><?php echo __("Subscribe to newsletter", "ar-medical"); ?></h2>
				<p class="text-lg mb-3 text-center">Fii la curent cu cele mai recente știri și produse.</p>
			</div>

			<form class="grid grid-cols-4 gap-2 my-auto px-2" method="post"
				action="https://armedicalcosmetic.ro/wp-admin/admin-ajax.php?action=tnp&na=s">

				<input type="hidden" name="nlang" value="">
				<div class="tnp-field tnp-field-email col-span-3"><label for="tnp-1"
						class=" screen-reader-text">Email</label>
					<input class="input input-text rounded-none" type="email" name="ne" id="tnp-1" value=""
						placeholder="Email" required>
				</div>
				<input class=" btn rounded-none uppercase" type="submit" value="Abonează-te" style="">

			</form>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 py-10 mx-5">
			<div class="p-2">
				<?php $footer_title_1 = get_field('footer_title_1', 'options');
				if (!empty($footer_title_1)) { ?>
					<p class="text-white text-2xl font-medium mb-6 text-center md:text-left">
						<?php echo $footer_title_1; ?>
					</p>
				<?php } ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu-1',
						'menu_class' => 'footer-menu',
						'container' => false,
						'walker' => new Footer_Nav_Walker(),
					)
				);
				?>
			</div>
			<div class="p-2">
				<?php $footer_title_2 = get_field('footer_title_2', 'options');
				if (!empty($footer_title_2)) { ?>
					<p class="text-white text-2xl font-medium mb-6 text-center md:text-left">
						<?php echo $footer_title_2; ?>
					</p>
				<?php } ?>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu-2',
						'menu_class' => 'footer-menu',
						'container' => false,
						'walker' => new Footer_Nav_Walker(),
					)
				);
				?>
			</div>
			<div class="p-2">
				<?php $footer_title_3 = get_field('footer_title_3', 'options');
				if (!empty($footer_title_3)) { ?>
					<p class="text-white text-2xl font-medium mb-6 text-center md:text-left">
						<?php echo $footer_title_3; ?>
					</p>
				<?php } ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu-3',
						'menu_class' => 'footer-menu',
						'container' => false,
						'walker' => new Footer_Nav_Walker(),
					)
				);
				?>
			</div>
			<div class="p-2">
				<?php $footer_title_4 = get_field('footer_title_4', 'options');
				if (!empty($footer_title_4)) { ?>
					<p class="text-white text-2xl font-medium mb-6 text-center md:text-left">
						<?php echo $footer_title_4; ?>
					</p>
				<?php } ?>

				<div class="w-fit mx-auto grid gap-4 grid-cols-[20%_80%] opacity-70">
					<img class="m-auto w-10" src="<?php echo get_template_directory_uri(); ?>/images/svg/contact1.svg"
						alt="program">
					<p class="text-white text-base">Luni - Vineri: 10:00 - 18:00 <br>Sâmbătă - Duminică: Închis</p>
					<img class="m-auto w-10" src="<?php echo get_template_directory_uri(); ?>/images/svg/contact2.svg"
						alt="contact">
					<a href="mailto:office@armedicalcosmetic.ro"
						class="text-white text-base">office@armedicalcosmetic.ro</a>
					<img class="m-auto w-10" src="<?php echo get_template_directory_uri(); ?>/images/svg/contact3.svg"
						alt="adresa">
					<a class="text-white text-base" href="https://goo.gl/maps/jB4zLdAaZRVbzeUq8" target="_blank">Str.
						N.Titulescu, Nr.9, Bacau</a>
				</div>
			</div>
		</div>
		<div class="w-full" style="border-top: 1px solid #3a3a3a;">
			<div class="mx-auto w-fit grid grid-cols-2 gap-5 lg:grid-cols-4 lg:gap-10 items-center py-7">
				<a href="https://netopia-payments.com/" title="Neotpia" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/jpg/mobilpay.jpeg" width="200"
						alt="logo Netopia">
				</a>
				<a href="https://anpc.ro/ce-este-sal/" title="ANPC" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/png/pictograma-anpc.png" width="200"
						alt="logo ANPC">
				</a>
				<a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home2.show&lng=RO" title="Litigii"
					target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/webp/litigii.webp" width="200"
						alt="litigii">
				</a>
				<a href="" title="Sigla Trusted" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/webp/trusted.webp" width="200"
						alt="Sigla verificat">
				</a>
			</div>
		</div>
		<div class="flex flex-col-reverse lg:flex-row w-full items-center justify-between pt-6 text-base"
			style="border-top: 1px solid #3a3a3a;">
			<?php $copyright = get_field('copyright', 'options');
			if (!empty($copyright)) { ?>
				<p class="text-white py-5 text-sm">Copyright <?php echo auto_copyright(2022); ?> ©
					<?php echo $copyright; ?>
				</p>
			<?php } ?>
			<?php $social = show_social();
			if (!empty($social)) { ?>
				<div class="flex flex-row items-center justify-center">
					<?php echo $social; ?>
				</div>
			<?php } ?>
		</div>
		<p class="text-white text-center text-sm">
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf(esc_html__('Tema: %1$s realizata de %2$s.', 'ar-medical'), 'ar-medical', '<a href="http://f0lder.xyz" class="text-white underline">Ursan Bogdan</a>');
			?>
		</p>
	</div><!-- .container -->
</footer><!-- #colophon -->
</div> <!-- drawer-content -->
<div class=" drawer-side z-[100]">
	<label for="mini-cart" aria-label="close sidebar" class=" drawer-overlay"></label>
	<div class="mini-cart-div max-w-xl w-full h-full py-10 bg-white flex flex-col">
		<?php woocommerce_mini_cart(); ?>
	</div>
</div>
</div> <!-- drawer -->
</div> <!-- right drawer -->


<div class="lg:hidden drawer-side z-[100]">
	<label for="mobile-menu" aria-label="close sidebar" class="drawer-overlay"></label>
	<nav id="mobile" class="lg:hidden flex flex-col h-full bg-[#F3F3F3] pt-2">

		<div class="w-4/5 mx-auto flex flex-row items-center justify-between py-5 border-b-2">

			<a href="/" class="block">
				<?php
				$custom_logo_id = get_theme_mod('custom_logo');
				$logo = wp_get_attachment_image_src($custom_logo_id, 'full');

				if (has_custom_logo()) {
					echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="w-24">';
				} else {
					echo '<h1>' . get_bloginfo('name') . '</h1>';
				}
				?>
			</a>

			<label for="mobile-menu" aria-label="close sidebar"
				class=" p-2 size-10 text-xl flex items-center justify-center">
				<img class="w-full" src="<?php echo get_template_directory_uri(); ?>/images/svg/close.svg"
					alt="close-mobile-menu">
			</label>

		</div>
		<div class=" md:hidden w-4/5 mx-auto flex flex-row items-center justify-between gap-4 mb-5 py-2 border-b-2">

			<!-- User Button for Mobile -->
			<?php
			if (class_exists('WooCommerce')) {
				$my_account_url = wc_get_page_permalink('myaccount');
				?>

				<a href="<?php echo esc_url($my_account_url); ?>" class="btn btn-ghost btn-sm size-12 relative">
					<img src="<?php echo get_template_directory_uri(); ?>/images/svg/user.svg" alt="contul-meu">
				</a>
				<?php
			}
			?>

			<!-- Heart Icon for Favorites -->
			<a href="<?php echo esc_url(home_url('/wishlist')); ?>" class="btn btn-ghost btn-md size-auto relative">
				<img src="<?php echo get_template_directory_uri(); ?>/images/svg/favorite.svg" alt="fav">
				<?php echo do_shortcode("[ti_wishlist_products_counter]"); ?>
			</a>

			<!-- Cart Icon -->
			<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn btn-ghost btn-sm size-12 relative">
				<img src="<?php echo get_template_directory_uri(); ?>/images/svg/cart.svg" alt="cart">
				<span class="cart-count cart-count-header"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			</a>
		</div>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-mobile',
				'menu_id' => 'primary-menu',
				'menu_class' => 'menu menu-lg bg-[#F3F3F3]',
				'walker' => new Mobile_Menu_Walker(),
			)
		);
		?>
		<div class="flex-grow"></div>
		<div class="mt-auto p-4 bg-black text-white flex flex-row items-center justify-center">
			<?php echo show_social(); ?>
		</div>
	</nav>
</div> <!-- drawer-side -->
</div> <!-- drawer -->


<?php wp_footer(); ?>


</body>

</html>