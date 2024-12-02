<?php
// minicart

add_action('woocommerce_before_mini_cart_contents', 'mini_cart_nonce');
function mini_cart_nonce()
{
    wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce', false);
}

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    // Update cart count
    $count = $woocommerce->cart->cart_contents_count;
    $fragments['span.cart-count-header'] = '<span class="cart-count-header cart-count">' . $count . '</span>';

    return $fragments;
}

function update_mini_cart($fragments)
{
    // Update mini cart contents
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    $fragments['div.mini-cart-div'] = '<div class="mini-cart-div max-w-xl w-full h-full py-10 bg-white flex flex-col">' . $mini_cart . '</div>';

    return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment', 10, 1);
add_filter('woocommerce_add_to_cart_fragments', 'update_mini_cart', 10, 1);

function show_rest_payment()
{
    ob_start();

    $min_amount = get_field('sum_free', 'options');
    if (!empty($min_amount)) {
        $current = WC()->cart->subtotal;
        if ($current < $min_amount) { ?>
            <p class="py-8 px-3 text-center"><?php
            $added_text = __('Mai adaugă în coș produse în valoare de ', 'woocommerce') . '<strong>' . wc_price($min_amount - $current) . '</strong>' . __(' pentru a beneficia de transport <strong>Gratuit</strong>!', 'woocommerce');
            echo $added_text; ?></p>
        <?php }
    }

    $content = ob_get_clean();
    return $content;
}


function vc_set_cart_quantity()
{
    $res['success'] = '';
    $q = $_POST['quantity'];
    $key = $_POST['data_key'];

    if ($key) {
        if ($q == 0) {
            WC()->cart->remove_cart_item($key);
        } else {
            WC()->cart->set_quantity($key, $q);
        }
    }


    ob_start();

    echo woocommerce_mini_cart();

    $res['success'] = ob_get_clean();

    echo json_encode($res);
    die();
}

add_action('wp_ajax_vc-increase-cart-quantity', 'vc_set_cart_quantity');
add_action('wp_ajax_nopriv_vc-increase-cart-quantity', 'vc_set_cart_quantity');


add_filter('formatted_woocommerce_price', 'ts_woo_decimal_price', 10, 5);


function ts_woo_decimal_price($formatted_price, $price, $decimal_places, $decimal_separator, $thousand_separator)
{
    $unit = number_format(intval($price), 0, $decimal_separator, $thousand_separator);
    $decimal = sprintf('%02d', ($price - intval($price)) * 100);
    return $unit . '<sup>.' . $decimal . '</sup>';
}


// procent discount
function bbloomer_show_sale_percentage_loop($product_id)
{
    $max_percentage = 0;
    //$product = new WC_Product( $product_id );
    $product = wc_get_product($product_id);

    if (get_post_status($product_id) == "publish") {  //var_dump($product->get_available_variations());
        if ($product->has_child()) { //$product->get_available_variations() > 0) {
            $max_percentage = 0;
            foreach ($product->get_children() as $child_id) {
                $variation = wc_get_product($child_id);
                $price = $variation->get_regular_price();
                $sale = $variation->get_sale_price();
                if ($price != 0 && !empty($sale)) {
                    $percentage = ($price - $sale) / $price * 100;
                    if ($percentage > $max_percentage) {
                        $sales_price_from = $variation->get_date_on_sale_from();
                        $sales_price_to = $variation->get_date_on_sale_to();

                        if (!empty($sales_price_to)) {
                            $sales_price_date_to = $sales_price_to->date("Ymd");
                            if (empty($sales_price_from)) {
                                $sales_price_date_from = date("Ymd");
                            } else {
                                $sales_price_date_from = $sales_price_from->date("Ymd");
                            }

                            $today = date('Ymd');

                            if (intval($today) >= intval($sales_price_date_from) && intval($today) <= intval($sales_price_date_to)) {
                                $max_percentage = $percentage;
                            }
                        } else {
                            $max_percentage = $percentage;
                        }
                    }
                }
            }
            if ($max_percentage > 0 && $max_percentage < 100)
                return "<span class='sale'>-" . round($max_percentage) . "%</span>"; // If you would like to show -40% off then add text after % sign
        } else {
            if (!$product->is_on_sale()) {
                return null;
            } else {
                $max_percentage = (($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100;
                // simple product
                $sales_price_from = $product->get_date_on_sale_from();
                $sales_price_to = $product->get_date_on_sale_to();
                if (!empty($sales_price_to)) {
                    $sales_price_date_to = $sales_price_to->date("Ymd");
                    if (empty($sales_price_from)) {
                        $sales_price_date_from = date("Ymd");
                    } else {
                        $sales_price_date_from = $sales_price_from->date("Ymd");
                    }

                    $today = date('Ymd');

                    if (intval($today) >= intval($sales_price_date_from) && intval($today) <= intval($sales_price_date_to)) {
                        if ($max_percentage > 0 && $max_percentage < 100) {
                            return "<span class='sale'>-" . round($max_percentage) . "%</span>";
                        }
                    }
                } else {
                    if ($max_percentage > 0 && $max_percentage < 100)
                        return "<span class='sale'>-" . round($max_percentage) . "%</span>"; // If you would like to show -40% off then add text after % sign
                    else
                        return null;
                }

            }

        }
    }

    return null;

}

function show_product($id)
{
    ob_start();
    $_product = wc_get_product($id); ?>

    <div class="single_product_slide" data-id="<?php echo $id; ?>">
        <div class="wrapp_single_slider">
            <div class="prod_img relative">
                <?php $sale_text = bbloomer_show_sale_percentage_loop($id);
                if (!empty($sale_text)) {
                    echo $sale_text;
                } ?>
                <a href="<?php echo get_permalink($id); ?>" title="<?php echo get_the_title($id); ?>" class="prod-img-a">
                    <div class="prod-img-item">
                        <div class="cover" style="background-image: url(<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
                        if ($img[0]) {
                            echo $img[0];
                        } ?>)"></div>
                    </div>
                </a>
                <?php echo do_shortcode("[ti_wishlists_addtowishlist product_id='" . $id . "' loop=yes]"); ?>

                <div class="warp-button">
                    <?php echo do_shortcode('[add_to_cart id="' . $id . '" show_price="false" style="" quantity="1"]'); ?>
                </div>
            </div>
            <div class="about_product">
                <div class="about_product_text">
                    <div class="prod-info">
                        <h4 class="prod_title"><a href="<?php echo get_permalink($id); ?>"><?php
                           $title = get_the_title($id);
                           echo $title;
                           ?></a></h4>
                    </div>
                    <div class="price-products">
                        <p class="prod_price"><?php echo $_product->get_price_html(); //echo $_product->get_price_html(); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}


function show_sale_product()
{
    ob_start();
    global $post, $product;
    if ($product->is_on_sale() && $product->product_type == 'variable'): ?>
        <span class="onsale-product"><?php
        $available_variations = $product->get_available_variations();
        $maximumper = 0;
        for ($i = 0; $i < count($available_variations); ++$i) {
            $variation_id = $available_variations[$i]['variation_id'];
            $variable_product1 = new WC_Product_Variation($variation_id);
            $regular_price = $variable_product1->regular_price;
            $sales_price = $variable_product1->sale_price;
            $percentage = round(((($regular_price - $sales_price) / $regular_price) * 100), 0, PHP_ROUND_HALF_UP);
            if ($percentage > $maximumper) {
                $maximumper = $percentage;
            }
        }
        echo $price . sprintf(__('-%s', 'woocommerce'), $maximumper . '%');
        ?></span>
    <?php elseif ($product->is_on_sale() && $product->product_type == 'simple'):
        $percentage = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100, 0, PHP_ROUND_HALF_UP);


        if (!empty($percentage)) {
            echo '<span class="onsale-product">' . sprintf(__('-%s', 'woocommerce'), $percentage . '%') . '</span>';
        } ?>

    <?php endif;
    $content = ob_get_clean();
    return $content;
}


remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
//add_filter( 'wc_product_sku_enabled', '__return_false' );

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


// custom ratting
function wc_single_product_ratings()
{
    global $product;

    $rating_count = $product->get_rating_count();

    if ($rating_count >= 0) {
        $review_count = $product->get_review_count();
        $average = $product->get_average_rating();
        $count_html = '<div class="count-rating">' . array_sum($product->get_rating_counts()) . '</div>';
        ?>
        <div class="woocommerce-product-rating">
            <div class="container-rating">
                <div class="star-rating">
                    <?php echo wc_get_rating_html($average, $rating_count); ?>
                </div><?php //echo  $count_html ; ?>
                <?php /*if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a><?php endif */ ?>
            </div>
        </div>
        <?php
    }
}

//This is how you hook a function called by ajax, in WordPress
add_action('wp_ajax_nopriv_ts_calc_percentage_saved', 'ts_calc_percentage_saved');
add_action("wp_ajax_ts_calc_percentage_saved", "ts_calc_percentage_saved");
//The function below is called via an ajax script in footer.php
function ts_calc_percentage_saved()
{
    // The $_REQUEST contains all the data sent via ajax
    if (isset($_POST)) {
        $percentage = 0;
        $variation_id = $_POST['vari_id'];
        $variable_product = wc_get_product($variation_id); //var_dump( $variable_product );
        $regular_price = $variable_product->get_regular_price();
        $sale_price = $variable_product->get_sale_price();

        if (!empty($sale_price)) { // is discout
            $amount_saved = $regular_price - $sale_price;
            // $currency_symbol = get_woocommerce_currency_symbol();
            $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
            $output = '<p class="discount">-' . $percentage . '%</p>';
        }
        echo json_encode(array('percentage' => $percentage, 'output' => $output));
    }
    die();
}

function golden_oak_web_design_woocommerce_checkout_terms_and_conditions()
{
    remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
}
add_action('wp', 'golden_oak_web_design_woocommerce_checkout_terms_and_conditions');



add_filter('woocommerce_show_variation_price', function () {
    return TRUE;
});



//Hide Price Range for WooCommerce Variable Products
add_filter('woocommerce_variable_sale_price_html', 'lw_variable_product_price', 10, 2);
add_filter('woocommerce_variable_price_html', 'lw_variable_product_price', 10, 2);
function lw_variable_product_price($v_price, $v_product)
{
    // Product Price
    if (!$v_product->has_child()) {
        $prod_prices = array($v_product->get_variation_price('min', true), $v_product->get_variation_price('max', true));
        $prod_price = $prod_prices[0] !== $prod_prices[1] ? '<span class="from">De la</span>' . sprintf(__('%1$s', 'woocommerce'), wc_price($prod_prices[0])) : wc_price($prod_prices[0]);

        // Regular Price
        $regular_prices = array($v_product->get_variation_regular_price('min', true), $v_product->get_variation_regular_price('max', true));
        sort($regular_prices);
        $regular_price = $regular_prices[0] !== $regular_prices[1] ? '<span class="from">De la</span>' . sprintf(__('%1$s', 'woocommerce'), wc_price($regular_prices[0])) : wc_price($regular_prices[0]);

        if ($prod_price !== $regular_price) {
            $prod_price = '<del>' . $regular_price . $v_product->get_price_suffix() . '</del> <ins>' . $prod_price . $v_product->get_price_suffix() . '</ins>';
        }

        return $prod_price;
    } else {
        return $v_price;
    }

}


function show_loop_products($type)
{
    ob_start();
    $args = array(
        'ignore_sticky_posts' => true,
        'post_type' => 'product',
        'order' => 'DESC',
        'posts_per_page' => 10,
        'post_status' => array('publish'),
    );

    if ($type == "random") {
        $args['orderby'] = 'rand';
    }

    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            ?>
            <div class="block w-fit mx-auto">
                <?php
                wc_get_template_part('content', 'product');
                ?>
            </div>
            <?php
        }
    }
    wp_reset_query();
    $content = ob_get_clean();
    return $content;
}


