<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/26/17
 * Time: 19:05
 */

use rest\components\Container;
use rest\components\Router;

require_once __DIR__ . '/vendor/autoload.php';

$router = new Router(new \rest\collections\UrlRuleCollection([
    new \rest\dto\UrlRule(
        '/articles',
        'article',
        'index',
        'GET'
    ),
    new \rest\dto\UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'view',
        'GET'
    ),
    new \rest\dto\UrlRule(
        '/articles',
        'article',
        'create',
        'POST'
    ),
    new \rest\dto\UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'update',
        'PATCH'
    ),
    new \rest\dto\UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'update',
        'PUT'
    ),
    new \rest\dto\UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'delete',
        'DELETE'
    ),
    new \rest\dto\UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'options',
        'OPTIONS'
    ),
    new \rest\dto\UrlRule(
        '/articles',
        'article',
        'options',
        'OPTIONS'
    ),
]));

$container = Container::getInstance();
$container->setShared('request', '\rest\components\Request');

$application = new \rest\components\Application($router);
$application->run();
