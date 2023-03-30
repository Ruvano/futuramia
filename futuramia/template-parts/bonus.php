<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = $globalOptions['general_home_id'] ?? '';
    $homeFields = get_fields($general_home_id);
?>
<?php
    /** Bonus */
    $bonus_title = $homeFields['bonus_title'] ?? '';
?>
<?php if(isset($bonus_title)) : ?>
    <section class="bonus">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title fs-42"><?php echo $bonus_title; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php //echo do_shortcode('[contact-form-7 id="104" title="Bonus form" html_class="bonus-form"]'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>