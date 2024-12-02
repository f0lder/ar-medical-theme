<?php
/*
 * Template Name: Cursuri Template
 * Template Post Type: page
 */
get_header();

echo show_hero();

$args = array(
    'post_type' => 'curs',
    'posts_per_page' => -1, // -1 to display all posts
);

$query = new WP_Query($args);
?>

<main id="main" class="site-main container max-w-6xl mx-auto py-20">
    <div class="the-content max-w-3xl mx-auto text-center">
        <?php the_content(); ?>
    </div>
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 mt-10">
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