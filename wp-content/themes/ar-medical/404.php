<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AR_Medical_Cosmetic
 */

get_header('empty');
?>

<main id="primary" class=" w-full h-screen flex items-center">

	<section class="max-w-5xl mx-auto grid grid-cols-3 px-5 lg:px-0">
		<div class="col-span-3 md:col-span-2 lg:col-span-1 flex flex-col gap-5">
			<?php
			$logo_error = get_field('logo_error', 'options');
			if (!empty($logo_error)) { ?>
				<a class="block w-full" href="<?php echo site_url(); ?>">
					<img src="<?php echo $logo_error['url']; ?>" alt="<?php echo $logo_error['alt']; ?>"
						width="<?php echo $logo_error['width']; ?>" height="<?php echo $logo_error['height']; ?>"
						class="w-1/2 mx-auto">
				</a>
			<?php } ?>

			<h1 class=" text-7xl font-bold"><?php esc_html_e('404', 'ar-medical'); ?></h1>
			
			<h4 class=" text-xl font-medium leading-snug"><?php esc_html_e('Page not found.', 'ar-medical'); ?></h4>

			<?php
			$content_page_error = get_field('content_page_404', 'options');
			if (!empty($content_page_error)) { ?>
				<div class="the-content">
					<?php echo $content_page_error; ?>
				</div>
			<?php } ?>
			<a href="<?php echo site_url(); ?>"
				class=" btn btn-primary uppercase"><?php _e('Back home', 'ar-medical'); ?></a>
		</div>


		<?php $error_image = get_field('error_image', 'options');
		if (!empty($error_image)) { ?>
			<div class="w-full h-full absolute -z-10 opacity-10 bottom-0 left-0 cover"
				style="background-image:url('<?php echo $error_image['url']; ?>" alt="<?php echo $error_image['alt']; ?>')">
			</div>
		<?php } ?>

	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer('empty');
