<?php
/**
 * Удаляем лишние элементы меню
 */
add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu() {
	/** Отключаем лишние ссылки в админке для всех кроме Administrator */
	$user = wp_get_current_user();
	if (in_array( 'administrator', (array) $user->roles ) ) {
		return true;
	}

	remove_menu_page('edit.php?post_type=acf-field-group'); // Настройки ACF плагина
	remove_menu_page('options-general.php'); // Удаляем раздел Настройки	
  	remove_menu_page('tools.php'); // Инструменты
	// remove_menu_page('users.php'); // Пользователи
	remove_menu_page('plugins.php'); // Плагины
	// remove_menu_page('themes.php'); // Внешний вид	
	remove_menu_page('edit.php'); // Посты блога
	// remove_menu_page('upload.php'); // Медиабиблиотека
	// remove_menu_page('edit.php?post_type=page'); // Страницы
	remove_menu_page('edit-comments.php'); // Комментарии
	remove_menu_page('link-manager.php'); // Ссылки
}