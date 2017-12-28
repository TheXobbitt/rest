<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/26/17
 * Time: 19:05
 */

use base\components\Application;
use base\components\Container;
use base\components\Router;

require_once(__DIR__ . '/../vendor/autoload.php');

$urlRules = require_once(__DIR__ . '/configs/routes.php');

$router = new Router($urlRules);

$container = Container::getInstance();
$container->setShared('request', '\base\components\Request');

$application = new Application($router);
$application->run();
