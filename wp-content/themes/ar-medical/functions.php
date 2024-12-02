<?php
/**
 * AR Medical Cosmetic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AR_Medical_Cosmetic
 */

require_once get_template_directory() . '/framework/settings.php';
require_once get_template_directory() . '/framework/woo.php';


if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!defined('THEME_TEXT_DOMAIN')) {
	// Replace the text domain of the theme on each release.
	define('THEME_TEXT_DOMAIN', 'ar-medical');
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ar_medical_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AR Medical Cosmetic, use a find and replace
	 * to change 'ar-medical' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('ar-medical', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'ar-medical'),
			'user-menu' => esc_html__('User Menu', 'ar-medical'),
			'menu-mobile' => esc_html__('Mobile Menu', 'ar-medical'),
			'footer-menu-1' => __('Footer Menu 1', 'ar-medical'),
			'footer-menu-2' => __('Footer Menu 2', 'ar-medical'),
			'footer-menu-3' => __('Footer Menu 3', 'ar-medical'),
			'info-menu' => __('Meniu termeni', 'ar-medical'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ar_medical_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'ar_medical_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ar_medical_content_width()
{
	$GLOBALS['content_width'] = apply_filters('ar_medical_content_width', 640);
}
add_action('after_setup_theme', 'ar_medical_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ar_medical_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'ar-medical'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'ar-medical'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Shop Sidebar', 'ar_medical'),
			'id' => 'shop-sidebar',
			'description' => __('Widgets in this area will be shown on the shop page.', 'ar_medical'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'ar_medical_widgets_init');

/**
 * Enqueue scripts and styles.
 */

function ar_medical_scripts()
{

	wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);

	wp_enqueue_script('flatpickr-js', 'https://cdn.jsdelivr.net/npm/flatpickr', array('jquery'), null, true);
	wp_enqueue_script('flatpickr-locale-js', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ro.js', array('jquery'), null, true);

	wp_enqueue_script('ar-medical-script', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);

	wp_enqueue_script('ar-medical-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), null, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'ar_medical_scripts');


// Defer scripts
function ar_medical_defer_scripts($tag, $handle, $src)
{
	$handles_to_defer = array('dashicons', 'slick-js', 'flatpickr-js', 'flatpickr-locale-js', 'ar-medical-script', 'ar-medical-navigation');

	if (in_array($handle, $handles_to_defer)) {
		return '<script src="' . esc_url($src) . '" defer></script>' . "\n";
	}

	return $tag;
}
add_filter('script_loader_tag', 'ar_medical_defer_scripts', 10, 3);

function my_theme_enqueue_styles()
{
	wp_enqueue_style('critical', get_template_directory_uri() . '/critical.min.css');

	wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), null);
	wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', array(), null);
	wp_enqueue_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), null);

	wp_enqueue_style('ar-medical-google-fonts', 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap', false);

	wp_enqueue_style('theme-header', get_template_directory_uri() . '/style.css');

	wp_enqueue_style('minified-css', get_template_directory_uri() . '/main.min.css');


	wp_enqueue_style('content', get_template_directory_uri() . '/content.min.css');

}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


// Defer non-critical CSS
function ar_medical_defer_non_critical_css($tag, $handle)
{
	$handles_to_defer = array('ar-medical-google-fonts', 'content', 'theme-header', 'flatpickr');

	if (in_array($handle, $handles_to_defer)) {
		return str_replace("rel='stylesheet'", "rel='stylesheet' media='print' onload=\"this.media='all'\"", $tag);
	}

	return $tag;
}
add_filter('style_loader_tag', 'ar_medical_defer_non_critical_css', 10, 2);


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load custom walker for the main menu.
 */

class Mobile_Menu_Walker extends Walker_Nav_Menu
{
	// Start Level
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}

	// End Level
	function end_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	// Start Element
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
		$attributes .= ' class="text-center"';

		$item_output = $args->before;

		// Check if the item has children
		if (in_array('menu-item-has-children', $item->classes)) {
			$item_output .= '<details>';
			$item_output .= '<summary' . $attributes . '>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</summary>';
		} else {
			$item_output .= '<a' . $attributes . '>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</a>';
		}

		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	// End Element
	function end_el(&$output, $item, $depth = 0, $args = array())
	{
		// Close the <details> tag if the item has children
		if (in_array('menu-item-has-children', $item->classes)) {
			$output .= "</details>";
		}
		$output .= "</li>\n";
	}
}

