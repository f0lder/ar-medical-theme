<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined('ABSPATH') || exit;

/* translators: %s: Quantity. */
$label = !empty($args['product_name']) ? sprintf(esc_html__('%s quantity', 'woocommerce'), wp_strip_all_tags($args['product_name'])) : esc_html__('Quantity', 'woocommerce');

?>
<div class="quantity grid grid-cols-3 gap-0 add-to-cart-div">
    <?php
    /**
     * Hook to output something before the quantity input field.pu
     *
     * @since 7.2.0
     */
    do_action('woocommerce_before_quantity_input_field');
    ?>
    <label class="hidden invisible screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label>

    <div
        class="quantity quantity-down flex items-center justify-center hover:border-primary hover:border-2 hover:cursor-pointer">
        <i class="fa fa-solid fa-minus fa-lg"></i>
    </div>

    <input 
        type="<?php echo esc_attr($type); ?>" <?php echo $readonly ? 'readonly="readonly"' : ''; ?>
        id="<?php echo esc_attr($input_id); ?>"
        class="text-center p-2 focus:border-primary focus:outline-primary"
        name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>"
        aria-label="<?php esc_attr_e('Product quantity', 'woocommerce'); ?>" size="4"
        min="<?php echo esc_attr($min_value); ?>" max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>" <?php
                    if (!$readonly): ?> step="<?php echo esc_attr($step); ?>" placeholder="<?php echo esc_attr($placeholder); ?>"
            inputmode="<?php echo esc_attr($inputmode); ?>"
            autocomplete="<?php echo esc_attr(isset($autocomplete) ? $autocomplete : 'on'); ?>" <?php endif; ?> />
    <div
        class="quantity quantity-up flex items-center justify-center hover:border-primary hover:border-2 hover:cursor-pointer">
        <i class="fa fa-solid fa-plus fa-lg"></i>
    </div>
    <?php
    /**
     * Hook to output something after quantity input field
     *
     * @since 3.6.0
     */
    do_action('woocommerce_after_quantity_input_field');
    ?>
</div>
<?php
