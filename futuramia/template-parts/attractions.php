<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = isset($globalOptions['general_home_id']) ? $globalOptions['general_home_id'] : '';
    $homeFields = get_fields($general_home_id);
?>
<?php
    /** Attractions */
    $attractions_title = isset($homeFields['attractions_title']) ? $homeFields['attractions_title'] : '';
?>
<?php if(isset($attractions_title)) : ?>
    <section id="attractions" class="attractions">

    <?php echo get_template_part('template-parts/popups/popup-attractions'); ?>

        <div class="attraction-title--absolute">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title fs-42"><?php echo $attractions_title; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $attraction_args = [
            'post_type' => 'attraction',
            'posts_per_page' => -1
        ];
        $attractions = new WP_Query($attraction_args);
        $videoUrls = [];
        ?>
        <?php if ( $attractions->have_posts() ) : ?>
            <div class="attractions-list owl-carousel">
                <?php $i = 0;?>
                <?php while ( $attractions->have_posts() ) : $attractions->the_post(); ?>
                    <?php
                        $attraction_fields = get_fields();
                        $attraction_description = isset($attraction_fields['description']) ? $attraction_fields['description'] : '';
                        $attraction_bg = !empty($attraction_fields['bg']) ? $attraction_fields['bg'] : [];
                        $attraction_type = isset($attraction_bg['type']) ? $attraction_bg['type'] : '';
                        $attraction_img_src = '';
                        if ($attraction_type == 'video') {
                            $attraction_video_src = get_field('bg_video', false, false);
                            $videoUrls[$i] = $attraction_video_src;
                        } elseif ($attraction_type == 'img') {
                            $attraction_img_id = isset($attraction_bg['img']) ? $attraction_bg['img'] : '';
                            $attraction_img_attributes = wp_get_attachment_image_src($attraction_img_id, $size = 'full-screen');
                            $attraction_img_src = !empty($attraction_img_attributes) ? $attraction_img_attributes[0] : '';
                        }
                    ?>

                    <?php if ($attraction_type == 'video') : ?>
                        <div id="attraction-item-<?php echo $i; ?>" class="attraction-item video-item" data-video-id="<?php echo $i; ?>">
                            <div class="bg-video-attraction-wrapper">
                                <div class="bg-block"></div>
                                <div id="bgndVideo-<?php echo $i; ?>" class="bg-video-attraction"></div>
                            </div>
                            <div class="attraction-title-mobile">
                               <span class="title fs-14"><?php the_title(); ?></span>
                               <span class="description fs-12"><?php echo $attraction_description; ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($attraction_type == 'img') : ?>
                        <div id="attraction-item-<?php echo $i; ?>" class="attraction-item" style="background-image: url('<?php echo $attraction_img_src; ?>');">
                            <div class="attraction-title-mobile">
                               <span class="title fs-14"><?php the_title(); ?></span>
                               <span class="description fs-12"><?php echo $attraction_description; ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $i++; ?>
                <?php endwhile; ?>
            </div>
            <script>
                var attractionsVideo = '<?php echo json_encode($videoUrls, JSON_FORCE_OBJECT); ?>';
            </script>
            <div class="attractions-list-dots">
                <?php while ( $attractions->have_posts() ) : $attractions->the_post(); ?>
                    <?php
                    $attraction_fields = get_fields();

                    $attraction_description = isset($attraction_fields['description']) ? $attraction_fields['description'] : '';

                    $attraction_icon_id = isset($attraction_fields['icon']) ? $attraction_fields['icon'] : '';
                    $attraction_icon_attributes = wp_get_attachment_image_src($attraction_icon_id, 'full');
                    $attraction_icon_src = !empty($attraction_icon_attributes) ? $attraction_icon_attributes[0] : '';
                    ?>
                    <div class="attraction-dot" data-attraction-button-id="<?php echo get_the_ID();?>">
                        <img class="icon" src="<?php echo $attraction_icon_src; ?>">
                        <div class="box">
                            <div class="text-line">
                                <span class="title fs-16"><?php the_title(); ?></span>
                                <span class="small fs-10">Нажми на меня ;)</span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>
