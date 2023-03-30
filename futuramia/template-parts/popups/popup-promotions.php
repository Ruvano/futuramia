<?php 
    global $promotion_popups;
    if (!empty($promotion_popups)) {
        $promotions = !empty($promotion_popups) ? $promotion_popups : [];
    } else {
        return;
    }
?>
<?php foreach($promotions as $key => $item):?>
    <?php 
        $promotion_title = isset($item['title']) ? $item['title'] : '' ;
        $promotion_content = isset($item['content']) ? $item['content'] : '' ;
    ?>
                            
<div class="modal micromodal-slide" id="popup-promotion-<?php echo $key?>" aria-hidden="false">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <div class="title modal__title">
                    <span class="fs-24"><?php echo $promotion_title; ?></span>
                </div>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <div class="description fs-16">
                    <div class="program-form">
                        <?php echo $promotion_content; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<?php endforeach;?>