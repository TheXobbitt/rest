<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 11:23
 */

function fibonaci($n)
{
    if ($n < 2) {
        return 1;
    } else {
        return fibonaci($n-1) + fibonaci($n-2);
    }
}

for ($i = 0; $i <= 16; $i++) {
    echo($i . "\t" . fibonaci($i) . PHP_EOL);
}
