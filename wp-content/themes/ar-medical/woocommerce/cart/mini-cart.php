<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<div class=" w-11/12 mx-auto bg-[#F3F3F3] my-4 flex items-center justify-between p-6">
    <div class="flex flex-row space-x-3">
        <h2 class="text-2xl"><?php _e('Shopping cart', 'ar-medical'); ?></h2>
        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/cart.svg" alt="cart">
    </div>
    <label for="mini-cart" aria-label="close sidebar" class="btn btn-ghost">
        <i class="fa-solid fa-2x fa-xmark w-full"></i>
    </label>

</div>

<div class=" pt-10 px-8 h-full flex flex-col">
    <?php if (!WC()->cart->is_empty()): ?>

        <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
            <?php
            do_action('woocommerce_before_mini_cart_contents');

            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    /**
                     * This filter is documented in woocommerce/templates/cart/cart.php.
                     *
                     * @since 2.1.0
                     */
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                    $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>
                    <li
                        class=" grid grid-cols-8 border-b border-[#e8e8e8] pb-4 mb-3 gap-4 <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                        <?php if (empty($product_permalink)): ?>
                            <?php echo $thumbnail . wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php else: ?>
                            <!-- Product image -->
                            <a class=" col-span-2 border border-[#ececec]" href="<?php echo esc_url($product_permalink); ?>">
                                <?php echo $thumbnail // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </a>
                            <!-- Product link -->
                            <a class=" col-span-4 text-lg font-medium leading-tight flex items-center hover:text-primary"
                                href="<?php echo esc_url($product_permalink) ?>">
                                <?php echo wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </a>
                        <?php endif; ?>

                        <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                        <div class=" col-span-2 flex flex-col gap-4">
                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="far fa-trash-alt hover:text-red-500"></i></a>',
                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                    esc_attr__('Remove this item', 'woocommerce'),
                                    esc_attr($product_id),
                                    esc_attr($cart_item_key),
                                    esc_attr($_product->get_sku())
                                ),
                                $cart_item_key
                            );
                            ?>

                            <span
                                class="subtotal_prod"><?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?></span>
                            <input type="hidden" name="current-key" value="<?php echo $cart_item_key; ?>" class="current-key">


                            <?php
                            if ($_product->is_sold_individually()) {
                                $product_quantity = sprintf('<input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                            } else {
                                $input_args = array(
                                    'input_name' => "cart[{$cart_item_key}][qty]",
                                    'input_value' => $cart_item['quantity'],
                                    'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                    'min_value' => '0',
                                );

                                $product_quantity = woocommerce_quantity_input($input_args, $_product, true);

                            }
                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                            ?>
                        </div>
                    </li>

                    <?php
                }
            }

            do_action('woocommerce_mini_cart_contents');
            ?>
        </ul>

        <a href="<?php echo wc_get_page_permalink('shop'); ?>"
            class=" underline hover:text-primary"><?php echo __('Continuă cumpărăturile', 'woocommerce') ?></a>

        <div class="flex-grow"></div>

        <div class="mt-3 pt-3 border-t border-[#e8e8e8]">
            <div class="grid grid-cols-2 text-xl font-bold leading-tight mb-5">
                <p><?php echo __('Subtotal: ', 'woocommerce') ?></p>
                <p class="text-right"><?php echo WC()->cart->get_cart_subtotal(); ?></p>
            </div>
            <?php echo show_rest_payment(); ?>
            <a href="<?php echo wc_get_checkout_url(); ?>"
                class="btn btn-primary uppercase w-full"><?php echo __('Finalizare comandă', 'woocommerce') ?></a>
        </div>
        <input type="hidden" name="_wp_http_referer" value="<?php echo wc_get_cart_url(); ?>">

        <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

    <?php else: ?>

        <div class="cart-detail">
            <p class="no-products"><?php _e('No items in cart!', 'ar-medical'); ?></p>
            <div class="continue-shopping"><a href="<?php echo wc_get_page_permalink('shop'); ?>"
                    class="link-btn underline hover:text-primary"><?php echo __('Continuă cumpărăturile', 'woocommerce') ?></a>
            </div>
        </div>

    <?php endif; ?>

    <?php do_action('woocommerce_after_mini_cart'); ?>

</div>