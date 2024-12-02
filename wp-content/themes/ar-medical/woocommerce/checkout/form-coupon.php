<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

if (!wc_coupons_enabled()) { // @codingStandardsIgnoreLine.
    return;
}

?>
<div class="woocommerce-form-coupon-toggle mt-5">
    <?php wc_print_notice(
        '<i class="fa fa-gift"></i> ' .
        apply_filters('woocommerce_checkout_coupon_message', esc_html__('Have a coupon?', 'woocommerce') . ' <a href="#" class="showcoupon">' . esc_html__('Click here to enter your code', 'woocommerce') . '</a>'),
        'notice'
    ); ?>
</div>

<form class="checkout_coupon woocommerce-form-coupon bg-gray-100 py-8 px-5 flex flex-row gap-5" method="post"
    style="display:none">

    <label class="input rounded-none without-ring input-text flex items-center gap-2" for="coupon_code"
        class="screen-reader-text">
        <?php esc_html_e('Coupon:', 'woocommerce'); ?>
        <input type="text" name="coupon_code" class="grow" id="coupon_code" value="" />
    </label>

    <button type="submit"
        class=" btn btn-primary uppercase <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
        name="apply_coupon"
        value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
</form>