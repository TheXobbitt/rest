<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 11:33
 */

class A {
    public $b;
}

function test($obj) {
    $obj->b = 6;
}

function test1($obj) {
    $obj = 10;
}

$obj = new A;
$obj->b = 1;

test($obj);
echo $obj->b . PHP_EOL; //6

test1($obj);
echo $obj->b . PHP_EOL; //6
