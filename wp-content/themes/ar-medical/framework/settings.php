<?php defined('ABSPATH') or die('Direct access is forbidden!');


# Register option pages
if (function_exists('acf_add_options_sub_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-options',
        'capability' => 'manage_options',
        //'icon_url'   => get_template_directory_uri() . '/images/icons/favicon.png'
    ));
    acf_add_options_sub_page(array(
        'parent' => 'theme-options',
        'title' => 'General',
        'slug' => 'theme-general',
        'capability' => 'manage_options'
    ));

}

/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'wp_enqueue_emoji_styles');
    remove_action('admin_print_styles', 'wp_enqueue_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emojis');



function show_hero()
{
    ob_start(); ?>

    <div class="breadcrumbs-outer w-full py-32 px-5" style="background-image: url('<?php
    $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    if ($img[0] && !is_singular('curs')) {
        echo $img[0];
    } else {
        $bg = get_field('general_top_image', 'options');
        if (!empty($bg)) {
            echo $bg['url'];
        }
    } ?>'); background-size: cover; background-position: center;">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs-container text-white h-28 font-semibold">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            } ?>
            <h1 class="text-4xl">
                <?php echo get_the_title(); ?>
            </h1>
        </div>
    </div>

    <?php
    $content = ob_get_clean();
    return $content;
}

function show_product_carousel()
{

    // Fetch product categories
    $product_categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));
    ?>
    <div class="product-categories-carousel max-w-6xl mx-auto">
        <?php foreach ($product_categories as $category): ?>
            <?php
            // Get the first product in the category
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $category->term_id,
                    ),
                ),
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                $query->the_post();
                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            } else {
                // Fallback to category thumbnail if no products found
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image_url = wp_get_attachment_url($thumbnail_id);
            }
            wp_reset_postdata();

            ?>
            <div class="p-3 hover:text-primary">
                <a href="<?php echo get_term_link($category); ?>">
                    <img class=" max-h-64 max-w-64 mx-auto" src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($category->name); ?>">
                    <h3 class="text-center"><?php echo esc_html($category->name); ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

function show_breadcrumbs()
{
    ob_start();
    wp_reset_query();
    if (function_exists('yoast_breadcrumb')) { ?>
        <div class="breadcrumbs-wrap">
            <?php yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); ?>
        </div>
        <?php
    }
    $content = ob_get_clean();
    return $content;
}

function vc_show_avatar_letters($title)
{
    $title_array = explode(' ', $title);

    if (sizeof($title_array) == 1) {
        $title = substr($title_array[0], 0, 1);
    } else {
        $title = substr($title_array[0], 0, 1) . '' . substr($title_array[1], 0, 1);
    }
    //$title1 = substr($title_array[0], 0, 1);

    return '<span class="avatar">' . $title . '</span>';
}


function show_social()
{
    ob_start();
    $social_list = get_field('social_list', 'options');
    if (!empty($social_list)) {
        foreach ($social_list as $soc) {
            $icon = $soc['icon'];
            $link = $soc['link'];
            $name = $soc['name']; ?>

            <a class="btn btn-ghost text-sm hover:text-primary font-normal" href="<?php echo $link; ?>" title="" target="_blank"
                rel="nofollow">
                <span><?php echo $icon; ?></span>
                <?php echo $name; ?>
            </a>
            <?php
        }
    }
    $content = ob_get_clean();
    return $content;
}

