<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = $fields['general_home_id'] ?? '';
    $homeFields = get_fields($general_home_id);
?>
<?php
    /** Section Promo */
    $promo_title = $homeFields['promo_title'] ?? '';
    $promo_title_strings = !empty($homeFields['promo_title_strings']) ? $homeFields['promo_title_strings'] : [];
    $promo_video = get_field('promo_video', false, false);

    /** Section Slider */
    $promo_slider = !empty($homeFields['promo_slider']) ? $homeFields['promo_slider'] : [];
?>
<section class="promo">
    <div class="bg-video">
        <div class="banner-overlay"></div>
        <?php if ($promo_video) : ?>
            <div id="front-promo-video" class="vimeo-wrapper"></div>
            <script>
                const promoVideoUrl = "<?= $promo_video; ?>";
            </script>
        <?php endif; ?>
    </div>
    <div class="slider-mobile-promo owl-carousel owl-theme">
        <?php foreach($promo_slider as $slide) : ?>
            <?php 
                $image_id = $slide['image'] ?? false;
                $image_src = wp_get_attachment_image_url( $image_id, 'full-width-mobile' );
            ?>
            <div class="promo-item" style="background-image: url('<?php echo $image_src; ?>');"></div>
        <?php endforeach; ?>    
    </div>
    <div class="block-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-title fs-42"><?php echo $promo_title; ?></div>
                    <div id="typed-title-strings">
                        <?php foreach($promo_title_strings as $item) : ?>
                            <?php $string = $item['string'] ?? ''; ?>
                            <p><?php echo $string; ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>