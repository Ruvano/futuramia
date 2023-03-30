<!-- Всплывающее окно на страницах программ. Пока отключил -->
<?php
return;

$program_args = [
    'post_type' => 'program',
    'posts_per_page' => -1
];
$programs = new WP_Query( $program_args );
?>
<?php if ( $programs->have_posts() ) : ?>
    <?php while ( $programs->have_posts() ) : $programs->the_post(); ?>
        <?php
        $program_fields = get_fields();
        // $program_promo_title = isset($fields['program_promo_title']) ? $fields['program_promo_title'] : false;
        ?>
        <div class="modal micromodal-slide get-program" id="get-program-<?php echo get_the_ID(); ?>" data-program-name="<?php echo get_the_title(); ?>" aria-hidden="false">
            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                    <header class="modal__header">
                        <div class="title modal__title">
                            <span class="program-sup-title fs-18">Заказать программу: </span>
                            <span class="program-title fs-24"><?php echo get_the_title(); ?></span>
                        </div>
                        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                    </header>
                    <main class="modal__content" id="modal-1-content">
                        <div class="description fs-16">
                            <div class="program-form">
                                <style>#wpcf7-f1176-o16 label{color:unset!important}</style>
                                <?php //echo do_shortcode('[contact-form-7 id="1176" title="Контактная форма 1"]') ?>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>