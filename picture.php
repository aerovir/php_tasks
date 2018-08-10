<?php
// Вычисляет общую сумму пикселей в картинке(jpg, но можно модернезировать и для png, bmp, etc) и количество самых тёмных пикселей.
$im = imagecreatefromjpeg("img.jpg");

$width = imagesx ($im);
$height = imagesy ($im);

$maxPixelImg = $width * $height;
$black_pixels_count = 0;

for ($i = 0; $i < $width; $i++) {
    for ($j = 0; $j < $height; $j++) {
        $rgb = ImageColorAt($im, $i, $j);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        if ($r == 0 && $g == 0 && $b == 0) {
            $black_pixels_count++;
        }
    }
}
imagedestroy($im);

echo 'all pixels = '.$maxPixelImg.'<br />';
echo 'black pixels = '.$black_pixels_count;
