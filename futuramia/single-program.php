<?php
/**
 * The main template file
 *
 * @package Futuramia
 * @since 1.0.0
 */

global $class_header, $globalOptions;
$class_header = 'site-header--absolute';
$fields = get_fields();
get_header();
?>

<?php
$program_promo_video_src = get_field('program_promo_video', false, false);
$program_promo_category = $fields['program_promo_category'] ?? false;
$program_promo_title = $fields['program_promo_title'] ?? false;
$program_promo_subtitle = $fields['program_promo_subtitle'] ?? false;
$program_promo_description = $fields['program_promo_description'] ?? false;
?>
    <section class="cpt-program-promo promo">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="cpt-program-promo-player-wrapper">
                        <?php if ($program_promo_video_src) : ?>
                            <div id="cpt-promo-video" class="responsive-video"></div>
                            <script>
                                const programVideoUrl = "<?= $program_promo_video_src ?>";
                                //alert(programVideoUrl)
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="program-promo-textblock center">
                        <?php if ($program_promo_category) : ?>
                            <span class="fs-24"> <?= $program_promo_category ?></span>
                        <?php endif ?>
                        <?php if ($program_promo_title) : ?>
                            <span class="fs-42"> <?= $program_promo_title ?></span>
                        <?php endif ?>
                        <?php if ($program_promo_subtitle) : ?>
                            <span class="fs-20"> <?= $program_promo_subtitle ?></span>
                        <?php endif ?>
                        <?php if ($program_promo_description) : ?>
                            <span class="fs-20"> <?= $program_promo_description ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div><!-- .container -->
    </section><!-- .cpt-program-promo -->

    <section class="cpt-program-about">
        <?php
        $program_about_title = $fields['program_about_title'] ?? false;
        $program_about_text = $fields['program_about_text'] ?? false;
        $program_about_text_title = (isset($fields['program_about_text_title']) && $fields['program_about_text_title'] != '') ? $fields['program_about_text_title'] : 'В стоимость праздника входят:';
        $program_about_note = $fields['program_about_note'] ?? false;
        $program_about_gallery = !empty($fields['program_about_gallery']) ? $fields['program_about_gallery'] : [];
        $general_slider_gallery = !empty($fields['program_about_gallery']) ? $fields['program_about_gallery'] : [];
        $general_parks = !empty($fields['general_parks']) ? $fields['general_parks'] : [];
        $program_additives_item = $fields['program_additives_items'] ?? false;
        $program_additives_title = $fields['program_additives_title'] ?? '' ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 order-2 order-lg-1">
                    <?php if ($program_about_title) : ?>
                        <div class="section-title cpt-program-about-title fs-42"> <?= $program_about_title ?></div>
                    <?php endif;
                    if ($program_about_text) : ?>
                        <div class="wrapper-cpt-program-content">
                            <div class="cpt-program-content read-more-program-features fs-20">
                                <div class="content-sub-title fs-24"> <?= $program_about_text_title ?></div>
                                <?= $program_about_text ?>
                            </div>
                        </div>
                    <?php endif;
                    if (!empty($general_parks)) : ?>
                        <div class="cpt-program-content fs-20">
                            <div class="content-sub-title fs-24">Программа доступна в парках:</div>
                            <?php foreach ($general_parks as $key => $park) :
                                $park_obj = $park['park'] ?? false;
                                $park_fields = get_fields($park_obj->ID);
                                $contact_address = $park_fields['address'] ?? '';
                                $contact_link_to_map = $park_fields['link_to_map'] ?? '';
                                $program_params = !empty($park['general_icons']) ? $park['general_icons'] : [];
                                $age = $program_params['age'] ?? false;
                                $time = $program_params['time'] ?? false;
                                $price = $program_params['price'] ?? false;
                                $price_weekend = $program_params['price_weekend'] ?? false;
                                ?>
                                <div class="park-item">
                                    <div>
                                        <strong class="park-title"> <?= $park_obj->post_title ?></strong>
                                    </div>
                                    <div>
                                        <strong>Стоимость:</strong>
                                        <?= (!$price) ?: "в будни $price руб." ?>
                                        <?= (!$price_weekend) ?: "/ в выходные $price_weekend руб." ?>
                                    </div>
                                    <div>
                                        <strong>Продолжительность программы * :</strong> <?= $time ?> часа.
                                    </div>
                                    <div>
                                        <strong>Адрес:</strong>
                                        <span> <?= $contact_address ?> (
                                            <a href="<?= $contact_link_to_map ?>" target="_blank">
                                                открыть на карте
                                            </a>
                                            )</span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <?php if (isset($_GET['test-555555']) or true !== null) :
                        if ($program_additives_item) : ?>
                            <div class="cpt-program-content fs-20 additives">
                                <div class="content-sub-title fs-24"> <?= $program_additives_title ?></div>
                                <div class="additive-items">
                                    <?php foreach ($program_additives_item as $key) :
                                        $additive_fields = get_fields($key);
                                        $additive_title = get_the_title($key);
                                        $additive_description = !empty($additive_fields['additive_description']) && $additive_fields['additive_description'] != '' ? $additive_fields['additive_description'] : false;
                                        $additive_icon = !empty($additive_fields['additive_icon']) && $additive_fields['additive_icon'] != '' ? $additive_fields['additive_icon'] : false;
                                        $additive_price = !empty($additive_fields['additive_price']) && $additive_fields['additive_price'] != '' ? $additive_fields['additive_price'] : false;
                                        // var_dump($additive_fields);
                                        ?>
                                        <div class="additive-item">
                                            <?php if ($additive_icon) : ?>
                                                <div class="additive-item-icon">
                                                    <img src=" <?= $additive_icon ?>" alt="">
                                                </div>
                                            <?php endif ?>
                                            <div class="additive-item-content">
                                                <div>
                                                    <strong class="park-title"> <?= $additive_title ?></strong>
                                                </div>
                                                <?php if ($additive_description) : ?>
                                                    <div>
                                                        <?= $additive_description ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if ($additive_price) : ?>
                                                    <div>
                                                        <strong>Цена: </strong> <?= $additive_price ?> руб.
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif;
                    endif ?>
                    <?php if ($program_about_note) : ?>
                        <div class="cpt-program-content fs-20">
                            <div class="content-sub-title fs-24">Примечание:</div>
                            <?= $program_about_note ?>
                        </div>
                    <?php endif ?>
                    <!--<div class="cpt-program-content">
                        <div class="open-get-program-wrapper">
                            <a href="javascript:void(0);" class="open-get-program fs-24"
                               data-micromodal-trigger="get-program-<?php /*= get_the_ID() */?>">Заказать праздник</a>
                        </div>
                    </div>-->
                </div>

                <div class="col-lg-6 col-12 order-1 order-lg-2">
                    <div class="splash-panel">
                        <div class="cpt-gallery-decor-top-wrapper">
                            <img class="cpt-gallery-decor-top"
                                 src=" <?= get_stylesheet_directory_uri() ?>/assets/img/decors/gallery-top.png" alt="">
                        </div>
                        <div class="program-gallery-slider-one  owl-carousel owl-theme">
                            <?php foreach ($general_slider_gallery as $item) :
                                $gallery_img_full_url = $item['url'] ?? '';
                                $gallery_img_id = $item['id'] ?? '';
                                $gallery_img_attributes = wp_get_attachment_image_src($gallery_img_id, $size = 'full-width-mobile');
                                $gallery_img_src = !empty($gallery_img_attributes) ? $gallery_img_attributes[0] : '' ?>
                                <div class="item">
                                    <a class="gallery-item-program" data-fancybox="gallery-program"
                                       href=" <?= $gallery_img_full_url ?>"
                                       data-caption=" <?= $program_promo_title ?>"
                                       style="background-image:url(' <?= $gallery_img_src ?>');">
                                    </a>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="program-gallery-thumbnails">
                            <?php foreach ($general_slider_gallery as $key => $item) : ?>
                                <?php
                                $gallery_img_id = $item['id'] ?? '';
                                $gallery_img_attributes = wp_get_attachment_image_src($gallery_img_id, $size = 'logo');
                                $gallery_img_src = !empty($gallery_img_attributes) ? $gallery_img_attributes[0] : '';
                                ?>
                                <div class="item" data-number=" <?= $key ?>">
                                    <img src=" <?= $gallery_img_src ?>" alt="">
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- .container -->
    </section><!-- section.gallery -->

    <section class="cpt-program-faq">
        <?php $program_faq_questions = !empty($fields['program_faq_questions']) ? $fields['program_faq_questions'] : [] ?>
        <?php $program_faq_title = $fields['program_faq_title'] ?? false ?>
        <div class="container">
            <?php if ($program_faq_title) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="section-title faq_title"> <?= $program_faq_title ?></div>
                    </div>
                </div>
            <?php endif ?>

            <?php if (!empty($program_faq_questions)) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="faq_text">
                            <div class="row">
                                <?php foreach ($program_faq_questions as $key => $value) :
                                    $answer = $value['answer'] ?? '';
                                    $question = $value['question'] ?? '' ?>
                                    <div class="col-lg-6 col-12">
                                        <div class="faq-item<?php if ($key == 0) : echo ' active'; endif ?>">
                                            <span class="faq_question fs-24"
                                                  data-question-number=" <?= $key ?>"> <?= $question ?></span>
                                            <span class="faq_answer faq_answer- <?= $key ?> fs-20"> <?= $answer ?></span>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;
            $program_form_question_title = $fields['program_form_question_title'] ?? false;
            $program_form_question_subtitle = $fields['program_form_question_subtitle'] ?? false ?>
            <div class="row">
                <div class="col-12">
                    <div class="form_question_title">
                        <span class="center fs-42">Остались вопросы?</span>
                        <span class="center fs-24">Задайте их любым удобным для вас способом.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="form-question">
                        <style>#wpcf7-f1176-o20 label{color:white}</style>
                        <?php //echo do_shortcode('[contact-form-7 id="1176" title="Контактная форма 1"]') ?>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="form_question-separator">
                        ИЛИ
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <?php
                    $contact_whatsapp = $globalOptions['contact_whatsapp'] ?? false;
                    $contact_phone = $globalOptions['contact_phone'] ?? false;
                    $contact_vk = $globalOptions['contact_vk'] ?? false;
                    ?>
                    <div class="form_question_communication">
                        <?php if ($contact_phone) : ?>
                            <div class="form_question_communication-item">
                            <span class="form_question_communication-title fs-18">
                                По телефону:
                            </span>
                                <span class="form_question_communication-text fs-20">
                                <a class="" href="tel: <?= $contact_phone[1] ?>"> <?= $contact_phone[0] ?></a>
                            </span>
                            </div>
                        <?php endif ?>
                        <?php if ($contact_whatsapp) : ?>
                            <div class="form_question_communication-item">
                            <span class="form_question_communication-title fs-18">
                                Через WhatsApp:
                            </span>
                                <span class="form_question_communication-text  fs-20">
                                <a class="link" href=" <?= $contact_whatsapp ?>"
                                   target="_blank">Написать в WhatsApp</a>
                            </span>
                            </div>
                        <?php endif ?>
                        <?php if ($contact_vk) : ?>
                            <div class="form_question_communication-item">
                            <span class="form_question_communication-title fs-18">
                                В группе ВКонтакте:
                            </span>
                                <span class="form_question_communication-text  fs-20">
                                <a class="link" href=" <?= $contact_vk ?>"
                                   target="_blank">Перейти в группу ВКонтакте</a>
                            </span>
                            </div>
                        <?php endif ?>

                        <div class="form_question_communication-item">
                        <span class="form_question_communication-title fs-18">
                            В Футурамии (адреса в Екатеринбурге):
                        </span>
                            <span class="form_question_communication-text">
                            <?php
                            $parksContact = get_posts([
                                'post_type' => 'park',
                                'numberposts' => -1,
                                'order' => 'ASC'
                            ]);
                            ?>
                                <?php foreach ($parksContact as $key => $park) : ?>
                                    <?php
                                    $park_fields = get_fields($park->ID);
                                    $contact_address = $park_fields['address'] ?? '';
                                    $contact_link_to_map = $park_fields['link_to_map'] ?? '';
                                    ?>
                                    <div class="park-item">
                                    <strong class="park-item-title fs-20"> <?= $park->post_title ?></strong>
                                    <div class="park-item-contact fs-18">
                                         <?= $contact_address ?> (<a href=" <?= $contact_link_to_map ?>"
                                                                     target="_blank">на карте</a>)
                                    </div>
                                </div>
                                <?php endforeach ?>
                        </span>
                        </div>

                    </div>

                </div>
            </div>

        </div><!-- .container -->
    </section><!-- section.program -->

<?= get_template_part('template-parts/contact') ?>

<?php get_footer();