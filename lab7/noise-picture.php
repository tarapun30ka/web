<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$backgroundPath = 'noise.jpg';

if (!file_exists($backgroundPath)) {
    die('Файл noise.jpg не найден!');
}

$im = imagecreatefromjpeg($backgroundPath);
if (!$im) {
    die('Не удалось загрузить изображение noise.jpg');
}

$imageWidth = imagesx($im);
$imageHeight = imagesy($im);

$characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
$string = '';
$length = rand(5, 6);
// $length = 5;
for ($i = 0; $i < $length; $i++) {
    $string .= $characters[rand(0, strlen($characters) - 1)];
}

$_SESSION['captcha_string'] = $string;
$_SESSION['images_enabled'] = true;

$fontDir = 'fonts/';
if (!is_dir($fontDir)) {
    die('Папка fonts не найдена!');
}
$fonts = array_filter(glob($fontDir . '*.{ttf,otf}', GLOB_BRACE), 'is_file');
if (empty($fonts)) {
    die('Шрифты не найдены в папке fonts/');
}

$x = 20;
$y = 30;

$paddingLeft = 15;
$paddingRight = 15;
$availableWidth = $imageWidth - $paddingLeft - $paddingRight;
$charWidth = $availableWidth / strlen($string); // равномерный шаг

for ($i = 0; $i < strlen($string); $i++) {
    $char = $string[$i];
    $font = $fonts[array_rand($fonts)];
    $fontSize = rand(18, 30);
    $angle = rand(-20, 20);
    $color = imagecolorallocate($im, rand(0, 100), rand(0, 100), rand(0, 100));

    $x = $paddingLeft + $i * $charWidth + $charWidth / 2;
    $y = rand(30, $imageHeight - 10); 

    imagettftext($im, $fontSize, $angle, $x, $y, $color, $font, $char);
}

// for ($i = 0; $i < strlen($string); $i++) {
//     $char = $string[$i];
//     $font = $fonts[array_rand($fonts)];
//     $fontSize = rand(18, 30);
//     $angle = rand(-20, 20);
//     $color = imagecolorallocate($im, rand(0, 100), rand(0, 100), rand(0, 100));
//     imagettftext($im, $fontSize, $angle, $x, $y, $color, $font, $char);
//     $x += 40;
// }

header('Content-Type: image/jpeg');
imagejpeg($im, null, 50);

imagedestroy($im);

?>