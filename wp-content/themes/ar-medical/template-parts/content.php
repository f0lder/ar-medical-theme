<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AR_Medical_Cosmetic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container mx-auto lg:pl-16">

		<header class="entry-header">
			<?php if (has_post_thumbnail()): ?>
				<div class="post-thumbnail w-full bg-cover bg-center"
					style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');">
				</div>
			<?php endif; ?>
			<div class="flex w-full border-y-2 py-7 my-5">
				<div class="flex-row mr-4">
					<p>Publicat</p>
					<p><?php echo get_the_date(); ?></p>
				</div>
				<div class="flex-row mr-4">
					<p>Categorie</p>
					<p><?php the_category(); ?></p>
				</div>
				<div class="flex-row">
					<p>Comentarii</p>
					<p><?php comments_number(); ?></p>
				</div>
			</div>

		</header><!-- .entry-header -->


		<div class="the-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'ar-medical'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'ar-medical'),
					'after' => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>

</article><!-- #post-<?php the_ID(); ?> -->