/**
 * Remove product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
    unset($tabs['additional_information']);   // Remove the additional information tab
    return $tabs;
}

/**
 * Add a custom product data tab
 */
add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
function woo_new_product_tab($tabs)
{
    // Adds the new tab
    $tabs['support'] = array(
        'title' => __('Informatii Suplimentare', 'woocommerce'),
        'priority' => 25,
        'callback' => 'woo_new_product_tab_content_support'
    );

    return $tabs;
}

function woo_new_product_tab_content_support()
{
    $extra_info = get_field('extra_info');
    if (!empty($extra_info)) { ?>
        <div class="the-content general_content">
            <?php /* <h2><?php   _e( 'Informatii Suplimentare', 'woocommerce' ); ?></h2>*/ ?>
            <?php echo $extra_info; ?>
        </div>
        <?php
    }
}
add_filter('woocommerce_output_related_products_args', 'bbloomer_change_number_related_products', 9999);

function bbloomer_change_number_related_products($args)
{
    $args['posts_per_page'] = 8; // # of related products
    $args['columns'] = 4; // # of columns per row
    return $args;
}


/**
 * Show savings at the cart.
 */
function my_custom_buy_now_save_x_cart()
{

    $savings = 0;
    $coupon_amount = 0;

    foreach (WC()->cart->get_cart() as $key => $cart_item) {
        /** @var WC_Product $product */
        $product = $cart_item['data'];

        if ($product->is_on_sale()) {
            $savings += ($product->get_regular_price() - $product->get_sale_price()) * $cart_item['quantity'];
        }
    }

    foreach (WC()->cart->get_coupons() as $code => $coupon):
        $coupon_amount += WC()->cart->get_coupon_discount_amount($coupon->get_code(), WC()->cart->display_cart_ex_tax); // get_coupon_discount_amount($coupon); // $coupon->get_coupon_discount_amount; // ->get_amount();
    endforeach;

    $savings = $savings + $coupon_amount;

    if (!empty($savings)) {
        ?>
        <tr class="order-savings">
            <th>&nbsp;</th>
            <td>Ai salvat: <?php echo wc_price($savings); ?></td>
        </tr><?php
    }

}
add_action('woocommerce_cart_totals_after_order_total', 'my_custom_buy_now_save_x_cart');



