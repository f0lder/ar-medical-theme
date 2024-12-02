<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

$_stock_status = $product->get_stock_status();

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

?>
<div class="max-w-6xl container mx-auto" id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="relative">
            <?php
            // Show Product Sale Flash
            woocommerce_show_product_sale_flash();

            // Get the main product image
            $main_image_url = get_the_post_thumbnail_url($product->get_id(), 'full');
            if ($main_image_url) {
                echo '<div class="product-image-carousel">';
                echo '<div><img src="' . esc_url($main_image_url) . '" alt=""></div>';
            }

            // Get product gallery images
            $attachment_ids = $product->get_gallery_image_ids();
            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                    $image_url = wp_get_attachment_url($attachment_id);
                    if ($image_url) {
                        echo '<div><img src="' . esc_url($image_url) . '" alt=""></div>';
                    } else {
                        echo '<div><p>Image not found for attachment ID: ' . esc_html($attachment_id) . '</p></div>';
                    }
                }
            }

            // Close the carousel div
            echo '</div>';
            ?>
        </div>
        <div class=" mx-4 md:mx-0">
            <div class=" grid grid-cols-2">
                <div>
                    <?php $sku = $product->get_sku();
                    if (!empty($sku)) { ?>
                        <div class=" mb-5"><?php _e('Cod Produs ', 'woocommerce'); ?> <strong><?php echo $sku; ?></strong>
                        </div>
                    <?php } ?>
                    <div class=" mb-5 flex flex-row gap-4">
                        <?php echo wc_single_product_ratings(); ?>
                        <a class="underline hover:text-primary transition-all duration-300" role="tab"
                            href="#tab-title-reviews" aria-controls="tab-reviews" title="">(<?php $no = $product->get_rating_count();
                            if ($no == 1) {
                                echo 'o recenzie';
                            } else {
                                echo $no . ' recenzii';
                            }
                            ?>)
                        </a>
                    </div>
                </div>

                <div class="stock_info flex items-center">
                    <?php

                    if ('instock' == $_stock_status) {
                        ?>
                        <span class="stock in-stock font-bold text-base ml-auto">
                            <i class="fa fa-check-circle fa-xl"></i>
                            <?php echo __('In stock', 'woocommerce') ?>
                        </span>
                        <?php
                    } else if ('outofstock' == $_stock_status) {
                        ?>
                            <span class="stock out-of-stock font-bold text-base ml-auto">
                                <i class="fa-solid fa-circle-xmark  fa-xl"></i>
                            <?php echo __('Out of stock', 'woocommerce') ?>
                            </span>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <?php $premium = get_field('premium', $product->get_id());
            if ($premium) {
                ?>
                <div class="flex flex-row items-center py-4 space-x-3">
                    <p class=" text-red-500">Produs disponibil doar pentru profesionisti verificati.</p>
                    <div class="tooltip" data-tip="Acest produs este valabil doar pentru profesionisti verificati">
                        <i class=" fa fa-question-circle fa-lg"></i>
                    </div>
                </div>
                <?php
            } ?>

            <div class="desc">
                <?php woocommerce_template_single_excerpt(); ?>
            </div>

            <?php

            if ('instock' == $_stock_status) {

                woocommerce_template_single_price();
                ?>
                <div class="w-full flex flex-row mb-5 gap-20">

                    <?php

                    // Add to Cart Button
                    woocommerce_template_single_add_to_cart();

                    echo do_shortcode("[ti_wishlists_addtowishlist product_id='" . $product->get_ID() . "' loop=yes]");

                    ?>
                </div>
                <?php
            } else if ('outofstock' == $_stock_status) {
                ?>
                    <div class="w-full grid grid-cols-2 gap-5">

                        <?php
                        woocommerce_template_single_price();
                        ?>

                        <div class="flex items-center">
                            <?php
                            echo do_shortcode("[ti_wishlists_addtowishlist product_id='" . $product->get_ID() . "' loop=yes]");
                            ?>
                        </div>
                    </div>
                <?php
            }
            echo show_features_product();
            ?>
        </div>
    </div>
    <div class="w-full mt-16">
        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action('woocommerce_after_single_product_summary');

        ?>
        <div class="container max-w-6xl mx-auto my-14">
            <h2 class="mb-5 text-3xl leading-tight font-medium">Cele mai populare produse</h2>
            <div class="products-home" aria-hidden="false">
                <?php echo show_loop_products('random'); ?>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>