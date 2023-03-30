<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = isset($globalOptions['general_home_id']) ? $globalOptions['general_home_id'] : '';
    $homeFields = get_fields($general_home_id);
    /**
     * About
     */
    $about_title = isset($homeFields['about_title']) ? $homeFields['about_title'] : '';
    $about_description = isset($homeFields['about_description']) ? $homeFields['about_description'] : '';
?>
<section class="about">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="section-title fs-42"><?php echo $about_title; ?></h1>
                <div class="section-description fs-24"><?php echo $about_description; ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="about-content">
                    <?php echo $about_content; ?>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-gallery">
                    <?php echo $about_gallery; ?>
                </div>
            </div>
        </div>
    </div>
</section>