// extra fields for register
add_action('woocommerce_register_form_start', 'wc_register_form_password_top');
function wc_register_form_password_top()
{ ?>
    <div class="w-full grid grid-cols-2 gap-5">

        <input type="text" class=" input input-bordered input-primary" name="billing_last_name" id="reg_billing_last_name"
            value="<?php if (!empty($_POST['billing_last_name']))
                esc_attr_e($_POST['billing_last_name']); ?>" placeholder="<?php _e('Last name', 'woocommerce'); ?>*"
            required="required" />


        <input type="text" class="input input-bordered input-primary" name="billing_first_name" id="reg_billing_first_name"
            value="<?php if (!empty($_POST['billing_first_name']))
                esc_attr_e($_POST['billing_first_name']); ?>" placeholder="<?php _e('First name', 'woocommerce'); ?>*"
            required="required" />

    </div>

    <?php
}
add_action('woocommerce_register_form', 'wc_register_form_password_bottom');
function wc_register_form_password_bottom()
{ ?>
    <label class="input input-primary input-bordered flex items-center gap-2">
        <?php echo __('Reintrodu parola', 'woocommerce') ?>*
        <input type="password" class="grow" name="account_confirm_password" id="reg_password2" value="<?php if (!empty($_POST['account_confirm_password']))
            echo esc_attr($_POST['account_confirm_password']); ?>" placeholder="" required="required" />
    </label>

    <?php
}

