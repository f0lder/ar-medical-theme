<?php
get_header();

$args = array(
    'post_type' => 'serviciu',
    'posts_per_page' => -1, // -1 to display all posts
);

$query = new WP_Query($args);
?>

<main id="main" class="site-main container max-w-6xl mx-auto">
    <section class="serviciu-list py-11 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php

            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();
                    get_template_part('template-parts/content', 'title');
                endwhile;
                wp_reset_postdata();
            else:
                echo 'No posts found';
            endif;
            ?>
    </section>
</main>

<?php
get_footer();