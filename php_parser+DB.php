<?php
include 'libs/simple_html_dom.php';

$html = file_get_contents('https://www.ozon.ru/catalog/1137439/?store=1,0');

echo $html;