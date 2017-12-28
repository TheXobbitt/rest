<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/26/17
 * Time: 19:05
 */

use rest\components\Router;

require_once __DIR__ . '/vendor/autoload.php';

$router = new Router(new \rest\collections\UrlRuleCollection([
    new \rest\dto\UrlRule(
        '/article',
        'article',
        'index',
        'GET'
    ),
    new \rest\dto\UrlRule(
        '/article/(?P<id>\d+)',
        'article',
        'view',
        'GET'
    ),
    new \rest\dto\UrlRule(
        '/article',
        'article',
        'create',
        'POST'
    ),
    new \rest\dto\UrlRule(
        '/article/(?P<id>\d+)',
        'article',
        'update',
        'PATCH'
    ),
    new \rest\dto\UrlRule(
        '/article/(?P<id>\d+)',
        'article',
        'delete',
        'DELETE'
    ),
]));

$container = \rest\components\Container::getInstance();
$container->setShared('request', '\rest\components\Request');

$application = new \rest\components\Application($router);
$application->run();
