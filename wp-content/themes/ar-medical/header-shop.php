<div class="max-w-6xl mx-auto py-8 px-3 lg:px-0">
    <?php if (function_exists('yoast_breadcrumb')): ?>
        <div class="breadcrumbs-container mb-10">
            <?php yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); ?>
        </div>
    <?php endif; ?>

    <h1 class="text-center text-5xl font-medium">
        <?php
        if (is_product()) {
            the_title(); // Show single product title
        } elseif (is_account_page()) {
            echo get_the_title(); // Show the title of the My Account page
        } else {
            woocommerce_page_title(); // Show store title or other WooCommerce page titles
        }
        ?>
    </h1>
</div>