<?php
    global $globalOptions;
    /** Fields from Home Page */
    $price_title = isset($globalOptions['price_title']) ? $globalOptions['price_title'] : false;
    $price_description = isset($globalOptions['price_description']) ? $globalOptions['price_description'] : false;
    $price_children_ticket = !empty($globalOptions['price_children_ticket']) ? $globalOptions['price_children_ticket'] : [];
    $price_adult_ticket = !empty($globalOptions['price_adult_ticket']) ? $globalOptions['price_adult_ticket'] : [];
    $price_park_rental = !empty($globalOptions['price_park_rental']) ? $globalOptions['price_park_rental'] : [];
    $parks = get_posts([
        'post_type' => 'park',
        'numberposts' => -1,
        'order' => 'ASC'
    ]);
?>
<?php if (!empty($parks)) : ?>
    <?php foreach($parks as $key => $park) : ?>
        <div class="modal micromodal-slide price-list" id="price-list-<?php echo $park->ID; ?>" aria-hidden="false">
            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                    <header class="modal__header">
                        <?php if ( $price_title ) : ?>
                            <div class="title modal__title">
                                <?php echo $price_title; ?>
                            </div>
                        <?php endif; ?>
                        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                    </header>
                    <main class="modal__content" id="modal-1-content">
                        <div class="description fs-16">
                            <div class="program-form">
                                <?php if ( $price_description ) : ?>
                                    <div><?php echo $price_description; ?></div>
                                <?php endif; ?>
                                <?php if ( !empty($price_children_ticket) ) : ?>
                                    <div class="table-title fs-24">Детский билет:</div>
                                    <table class="price-table">
                                        <thead>
                                            <tr class="table100-head">
                                                <th class="column fs-18">Время</th>
                                                <th class="column c fs-18">Цена</th>
                                                <!-- <th class="column c fs-18">Выходные</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($price_children_ticket as $item) : ?>
                                                <?php 
                                                    $time = isset($item['time']) ? $item['time'] : false;
                                                    $price_workday = isset($item['price_workday']) ? $item['price_workday'] : false;
                                                    $price_holiday = isset($item['price_holiday']) ? $item['price_holiday'] : false;
                                                ?>
                                                <tr>
                                                    <td class="column fs-18"><?php echo $time; ?></td>
                                                    <td class="column c fs-18"><?php echo $price_workday; ?> <span style="bold">₽</span></td>
                                                    <!-- <td class="column c fs-18"><?php echo $price_holiday; ?> <span style="bold">₽</span></td> -->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <?php if ( !empty($price_adult_ticket) ) : ?>
                                    <div class="table-title fs-24">Другие билеты:</div>
                                    <table class="price-table">
                                        <thead>
                                            <tr class="table100-head">
                                                <th class="column fs-18">Тип билета</th>
                                                <th class="column c fs-18">Цена</th>
                                                <!-- <th class="column c fs-18">Выходные</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($price_adult_ticket as $item) : ?>
                                                <?php 
                                                    $time = isset($item['time']) ? $item['time'] : false;
                                                    $price_workday = isset($item['price_workday']) ? $item['price_workday'] : false;
                                                    $price_holiday = isset($item['price_holiday']) ? $item['price_holiday'] : false;
                                                ?>
                                                <tr>
                                                    <td class="column fs-18"><?php echo $time; ?></td>
                                                    <td class="column c fs-18"><?php echo $price_workday; ?> <span style="bold">₽</span></td>
                                                    <!-- <td class="column c fs-18"><?php echo $price_holiday; ?> <span style="bold">₽</span></td> -->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <?php if (!empty($price_park_rental)) : ?>
                                    <div class="table-title fs-24">День рождения в парке <?php echo $park->post_title; ?></div>
                                    <table class="price-table">
                                        <thead>
                                            <tr class="table100-head">
                                                <th class="column fs-18">Аренда парка</th>
                                                <th class="column c fs-18">Цена</th>
                                                <!-- <th class="column c fs-18">Выходные</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($price_park_rental as $item) : ?>
                                                <?php 
                                                    $park_relation = isset($item['park_relation']) ? $item['park_relation'] : false;
                                                    if ($park_relation->ID != $park->ID) continue;
                                                    $price_workday = isset($item['price_workday']) ? $item['price_workday'] : false;
                                                    $price_holiday = isset($item['price_holiday']) ? $item['price_holiday'] : false;
                                                ?>
                                                <tr>
                                                    <td class="column fs-18">2 часа</td>
                                                    <td class="column c fs-18"><?php echo $price_workday; ?> <span style="bold">₽</span></td>
                                                    <!-- <td class="column c fs-18"><?php echo $price_holiday; ?> <span style="bold">₽</span></td> -->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>