function show_app()
{
    ob_start(); ?>
    <div class="relative w-full appointment pt-28">
        <?php $image_app1 = get_field('image_app1', 'options');
        if (!empty($image_app1)) { ?>
            <div class="invisible lg:visible absolute bottom-0 z-0 h-[90%] w-[1135px] -left-64 cover"
                style="background-image:url('<?php echo $image_app1['url']; ?>')"></div>
        <?php } ?>
        <?php $image_app2 = get_field('image_app2', 'options');
        if (!empty($image_app2)) { ?>
            <div class="invisible lg:visible absolute bottom-0 h-full w-9/12 -right-36 cover"
                style="background-image:url('<?php echo $image_app2['url']; ?>')"></div>
        <?php } ?>
        <div class="relative container ml-auto px-2 lg:px-16 py-8 max-w-4xl schedule-form z-10">
            <?php $subtitle_app = get_field('subtitle_app', 'options');
            if (!empty($subtitle_app)) { ?>
                <h6 class="text-center text-base"><?php echo $subtitle_app; ?></h6>
            <?php } ?>

            <?php $title_app = get_field('title_app', 'options');
            if (!empty($title_app)) { ?>
                <h2 class="text-center text-4xl"><?php echo $title_app; ?></h2>
            <?php } ?>
            <div class="py-5">
                <?php $app_form = get_field('app_form', 'options');
                if (!empty($app_form)) { ?>
                    <?php echo do_shortcode($app_form); ?>
                <?php } ?>
            </div>

            <?php $form_note_app = get_field('form_note_app', 'options');
            if (!empty($form_note_app)) { ?>
                <div class="text-center p-4 bg-[#D8D9DD] my-3">
                    <p><?php echo $form_note_app; ?></p>
                </div>
            <?php } ?>
        </div>
    </div><?php
    $content = ob_get_clean();
    return $content;
}

