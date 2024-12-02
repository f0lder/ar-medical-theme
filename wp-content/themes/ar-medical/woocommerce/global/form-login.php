<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (is_user_logged_in()) {
    return;
}

?>
<form class="woocommerce-form woocommerce-form-login login bg-gray-100 py-8 px-5" method="post" <?php echo ($hidden) ? 'style="display:none;"' : ''; ?>>

    <?php do_action('woocommerce_login_form_start'); ?>

    <?php echo ($message) ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine ?>

    <div class=" grid grid-cols-2 gap-1 md:gap-5 py-3">

        <label class="input rounded-none without-ring input-text flex items-center gap-2 col-span-2 md:col-span-1"
            for="username">
            <i class=" fa-solid fa-user account-icon"></i>
            <span class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span>

            <input type="text" class="grow" name="username" id="username" autocomplete="username" required
                aria-required="true" />
        </label>

        <label class="input rounded-none without-ring input-text flex items-center gap-2 col-span-2 md:col-span-1"
            for="password">
            <i class=" fa-solid fa-key account-icon"></i>
            <span class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span>

            <input class="grow" type="password" name="password" id="password" autocomplete="current-password" required
                aria-required="true" />
        </label>

        <?php do_action('woocommerce_login_form'); ?>

        <div class=" flex items-center justify-center">
            <label
                class="flex items-center gap-2 woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                <input
                    class="checkbox checked:checkbox-primary rounded-none woocommerce-form__input woocommerce-form__input-checkbox"
                    name="rememberme" type="checkbox" id="rememberme" value="forever" />
                <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
            </label>
        </div>

        <div class="flex items-center justify-center">
            <a class="underline hover:text-primary"
                href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
        </div>
    </div>

    <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

    <input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>" />

    <div class="w-full flex items-center justify-center">
        <button type="submit"
            class=" btn btn-primary uppercase woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
            name="login"
            value="<?php esc_attr_e('Login', 'woocommerce'); ?>"><?php esc_html_e('Login', 'woocommerce'); ?></button>
    </div>
    <?php do_action('woocommerce_login_form_end'); ?>

</form>