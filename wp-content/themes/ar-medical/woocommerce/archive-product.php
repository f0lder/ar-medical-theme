<?php
defined('ABSPATH') || exit;

get_header();
get_header('shop');


/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');


// Fetch product categories
$product_categories = get_terms(array(
	'taxonomy' => 'product_cat',
	'hide_empty' => true,
));

show_product_carousel();

?>

<div class=" grid grid-cols-1 lg:grid-cols-4 gap-2 max-w-6xl mx-auto py-20">

	<?php if (is_active_sidebar('shop-sidebar')): ?>
		<aside id="secondary"
			class="col-span-1 collapse collapse-plus lg:collapse-open border rounded-none lg:border-0">
			<input type="checkbox" />
			<div class="collapse-title text-xl font-medium lg:hidden"><?php _e("Filters", "ar-medical") ?></div>
			<div class="collapse-content">
				<?php dynamic_sidebar('shop-sidebar'); ?>
			</div>
		</aside><!-- #secondary -->
	<?php endif; ?>

	<div class=" col-span-1 lg:col-span-3">
		<?php

		if (woocommerce_product_loop()) {
			?>

			<div class="w-5/6 mx-auto lg:w-1/2 lg:ml-auto lg:mr-0 py-7">
				<?php echo woocommerce_catalog_ordering(); ?>
			</div>
			<?php

			woocommerce_product_loop_start();

			if (wc_get_loop_prop('total')) {

				while (have_posts()) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');

					wc_get_template_part('content', 'product');
				}

			}

			woocommerce_product_loop_end();
			?>
			<div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5 mt-10 pt-8"
				style="border-top: 1px solid rgb(232, 232, 232);">
				<div class="flex justify-center md:justify-normal items-center">
					<?php echo woocommerce_result_count(); ?>
				</div>
				<?php
				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action('woocommerce_after_shop_loop');
				?>
			</div>
			<?php
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action('woocommerce_no_products_found');
		}

		/**
		 * Hook: woocommerce_shop_loop_footer.
		 */
		do_action('woocommerce_shop_loop_footer');
		?>
	</div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */

do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action('woocommerce_sidebar');

get_footer('shop');
?>