<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

global $product;

if (!$product->is_purchasable()) {
    return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()):
    $premium = get_field('premium', $product->get_id());
    ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart flex items-center justify-between w-full gap-4"
        action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
        method="post" enctype='multipart/form-data'>
        <?php


        if (current_user_can('professional_customer')) {

            do_action('woocommerce_before_add_to_cart_button'); ?>

            <?php

            do_action('woocommerce_before_add_to_cart_quantity');

            woocommerce_quantity_input(
                array(
                    'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                    'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                    'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                )
            );

            do_action('woocommerce_after_add_to_cart_quantity');

            ?>
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                class=" btn btn-primary <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>


            <?php

        } elseif ($premium) {
            ?>
            <!-- The button to open modal -->
            <label for="my_modal_7" class="btn btn-primary">Inregistrare profesionist</label>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my_modal_7" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="text-lg font-bold text-center">Inregistrare cont profesionist</h3>
                    <p class="py-4">Pentru a cere un cont de profesionist te rog acceseaza link-ul de mai jos pentru a
                        completa formularul.</p>
                    <div class=" flex items-center justify-center w-full">
                        <a class=" btn btn-outline rounded-none mx-auto" href="">Formular</a>
                    </div>
                </div>
                <label class="modal-backdrop" for="my_modal_7">Inchide</label>
            </div>
            <?php
        } else {
            do_action('woocommerce_before_add_to_cart_button'); ?>

            <?php

            do_action('woocommerce_before_add_to_cart_quantity');

            woocommerce_quantity_input(
                array(
                    'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                    'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                    'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                )
            );

            do_action('woocommerce_after_add_to_cart_quantity');
            ?>
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                class=" btn btn-primary <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

            <?php

        }
        ?>

    </form>


    <?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>