function show_general_features()
{
    ob_start();

    $intro_features = get_field('intro_features', 'options');
    $image_1 = get_field('image_1', 'options');
    $image_2 = get_field('image_2', 'options');
    $button_label_feature = get_field('button_label_feature', 'options');
    $button_link_feature = get_field('button_link_feature', 'options');
    $features = get_field('features', 'options'); ?>
    <div class=" w-full py-24 bg-footer text-white">
        <div class="container mx-auto max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-2 px-8 md:px-0 gap-10">
                <div class="relative pb-36">
                    <?php if (!empty($image_1)) { ?>
                        <div class="img1 cover" style="background-image:url('<?php echo $image_1['url']; ?>')"></div>
                    <?php } ?>
                    <?php if (!empty($image_2)) { ?>
                        <div class="img2 cover" style="background-image:url('<?php echo $image_2['url']; ?>')"></div>
                    <?php } ?>

                </div>
                <div class="features-text flex items-center justify-center">
                    <div class="h-fit">
                        <?php if (!empty($intro_features)) {
                            echo $intro_features;
                        }
                        if (!empty($button_label_feature) && !empty($button_link_feature)) { ?>
                            <div class="w-full flex justify-center md:block">
                                <a href="<?php echo $button_link_feature; ?>"
                                    class="btn btn-lg uppercase rounded-none mt-8 md:mx-0"><?php echo $button_label_feature; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($features)) { ?>
                <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-20">
                    <?php foreach ($features as $feature) {
                        $image = $feature['image'];
                        $title = $feature['title'];
                        $subtitle = $feature['subtitle']; ?>
                        <div class="">
                            <?php if (!empty($image)) { ?>
                                <div class="w-full">
                                    <img class="mx-auto" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"
                                        width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>">
                                </div>
                            <?php } ?>
                            <?php if (!empty($title)) { ?>
                                <h4 class="text-center text-xl mb-1 font-medium"><?php echo $title; ?></h4>
                            <?php } ?>
                            <?php if (!empty($subtitle)) { ?>
                                <p class="text-center"><?php echo $subtitle; ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="relative w-full h-0">
            <img class=" invisible lg:visible w-1/3 right-0 absolute transform translate-x-1/2 -translate-y-[150%] rotate-180"
                src="<?php echo get_template_directory_uri(); ?>/images/png/flower.png" alt="" width="860" height="295">
            <img class="invisible lg:visible left-0 transform -translate-y-[125%] -translate-x-1/3"
                src="<?php echo get_template_directory_uri(); ?>/images/png/water-waves2.png" alt="" width="635"
                height="585">
        </div>
    </div>

    <?php
    $content = ob_get_clean();
    return $content;
}


function show_app_widget($extra_class)
{
    ob_start();
    $image_app = get_field('image_app', 'options');
    $title_side_app = get_field('title_side_app', 'options');
    $subtitle_side_app = get_field('subtitle_side_app', 'options');
    $button_label_app = get_field('button_label_app', 'options');
    $button_link_app = get_field('button_link_app', 'options'); ?>

    <div class="<?php echo $extra_class; ?> make-appointment">
        <div class="make-appointment-box">
            <div class="appointment-text">
                <?php if (!empty($subtitle_side_app)) { ?>
                    <h6 class="ttu"><?php echo $subtitle_side_app; ?></h6>
                <?php } ?>
                <?php if (!empty($title_side_app)) { ?>
                    <h2 class="big-title"><?php echo $title_side_app; ?></h2>
                <?php } ?>
                <?php if (!empty($button_label_app) && !empty($button_link_app)) { ?>
                    <a href="<?php echo $button_link_app; ?>" class="button1"><?php echo $button_label_app; ?></a>
                <?php } ?>
            </div>
            <?php if (!empty($image_app)) { ?>
                <div class="appoinment-image">
                    <img src="<?php echo $image_app['url']; ?>" alt="<?php echo $image_app['alt']; ?>">
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    $content = ob_get_clean();
    return $content;
}

function show_testimonials()
{
    ob_start();

    $title_testm = get_field('title_testm', 'options');
    $content_testm = get_field('content_testm', 'options');
    $bg = get_field('background_text_testm', 'options');
    $testimonials = get_field('testimonials', 'options'); ?>

    <div class="w-full py-24" style="background: linear-gradient(180deg, #fafafa 0%, white 100%);">
        <div class="container max-w-3xl mx-auto">
            <?php if (!empty($content_testm)) { ?>
                <h6 class="text-center text-sm font-medium uppercase mb-1 tracking-widest"><?php echo $content_testm; ?></h6>
            <?php } ?>
            <?php if (!empty($title_testm)) { ?>
                <h2 class="text-center text-4xl font-medium"><?php echo $title_testm ?></h2>
            <?php } ?>
            <?php if (!empty($bg)) { ?>
                <span class="hidden"><?php echo $bg; ?></span>
            <?php } ?>
            <span class="hidden"><img src="<?php echo get_template_directory_uri(); ?>/images/svg/quotes.svg" alt=""
                    width="253" height="211"></span>
        </div>
        <?php if ($testimonials): ?>
            <div class="testimonials-slider-wrap slider-horizontal">
                <div class="testimonials-slider">
                    <?php foreach ($testimonials as $post):
                        setup_postdata($post);
                        $testm_id = $post->ID;
                        $title = get_the_title($testm_id); ?>
                        <div class="testimonials-slide">
                            <div class="testimonials-box-white">
                                <div class="testimonial-text">
                                    <?php echo get_the_content($testm_id); ?>
                                </div>
                                <div class="testimonial-user">
                                    <?php echo vc_show_avatar_letters($title); ?>
                                    <div class="user-right">
                                        <h3><?php echo $title; ?></h3>
                                        <?php $occ = get_field('occupation', $testm_id);
                                        if (!empty($occ)) { ?>
                                            <span><?php echo $occ; ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>

    <?php
    $content = ob_get_clean();
    return $content;
}

function show_post($id)
{
    ob_start(); ?>
    <div class="blog-slide">
        <a href="<?php echo get_permalink($id); ?>" class="blog-box">
            <div class="blog-image cover" style="background-image: url(<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'post_image');
            if ($img[0]) {
                echo $img[0];
            } else {
                echo get_template_directory_uri() . '/images/jpg/no-post.jpg';
            } ?>);"></div>
            <div class="blog-date">
                <span class="date-month"><?php echo get_the_date('F', $id); ?></span>
                <span class="date-day"><?php echo get_the_date('j', $id); ?></span>
            </div>
            <div class="blog-box-overlay">
                <?php
                $terms = get_the_terms($id, 'category');
                if ($terms && !is_wp_error($terms)):
                    $draught_links = array(); ?>
                    <div class="category-blog-top">
                        <span><?php _e('Categorie: ', 'ar-medical'); ?>
                            <strong><?php
                            foreach ($terms as $term) {
                                $draught_links[] = $term->name;
                            }
                            $on_draught = join(", ", $draught_links);
                            ?>
                                <span class="blog-category"><?php echo $on_draught; ?></span>
                            </strong>
                        </span>
                    </div>
                <?php endif; ?>
                <h3><?php echo get_the_title($id); ?></h3>
            </div>
        </a>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}


function ov3rfly_replace_include_blank($name, $text, &$html)
{
    $matches = false;
    preg_match('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $html, $matches);
    if ($matches) {
        $select = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $matches[0]);
        $html = preg_replace('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $select, $html);
    }
}
function my_wpcf7_form_elements($html)
{
    ov3rfly_replace_include_blank('service', 'Selectează serviciul *', $html);
    ov3rfly_replace_include_blank('hours', 'Selectează ora *', $html);

    return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');



function alter_comment_form_fields($fields)
{
    $fields['url'] = '';  //removes website field
    return $fields;
}
add_filter('comment_form_default_fields', 'alter_comment_form_fields');

function mytheme_enqueue_comment_reply()
{
    // on single blog post pages with comments open and threaded comments
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script('comment-reply');
    }
}
// Hook into wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'mytheme_enqueue_comment_reply');


add_filter('wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail');
function wpse_100012_override_yoast_breadcrumb_trail($links)
{
    global $post;
    if (is_singular('serviciu')) {
        $page_services = get_field('page_services', 'options');
        if (!empty($page_services)) {
            $breadcrumb[] = array(
                'url' => get_permalink($page_services),
                'text' => get_the_title($page_services),
            );

            array_splice($links, 1, -2, $breadcrumb);
        }
    } else if (is_singular('curs')) {

        $page_courses = get_field('page_courses', 'options');
        if (!empty($page_courses)) {
            $breadcrumb[] = array(
                'url' => get_permalink($page_courses),
                'text' => get_the_title($page_courses),
            );

            array_splice($links, 1, -2, $breadcrumb);
        }
    } else if (is_singular('post')) {
        $breadcrumb[] = array(
            'url' => get_permalink(get_option('page_for_posts', true)),
            'text' => get_the_title(get_option('page_for_posts', true))
        );

        array_splice($links, 1, -2, $breadcrumb);
    }

    return $links;
}

// hook into wpcf7_before_send_mail
add_action('wpcf7_before_send_mail', 'cf7dynamicnotifications'); // Hooking into wpcf7_before_send_mail
function cf7dynamicnotifications($contact_form)
{

    if (isset($_POST['cf7_page']) && $_POST['cf7_page'] == 'curs') {
        $submission = WPCF7_Submission::get_instance(); // Create instance of WPCF7_Submission class

        $course_id = $_POST['courseid'];

        $mailProp = $contact_form->get_properties('mail');
        $mailProp['mail']['subject'] = $mailProp['mail']['subject'] . ' ' . get_the_title($course_id);
        // update the form properties
        $contact_form->set_properties(array('mail' => $mailProp['mail']));
    }

}

add_action('wp_print_styles', 'my_deregister_styles', 100);

function my_deregister_styles()
{
    //wp_deregister_style( 'amethyst-dashicons-style' );
//    wp_deregister_style( 'dashicons' );
    wp_deregister_style('wp-block-library');
    //    wp_deregister_style( 'wcmd-custombox-stylesheet' );


    if (is_front_page()) {
        wp_deregister_style('wc-blocks-style');
        wp_deregister_style('wc-blocks-vendors-style');
        wp_deregister_style('berocket_aapf_widget-style');
        wp_deregister_style('classic-theme-styles');
    }

}

/*

<div class="inner-margin inner-hero">
    <div class="cover" style="background-image:url('<?php echo get_template_directory_uri();?>/images/jpg/hero-services.jpg')">
        <div class="container">
            <div class="inner-hero-text">
                <div class="breadcrumbs-section">
                    <p>
                         <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb( '' );}?>
                    </p>

                </div>

                <h1>Servicii</h1>
            </div>
        </div>
    </div>
</div>*/