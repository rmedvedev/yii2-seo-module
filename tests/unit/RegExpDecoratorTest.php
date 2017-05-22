<?php

namespace rusmd89\seo\tests\unit;

use rusmd89\seo\classes\RegExpDecorator;

class RegExpDecoratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getMatchRoutes
     * @param $route
     */
    public function testMatchRoute($route)
    {
        $this->assertTrue((bool)RegExpDecorator::match('example/(?P<id>\d+)', $route));
    }

    /**
     * @dataProvider getMismatchRoute
     * @param $route
     */
    public function testMismatchRoute($route)
    {
        $this->assertFalse((bool)RegExpDecorator::match('example/(?P<id>\d+)', $route));
    }

    public function getMismatchRoute()
    {
        return [
            ['/examples/'],
            ['/example/qwerty'],
        ];
    }

    public function getMatchRoutes()
    {
        return [
            ['example/123'],
            ['example/11?page=1'],
            ['example/11/childs']
        ];
    }


}
