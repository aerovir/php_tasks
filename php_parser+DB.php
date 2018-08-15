<?php
include 'simple_html_dom.php';

$link = 'http://lubematch.shell.com/ru/ru/equipment/100_2_8i_avant_001755';

$data = file_get_html($link);

$result = array();

foreach($data->find('td.application') as $a){

    $result['application'][] =  $a->plaintext;

}

foreach($data->find('td.recommendation') as $a){

    $result['recommendation'][] =  $a->plaintext;
}

foreach($data->find('td.capacity') as $a){

    $result['capacity'][] =  $a->plaintext;
}



echo "<pre>";
print_r($result);
echo "</pre>";