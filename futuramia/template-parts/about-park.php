<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = $globalOptions['general_home_id'] ?? '';
    $homeFields = get_fields($general_home_id);
    /**
     * About
     */
    $about_title = $homeFields['about_park_title'] ?? '';
    $about_description = $homeFields['about_park_text'] ?? '';
    $about_gallery = !empty($homeFields['about_park_gallery']) ? $homeFields['about_park_gallery'] : []; ?>
<section class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="section-title fs-42"><?= $about_title; ?></h1>
            </div>
            <div class="col-lg-4">
                <div class="monster-about-wrapper">
                    <img class="monster-about" src="<?= get_stylesheet_directory_uri(); ?>/assets/img/monster-about.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="park-about-wrapper">
                    <div class="section-description fs-18 read-more-text"><?= $about_description; ?></div>
                </div>
            </div>
        </div>
        <?php if(!empty($about_gallery)) : ?>
          <div class="row gallery">
              <?php foreach($about_gallery as $item) : ?>
                  <?php
                      $gallery_img_id = $item['id'] ?? '';
                      $gallery_img_attributes = wp_get_attachment_image_src($gallery_img_id, $size = 'program-thumbnail');
                      $gallery_img_src = empty($gallery_img_attributes) ?: $gallery_img_attributes[0]; ?>
                  <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                      <img src="<?= $gallery_img_src; ?>" alt="">
                  </div>
              <?php endforeach; ?>
          </div>
        <?php endif; ?>
    </div>
</section>
