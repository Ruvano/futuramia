<?php
global $post, $mh;

$dataMH = ($mh == true) ? 'data-mh="program-box-row"' : '';
$program_fields = get_fields();
$img_url = isset($program_fields['general_img']) ? $program_fields['general_img'] : '';
$general_desciption = isset($program_fields['general_desciption']) ? $program_fields['general_desciption'] : '';
$general_slider_gallery = !empty($program_fields['general_slider_gallery']) ? $program_fields['general_slider_gallery'] : [];
$general_parks = !empty($program_fields['general_parks']) ? $program_fields['general_parks'] : [];
$general_button_text = isset($program_fields['general_button_text']) && $program_fields['general_button_text'] != '' ? $program_fields['general_button_text'] : false;
?>
<div class="col-xl-6">
    <div class="program-box" <?php echo $dataMH; ?> data-program-box-id="<?php echo get_the_ID(); ?>">
        <div class="row">
            <div class="col-12">
                <h3 class="title fs-24"><?php the_title(); ?></h3>
                <div class="description fs-16">
                    <?php echo $general_desciption; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-4 col-lg-3 col-xl-6">
                <div class="left-col">
                    <div class="thumbnail-box">
                        <div class="program-gallery-slider owl-carousel owl-theme">
                            <?php foreach($general_slider_gallery as $item) : ?>
                                <?php
                                    $gallery_img_id = isset($item['id']) ? $item['id'] : '';
                                    $gallery_img_attributes = wp_get_attachment_image_src($gallery_img_id, $size = 'program-thumbnail');
                                    $gallery_img_src = !empty($gallery_img_attributes) ? $gallery_img_attributes[0] : '';
                                    $image_alt = get_post_meta($gallery_img_id, '_wp_attachment_image_alt', TRUE);
                                    $image_alt = ($image_alt == "") ?  get_the_title() : $image_alt;
                                    $image_title = get_the_title($gallery_img_id);
                                    $image_title = ($image_title == "") ?  get_the_title() : $image_title;
                                ?>
                                <div>
                                    <img class="thumbnail" src="<?php echo $gallery_img_src; ?>" alt="<?php echo $image_alt; ?>" title="<?php echo $image_title; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-md-8 col-lg-9 col-xl-6">
                <div class="right-col">
                    <div class="item">
                        <?php $parksTemp = $general_parks; ?>
                        <?php foreach($general_parks as $key => $item) : ?>
                            <?php if ($key > 0) break; ?>
                            <?php
                                $park_name = $item['park']->post_title;
                                $park_id = $item['park']->ID;
                                $general_icons = !empty($item['general_icons']) ? $item['general_icons'] : [];
                                $general_icons_age = isset($general_icons['age']) ? $general_icons['age'] : '';
                                $general_icons_time = isset($general_icons['time']) ? $general_icons['time'] : '';
                                $general_icons_price = isset($general_icons['price']) ? $general_icons['price'] : '';
                                $class_active = $key == 0 ? 'active' : '';
                            ?>
                            <?php if($general_icons_age != '' || $general_icons_time != '' || $general_icons_price != '') : ?>
                                <div id="feature-id-<?php echo $park_id; ?>" class="icons feature <?php echo $class_active; ?>">
                                    <div class="icon-box">
                                        <div class="text fs-16 icon-description">Адаптированна для: </div>
                                        <div class="text fs-16 icon-bold"><?php echo $general_icons_age; ?> лет.</div>
                                    </div>
                                    <div class="icon-box">
                                        <div class="text fs-16 icon-description">Аренда парка: </div>
                                        <div class="text fs-16 icon-bold"><?php echo $general_icons_time; ?> час.</div>
                                    </div>
                                    <div class="icon-box icon-box--parks">
                                        <div class="text fs-16 icon-description">
                                            <!--Программа доступна в парках:-->
                                        </div>
                                        <?php foreach($general_parks as $parkPrice) : ?>
                                            <?php
                                                $park_name = $parkPrice['park']->post_title;
                                                $park_id = $parkPrice['park']->ID;
                                                $park_address = get_field('address', $park_id);
                                                $general_icons = !empty($parkPrice['general_icons']) ? $parkPrice['general_icons'] : [];
                                                $general_icons_price = isset($general_icons['price']) ? $general_icons['price'] : '';
                                            ?>
                                            <div class="text fs-16 icon--park">
                                                <div class="text fs-16 icon-bold icon-park-name">
                                                    <?php //echo $park_name; ?>
                                                </div>
                                                <div class="text fs-16 icon-description icon-park-address">
                                                    <?php //echo $park_address; ?>
                                                </div>
                                                <div class="price-group">
                                                    <div class="text fs-16 icon-description">Cтоимость: </div>
                                                    <div class="text fs-16 icon-bold"><?php echo $general_icons_price; ?> ₽.</div>
                                                </div>
                                            </div>
                                        <?php
                                        break;
                                        endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div><!-- .item -->
                    <div class="item">
                        <a href="<?php echo get_the_permalink(); ?>" class="button button-program fs-16">
                            <?php if ($general_button_text) : ?>
                                <?php echo $general_button_text; ?>
                            <?php else : ?>
                                Подробнее о программе
                            <?php endif; ?>
                        </a>
                    </div><!-- .item -->
                </div>
            </div>
        </div>
    </div>
</div>
