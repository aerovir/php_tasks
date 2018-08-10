<?php
// Выводит сумму четных чисел членов последовательности Фибоначчи до 10000

function fibonacci($n,$first = 0,$second = 1)
{
    $fib = [$first,$second];
    for($i=1;$i<$n;$i++)
    {
        $fib[] = $fib[$i]+$fib[$i-1];
        if(end($fib) >= 10000){break;}
    }
    array_pop($fib);
    foreach ($fib as $value){
        if ($value % 2 == 0){
            $result[] = $value;
        }
    }
    return array_sum($result);
}
print_r(fibonacci(50));
?>
