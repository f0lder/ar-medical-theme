<?php
/*
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div class="h-screen grid grid-cols-1 lg:grid-cols-2">

    <div class="w-full flex items-center justify-center">

        <div class="w-11/12 lg:w-4/5 xl:w-2/3 mx-auto" id="to-scroll">

            <?php do_action('woocommerce_before_customer_login_form'); ?>

            <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')):

                $logo_svg = get_field('logo_header', 'options');
                if (!empty($logo_svg)) { ?>
                    <a class="block w-fit mx-auto" href="<?php echo site_url(); ?>" title="">
                        <img class=" w-52" src="<?php echo $logo_svg['url']; ?>" alt="<?php echo $logo_svg['alt']; ?>">
                    </a>
                <?php }

                if (isset($_GET['action']) && $_GET['action'] == "register"): ?>

                    <!-- Section for registration -->

                    <h2 class="text-4xl mt-8 text-center"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

                    <p class="mb-4 text-base mx-4 text-[#2b2b2b] leading-relaxed font-light text-center">
                        <?php _e('Vă rugăm să completați informațiile de mai jos:', 'ar-medical'); ?>
                    </p>

                    <form method="post" class=" flex flex-col space-y-5 pb-10 max-w-md mx-auto" <?php do_action('woocommerce_register_form_tag'); ?>>

                        <?php do_action('woocommerce_register_form_start'); ?>

                        <label class="input input-primary input-bordered flex items-center gap-2"
                            for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>*

                            <input required type="text" class="grow" name="username" id="reg_username" autocomplete="username"
                                value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
                        </label>

                        <label class="input input-primary input-bordered flex items-center gap-2"
                            for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>*
                            <input required type="email" class="grow" name="email" id="reg_email" autocomplete="email"
                                value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />
                        </label>

                        <label class="input input-primary input-bordered flex items-center gap-2"
                            for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>*
                            <input required type="password" class="grow" name="password" id="reg_password"
                                autocomplete="new-password" />
                        </label>

                        <?php do_action('woocommerce_register_form'); ?>


                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>


                        <button type="submit" class="btn btn-primary uppercase" name="register"
                            value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
                            <?php esc_html_e('Register', 'woocommerce'); ?>
                        </button>

                        <p class="text-center"><?php _e('Sau te poti folosi alternativele:', THEME_TEXT_DOMAIN); ?></p>

                        <div class="grid grid-cols-2 gap-5">
                            <a href="https://armedicalcosmetic.ro/wp-login.php?itsec-hb-token=aaccess&loginSocial=facebook"
                                data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook"
                                data-popupwidth="600" data-popupheight="679" data-popupwidth="475" data-popupheight="175"
                                class="btn btn-outline rounded-none">
                                <div>
                                    <i class="fab fa-facebook-f"></i>
                                    <?php esc_html_e('Log in', 'woocommerce'); ?>
                                    <?php _e('cu Facebook', THEME_TEXT_DOMAIN); ?>
                                </div>
                            </a>

                            <a href="https://armedicalcosmetic.ro/wp-login.php?itsec-hb-token=aaccess&loginSocial=google"
                                data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google"
                                data-popupwidth="600" data-popupheight="600" class="btn btn-outline rounded-none">
                                <div>
                                    <i class="fab fa-google"></i>
                                    <?php esc_html_e('Log in', 'woocommerce'); ?>
                                    <?php _e('cu Google', THEME_TEXT_DOMAIN); ?>
                                </div>
                            </a>
                        </div>



                        <div class=" w-fit mx-auto">
                            <span><?php _e('Ai deja un cont?', THEME_TEXT_DOMAIN); ?></span>

                            <?php $my_account_url = wc_get_page_permalink('myaccount'); ?>

                            <a href="<?php echo esc_url($my_account_url); ?>" class=" underline hover:text-primary">
                                <?php esc_attr_e('Login', 'woocommerce'); ?>
                            </a>
                        </div>


                        <?php do_action('woocommerce_register_form_end'); ?>

                    </form>

                <?php else: ?>
                    <!-- Section for Login form -->

                    <h2 class=" text-4xl mt-8 text-center"><?php esc_html_e('Login', 'woocommerce'); ?></h2>
                    <p class="mb-4 text-base mx-4 text-[#2b2b2b] leading-relaxed font-light text-center">
                        <?php _e('Acesta este un sistem securizat și va trebui să furnizați informațiile de conectare pentru a accesa site-ul.', THEME_TEXT_DOMAIN); ?>
                    </p>

                    <form class="flex flex-col space-y-5 max-w-md mx-auto" method="post">

                        <?php do_action('woocommerce_login_form_start'); ?>

                        <label class="input input-primary input-text flex items-center gap-2 without-ring rounded-none" for="username">
                            <i class=" fa-solid fa-user account-icon"></i>

                            <input required placeholder="<?php esc_html_e('Username or email address', 'woocommerce'); ?>*"
                                type="text" class="grow" name="username" id="username" autocomplete="username" />
                        </label>

                        <label class="input input-primary input-text flex items-center gap-2 without-ring rounded-none" for="password">
                            <i class=" fa-solid fa-key account-icon"></i>
                            <input type="password" class="grow" name="password" id="password" autocomplete="current-password"
                                required placeholder="<?php esc_html_e('Password', 'woocommerce'); ?>*" />
                        </label>

                        <?php do_action('woocommerce_login_form');

                        wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

                        <div class="w-full grid grid-cols-2">

                            <label class="flex flex-row w-fit space-x-4">
                                <input class="checkbox rounded-none" name="rememberme" type="checkbox" id="rememberme"
                                    value="forever" />
                                <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                            </label>

                            <a class="underline hover:text-primary text-right"
                                href="<?php echo esc_url(wp_lostpassword_url()); ?>">
                                <?php esc_html_e('Lost your password?', 'woocommerce'); ?>
                            </a>
                        </div>

                        <button type="submit" class="btn btn-primary uppercase" name="login"
                            value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>


                        <p class="text-center"><?php _e('Sau te poti folosi alternativele:', THEME_TEXT_DOMAIN); ?></p>
                        <div class="grid grid-cols-2 gap-5">

                            <a href="https://armedicalcosmetic.ro/wp-login.php?itsec-hb-token=aaccess&loginSocial=facebook"
                                data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook"
                                data-popupwidth="600" data-popupheight="679" data-popupwidth="475" data-popupheight="175"
                                class="btn btn-outline rounded-none">
                                <div>
                                    <i class="fab fa-facebook-f"></i>
                                    <?php esc_html_e('Log in', 'woocommerce'); ?>
                                    <?php _e('cu Facebook', THEME_TEXT_DOMAIN); ?>
                                </div>
                            </a>

                            <a href="https://armedicalcosmetic.ro/wp-login.php?itsec-hb-token=aaccess&loginSocial=google"
                                data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google"
                                data-popupwidth="600" data-popupheight="600" class="btn btn-outline rounded-none ">
                                <div>
                                    <i class="fab fa-google"></i>
                                    <?php esc_html_e('Log in', 'woocommerce'); ?>
                                    <?php _e('cu Google', THEME_TEXT_DOMAIN); ?>
                                </div>
                            </a>

                        </div>

                        <?php wc_get_page_permalink('myaccount'); ?>

                        <div class=" w-fit mx-auto">
                            <span><?php _e('Esti client nou?', THEME_TEXT_DOMAIN); ?></span>

                            <?php $my_account_url = wc_get_page_permalink('myaccount'); ?>

                            <a href="<?php echo esc_url($my_account_url) . '?action=register'; ?>"
                                class=" underline hover:text-primary">
                                <?php _e('Inregistrare', THEME_TEXT_DOMAIN); ?>
                            </a>
                        </div>


                        <?php do_action('woocommerce_login_form_end'); ?>

                    </form>

                <?php endif;

            endif;

            do_action('woocommerce_after_customer_login_form'); ?>
        </div>
    </div>
    <?php $image_error = get_field('my_account_image', 'options');
    if (!empty($image_error)) { ?>
        <div class="w-full h-full absolute -z-10 opacity-10 lg:relative lg:opacity-100 lg:z-0"
            style="background-image: url(<?php echo $image_error['url']; ?>)"></div>
    <?php } ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('to-scroll').scrollIntoView({ block: 'center' });
    });
</script>