<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 23:19
 */

use base\collections\UrlRuleCollection;
use base\dto\UrlRule;

return new UrlRuleCollection([
    new UrlRule(
        '/token',
        'token',
        'generate',
        'POST'
    ),
]);
