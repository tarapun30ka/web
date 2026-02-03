<?php
spl_autoload_register();

use Singleton\Settings;

// Settings::get()->items_per_page = 20;
// echo Settings::get()->items_per_page; // 20

$settings = Settings::get();
$settings->app_name = 'strApp';
$settings->version = 1.5;
$settings->debug_mode = false;
// Settings::get()->app_name = 'strApp';
// Settings::get()->version = 1.5;
// Settings::get()->debug_mode = false;

// echo "Строковое значение: название приложения = " . Settings::get()->app_name . '<br>';
// echo "Числовое значение: версия приложения = " . Settings::get()->version . '<br>';
// echo "Логическое значение: режим = " . Settings::get()->debug_mode . '<br>';
echo "Строковое значение: название приложения = " . $settings->app_name . '<br>';
echo "Числовое значение: версия приложения = " . $settings->version . '<br>';
echo "Логическое значение: режим = " . ($settings->debug_mode ? 'true' : 'false') . '<br>';

// echo "<br>Проверка<br>";

// $settings1 = Settings::get();
// $settings2 = Settings::get();

// echo '$settings1 === $settings2 ? ' .
//      ($settings1 === $settings2 ? 'Да' : 'Нет');