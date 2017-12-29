<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/26/17
 * Time: 19:05
 */

use base\components\Application;
use base\components\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/configs/bootstrap.php';

$urlRules = require_once __DIR__ . '/configs/routes.php';
$router = new Router($urlRules);

$application = new Application($router, '\\auth\\controllers');
$application->run();
