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
                <img class="w-full bg-cover bg-center"
                    src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                    alt="<?php the_title_attribute(); ?>" />
            <?php endif; ?>
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