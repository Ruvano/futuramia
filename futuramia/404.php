<?php
/**
 * @package Futuramia
 * @since 1.0.0
 */
get_header();
?>

<section class="page-404">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title fs-42">Ошибка 404<br>Страница не найдена!</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-description">
                    К сожалению такой страницы не существует, попробуйте поискать на <a href="<?php echo site_url(); ?>">главной</a>!
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();