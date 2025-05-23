<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<h3 class="text-3xl font-medium my-4">
    <?php esc_html_e('Account details', 'woocommerce'); ?>
</h3>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

    <?php do_action('woocommerce_edit_account_form_start'); ?>

    <div class=" w-full grid grid-cols-1 md:grid-cols-2 gap-5">
        <label class="input rounded-none without-ring input-text flex items-center gap-1"
            for="account_first_name"><?php esc_html_e('First name', 'woocommerce'); ?>
            <span class="required">*</span>
            <input type="text" class="grow" name="account_first_name" id="account_first_name" autocomplete="given-name"
                value="<?php echo esc_attr($user->first_name); ?>" />
        </label>


        <label class="input rounded-none without-ring input-text flex items-center gap-1"
            for="account_last_name"><?php esc_html_e('Last name', 'woocommerce'); ?>
            <span class="required">*</span>
            <input type="text" class="grow" name="account_last_name" id="account_last_name" autocomplete="family-name"
                value="<?php echo esc_attr($user->last_name); ?>" />
        </label>
    </div>

    <!-- Here was the display name field -->

    <label class="input rounded-none without-ring input-text flex items-center gap-1"
        for="account_email"><?php esc_html_e('Email address', 'woocommerce'); ?>
        <span class="required">*</span>
        <input type="email" class="grow" name="account_email" id="account_email" autocomplete="email"
            value="<?php echo esc_attr($user->user_email); ?>" />
    </label>

    <?php
    /**
     * Hook where additional fields should be rendered.
     *
     * @since 8.7.0
     */
    do_action('woocommerce_edit_account_form_fields');
    ?>

    <fieldset>
        <legend class="text-3xl font-medium my-4"><?php esc_html_e('Password change', 'woocommerce'); ?></legend>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label
                for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                name="password_current" id="password_current" autocomplete="off" />
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label
                for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1"
                id="password_1" autocomplete="off" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2"
                id="password_2" autocomplete="off" />
        </p>
    </fieldset>
    <div class="clear"></div>

    <?php
    /**
     * My Account edit account form.
     *
     * @since 2.6.0
     */
    do_action('woocommerce_edit_account_form');
    ?>

    <p>
        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
        <button type="submit" class="btn btn-primary" name="save_account_details"
            value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
        <input type="hidden" name="action" value="save_account_details" />
    </p>

    <?php do_action('woocommerce_edit_account_form_end'); ?>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>