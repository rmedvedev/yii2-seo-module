<?php

namespace ruslan89\seo\tests\unit;

use ruslan89\seo\classes\ParamsResolver;
use ruslan89\seo\tests\classes\Example;

class ParamsResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testResolveParams()
    {
        $paramsResolver = new ParamsResolver(include(__DIR__ . '/../routeParamsTest.php'));

        $paramsResolver->resolve([
            'example' => 1,
        ]);

        $this->assertNotEmpty($paramsResolver->getResolvedParams());
        $this->assertInstanceOf(Example::class, $paramsResolver->getResolvedParams()['example']);
        $this->assertEquals('example1', $paramsResolver->getResolvedParams()['example']->name);
    }

    /**
     * @expectedException ruslan89\seo\classes\exceptions\NotFoundModelException
     */
    public function testErrorResolveParams()
    {
        $paramsResolver = new ParamsResolver(include(__DIR__ . '/../routeParamsTest.php'));

        $paramsResolver->resolve([
            'example' => 2,
        ]);
    }
}
