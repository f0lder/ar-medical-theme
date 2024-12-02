<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AR_Medical_Cosmetic
 */

if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>
<aside id="secondary" class="widget-area max-w-3xl lg:w-[35%] p-4 hidden lg:block">
	<?php
	// Default sidebar content
	dynamic_sidebar('sidebar-1');
	?>
	<div class="widget widget_tags">
		<h2 class="widget-title"><?php esc_html_e('Etichete blog', 'ar-medical'); ?></h2>
		<div class="tagcloud">
			<?php
			$tags = get_tags();
			if ($tags) {
				foreach ($tags as $tag) {
					echo '<span class="tag-item">';
					echo '<a href="' . get_tag_link($tag->term_id) . '">';
					echo $tag->name . ' (' . $tag->count . ')';
					echo '</a>';
					echo '</span> ';
				}
			}
			?>
		</div>
	</div>
	<div class="widget widget_recent_posts">
		<h2 class="widget-title"><?php esc_html_e('Recent Posts', 'ar-medical'); ?></h2>
		<ul>
			<?php
			$recent_posts = new WP_Query(
				array(
					'posts_per_page' => 4,
					'post_status' => 'publish',
				)
			);
			if ($recent_posts->have_posts()) {
				while ($recent_posts->have_posts()) {
					$recent_posts->the_post();
					get_template_part('template-parts/recent-post');
				}
				wp_reset_postdata();
			}
			?>
		</ul>
	</div>
</aside>