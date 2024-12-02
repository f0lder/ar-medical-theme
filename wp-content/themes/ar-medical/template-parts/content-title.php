<article id="post-<?php the_ID(); ?>" <?php post_class('relative overflow-hidden w-full h-96'); ?>>
    <a href="<?php the_permalink(); ?>" class="block h-full relative overflow-hidden">
        <div class="bg-image"
            style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');"></div>
        <?php if (get_post_type() === 'serviciu') {
            ?>
            <div
                class="absolute inset-0 bg-gradient-to-b from-transparent to-black flex flex-col justify-between text-white">
            <?php } else { ?>
                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-between text-white">
                    <?php
        } ?>
                <div class="text-left">
                    <?php if (get_post_type() !== 'serviciu' && get_post_type() !== 'curs'): ?>
                        <?php
                        // Display the post date split into day and full month
                        $day = get_the_date('d');
                        $month = get_the_date('F');
                        ?>
                        <div style="background-color: #feeae7"
                            class="flex flex-col w-fit text-black ml-4 p-1 px-3 items-center justify-center">
                            <span class="text-md data"><?php echo $month; ?></span>
                            <span class="text-lg font-bold data"><?php echo $day; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-4">
                    <?php
                    // Display the category
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<p class="text-sm text-white mb-1">Categorie: ' . esc_html($categories[0]->name) . '</p>';
                    }
                    if (get_post_type() === 'serviciu') {

                        the_title('<h2 class="text-2xl text-center font-bold mb-2">', '</h2>');
                    } else {
                        the_title('<h2 class="text-2xl font-bold mb-2">', '</h2>');

                    } ?>
                </div>
            </div>
            <div class="entry-content p-4">
                <?php
                // Optionally, you can add an excerpt or other content here
                ?>
            </div><!-- .entry-content -->
    </a>
</article><!-- #post-<?php the_ID(); ?> -->