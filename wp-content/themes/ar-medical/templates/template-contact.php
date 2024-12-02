<?php
/*
 * Template Name: Pagina Contact
 * Template Post Type: page
 */
get_header();

echo show_hero();

?>

<main class="w-full py-16">
    <div class="flex flex-col-reverse lg:grid grid-cols-6 gap-5 max-w-2xl px-5 lg:max-w-6xl lg:px-0 mx-auto">
        <div class="mx-auto lg:col-span-4 p-8 bg-[#fbfbfb]">
            <?php $intro_form = get_field('intro_form');
            if (!empty($intro_form)) { ?>
                <div class="the-content pb-5">
                    <?php echo $intro_form; ?>
                </div>
            <?php } ?>
            <?php $form = get_field('form');
            if (!empty($form)) { ?>
                <?php echo do_shortcode($form); ?>
            <?php } ?>
        </div>
        <div class="w-full lg:col-span-2 p-8 bg-[#fbfbfb]">
            <?php $intro_contact = get_field('intro_contact');
            if (!empty($intro_contact)) { ?>
                <h2 class="text-4xl font-medium leading-tight mb-2"><?php echo $intro_contact; ?></h2>
            <?php } ?>
            <?php $phone_label_1 = get_field('phone_label_1', 'options');
            $phone_number_1 = get_field('phone_number_1', 'options');
            if (!empty($phone_number_1) && !empty($phone_label_1)) { ?>
                <div class="grid grid-cols-6 gap-5">
                    <div class="col-span-1 flex items-center justify-center">
                        <img class="size-9" src="<?php echo get_template_directory_uri(); ?>/images/svg/icon-contact1.svg">
                    </div>
                    <div class="col-span-5 flex flex-col">
                        <p><?php echo $phone_label_1; ?></p>
                        <a href="tel:<?php echo phonenr($phone_number_1); ?>" title=""
                            class="hover:underline"><?php echo $phone_number_1; ?></a>
                    </div>
                </div>
            <?php } ?>
            <?php $phone_label_2 = get_field('phone_label_2', 'options');
            $phone_number_2 = get_field('phone_number_2', 'options');
            if (!empty($phone_number_2) && !empty($phone_label_2)) { ?>
                <div class="mt-5 grid grid-cols-6 gap-5">
                    <div class="flex items-center justify-center">
                        <img class="size-9" src="<?php echo get_template_directory_uri(); ?>/images/svg/icon-contact1.svg">
                    </div>
                    <div class="col-span-5 flex flex-col">
                        <p><?php echo $phone_label_2; ?></p>
                        <a href="tel:<?php echo phonenr($phone_number_2); ?>"
                            class="hover:underline"><?php echo $phone_number_2; ?></a>
                    </div>
                </div>
            <?php } ?>
            <?php $program = get_field('program', 'options');
            if (!empty($program)) { ?>
                <div class="mt-5 grid grid-cols-6 gap-5">
                    <div class="flex items-center justify-center">
                        <img class="size-9" src="<?php echo get_template_directory_uri(); ?>/images/svg/icon-contact2.svg">
                    </div>
                    <div class="col-span-5 flex flex-col">
                        <p><?php _e('Program', 'ar-medical'); ?></p>
                        <p class="hover:underline"><?php echo $program; ?></p>
                    </div>
                </div>
            <?php } ?>
            <?php $email = get_field('email', 'options');
            if (!empty($email)) { ?>
                <div class="mt-5 grid grid-cols-6 gap-5">
                    <div class="flex items center justify-center">
                        <img class="size-9" src="<?php echo get_template_directory_uri(); ?>/images/svg/icon-contact3.svg">
                    </div>
                    <div class="col-span-5 flex flex-col">
                        <p><?php _e('Email', 'ar-medical'); ?></p>
                        <a href="mailto:<?php echo $email; ?>" class="hover:underline"><?php echo $email; ?></a>
                    </div>
                </div>
            <?php } ?>
            <?php $address = get_field('address', 'options');
            $address_link = get_field('address_link', 'options');
            if (!empty($address) && !empty($address_link)) { ?>
                <div class="mt-5 grid grid-cols-6 gap-5">
                    <div class="flex items
                        center justify-center">
                        <img class="size-9" src="<?php echo get_template_directory_uri(); ?>/images/svg/icon-contact4.svg">
                    </div>
                    <div class="col-span-5 flex flex-col">
                        <p><?php _e('Adresa', 'ar-medical'); ?></p>
                        <a href="<?php echo $address_link; ?>" class="hover:underline"><?php echo $address; ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>