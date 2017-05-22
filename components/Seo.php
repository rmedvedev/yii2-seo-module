<?php

namespace ruslan89\seo\components;

use ruslan89\seo\classes\exceptions\SeoBaseException;
use ruslan89\seo\classes\ParamsResolver;
use ruslan89\seo\classes\RouteResolver;
use ruslan89\seo\classes\SeoParamsInterpreter;
use ruslan89\seo\classes\SeoTagsDataObject;
use yii\base\Application;
use yii\base\Component;
use yii\log\Logger;
use yii\web\View;

/**
 * Class Seo
 * @package ruslan89\seo\components
 */
class Seo extends Component
{
    const CACHE_KEY = 'seo_cache_key';

    /**
     * @var array
     */
    public $params;

    /**
     * @var int
     */
    public $cacheExpire = 3600;

    /** @var SeoTagsDataObject */
    private $seoDataObject;

    public function init()
    {
        parent::init();
        \Yii::$app->on(Application::EVENT_BEFORE_REQUEST, [$this, 'renderMetaTags']);
        \Yii::$app->getView()->on(View::EVENT_BEGIN_PAGE, [$this, 'registerMetaTags']);
    }

    /**
     * Render meta tags
     */
    public function renderMetaTags()
    {
        $this->seoDataObject = $this->getSeoDataObject();
    }

    /**
     * Register meta tag in view
     */
    public function registerMetaTags()
    {
        $this->registerMetaTag('title', $this->seoDataObject->getTitle());
        $this->registerMetaTag('description', $this->seoDataObject->getDescription());
        $this->registerMetaTag('keywords', $this->seoDataObject->getKeywords());

        //add custom tags
        foreach ($this->seoDataObject->getTags() as $tag) {
            $this->registerMetaTag($tag->name, $tag->content);
        }
    }

    /**
     * Get current route
     *
     * @return string
     */
    protected function getCurrentRoute()
    {
        return '/' . \Yii::$app->getRequest()->getPathInfo();
    }

    /**
     * @return SeoTagsDataObject
     */
    protected function getSeoDataObject()
    {
        try {
            $currentRoute = $this->getCurrentRoute();

            $cacheKey = self::CACHE_KEY . $currentRoute;
            if( false == $seoDataObject = $this->getCache()->get($cacheKey)) {
                $routeResolver = new RouteResolver();
                $routeResolver->resolve($currentRoute);
                $seoDataObject = $routeResolver->getSeoDataObject();

                $paramsResolver = new ParamsResolver($this->params);
                $paramsResolver->resolve($routeResolver->getRouteMatches());

                $seoParamsInterpreter = new SeoParamsInterpreter($seoDataObject, $paramsResolver->getResolvedParams());
                $seoParamsInterpreter->run();

                $this->getCache()->set($cacheKey, $seoDataObject, $this->cacheExpire);
            }

            return $seoDataObject;
        } catch (SeoBaseException $e) {
            \Yii::getLogger()->log($e->getMessage(), Logger::LEVEL_WARNING);
        }

        return new SeoTagsDataObject();
    }

    /**
     * @param $name
     * @param $content
     */
    protected function registerMetaTag($name, $content)
    {
        $view = \Yii::$app->getView();
        switch ($name) {
            case 'title':
                $view->title = $content;
                break;
            default:
                $view->registerMetaTag(['name' => $name, 'content' => $content]);
        }
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->seoDataObject->setDescription($description);
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->seoDataObject->setTitle($title);
    }

    /**
     * @param $keywords
     */
    public function setKeywords($keywords)
    {
        $this->seoDataObject->setKeywords($keywords);
    }

    /**
     * @return \yii\caching\Cache
     */
    protected function getCache()
    {
        return \Yii::$app->cache;
    }
}
