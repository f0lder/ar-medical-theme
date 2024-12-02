<?php
/*
 * Template Name: Pagina Servicii
 * Template Post Type: page
 */
get_header();

$args = array(
    'post_type' => 'serviciu',
    'posts_per_page' => -1, // -1 to display all posts
);

$query = new WP_Query($args);

echo show_hero();
?>

<main id="main" class="site-main container max-w-6xl mx-auto py-20">
    <div class="the-content max-w-3xl mx-auto text-center">
        <?php the_content(); ?>
    </div>
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-10">
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
echo show_general_features();
echo show_testimonials();
echo show_app();
get_footer();