<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

$premium = get_field('premium', $product->get_id());

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}

// Calculate discount percentage
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$discount_percentage = 0;

if ($regular_price && $sale_price) {
    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
}

// Determine the HTML tag to use
$tag = is_woocommerce() ? 'li' : 'div';

?>

<<?php echo $tag; ?> class="max-w-64 mx-auto" <?php wc_product_class('', $product); ?>>

    <div class="relative group mx-auto">

        <div class="product-thumbnail bg-cover bg-center h-52 w-52 transition duration-300 ease-in-out mx-auto"
            style="background-image: url('<?php echo wp_get_attachment_url($product->get_image_id()); ?>');">
            <div class="absolute inset-0 prod-effect opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
            <?php if ($discount_percentage > 0): ?>
                <div class="absolute top-4 left-0 bg-[#276331] text-white text-xl font-normal px-2 py-1">
                    -<?php echo $discount_percentage; ?>%
                </div>
            <?php endif; ?>
        </div>
        <div
            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="add-to-cart flex flex-col items-center">
                <?php
                if (current_user_can('professional_customer')) {
                    woocommerce_template_loop_add_to_cart();
                } elseif ($premium) {
                    ?>
                    <p class=" btn btn-secondary btn-outline rounded-none uppercase">
                        <?php
                        _e('Professional product', 'ar-medical');
                        ?>
                    </p>
                    <?php
                } else {
                    woocommerce_template_loop_add_to_cart();
                }
                ?>
            </div>
            <div class="absolute top-3 right-0">
                <?php echo do_shortcode("[ti_wishlists_addtowishlist product_id='" . $id . "' loop=yes]"); ?>
            </div>
        </div>
    </div>

    <!-- Product title as a link -->
    <div class="mt-4 text-center text-base">
        <a href="<?php echo get_permalink($product->get_id()); ?>"
            class="text-base font-semibold capitalize hover:text-primary leading-[22.5px]">
            <?php echo $product->get_name(); ?>
        </a>
    </div>

    <!-- Product price -->
    <div class="mt-2 text-center text-base lg:text-lg">
        <?php if ($sale_price): ?>
            <span class="line-through text-xs"><?php echo wc_price($regular_price); ?></span>
            <span class="text-lg"><?php echo wc_price($sale_price); ?></span>
        <?php else: ?>
            <span class="text-lg"><?php echo wc_price($regular_price); ?></span>
        <?php endif; ?>
    </div>

</<?php echo $tag; ?>>