<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 00:54
 */

use base\components\Container;
use base\components\Request;
use base\sqlite\Connection;

$container = Container::getInstance();
$container->setShared('request', Request::class);
$container->setShared(Connection::class, function (Container $container) {
    return new Connection('data/auth.db');
});
