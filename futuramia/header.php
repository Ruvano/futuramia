<?php
/**
 * The header for our theme
 *
 * @package Futuramia
 * @since 1.0.0
 */
?>
<?php
    global $globalOptions, $class_header;
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel='apple-touch-icon' sizes='120x120' href='/apple-touch-icon.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='/favicon-32x32.png'>
    <link rel='icon' type='image/png' sizes='16x16' href='/favicon-16x16.png'>
    <link rel='manifest' href='/site.webmanifest'>
    <link rel='mask-icon' href='/safari-pinned-tab.svg' color='#5bbad5'>
    <meta name='msapplication-TileColor' content='#da532c'>
    <meta name='theme-color' content='#ffffff'>

    <?php wp_head(); ?>
	<?php $scripts = !empty($globalOptions['scripts_head']) ? $globalOptions['scripts_head'] : [];
        foreach($scripts as $script) :
            echo $script['script'];
        endforeach;
        //die(var_dump($globalOptions));
    ?>
</head>

<body <?php body_class(); ?>>
<?php
    $contact_phone = $globalOptions['contact_phone'] ?? '';
    $general_logo_id = $globalOptions['general_logo'] ?? '';
    $general_logo_attributes = wp_get_attachment_image_src($general_logo_id, $size = 'logo');
?>
    <?php $class_header = $class_header ?? ''; ?>

    <?php if (is_front_page() || is_home()) : ?>
    
        <header class="site-header <?php echo $class_header; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="top-container">
                            <div class="left">
                                <?php if ( $general_logo_attributes ) : ?>
                                    <div class="logo">
                                        <a data-scroll href="<?php echo site_url(); ?>">
                                            <img class="img" src="<?php echo $general_logo_attributes[0]; ?>" alt="logo" />
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="middle">
                                <?php $headerMenu = customGetMenuArray('header'); ?>
                                <?php if( ! empty($headerMenu) ) : ?>
                                    <nav class="header-nav">
                                        <ul class="list">
                                            <?php foreach ($headerMenu as $item) : ?>
                                                <li class="item fs-18">
                                                    <a data-scroll class="link" href="<?php echo $item['href']; ?>"><?php echo $item['title']; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </nav>
                                <?php endif; ?>
                            </div>
                            <div class="right">
                                <a href="tel:<?php echo $contact_phone[1]; ?>" class="phone">
                                    <span class="small fs-12">Телефон для заказа:</span>
                                    <span class="normal fs-20"><?php echo $contact_phone[0]; ?></span>
                                </a>
                                <div class="mobile-hamburger hamburger hamburger--arrow">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div><!-- .mobile-hamburger -->
                            </div>
                        </div><!-- .top-container -->
                    </div>
                </div>
            </div>
        </header><!-- .site-header -->

        <div class="mobile-menu">
            <div class="center">
                <img class="element-decor-logo" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/decors/menu-mobile-logo.png'; ?>" alt="Футурамия" />
            </div>
            <?php $headerMenu = customGetMenuArray('header'); ?>
            <?php if( ! empty($headerMenu) ) : ?>
                <nav class="header-nav">
                    <ul class="list">
                        <?php foreach ($headerMenu as $item) : ?>
                            <li class="item fs-18">
                                <a data-scroll class="link" href="<?php echo $item['href']; ?>"><?php echo $item['title']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <div class="center">
                <img class="element-decor-footer" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/decors/menu-mobile-footer.png'; ?>" alt="Футурамия" />
            </div>
        </div><!-- .mobile-menu -->
        <div class="overlay-mobile-menu"></div>

    <?php else : ?>

        <header class="site-header site-header-page <?php echo $class_header; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="top-container">
                            <div class="left">
                                <a href="/" class="back-to-home fs-20"><span>На главную</span></a>
                            </div>
                            <div class="middle">
                                <?php if ( $general_logo_attributes ) : ?>
                                    <div class="logo">
                                        <a data-scroll href="<?php echo site_url(); ?>">
                                            <img class="img" src="<?php echo $general_logo_attributes[0]; ?>" alt="logo" />
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="right">
                                <a href="tel:<?php echo $contact_phone[1]; ?>" class="phone">
                                    <span class="small fs-12">Телефон для заказа:</span>
                                    <span class="normal fs-20"><?php echo $contact_phone[0]; ?></span>
                                </a>
                                <?php if ( $general_logo_attributes ) : ?>
                                    <div class="logo mobile_only">
                                        <a data-scroll href="<?php echo site_url(); ?>">
                                            <img class="img" src="<?php echo $general_logo_attributes[0]; ?>" alt="logo" />
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div><!-- .top-container -->
                    </div>
                </div>
            </div>
        </header><!-- .site-header -->

    <?php endif; ?>

    <?php echo get_template_part('template-parts/popups/popup-program'); ?>
    <?php echo get_template_part('template-parts/popups/popup-thank-you'); ?>
    <?php echo get_template_part('template-parts/popups/popup-price-list'); ?>

    <?php if (is_front_page() || is_home()) : ?>
        <?php
            /** Fields from Home Page */
            $general_home_id = $globalOptions['general_home_id'] ?? '';
            $homeFields = get_fields($general_home_id);   

            $promotions = !empty($homeFields['promotions']) ? $homeFields['promotions'] : []; 
            global $promotion_popups;
            $promotion_popups = $promotions;
            echo get_template_part('template-parts/popups/popup-promotions'); 
        ?>
    <?php endif; ?>

    <main class="site-main">
