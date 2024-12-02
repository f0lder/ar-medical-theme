<li class="recent-post">
    <a href="<?php the_permalink(); ?>" class="flex">
        <?php if (has_post_thumbnail()): ?>
            <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>
            <span class="blog-post-image"
                style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"></span>
        <?php endif; ?>
        <div class="post-details">
            <div class="post-title text-base font-medium mt-0"><?php the_title(); ?></div>
            <span class="post-date"><?php echo get_the_date(); ?></span>
        </div>
    </a>
</li>