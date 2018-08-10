<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'users');

$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) exit('Ошибка подключения к БД');
$mysqli->set_charset('utf-8');

$result_set1 = $mysqli->query('SELECT name, if((DAYOFYEAR(birthday)<=DAYOFYEAR(NOW())), DAYOFYEAR(\'2018-12-31\') - DAYOFYEAR(NOW()) + DAYOFYEAR(birthday), DAYOFYEAR(birthday) - DAYOFYEAR(NOW())) as `days` 
FROM users WHERE if((DAYOFYEAR(birthday)<=DAYOFYEAR(NOW())), DAYOFYEAR(\'2018-12-31\') - DAYOFYEAR(NOW()) + DAYOFYEAR(birthday), DAYOFYEAR(birthday) - DAYOFYEAR(NOW())) 
BETWEEN 0 AND 30 ORDER BY `days` DESC  ');

$result_set2 = $mysqli->query('SELECT name, birthday FROM users WHERE ( date_format(NOW()+interval 30 day,\'%m-%d\')>date_format(birthday,\'%m-%d\') 
AND date_format(NOW(),\'%m-%d\')<date_format(birthday,\'%m-%d\')) OR (date_format(NOW()+interval 30 day,\'%m\')=\'01\' 
AND date_format(NOW(),\'%m\')=\'12\' AND ( date_format(NOW()+interval 30 day,\'%m-%d\')>date_format(birthday,\'%m-%d\') 
OR ( date_format(NOW(),\'%m-%d\')<date_format(birthday, \'%m-%d\') AND \'12-31\'>=date_format(birthday,\'%m-%d\') ) ) ) 
ORDER BY date_format(birthday, \'%m-%d\') DESC ');

$table1 = [];
$table2 = [];

while (($row1 = $result_set1->fetch_assoc()) != false) {
    $table1[] = $row1;
}

while (($row2 = $result_set2->fetch_assoc()) != false) {
    $table2[] = $row2;
}






$mysqli->close();

echo '<table>';
echo '<tr>';
echo '<td>name</td><td>days</td>';
echo '</tr>';
foreach ($table1 as $first){
    echo '<tr>';
    foreach ($first as $key_first => $value_first)
        echo '<td>'.$value_first.'</td>';
        echo '</tr>';

}
echo '</table><br />';

echo '<table>';
echo '<tr>';
echo '<td>name</td><td>days</td>';
echo '</tr>';
foreach ($table2 as $second){
    echo '<tr>';
    foreach ($second as $key_second => $value_second)
        echo '<td>'.$value_second.'</td>';
    echo '</tr>';

}
echo '</table>';


?>
