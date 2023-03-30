<?php
/**
 * The template for displaying the footer
 *
 * @package Futuramia
 * @since 1.0.0
 */
?>
<?php global $globalOptions; ?>
<img data-scroll id="scroll-top" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/rocket-scroll-top.png">

</main><!-- .site-main -->
<footer class="site-footer">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <?php $footerMenu = customGetMenuArray('footer'); ?>
                    <?php if (!empty($footerMenu)) : ?>
                        <nav class="footer-nav">
                            <ul class="list">
                                <?php foreach ($footerMenu as $item) : ?>
                                    <li class="item">
                                        <span class="title fs-14"><?php echo $item['title']; ?></span>
                                        <?php if ($item['children']) : ?>
                                            <ul class="sub-list">
                                                <?php foreach ($item['children'] as $children) : ?>
                                                    <li class="sub-item fs-16">
                                                        <a href="<?php echo $children['href']; ?>"><?php echo $children['title']; ?></a>
                                                    </li>
                                                    <span class="separator">|</span>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <img class="element-decor"
                         src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/decors/footer.png"
                         alt="Футурамия"/>
                </div>
            </div>
        </div>
    </div>
    <!-- .top -->

    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                        <span class="copyright-futuramia fs-16">
                            © 2018-<?php echo date('Y'); ?>, <a href="<?php echo get_home_url(); ?>" target="_blank">ФУТУРАМИЯ</a> - Парк интерактивных развлечений в Екатеринбурге!
                        </span>
                </div>
                <div class="col-lg-5">
                        <span class="copyright-metrix fs-16">
                            Разработка и поддержка сайта: <a href="https://metrixonline.ru"
                                                             target="_blank">MetrixOnline</a>.
                        </span>
                </div>
            </div>
        </div>
    </div>
    <!-- .bottom -->
</footer><!-- .site-footer -->

<!-- Кнопка обратного звонка 2/3-->
<?php $feedback = [$globalOptions['contact_phone'], $globalOptions['contact_whatsapp'], $globalOptions['contact_vk'], $globalOptions['acf_mail'], get_template_directory_uri() . '/assets/css/call.css' ]; ?>
<script>
    const feedback = JSON.parse('<?= json_encode($feedback) ?>');
</script>
<script src="<?= get_template_directory_uri() . '/assets/js/widget-icons.js' ?>"></script>

<?php wp_footer(); ?>
<?php
$scripts = !empty($globalOptions['scripts_footer']) ? $globalOptions['scripts_footer'] : [];
foreach ($scripts as $script) :
    echo $script['script'];
endforeach;
?>
</body>
</html>