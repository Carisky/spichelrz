<?php
// Version
define('VERSION', '3.0.4.0');

// Устанавливаем корректный путь до корня проекта
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

if (is_file(ROOT_PATH . 'admin/config.php')) {
	require_once(ROOT_PATH . 'admin/config.php');
} else {
	die('config.php не найден. Проверь ROOT_PATH.');
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('admin');
