<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$allowed_html = array(
    'a' => array(
        'href' => array(),
        'class' => array(),
    ),
);
?>

<h3 class="text-3xl font-medium mt-5">
    <?php
    printf(
        /* translators: 1: user display name 2: logout url */
        wp_kses(__('Bună %1$s (Nu ești %1$s? <a class="%3$s" href="%2$s">Deconectare</a>)', 'woocommerce'), $allowed_html),
        '<strong>' . esc_html($current_user->display_name) . '</strong>',
        esc_url(wc_logout_url()),
        'underline hover:text-primary'
    );
    ?>
</h3>

<p class="text-lg font-light text-[#2b2b2b] my-4">
    <?php
    /* translators: 1: Orders URL 2: Address URL 3: Account URL. */
    $dashboard_desc = __('Din acest panou de control poți să vezi <a class="underline hover:text-primary" href="%1$s">comenzile recente</a>, să editezi <a class="underline hover:text-primary" href="%2$s">adresa de facturare</a> și <a class="underline hover:text-primary" href="%3$s">să schimbi parola și datele contului</a>.', 'woocommerce');
    if (wc_shipping_enabled()) {
        /* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
        $dashboard_desc = __('Din acest panou de control poți să vezi <a class="underline hover:text-primary" href="%1$s">comenzile recente</a>, să editezi <a class="underline hover:text-primary" href="%2$s">adresele de facturare și livrare</a>, și <a class="underline hover:text-primary" href="%3$s">să schimbi parola și datele contului</a>.', 'woocommerce');
    }
    printf(
        wp_kses($dashboard_desc, $allowed_html),
        esc_url(wc_get_endpoint_url('orders')),
        esc_url(wc_get_endpoint_url('edit-address')),
        esc_url(wc_get_endpoint_url('edit-account'))
    );
    ?>
</p>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
