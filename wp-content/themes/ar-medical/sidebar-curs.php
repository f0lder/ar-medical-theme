<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AR_Medical_Cosmetic
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>
<aside id="secondary" class="widget-area max-w-3xl lg:w-[35%] p-4 mx-auto">
    <div class="widget">
        <h2 class="widget-title"><?php _e('Course details','ar-medical'); ?></h2>
        <?php
        $durata = get_field('durata');
        if (!empty($durata)) { ?>
            <div class="w-full grid grid-cols-5 mb-4 pb-4" style="border-bottom: 1px dashed #e0e0e0;">
                <span class="col-span-1 flex items-center justify-center"><img
                        src="<?php echo get_template_directory_uri(); ?>/images/svg/course2.svg" alt=""></span>
                <div class="col-span-4 flex flex-col pl-3">
                    <p class="text-[#585858]"><?php _e('Length', 'ar-medical'); ?></p>
                    <strong class="font-bold "><?php echo $durata; ?></strong>
                </div>
            </div>
        <?php }

        $main_id = get_the_ID();

        $terms = get_the_terms($main_id, 'categorie-curs');
        if ($terms && !is_wp_error($terms)):
            $draught_ids = array();
            $draught_cat = array();
            foreach ($terms as $term) {
                $draught_ids[] = $term->term_id;
                $draught_cat[] = $term->name;
            }
            $on_draught = join(", ", $draught_ids);
            $on_draught_cat = join(", ", $draught_cat);

        endif; ?>
        <?php if (!empty($on_draught_cat)) { ?>
            <div class="w-full grid grid-cols-5 mb-4 pb-4" style="border-bottom: 1px dashed #e0e0e0;">
                <span class="col-span-1 flex items-center justify-center"><img
                        src="<?php echo get_template_directory_uri(); ?>/images/svg/course3.svg" alt=""></span>
                <div class="col-span-4 flex flex-col pl-3">
                    <p class="text-[#585858]"><?php _e('Course category', 'ar-medical'); ?></p>
                    <strong><?php echo $on_draught_cat; ?></strong>
                </div>
            </div>
        <?php } ?>

        <?php $pret_mare = get_field('pret_mare', $main_id);
        $pret_mic = get_field('pret_mic', $main_id);
        if (!empty($pret_mic)) { ?>
            <p class="text-[#585858]"><?php _e('Course price', 'ar-medical'); ?></p>
            <h2 class="widget-title"><?php echo $pret_mic; ?></h2>
            <?php if (!empty($pret_mare)) { ?>
                <del><?php echo $pret_mare; ?></del>
            <?php } ?>
            <?php if (!empty($ev_date) && intval($ev_date) >= intval($today) && !empty($general_form)) { ?>
                <a href="#inscriere-curs"
                    class="choose-course smooth-scroll button1"><?php _e('choose course', 'ar-medical'); ?></a>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="widget">
        <?php $diploma_example = get_field('diploma_example');
        if (!empty($diploma_example)) { ?>
            <div class="">
                <?php $intro_diploma_1 = get_field('intro_diploma_1', 'options');
                if (!empty($intro_diploma_1)) { ?>
                    <h2 class="widget-title"><?php echo $intro_diploma_1; ?></h2>
                <?php } ?>
                <?php $intro_diploma_2 = get_field('intro_diploma_2', 'options');
                if (!empty($intro_diploma_2)) { ?>
                    <p class="text-[#585858] mb-4"><?php echo $intro_diploma_2; ?></p>
                <?php } ?>
                <a href="<?php echo $diploma_example['url']; ?>" class=""><img src="<?php echo $diploma_example['url']; ?>"
                        alt="<?php echo $diploma_example['alt']; ?>"></a>
            </div>
        <?php } ?>
    </div>

    <?php $contact_title_1 = get_field('contact_title_1', 'options');
    $contact_title_2 = get_field('contact_title_2', 'options');
    $contact_title_3 = get_field('contact_title_3', 'options');
    $phone_no = get_field('phone_no', 'options');
    $contact_image = get_field('contact_image', 'options');
    if (!empty($contact_title_1) || !empty($contact_title_2) || !empty($contact_title_3) || !empty($phone_no) || !empty($contact_image)) { ?>
            <div style="background: linear-gradient(-90deg, #d6d7db 0%, #f0f1f5 67%, #f0f1f5 100%);">
                <div class="pt-8 px-8">
                    <?php if (!empty($contact_title_1)) { ?>
                        <h6 class="uppercase text-base font-medium mb-2"><?php echo $contact_title_1; ?></h6>
                    <?php } ?>
                    <?php if (!empty($contact_title_2)) { ?>
                        <h2 class="mb-3 text-3xl font-medium leading-tight"><?php echo $contact_title_2; ?></h2>
                    <?php } ?>
                    <?php if (!empty($contact_title_3)) { ?>
                        <p class="text-[#585858]"><?php echo $contact_title_3; ?></p>
                    <?php } ?>
                    <?php if (!empty($phone_no)) { ?>
                        <div class="w-full flex flex-row items-center text-lg mt-3">
                            <a href="tel:<?php echo phonenr($phone_no); ?>"
                                class="bg-primary rounded-full size-12 flex items-center justify-center"><img
                                    src="<?php echo get_template_directory_uri(); ?>/images/svg/phone2.svg" alt="" width="20"
                                    height="20"></a>

                            <a class="px-4 hover:text-primary" href="tel:<?php echo phonenr($phone_no); ?>"><?php echo $phone_no; ?></a>
                        </div>
                    <?php } ?>
                </div>
                <?php if (!empty($contact_image)) { ?>
                    <div class="appoinment-image"><img src="<?php echo $contact_image['url']; ?>"
                            alt="<?php echo $contact_image['alt']; ?>"></div>
                <?php } ?>
            </div>
    <?php } ?>
</aside>