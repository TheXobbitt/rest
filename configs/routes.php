<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 23:19
 */

use rest\collections\UrlRuleCollection;
use rest\dto\UrlRule;

return new UrlRuleCollection([
    new UrlRule(
        '/articles',
        'article',
        'index',
        'GET'
    ),
    new UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'view',
        'GET'
    ),
    new UrlRule(
        '/articles',
        'article',
        'create',
        'POST'
    ),
    new UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'update',
        'PATCH'
    ),
    new UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'update',
        'PUT'
    ),
    new UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'delete',
        'DELETE'
    ),
    new UrlRule(
        '/articles/(?P<id>\d+)',
        'article',
        'options',
        'OPTIONS'
    ),
    new UrlRule(
        '/articles',
        'article',
        'options',
        'OPTIONS'
    ),
]);
