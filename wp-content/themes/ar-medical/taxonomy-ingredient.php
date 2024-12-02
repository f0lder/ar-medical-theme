<?php
get_header();
get_header('shop') ?>

<div class="mx-auto max-w-6xl px-3 lg:px-0 mb-5">
    <?php
    // Get the current term
    $term = get_queried_object();
    ?>

    <div class="the-content">
        <?php echo term_description(); ?>

    </div>


    <?php
    // Query for products associated with the current ingredient term
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $term->taxonomy,
                'field' => 'slug',
                'terms' => $term->slug,
            ),
        ),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()): ?>
        <ul class="products-list mb-5">
            <?php while ($query->have_posts()):
                $query->the_post();
                wc_get_template_part('content', 'product');
            endwhile; ?>
        </ul>
    <?php else: ?>
        <p><?php echo __("No products for this ingredient", "ar-medical"); ?></p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

    <!-- Back to Shop Button -->
    <div class=" w-full py-5 flex justify-center">
        <a class="btn btn-primary rounded-none uppercase" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="button">
           <i class="fa fa-arrow-left"></i>
        <?php echo __('Back to shop', 'woocommerce'); ?>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
        <?php echo do_shortcode('[taxonomies_submenu slug="rutina"]'); ?>

        <?php echo do_shortcode('[taxonomies_submenu slug="ingredient"]'); ?>

        <?php echo do_shortcode('[taxonomies_submenu slug="linie"]'); ?>

        <?php echo do_shortcode('[taxonomies_submenu slug="problema-pilele"]'); ?>

        <?php echo do_shortcode('[taxonomies_submenu slug="tip-ten"]'); ?>


    </div>


</div>

<?php get_footer(); ?>