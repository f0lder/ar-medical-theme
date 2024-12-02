<?php
/*
 * Template Name: Pagina Termeni si Conditii
 * Template Post Type: page
 */

get_header();

echo show_hero();
?>


<div id="primary" class="content-area flex flex-col lg:flex-row container mx-auto max-w-6xl pt-12 pb-20">
    <aside id="left-sidebar" class="widget-area container w-11/12 mx-auto lg:w-1/4" role="complementary">
        <section class="serviciu-posts">
            <?php
            $menu = wp_nav_menu(array(
                'theme_location' => 'info-menu',
                'container' => '',
                'container_class' => '',
                'container_id' => '',
                'echo' => false,
                'items_wrap' => '<ul class="bg-gray-50 py-2 px-4 font-normal">%3$s</ul>',
                'depth' => 1,
                'walker' => new Info_Menu_Walker(),
            ));
            if (!empty($menu)) { ?>
                <?php echo $menu; ?>
            <?php } ?>
        </section>
    </aside>


    <main id="main"
        class="site-main w-full mt-10 max-w-3xl pl-0 lg:pl-16 lg:mt-0 lg:w-3/4 lg:max-w-6xl container mx-auto">
        <article class="px-5 lg:px-0" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-thumbnail mb-8">
                <?php
                if (has_post_thumbnail()):
                    the_post_thumbnail('large');
                endif;
                ?>
            </div>
            <header class="entry-header text-4xl font-medium">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="the-content">
                <?php the_content(); ?>
            </div>

            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if (comments_open() || get_comments_number()):
                comments_template();
            endif;
            ?>
        </article>
    </main>
</div>

<?php

get_footer();
?>