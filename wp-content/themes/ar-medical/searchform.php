<?php
/**
 * The template for displaying search forms in your theme
 *
 * @package Your_Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class=" input input-primary input-text rounded-none flex items-center gap-1 without-ring">
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'ar-medical'); ?></span>
        <input type="search" class="grow"
            placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'ar-medical'); ?>"
            value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit">
            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 2.35a7.5 7.5 0 010 14.3z"></path>
            </svg>
            <span class="screen-reader-text"><?php echo esc_html_x('Search', 'submit button', 'ar-medical'); ?></span>
        </button>
    </label>
</form>