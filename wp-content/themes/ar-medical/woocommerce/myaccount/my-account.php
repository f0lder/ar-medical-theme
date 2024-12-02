<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

get_header('shop');

?>

<div class=" max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-5 py-10 px-5 lg:px-0">

    <?php
    /**
     * My Account navigation.
     *
     * @since 2.6.0
     */
    do_action('woocommerce_account_navigation'); ?>

    <div class="col-span-1 sm:col-span-2 lg:col-span-5">
        <?php
        /**
         * My Account content.
         *
         * @since 2.6.0
         */
        do_action('woocommerce_account_content');
        ?>
    </div>
</div>