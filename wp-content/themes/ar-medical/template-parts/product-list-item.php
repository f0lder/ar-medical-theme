<li class="grid grid-cols-6 gap-1 border-b last:border-none pb-1 mb-1 last:mb-0">
    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>"
        alt="<?php echo get_the_title(); ?>">
    <div class=" col-span-5 flex flex-col">
        <a class=" hover:text-primary" href="<?php echo get_permalink(); ?>">
            <?php echo get_the_title(); ?>
        </a>
        <div class="w-full grid grid-cols-2">
            <?php echo wc_price(get_post_meta(get_the_ID(), '_price', true)); ?>

            <?php
            $sku = get_post_meta(get_the_ID(), '_sku', true);
            if ($sku) {
                echo '<span class="text-right italic text-gray-500">' . esc_html($sku) . '</span>';
            }
            ?>
        </div>
    </div>
</li>