<?php

namespace rusmd89\seo\classes;

/**
 * Class RegExpFacade
 * @package rusmd89\seo\classes
 */
class RegExpDecorator
{
    /**
     * @param $pattern string
     * @param $subject string
     * @param array $matches
     * @return int
     */
    public static function match($pattern, $subject, &$matches = [])
    {
        return @preg_match('@' . $pattern . '@', $subject, $matches);
    }
}
