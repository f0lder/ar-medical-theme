<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');


$icons = array(
    'dashboard' => 'fas fa-tachometer-alt',
    'orders' => 'fas fa-shopping-bag',
    'downloads' => 'fas fa-download',
    'edit-address' => 'fas fa-map-marker-alt',
    'payment-methods' => 'fas fa-credit-card',
    'edit-account' => 'fas fa-user',
    'wishlist' => 'fas fa-heart',
    'customer-logout' => 'fas fa-sign-out-alt',
);

?>

<nav class="col-span-1 lg:col-span-2 woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e('Account pages', 'woocommerce'); ?>">
    <ul class=" bg-gray-50 px-4 font-normal">
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label): ?>

            <li class=" item-serv relative w-full h-fit hover:bg-white <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                <a class=" w-full p-4 block relative" href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" <?php echo wc_is_current_account_menu_item($endpoint) ? 'aria-current="page"' : ''; ?>>
                    <?php if (isset($icons[$endpoint])): ?>
                        <i class="<?php echo esc_attr($icons[$endpoint]); ?>"></i>
                    <?php endif; ?>
                    <?php echo esc_html($label); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>