class Footer_Nav_Walker extends Walker_Nav_Menu
{
	// Start Level
	function start_lvl(&$output, $depth = 0, $args = null)
	{
		// Only show the first level
		if ($depth === 0) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"footer-sub-menu\">\n";
		}
	}

	// Start Element
	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		// Only show the first level
		if ($depth === 0) {
			$indent = ($depth) ? str_repeat("\t", $depth) : '';
			$class_names = ' class="footer-menu-item text-center md:text-left"';

			$output .= $indent . '<li' . $class_names . '>';

			$attributes = '';
			if (!empty($item->attr_title)) {
				$attributes .= ' title="' . esc_attr($item->attr_title) . '"';
			}
			if (!empty($item->target)) {
				$attributes .= ' target="' . esc_attr($item->target) . '"';
			}
			if (!empty($item->xfn)) {
				$attributes .= ' rel="' . esc_attr($item->xfn) . '"';
			}
			if (!empty($item->url)) {
				$attributes .= ' href="' . esc_attr($item->url) . '"';
			}

			$title = !empty($item->title) ? apply_filters('the_title', $item->title, $item->ID) : 'Untitled';

			$item_output = '<a ' . $attributes . '>';
			$item_output .= $title;
			$item_output .= '</a>';

			$output .= $item_output;
		}
	}

	// End Element
	function end_el(&$output, $item, $depth = 0, $args = array())
	{
		// Only show the first level
		if ($depth === 0) {
			$output .= "</li>\n";
		}
	}

	// End Level
	function end_lvl(&$output, $depth = 0, $args = null)
	{
		// Only show the first level
		if ($depth === 0) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}
	}
}


class Info_menu_walker extends Walker_Nav_Menu
{
	// Start the element output.
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'item-serv'; // Add your custom class here

		// Check if the current item is the active one
		if (in_array('current-menu-item', $classes)) {
			$classes[] = 'active bg-white';
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . ' relative w-full h-fit hover:bg-white"' : '';

		$output .= '<li' . $class_names . '>';

		$atts = array();
		$atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target) ? $item->target : '';
		$atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
		$atts['href'] = !empty($item->url) ? $item->url : '';

		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters('the_title', $item->title, $item->ID);

		$item_output = $args->before;
		$item_output .= '<a class="w-full p-4 block relative"' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

function remove_sidebar_on_account_page()
{
	if (is_account_page()) {
		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	}
}
add_action('template_redirect', 'remove_sidebar_on_account_page');


// other functions

function phonenr($args)
{
	$str = $args;
	$str = preg_replace('/[^+0-9a-zA-Z]/', '', $str);
	return $str;
}


/**
 * Auto Copyright
 */
function auto_copyright($year = 'auto')
{
	if (intval($year) == 'auto') {
		$year = date('Y');
	}
	if (intval($year) == date('Y')) {
		return intval($year);
	}
	if (intval($year) < date('Y')) {
		return intval($year) . ' - ' . date('Y');
	}
	if (intval($year) > date('Y')) {
		return date('Y');
	}
}

add_filter('woocommerce_product_tabs', 'remove_empty_product_tabs', 20);

function remove_empty_product_tabs($tabs)
{
	foreach ($tabs as $key => $tab) {
		// Start output buffering to capture the tab content
		ob_start();
		if (isset($tab['callback'])) {
			call_user_func($tab['callback'], $key, $tab);
		}
		$tab_content = ob_get_clean();

		// Check if the tab content is empty
		if (empty(trim($tab_content))) {
			unset($tabs[$key]);
		}
	}
	return $tabs;
}


// Ajax
function add_localize_script()
{
	?>
	<script type="text/javascript">
		var ajaxUrl = "<?php echo admin_url('admin-ajax.php') ?>";
	</script>
	<?php
}
add_action('wp_head', 'add_localize_script', 999);


// Register the AJAX action for both logged-in and non-logged-in users
add_action('wp_ajax_search_products', 'custom_ajax_search_products');
add_action('wp_ajax_nopriv_search_products', 'custom_ajax_search_products');

function custom_ajax_search_products()
{
	// Get the search query
	$query = sanitize_text_field($_POST['query']);


	// Query WooCommerce products (or any custom post type)
	$args_name = array(
		'post_type' => 'product', // WooCommerce products
		'posts_per_page' => 5,   // Limit results
		'post_status' => 'publish',
		's' => $query // Search query for post title
	);

	$args_sku = array(
		'post_type' => 'product', // WooCommerce products
		'posts_per_page' => 5,   // Limit results
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => '_sku',
				'value' => $query,
				'compare' => 'LIKE'
			)
		)
	);

	$search_results_name = new WP_Query($args_name);
	$search_results_sku = new WP_Query($args_sku);

	// Merge the two queries and remove duplicates
	$merged_posts = array_merge($search_results_name->posts, $search_results_sku->posts);
	$unique_posts = array_unique($merged_posts, SORT_REGULAR);

	// Create a new WP_Query object with the merged and unique posts
	$search_results = new WP_Query();
	$search_results->posts = $unique_posts;
	$search_results->post_count = count($unique_posts);


	// Check if we have any products that match the search
	if ($search_results->have_posts()) {
		echo '<ul>';
		while ($search_results->have_posts()) {
			$search_results->the_post();

			get_template_part('template-parts/product-list-item');
		}
		echo '</ul>';
	} else {
		// No results found

		echo '<p>' . __('No products found.', 'ar-medical') . '</p>';
	}

	// Reset post data
	wp_reset_postdata();

	// Important: Always die() in an AJAX callback to end the execution.
	wp_die();
}


