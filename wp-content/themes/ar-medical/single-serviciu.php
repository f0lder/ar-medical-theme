<?php
get_header();
?>

<div id="primary" class="content-area flex flex-col lg:flex-row container mx-auto max-w-6xl pt-12 pb-20">
    <aside id="left-sidebar" class="widget-area container w-11/12 mx-auto    lg:w-1/4" role="complementary">
        <section class="serviciu-posts">
            <ul class="bg-gray-50 py-2 px-4 font-normal">
                <?php
                $current_post_id = get_the_ID();
                $args = array(
                    'post_type' => 'serviciu',
                    'posts_per_page' => -1, // Adjust number of posts to display
                );

                $serviciu_query = new WP_Query($args);

                if ($serviciu_query->have_posts()):
                    while ($serviciu_query->have_posts()):
                        $serviciu_query->the_post();
                        $active_class = (get_the_ID() == $current_post_id) ? 'item-serv active bg-white' : 'item-serv';
                        ?>
                        <li class="<?php echo $active_class; ?> relative w-full h-fit hover:bg-white ">
                            <a class="w-full p-4 block relative" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<li>No other posts found.</li>';
                endif;
                ?>
            </ul>
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
echo show_general_features();
echo show_testimonials();
echo show_app();

get_footer();
?>