// Validate required term and conditions check box
add_action('woocommerce_register_post', 'terms_and_conditions_validation', 20, 3);
function terms_and_conditions_validation($username, $email, $validation_errors)
{
    if (!isset($_POST['account_confirm_password']))
        $validation_errors->add('account_confirm_password', __('Campul <b>Confirma Parola</b> este obligatoriu.', 'woocommerce'));

    if (strcmp($_POST['account_confirm_password'], $_POST['password']) != 0 && strlen($_POST['account_password']) == 0)
        $validation_errors->add('password_valid', __('Parolele nu se potrivesc. ', 'woocommerce'));

    return $validation_errors;
}


// ----- Validate confirm password field match to the checkout page
function lit_woocommerce_confirm_password_validation($posted)
{
    $checkout = WC()->checkout;
    if (!is_user_logged_in() && ($checkout->must_create_account || !empty($posted['createaccount']))) {
        if (!empty($posted['password']) && strcmp($posted['password'], $posted['account_confirm_password']) !== 0) {
            wc_add_notice(__('Parolele nu se potrivesc.', 'woocommerce'), 'error');
        }

        if (!empty($posted['account_password']) && strcmp($posted['account_password'], $posted['account_confirm_password']) !== 0) {
            wc_add_notice(__('Parolele nu se potrivesc.', 'woocommerce'), 'error');
        }
    }
}
add_action('woocommerce_after_checkout_validation', 'lit_woocommerce_confirm_password_validation', 10, 2);


