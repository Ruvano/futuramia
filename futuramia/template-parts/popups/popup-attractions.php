<?php
$attraction_args = [
    'post_type' => 'attraction',
    'posts_per_page' => -1
];
$attractions = new WP_Query($attraction_args);
?>
<?php if ( $attractions->have_posts() ) : ?>
    
        <?php while ( $attractions->have_posts() ) : $attractions->the_post(); ?>
            <?php
                $attraction_fields = get_fields();
                $attraction_description = isset($attraction_fields['description']) ? $attraction_fields['description'] : '';
            ?>
            <div class="attraction-popup" id="attraction-popup-id-<?php echo get_the_ID();?>">
                <div class="box">
                    <div class="title fs-24">
                        <?php the_title(); ?>
                    </div>
                    <div class="description fs-16">
                        <?php echo  $attraction_description; ?>
                    </div>
                    <div class="close">+</div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

<?php endif; ?>