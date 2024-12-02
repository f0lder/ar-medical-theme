<?php
get_header();


// Custom query to show posts from the selected category and order them by the most recent
$args = array(
    'posts_per_page' => 9,
    'orderby' => 'date',
    'order' => 'DESC',
    'cat' => get_queried_object_id(), // Get the ID of the current category
);

$query = new WP_Query($args);

if ($query->have_posts()):
    ?>
    <main id="primary" class="site-main max-w-6xl mx-auto py-8">
        <div class="py-8">
            <p class="italic text-gray-500"><?php echo esc_html__('Blog category', 'ar-medical') ?></p>
            <h1 class="text-5xl font-medium"><?php echo the_title(); ?></h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-6">
            <?php
            while ($query->have_posts()):
                $query->the_post();
                /*
                 * Include the Post-Type-specific template for the content.
                 */
                get_template_part('template-parts/content-title', get_post_type());
            endwhile;
            ?>
        </div>
    </main>

    <?php
    // Add pagination
    the_posts_pagination(
        array(
            'mid_size' => 2,
            'prev_text' => '<i class="fa fa-chevron-left"></i>',
            'next_text' => '<i class="fa fa-chevron-right"></i>',
        )
    );

else:
    echo '<p>' . esc_html_e('No posts found', 'ar-medical') . '</p>';
endif;

// Reset post data
wp_reset_postdata();

get_footer();
?>