<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/26/17
 * Time: 19:05
 */

use rest\components\Container;
use rest\components\Router;

require_once(__DIR__ . '/vendor/autoload.php');

$urlRules = require_once(__DIR__ . '/configs/routes.php');

$router = new Router($urlRules);

$container = Container::getInstance();
$container->setShared('request', '\rest\components\Request');

$application = new \rest\components\Application($router);
$application->run();
