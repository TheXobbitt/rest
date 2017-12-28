<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 16:45
 */

namespace base\components;

use base\collections\UrlRuleCollection;
use base\dto\UrlRule;
use base\exceptions\HttpNotFoundException;
use base\helpers\ArrayHelper;

class Router
{
    /**
     * @var UrlRuleCollection
     */
    private $rules;

    /**
     * Router constructor.
     * @param UrlRuleCollection $rules
     */
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

        throw new HttpNotFoundException();
    }
}
