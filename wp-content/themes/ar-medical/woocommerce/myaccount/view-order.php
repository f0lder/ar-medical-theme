<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined('ABSPATH') || exit;

$notes = $order->get_customer_order_notes();
?>
<p class="text-xl mb-5">
    <?php
    printf(
        /* translators: 1: order number 2: order date 3: order status */
        esc_html__('Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce'),
        '<strong>' . $order->get_order_number() . '</strong>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        '<strong>' . wc_format_datetime($order->get_date_created()) . '</strong>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        '<strong>' . wc_get_order_status_name($order->get_status()) . '</strong>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    );
    ?>
</p>

<?php if ($notes): ?>
    <h2 class="text-xl mb-5"><?php esc_html_e('Order updates', 'woocommerce'); ?></h2>
    <ol>
        <?php foreach ($notes as $note): ?>
            <li class=" grid grid-cols-2 gap-5 bg-gray-50 rounded p-3">
                <p>
                    <?php echo date_i18n(esc_html__('l jS \o\f F Y, h:ia', 'woocommerce'), strtotime($note->comment_date)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </p>
                    <?php echo wpautop(wptexturize($note->comment_content)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>

<?php do_action('woocommerce_view_order', $order_id); ?>