function exclude_products_from_search($query)
{
	if ($query->is_search() && !is_admin() && $query->is_main_query()) {
		// Set the post type to 'post' to exclude products
		$query->set('post_type', 'post');
	}
}
add_action('pre_get_posts', 'exclude_products_from_search');


function ar_medical_comment_callback($comment, $args, $depth)
{
	$tag = ('div' === $args['style']) ? 'div' : 'li';
	?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class=" py-3">
			<footer class="comment-meta flex flex-row items-center justify-between">
				<div class="comment-author vcard">
					<?php echo get_avatar($comment, 48); ?>
					<?php printf(__('%s <span class="says">says:</span>', 'ar-medical'), sprintf('<b class="fn">%s</b>', get_comment_author_link())); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>" class="italic">
						<time datetime="<?php comment_time('c'); ?>">
							<?php printf(__('%1$s at %2$s', 'ar-medical'), get_comment_date(), get_comment_time()); ?>
						</time>
					</a>
					<?php edit_comment_link(__('Edit', 'ar-medical'), '<span class="edit-link">', '</span>'); ?>
				</div><!-- .comment-metadata -->
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link(array_merge($args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div><!-- .reply -->
		</article><!-- .comment-body -->
		<?php
}

function generate_taxnomies_list($slug)
{
	// Get the taxonomy object
	$taxonomy = get_taxonomy($slug);

	// Get all terms in the 'ingredient' taxonomy
	$terms = get_terms(array(
		'taxonomy' => $slug,
		'hide_empty' => false,
	));

	// Check if any terms were found
	if (empty($terms) || is_wp_error($terms)) {
		return '<p>' . __("No taxonomies found!", 'ar-medical') . '</p>';
	}

	// Start building the output
	$output = '<div class="taxonomy-container"><h2 class="taxonomy-title">' . esc_html($taxonomy->labels->name) . '</h2>';
	$output .= '<ul class="taxonomy-list">';
	foreach ($terms as $term) {
		$term_link = esc_url(get_term_link($term));
		$output .= '<li class="taxonomy-item"><a href="' . $term_link . '">' . esc_html($term->name) . '</a></li>';
	}
	$output .= '</ul></div>';

	return $output;
}

function generate_taxnomies_list_shortcode($atts)
{
	// Get the shortcode attributes
	$atts = shortcode_atts(
		array(
			'slug' => 'ingredient',
		),
		$atts
	);

	// Generate the taxonomies list
	$output = generate_taxnomies_list($atts['slug']);

	return $output;
}

add_shortcode('taxonomies_list', 'generate_taxnomies_list_shortcode');


function generate_taxnomies_submenu($slug)
{
	// Get the taxonomy object
	$taxonomy = get_taxonomy($slug);

	// Get all terms in the 'ingredient' taxonomy
	$terms = get_terms(array(
		'taxonomy' => $slug,
		'hide_empty' => false,
	));

	// Check if any terms were found
	if (empty($terms) || is_wp_error($terms)) {
		return '<p>' . __("No taxonomies found!", 'ar-medical') . '</p>';
	}

	// Start building the output
	$output = '<div class="taxonomy-submenu"><h2 class="taxonomy-submenu-title">' . esc_html($taxonomy->labels->name) . '</h2>';
	$output .= '<ul class="taxonomy-submenu-list">';
	foreach ($terms as $term) {
		$term_link = esc_url(get_term_link($term));
		$output .= '<li class="taxonomy-submenu-item"><a class="text-center" href="' . $term_link . '">' . esc_html($term->name) . '</a></li>';
	}
	$output .= '</ul></div>';

	return $output;
}

function generate_taxnomies_submenu_shortcode($atts)
{
	// Get the shortcode attributes
	$atts = shortcode_atts(
		array(
			'slug' => 'ingredient',
		),
		$atts
	);

	// Generate the taxonomies list
	$output = generate_taxnomies_submenu($atts['slug']);

	return $output;
}

add_shortcode('taxonomies_submenu', 'generate_taxnomies_submenu_shortcode');