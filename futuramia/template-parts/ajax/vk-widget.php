<?php
    global $globalOptions;
    /** Fields from Home Page */
    $general_home_id = $globalOptions['general_home_id'] ?? '';
    $homeFields = get_fields($general_home_id);
    $social_vk = !empty($homeFields['social_vk']) ? $homeFields['social_vk'] : [];
    $social_vk_id = $social_vk['vk_id'] ?? '';
?>

<!-- VK Widget -->
<script type='text/javascript' src='https://vk.com/js/api/openapi.js?168' onload='vk_widget_init();'></script>
<div id='vk_groups'></div>
<script type="text/javascript">
    function vk_widget_init(){
        var vkWidget = document.getElementById("vk_groups"),
            socialBoxElement = document.getElementsByClassName("social-box--vk")[0],
            getHeight = socialBoxElement.clientHeight - 18,
            getWidth = socialBoxElement.clientWidth - 0;

        while (vkWidget.firstChild) {
            vkWidget.removeChild(vkWidget.firstChild);
        }
        VK.Widgets.Group('vk_groups', {
            mode: 1,
            width: getWidth,
            height: getHeight,
            no_cover: 1,
            color1: 'FFFFFF',
            color2: '000000',
            color3: '5181B8'
        }, <?php echo $social_vk_id; ?>);
    }
    window.addEventListener('load', vk_widget_init, false);
    window.addEventListener('resize', vk_widget_init, false);
</script>
<!-- /VK Widget -->