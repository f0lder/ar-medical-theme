<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package AR_Medical_Cosmetic
 */

get_header();
?>
<div class=" max-w-6xl mx-auto flex flex-col-reverse lg:flex-row-reverse py-10 px-5 lg:px-0">

	<main id="primary" class="site-main w-full">

		<?php if (have_posts()): ?>

			<header class="page-header">
				<h1 class=" text-3xl py-5">
					<?php
					/* translators: %s: search query. */
					printf(esc_html__('Search Results for: %s', 'ar-medical'), '<span>' . get_search_query() . '</span>');
					?>
				</h1>
			</header><!-- .page-header -->
			<div class="grid grid-cols-1 md:grid-cols-2 gap-5 w-full lg:min-w-max">
				<?php
				/* Start the Loop */
				while (have_posts()):
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part('template-parts/content', 'title');

				endwhile;
				?>
				<div class=" col-span-2">
					<?php
					// Add pagination
					the_posts_pagination(
						array(
							'mid_size' => 2,
							'prev_text' => '<i class="fa fa-chevron-left"></i>',
							'next_text' => '<i class="fa fa-chevron-right"></i>',
						)
					);
					?>
				</div>
			</div>
			<?php

		else:

			get_template_part('template-parts/content', 'none');

		endif;
		?>

	</main><!-- #main -->

	<?php
	get_sidebar();
	?>
</div>
<?php
get_footer();
