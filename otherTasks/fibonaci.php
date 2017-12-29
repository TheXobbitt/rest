<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 11:15
 */

$f = [];
$f[0] = $f[1] = '1';

for ($i = 2; $i <= 16; $i++) {
    $f[$i] = $f[$i-1] + $f[$i-2];
}

for ($i = 0; $i <= 16; $i++) {
    print_r($i . "\t" . $f[$i] . PHP_EOL);
}
