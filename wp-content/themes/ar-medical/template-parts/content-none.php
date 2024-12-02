<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AR_Medical_Cosmetic
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="text-3xl py-5"><?php esc_html_e('Nothing Found', 'ar-medical'); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content grid grid-cols-1 gap-5 py-2">
		<?php
		if (is_home() && current_user_can('publish_posts')):

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ar-medical'),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url(admin_url('post-new.php'))
			);

		elseif (is_search()):
			?>

			<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ar-medical'); ?>
			</p>
			<?php
			get_search_form();

		else:
			?>

			<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ar-medical'); ?>
			</p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->