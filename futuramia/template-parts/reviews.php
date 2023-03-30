<?php
global $globalOptions;
/** Fields from Home Page */
$general_home_id = $globalOptions['general_home_id'] ?? '';
$homeFields = get_fields($general_home_id);
?>
<?php
/** Reviews */
$reviews_title = $homeFields['reviews_title'] ?? '';
?>
<?php if (isset($reviews_title)) : ?>
    <section id="reviews" class="reviews">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title fs-42"><?php echo $reviews_title; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="no_mobile">
                        <a class="flamp-widget"
                           href="https://ekaterinburg.flamp.ru/firm/futuramiya_park_interaktivnykh_priklyuchenijj_ooo_zelenaya_galereya-70000001040224320"
                           data-flamp-widget-type="responsive-new" data-flamp-widget-id="70000001040224320"
                           data-flamp-widget-width="100%" data-flamp-widget-count="3">Отзывы о нас на Флампе</a>
                        <script>
                            function myWidgetFlamp() {
                                document.addEventListener('DOMContentLoaded', () => {
                                    !function (d, s) {
                                        let js, fjs = d.getElementsByTagName(s)[0];
                                        js = d.createElement(s);
                                        js.async = 1;
                                        js.src = '//widget.flamp.ru/loader.js';
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script');
                                });
                            }
                            myWidgetFlamp();
                        </script>
                    </div>
                    <div class="mobile_only">
                        <a class="flamp-widget"
                           href="https://ekaterinburg.flamp.ru/firm/futuramiya_park_interaktivnykh_priklyuchenijj_ooo_zelenaya_galereya-70000001040224320"
                           data-flamp-widget-type="responsive-new" data-flamp-widget-id="70000001040224320"
                           data-flamp-widget-width="100%" data-flamp-widget-count="1">Отзывы о нас на Флампе</a>
                        <script> myWidgetFlamp(); </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