// ----- Add a confirm password field to the checkout page
function lit_woocommerce_confirm_password_checkout($checkout)
{
    if (get_option('woocommerce_registration_generate_password') == 'no') {

        $fields = $checkout->get_checkout_fields();

        $fields['account']['account_confirm_password'] = array(
            'type' => 'password',
            'label' => __('Confirma parola', 'woocommerce'),
            'required' => true,
            'placeholder' => _x('Reintrodu parola', 'placeholder', 'woocommerce')
        );

        $checkout->__set('checkout_fields', $fields);
    }
}
add_action('woocommerce_checkout_init', 'lit_woocommerce_confirm_password_checkout', 10, 1);

/**
 * Below code save extra fields.
 */
function wooc_save_extra_register_fields($customer_id)
{

    if (isset($_POST['billing_first_name'])) {
        //First name field which is by default
        update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']));
        // First name field which is used in WooCommerce
        update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
    }

    if (isset($_POST['billing_last_name'])) {
        // Last name field which is by default
        update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));
        // Last name field which is used in WooCommerce
        update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
    }
}
add_action('woocommerce_created_customer', 'wooc_save_extra_register_fields');


function show_features_product()
{
    ob_start();

    $product_features = get_field('features_product', 'options');
    if (!empty($product_features)) { ?>
        <div class="p-5 flex flex-col bg-[#fbfbfb]" style="border: 1px solid #e8e8e8;">
            <ul>
                <?php foreach ($product_features as $feature) {
                    $label = $feature['text'];
                    $icon = $feature['image'];
                    if (!empty($label) && !empty($icon)) { ?>
                        <li class="flex flex-row items-center justify-start my-2 py-2 gap-3">
                            <img class=" max-h-full max-w-full h-auto" src="<?php echo $icon['url']; ?>" alt="">
                            <p class=" text-base"><?php echo $label; ?></p>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <?php
    }
    $content = ob_get_clean();
    return $content;
}


// set email as username
add_filter('woocommerce_new_customer_data', function ($data) {
    $data['user_login'] = $data['user_email'];

    return $data;
});



/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function vc_hide_shipping_when_free_is_available($rates)
{
    $free = array();
    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id) {
            $free[$rate_id] = $rate;
            break;
        }
    }
    return !empty($free) ? $free : $rates;
}
add_filter('woocommerce_package_rates', 'vc_hide_shipping_when_free_is_available', 100);



// Make zip/postcode field optional
add_filter('woocommerce_default_address_fields', 'QuadLayers_optional_postcode_checkout');
function QuadLayers_optional_postcode_checkout($p_fields)
{
    $p_fields['postcode']['required'] = false;
    return $p_fields;
}