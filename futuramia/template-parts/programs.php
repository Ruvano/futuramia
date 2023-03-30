<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = isset($globalOptions['general_home_id']) ? $globalOptions['general_home_id'] : '';
    $homeFields = get_fields($general_home_id);
?>
<?php
    /** Section Programs */
    $programs_title = isset($homeFields['programs_title']) ? $homeFields['programs_title'] : '';
    $programs_description = isset($homeFields['programs_description']) ? $homeFields['programs_description'] : '';
?>
<section id="programs" class="programs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title fs-42"><?php echo $programs_title; ?></h3>
            </div>
        </div>
    </div>
        <?php $promotions = !empty($homeFields['promotions']) ? $homeFields['promotions'] : []; ?>
        <?php if (!empty($promotions)) : ?>
          <section class="promotions-section" id="promotions-section">
              <div class="container">
                  <div class="row">
                      <div class="col-12">
                          <div class="promotions-slider owl-carousel owl-theme">
                            <?php foreach($promotions as $key => $item): ?>
                                <?php 
                                $promotion_icon = isset($item['icon']) ? $item['icon'] : '' ;
                                $promotion_icon_attributes = wp_get_attachment_image_src($promotion_icon, $size = 'promotion-icon-thumbnail');
                                $promotion_icon_src = !empty($promotion_icon_attributes) ? $promotion_icon_attributes[0] : '';
                                ?>
                                <div class="promotion-item promotion-icon-<?php echo $key; ?>" data-micromodal-trigger="popup-promotion-<?php echo $key; ?>" data-promotion-id="<?php echo $key; ?>">
                                  <img src="<?php echo $promotion_icon_src; ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                              
                          </div>
                      </div>
                  </div>
              </div>
          </section>
        <?php endif; ?>
        <div class="container">

          <div class="row program-slider-desktop">
            <?php $category_programs = !empty($homeFields['category_programs']) ? $homeFields['category_programs'] : []; ?>
            <?php foreach($category_programs as $program_key => $program_item) : ?>
                <?php  
                $category_title = isset($program_item['category_title']) ? $program_item['category_title'] : '' ;
                $program_items = !empty($program_item['program_item']) ? $program_item['program_item'] : [];
                ?>
                <div id="cat-program-<?php echo $program_key; ?>" class="col-12">
                  <div class="program-slider-category-title fs-24">
                    <span class="slider-category-title">
                      <?php echo $category_title; ?>
                    </span>
                    <!-- <span class="slider-category-buttons">
                      <?php if ($program_key > 0) : ?>
                        <a data-scroll href="#cat-program-<?php echo $program_key-1; ?>" class="slider-category-button slider-category-button-top"></a>
                      <?php endif; ?>
                      <?php if ($program_key < count($category_programs) - 1) : ?>
                        <a data-scroll href="#cat-program-<?php echo $program_key+1; ?>" class="slider-category-button slider-category-button-bottom"></a>
                      <?php endif; ?>
                    </span> -->
                  </div>
                </div>
                <?php foreach($program_items as $key => $item) : ?>
                    <?php
                        global $post, $mh;
                        $mh = true;
                        $post = $item;
                    ?>
                    <?php echo get_template_part('template-parts/program'); ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>
          </div>
    </div>
    <div class="program-slider-mobile-new">
        <?php
        $program_args = [
            'post_type' => 'program',
            'posts_per_page' => -1
        ];
        $programs = new WP_Query( $program_args );
        ?>
        

              <?php 
                foreach($category_programs as $program_key => $program_item) :
                  $category_title = isset($program_item['category_title']) ? $program_item['category_title'] : '' ;
                  $program_items = !empty($program_item['program_item']) ? $program_item['program_item'] : [];
              ?>
                <div id="cat-program-<?php echo $program_key; ?>" class="col-12">
                  <div class="program-slider-category-title fs-24">
                    <span class="slider-category-title">
                      <?php echo $category_title; ?>
                    </span>
                    <!-- <span class="slider-category-buttons">
                      <?php if ($program_key > 0) : ?>
                        <a data-scroll href="#cat-program-<?php echo $program_key-1; ?>" class="slider-category-button slider-category-button-top"></a>
                      <?php endif; ?>
                      <?php if ($program_key < count($category_programs) - 1) : ?>
                        <a data-scroll href="#cat-program-<?php echo $program_key+1; ?>" class="slider-category-button slider-category-button-bottom"></a>
                      <?php endif; ?>
                    </span> -->
                  </div>
                </div>
                <?php foreach($program_items as $key => $item) : ?>
                  <?php
                    $program_fields = get_fields($item);
                    $program_id = $item;
                    $program_title = $program_fields['program_promo_title'];
                    $img_url = isset($program_fields['general_img']) ? $program_fields['general_img'] : '';
                    $general_desciption = isset($program_fields['general_desciption']) ? $program_fields['general_desciption'] : '';
                    $general_icons = !empty($program_fields['general_icons']) ? $program_fields['general_icons'] : [];
                    $general_icons_age = isset($general_icons['age']) ? $general_icons['age'] : '';
                    $general_icons_time = isset($general_icons['time']) ? $general_icons['time'] : '';
                    $general_icons_price = isset($general_icons['price']) ? $general_icons['price'] : '';
                    $general_slider_gallery = !empty($program_fields['general_slider_gallery']) ? $program_fields['general_slider_gallery'] : [];
                    $general_parks = !empty($program_fields['general_parks']) ? $program_fields['general_parks'] : [];

                  ?>
                  <a href="<?php the_permalink($program_id); ?>" class="program-list-item">
                    <div class="row align-items-center 000">
                      <div class="col-5">
                        <div class="thumbnail-box">
                          <?php
                              $general_thumbnail_mobile = isset($program_fields['general_thumbnail_mobile']) ? $program_fields['general_thumbnail_mobile'] : '';
                              $gallery_img_attributes = wp_get_attachment_image_src($general_thumbnail_mobile, $size = 'logo');
                              $gallery_img_src = !empty($gallery_img_attributes) ? $gallery_img_attributes[0] : '';
                              
                              $image_alt = get_post_meta($general_thumbnail_mobile, '_wp_attachment_image_alt', TRUE);
                              $image_alt = ($image_alt == "") ?  get_the_title($program_id) : $image_alt;
                              $image_title = get_the_title($general_thumbnail_mobile);
                              $image_title = ($image_title == "") ?  get_the_title($program_id) : $image_title;
                          ?>
                          <img class="thumbnail" src="<?php echo $gallery_img_src; ?>" alt="<?php echo $image_alt; ?>" title="<?php echo $image_title; ?>">
                        </div>
                      </div>
                      <div class="col-7">
                          <h3 class="title fs-18"><?php echo $program_title ?></h3>
                          <div class="link-to-program fs-16">Открыть программу</div>
                      </div>
                      <div class="col-12">
                      </div>
                    </div>
                  </a>
                <?php endforeach; ?>
                
              <?php endforeach; ?>
        
    </div>
</section>
<!-- .programs -->
