<?php

namespace rusmd89\seo\tests\unit;

use rusmd89\seo\classes\RouteResolver;
use rusmd89\seo\models\SeoPage;

class RouteResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException rusmd89\seo\classes\exceptions\SeoPageNotFoundException
     */
    public function testEmptyRoutes()
    {
        $routeResolver = $this->getMock(RouteResolver::class, ['getSeoPages']);
        $routeResolver->expects($this->any())->method('getSeoPages')->will($this->returnValue([]));
        /** @var $routeResolver RouteResolver */
        $routeResolver->resolve('someUrl');
        $this->assertEmpty($routeResolver->getSeoDataObject());
    }

    public function testMismatchRoute()
    {
        $routeResolver = $this->getMock(RouteResolver::class);
        $seoModels = $this->getSeoModels();
        $routeResolver->expects($this->any())->method('getSeoPages')->will($this->returnValue($seoModels));
        /** @var $routeResolver RouteResolver */
        $routeResolver->resolve('someUrl');
        $this->assertEmpty($routeResolver->getSeoDataObject());
        $this->assertEmpty($routeResolver->getRouteMatches());
    }

    public function testMatchRoute()
    {
        $routeResolver = $this->getMock(RouteResolver::class, ['getSeoPages']);
        $seoModels = $this->getSeoModels();
        $routeResolver->expects($this->any())->method('getSeoPages')->will($this->returnValue($seoModels));
        /** @var $routeResolver RouteResolver */
        $routeResolver->resolve('examples');
        $this->assertNotNull($routeResolver->getSeoDataObject());
        $this->assertEquals('example_entity_list_page', $routeResolver->getSeoDataObject()->getTitle());
        $this->assertNotEmpty($routeResolver->getRouteMatches());

        $routeResolver->resolve('examples/1');
        $this->assertNotNull($routeResolver->getSeoDataObject());
        $this->assertEquals('example_entity_page', $routeResolver->getSeoDataObject()->getTitle());
        $this->assertNotEmpty($routeResolver->getRouteMatches());
        $this->assertEquals(1, $routeResolver->getRouteMatches()['example']);
    }

    private function getSeoModels()
    {
        //mock method getAttributes
        $seoPageMock = $this->getMock(SeoPage::class,
            ['hasAttribute']);
        $seoPageMock->expects($this->any())->method('hasAttribute')->will($this->returnValue(true));
        $seoPage1 = clone $seoPageMock;
        $seoPage1->route = 'examples/(?P<example>\d+)';
        $seoPage1->title = 'example_entity_page';
        $seoPage1->tags = [];

        $seoPage2 = clone $seoPageMock;
        $seoPage2->route = 'examples';
        $seoPage2->title = 'example_entity_list_page';
        $seoPage2->tags = [];

        return [$seoPage1, $seoPage2];
    }
}
