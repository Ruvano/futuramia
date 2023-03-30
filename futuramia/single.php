<?php
global $class_header;
$class_header = 'site-header--default';

get_header();
?>

<section class="text">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="row">
                    <div class="offset-xl-2 col-xl-8">
                        <?php the_title('<h1 class="section-title">', '</h1>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-xl-2 col-xl-8">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div><!-- .container -->
</section><!-- section.text -->

<?php get_footer();