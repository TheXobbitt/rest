<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 16:45
 */

namespace rest\components;

use rest\collections\UrlRuleCollection;
use rest\dto\UrlRule;
use rest\helpers\ArrayHelper;

class Router
{
    /**
     * @var UrlRuleCollection
     */
    private $rules;

    public function __construct(UrlRuleCollection $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function parseRequest(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        /** @var UrlRule $rule */
        foreach ($this->rules as $rule) {
            if (preg_match('~^' . $rule->getPattern() . '$~', $pathInfo, $matches) && $rule->getMethod() === $request->getMethod()) {
                return [
                    $rule->getController(),
                    $rule->getAction(),
                    ArrayHelper::getAssocArray($matches)
                ];
            }
        }

        throw new \Exception('Page not found.');
    }
}
