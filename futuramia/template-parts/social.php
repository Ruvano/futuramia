<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = $globalOptions['general_home_id'] ?? '';
    $homeFields = get_fields($general_home_id);
?>
<?php
    /** Social */
    $social_title = $homeFields['social_title'] ?? '';
    $social_instargam = !empty($homeFields['social_instagram']) ? $homeFields['social_instagram'] : [];
    $social_vk = !empty($homeFields['social_vk']) ? $homeFields['social_vk'] : [];
?>
<?php if(isset($social_title) && !empty($social_instargam) && !empty($social_vk)) : ?>
    <?php
    $social_instargam_title = $social_instargam['sub_title'] ?? '';
    $social_instargam_link = $social_instargam['link'] ?? '';
    $social_instargam_id = $social_instargam['instagram_id'] ?? '';

    $social_vk_title = $social_vk['sub_title'] ?? '';
    $social_vk_link = $social_vk['link'] ?? '';
    $social_vk_id = $social_vk['vk_id'] ?? '';
    ?>
    <section id="social" class="social">
        <div id="bg-canvas-stars-social"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title fs-42"><?php echo $social_title; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-6 col-md-12">
                    <div class="social-wrapper">
                        <div class="label fs-14">
                            <span><?php echo $social_instargam_title; ?></span>
                            <a href="<?php echo $social_instargam_link; ?>" target="_blank">ПРИСОЕДИНИТЬСЯ</a>
                        </div>
                        <div class="social-box social-box--instagram">
                            <?php
                            //echo do_shortcode('[instagram-feed showbutton=true]');
                            //echo do_shortcode('[instagram-feed feed = 1]');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="social-wrapper">
                        <div class="label fs-14">
                            <span><?php echo $social_vk_title; ?></span>
                            <a href="<?php echo $social_vk_link; ?>" target="_blank">ПРИСОЕДИНИТЬСЯ</a>
                        </div>
                        <div class="social-box social-box--vk">
                            <!-- ajax vk-widget.php -->
                        </div>
                    </div>
                    <!-- .social-wrapper -->
                </div>
            </div>
        </div>
    </section>
<?php endif;