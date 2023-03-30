<?php global $globalOptions; ?>
<?php
    $general_logo_id = isset($globalOptions['general_logo']) ? $globalOptions['general_logo'] : '';
    $general_logo_attributes = wp_get_attachment_image_src($general_logo_id, $size = 'logo');

    $parks = get_posts([
        'post_type' => 'park',
        'numberposts' => -1,
        'order' => 'ASC'
    ]);
?>
<section id="contact" class="contact">
    <div id="map" class="map"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8">
                <div class="contact-box">
                    <div class="logo">
                        <a data-scroll href="<?php echo site_url(); ?>#">
                            <img class="img" src="<?php echo $general_logo_attributes[0]; ?>" alt="logo" />
                        </a>
                    </div>
                    <?php if (!empty($parks)) : ?>
                        <div class="park-anchors">
                            <?php foreach($parks as $key => $park) : ?>
                                <?php $class_active = $key == 0 ? 'active' : ''; ?>
                                <h3 class="anchor-name fs-24 <?php echo $class_active; ?>" data-park-id="<?php echo $park->ID; ?>"><?php echo $park->post_title; ?></h3>
                            <?php endforeach; ?>
                        </div>
                        <div class="park-boxes">
                            <?php $park_ballons = []; ?>
                            <?php foreach($parks as $key => $park) : ?>
                                <?php
                                    $park_fields = get_fields($park->ID);
                                    $contact_phone = $park_fields['phone'] ?? '';
                                    $contact_address = $park_fields['address'] ?? '';
                                    $contact_operation_time = $park_fields['operation_time'] ?? '';
                                    $contact_link_to_map = $park_fields['link_to_map'] ?? '';
                                    $contact_operation_time_note = $park_fields['operation_time_note'] ?? '';
                                    $contact_map = !empty($park_fields['map']) ? $park_fields['map'] : [];
                                    $contact_map_lat = $contact_map['lat'] ?? '';
                                    $contact_map_lng = $contact_map['lng'] ?? '';
                                    $contact_map_center_lat = $contact_map['center_lat'] ?? '';
                                    $contact_map_center_lng = $contact_map['center_lng'] ?? '';
                                    $class_active = $key == 0 ? 'active' : '';
                                    $park_ballons[] = [
                                        'title' => $park->post_title,
                                        'center' => [$contact_map_center_lat, $contact_map_center_lng],
                                        'position' => [$contact_map_lat, $contact_map_lng],
                                        'ballon' => 'https://futuramia.loc/assets/themes/futuramia/assets/img/map-ballon-new.png'
                                    ];
                                ?>
                                <div id="contact-park-<?php echo $park->ID; ?>" class="contact-park items fs-18 <?php echo $class_active; ?>" data-pos-lat="<?php echo $contact_map_center_lat; ?>" data-pos-lng="<?php echo $contact_map_center_lng; ?>">
                                    <div class="item item-address">
                                        <span class="bold">Адрес: </span>
                                        <span><?php echo $contact_address; ?> (<a href="<?php echo $contact_link_to_map; ?>" target="_blank">открыть на карте</a>)</span>
                                    </div>
                                    <div class="item item-time">
                                        <span class="bold">Режим работы: </span>
                                        <span><?php echo $contact_operation_time; ?></span>
                                        <span class="italic fs-16"><?php echo $contact_operation_time_note; ?></span>
                                    </div>
                                    <div class="item item-phone">
                                        <span class="bold">Телефон: </span>
                                        <span><a href="tel:<?php echo $contact_phone; ?>"><?php echo $contact_phone; ?></a></span>
                                    </div>
                                    <div class="item item-price">
                                        <span class="bold">Стоимость: </span>
                                        <span class="popup-link">
                                            <a href="javascript:void(0);" class="open-price-list" data-micromodal-trigger="price-list-<?php echo $park->ID; ?>">Тарифы на посещение Футурамии</a>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <script>
                            var parkBallons = '<?php echo json_encode($park_ballons); ?>';
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section><!-- .contact -->
