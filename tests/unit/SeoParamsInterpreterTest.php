<?php

namespace rusmd89\seo\tests\unit;

use rusmd89\seo\classes\RouteResolver;
use rusmd89\seo\classes\SeoParamsInterpreter;
use rusmd89\seo\models\SeoPage;
use rusmd89\seo\tests\classes\Example;

class SeoParamsInterpreterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getRenderData
     */
    public function testRenderText($route)
    {
        $routeResolver = $this->getMock(RouteResolver::class, ['getSeoPages']);
        $seoModels = $this->getSeoModels();
        $routeResolver->expects($this->any())->method('getSeoPages')->will($this->returnValue($seoModels));

        $routeResolver->resolve($route);

        $seoDataObject = $routeResolver->getSeoDataObject();

        $seoParamsInterpreter = new SeoParamsInterpreter($seoDataObject, ['example' => new Example()]);
        $seoParamsInterpreter->run();
    }

    public function getRenderData()
    {
        return [
            ['examples/1'],
        ];
    }

    private function getSeoModels()
    {
        //mock method hasAttribute
        $seoPageModel = $this->getMock(SeoPage::class,
            ['hasAttribute']);
        $seoPageModel->expects($this->any())->method('hasAttribute')->will($this->returnValue(true));
        $seoPage1 = clone $seoPageModel;
        $seoPage1->route = 'examples/(?P<example>\d+)';
        $seoPage1->name = 'example_entity_page';
        $seoPage1->title = '{{example.name}}';
        $seoPage1->description = 'Qwerty {{example.name}} aqweqwqw';
        $seoPage1->keywords = '{{example.name}}';
        $seoPage1->tags = [];

        $seoPage2 = clone $seoPageModel;
        $seoPage2->route = 'examples';
        $seoPage2->name = 'example_entity_list_page';
        $seoPage2->tags = [];

        return [$seoPage1, $seoPage2];
    }
}
