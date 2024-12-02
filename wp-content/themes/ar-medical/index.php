<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AR_Medical_Cosmetic
 */

get_header();
?>


<div class="breadcrumbs-outer w-full py-32 px-5"
	style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/jpg/hero-blog.jpg'); background-size: cover; background-position: center;">
	<!-- Breadcrumbs -->
	<div class="breadcrumbs-container text-white h-28 font-semibold">
		<?php if (function_exists('yoast_breadcrumb')) {
			yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
		} ?>
		<h1 class="text-4xl">Blog</h1>
	</div>
</div>


<main id="primary" class="site-main max-w-6xl mx-auto py-8 px-4 lg:px-0">
	<?php
	if (is_front_page()):
		// Display the content of the front page
		while (have_posts()):
			the_post();
			the_content();
		endwhile;
	else:
		if (is_home()):
			?>
			<header>
				<h1 class="page-title screen-reader-text"><?php the_title(); ?></h1>
			</header>
			<?php
		endif;

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


		// Custom query to show only 9 posts and order them by the most recent
		$args = array(
			'posts_per_page' => 9,
			'orderby' => 'date',
			'order' => 'DESC',
			'paged' => $paged,
		);

		$query = new WP_Query($args);

		if ($query->have_posts()):
			?>
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
			get_template_part('template-parts/content', 'none');

		endif;

		// Reset post data
		wp_reset_postdata();

	endif;
	?>

</main><!-- #main -->

<?php
echo show_app();
//get_sidebar();
get_footer();
?>