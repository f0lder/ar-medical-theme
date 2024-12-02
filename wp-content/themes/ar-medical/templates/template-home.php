<?php
/**
 * Template Name: Home Page Template
 */
defined('ABSPATH') or die('Direct access is forbidden!');

get_header(); ?>

<?php $slider = get_field('slider');
if (!empty($slider)) { ?>
    <div class="relative w-full pt-12 bg-gradient-to-b from-white to-[#fff7f0]">
        <div class="contaier mx-auto max-w-6xl slider">
            <?php foreach ($slider as $index => $sl) {
                $image = $sl['image'];
                $top = $sl['top'];
                $title = $sl['title'];
                $subtitle = $sl['subtitle'];
                $button_label = $sl['button_label'];
                $button_link = $sl['button_link']; ?>
                <div
                    class="slide <?php echo $index === 0 ? 'active' : ''; ?> w-full grid grid-cols-1 sm:grid-cols-6 md:grid-cols-2">
                    <div class="w-full md:w-11/12 p-10 z-10 sm:col-span-4 md:col-span-1 text-center sm:text-left">
                        <?php if (!empty($top)) { ?>
                            <h1 class=" text-base mb-1 tracking-[0.1em] uppercase"><?php echo $top; ?></h1>
                        <?php } ?>
                        <?php if (!empty($title)) { ?>
                            <h2 class=" text-xl mt-6 italic font-semibold mb-2"><?php echo $title; ?></h2>
                        <?php } ?>
                        <?php if (!empty($subtitle)) { ?>
                            <p style="font-size: 1rem; margin-bottom: 1rem; line-height: 1.6; font-weight: 300; color: #1f2937;">
                                <?php echo $subtitle; ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($button_label) && !empty($button_link)) { ?>
                            <div class="w-fit mx-auto">
                                <a href="<?php echo $button_link; ?>" title=""
                                    class="uppercase btn btn-lg btn-outline btn-secondary rounded-none"><?php echo $button_label; ?></a>
                            </div>
                        <?php } ?>
                        <div class="invisible lg:visible w-fit mx-auto py-4">
                            <a class="btn btn-ghost" href="#main" title="">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/svg/scroll.svg" alt="" width="22"
                                    height="31"><?php echo _e('See below', 'ar-medical'); ?>
                            </a>
                        </div>
                    </div>
                    <?php if (!empty($image)) { ?>
                        <div class="w-full sm:col-span-2 md:col-span-1">
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"
                                width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" class="nolazzy block mx-auto w-64 mb-0
                                        sm:absolute sm:pl-7 sm:z-0 sm:bottom-0 sm:right-[-64px] sm:w-96
                                        md:w-[600px]
                                        lg:relative lg:w-auto lg:p-0">
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <!-- Navigation buttons -->

        </div>
        <div
            class="navigation-buttons absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-4 p-4 xl:bottom-auto xl:left-10 xl:top-1/2 xl:transform xl:-translate-y-1/2 xl:flex-col xl:space-x-0 xl:space-y-4">
            <?php foreach ($slider as $index => $sl) { ?>
                <button
                    class="nav-button w-4 h-4 bg-transparent rounded-full border-black border-2 hover: <?php echo $index === 0 ? 'active' : ''; ?>"
                    data-slide="<?php echo $index; ?>">
                    <?php echo $index + 1; ?>
                </button>
            <?php } ?>
        </div>

        <?php $social = show_social();
        if (!empty($social)) { ?>
            <div
                class="hidden xl:flex transform -rotate-90 md:absolute md:bottom-auto right-[-2em] top-1/2 -translate-y-1/2 flex-row space-y-0 space-x-4">
                <?php echo $social; ?>
            </div>
        <?php } ?>
    </div>
    <div class="relative">
        <img src="<?php echo get_template_directory_uri(); ?>/images/png/flower.png" alt="" width="409" height="392"
            class="absolute top-0 left-0 transform -translate-x-1/2 -translate-y-1/2">
    </div>

<?php }
if (have_rows('content')):
    while (have_rows('content')):
        the_row();
        if (get_row_layout() == 'general_appointment'):
            echo show_app();
        elseif (get_row_layout() == 'general_testimonials'):
            echo show_testimonials();
        elseif (get_row_layout() == 'general_features'):
            echo show_general_features();

        elseif (get_row_layout() == 'big_boxes'):
            $boxes = get_sub_field('boxes');
            if (!empty($boxes)) { ?>
                <div class="relative w-full grid grid-cols-1 md:grid-cols-2 text-white">
                    <?php foreach ($boxes as $box) {
                        $image = $box['image'];
                        $title = $box['title'];
                        $button_label = $box['button_label'];
                        $link = $box['link']; ?>
                        <article class="relative overflow-hidden w-full h-96">
                            <a href="<?php if (!empty($link)) {
                                echo get_permalink($link);
                            } ?>" class="block h-full relative overflow-hidden">
                                <div class="bg-image" style="background-image:url('<?php if (!empty($image)) {
                                    echo $image['url'];
                                } ?>')"></div>
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-white">
                                    <h2 class="text-3xl text-center font-medium"> <?php if (!empty($title)) {
                                        echo $title;
                                    } ?></h2>
                                    <button class="btn btn-lg uppercase rounded-none mt-8 mx-auto md:mx-0">
                                        <?php if (!empty($button_label)) {
                                            echo $button_label;
                                        } ?>
                                    </button>
                                </div>
                            </a>
                        </article>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php elseif (get_row_layout() == 'products'):
            $intro_prod = get_sub_field('intro_prod');
            $bg = get_sub_field('background_word');
            $type_of_products = get_sub_field('type_products');
            $products_list = get_sub_field('products_list'); ?>

            <!-- Home products -->
            <div class="w-full my-20">
                <div class="container mx-auto max-w-7xl">
                    <?php if (!empty($intro_prod)) { ?>
                        <div class="text-4xl text-center">
                            <?php echo $intro_prod; ?>
                        </div>
                    <?php } ?>

                    <div class="products-home container max-w-6xl mx-auto my-14 p-9">
                        <?php switch ($type_of_products) {
                            case 'random':
                                echo show_loop_products('random');
                                break;
                            case 'select':
                                if ($products_list):
                                    foreach ($products_list as $post):
                                        setup_postdata($post);
                                        $post_id = get_the_ID();
                                        ?>
                                        <div>
                                            <?php
                                            wc_get_template_part('content', 'product');
                                            ?>
                                        </div>
                                        <?php
                                    endforeach;
                                    wp_reset_postdata();
                                endif;
                                break;
                            case 'new':
                                echo show_loop_products('new');
                                break;
                            default:
                                break;
                        } ?>
                    </div>
                </div>
            </div>
        <?php elseif (get_row_layout() == 'services'):
            $list_of_services = get_sub_field('list_of_services');
            if ($list_of_services): ?>
                <!-- template-home.php -->
                <div class="slick-container w-full">
                    <?php foreach ($list_of_services as $post):
                        setup_postdata($post);
                        ?>
                        <div class="slick-slide">
                            <?php get_template_part('template-parts/content-title', get_post_type()); ?>
                        </div>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>

        <?php elseif (get_row_layout() == 'simple_content'):
            $content_simple = get_sub_field('content_simple');
            $button_label = get_sub_field('button_label');
            $button_link = get_sub_field('button_link'); ?>


            <div class="w-full bg-gradient-to-b from-white to-[#f2f2f2] py-24" id="main">
                <?php if (!empty($content_simple)) { ?>
                    <div class="the-content mx-auto max-w-3xl">
                        <?php echo $content_simple; ?>
                    </div>
                <?php } ?>
                <?php if (!empty($button_label) && !empty($button_link)) { ?>
                    <div class="w-fit mx-auto uppercase">
                        <a href="<?php echo $button_link; ?>"
                            class="btn btn-outline btn-secondary rounded-none mt-5"><?php echo $button_label; ?></a>
                    </div>
                <?php } ?>
            </div>

            <?php
        endif;
    endwhile;
endif; ?>


<?php get_footer(); ?>