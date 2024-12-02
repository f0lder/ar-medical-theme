<?php
/**
 * The Template for displaying dropdown wishlist products.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-wishlist-product-counter.php.
 *
 * @version             2.8.0
 * @package           TInvWishlist\Template
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
wp_enqueue_script('tinvwl');
if ($icon_class && 'custom' === $icon && !empty($icon_upload)) {
    $text = sprintf('<img alt="%s" src="%s" /> %s', apply_filters('tinvwl_default_wishlist_title', tinv_get_option('general', 'default_title')), esc_url($icon_upload), $text);
}
?>

<?php if ($show_counter): ?>
    <span class="wishlist_products_counter_number cart-count"></span>
<?php endif; ?>