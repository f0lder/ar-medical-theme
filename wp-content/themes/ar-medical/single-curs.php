<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AR_Medical_Cosmetic
 */

get_header();
?>

<div class="breadcrumbs-outer w-full py-32 px-5"
	style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/jpg/hero-price.jpg'); background-size: cover; background-position: center;">
    <!-- Breadcrumbs -->
    <div class="breadcrumbs-container text-white h-28 font-semibold">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        } ?>
        <h1 class="text-4xl">
            <?php
            the_title();
            ?>
        </h1>
    </div>
</div>

<div class="container mx-auto max-w-6xl flex flex-col lg:flex-row-reverse py-20 px-5 lg:px-0">
    <main id="primary" class="flex-1">
        <?php
        while (have_posts()):
            the_post();

            get_template_part('template-parts/content', get_post_type());


        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->

    <?php get_sidebar('curs'); ?>
</div><!-- .flex -->

<?php
echo show_testimonials();
echo show_app();

get_footer();
?>