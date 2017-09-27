<?php

namespace ruslan89\seo\classes;

use Twig_Environment;
use Twig_Loader_Array;

class SeoParamsInterpreter
{
    private $seoDataObject;
    private $resolvedParams;

    /**
     * @param SeoTagsDataObject $seoDataObject
     * @param array $resolvedParams
     */
    public function __construct(SeoTagsDataObject $seoDataObject, $resolvedParams)
    {
        $this->seoDataObject = $seoDataObject;
        $this->resolvedParams = $resolvedParams;
    }

    public function run()
    {
        $seoData = $this->seoDataObject;
        $this->seoDataObject->setTitle($this->twigRender($seoData->getTitle(), $this->resolvedParams));
        $this->seoDataObject->setDescription($this->twigRender($seoData->getDescription(), $this->resolvedParams));
        $this->seoDataObject->setKeywords($this->twigRender($seoData->getKeywords(), $this->resolvedParams));
        $this->seoDataObject->setHeader($this->twigRender($seoData->getHeader(), $this->resolvedParams));
        $this->seoDataObject->setSubheader($this->twigRender($seoData->getSubheader(), $this->resolvedParams));
        $this->seoDataObject->setSeoText($this->twigRender($seoData->getSeoText(), $this->resolvedParams));
        foreach ($this->seoDataObject->getTags() as &$tag) {
            $tag['content'] = $this->twigRender($tag['name'], $this->resolvedParams);
        }
    }

    /**
     * @param $text
     * @param $params
     * @return string
     */
    private function twigRender($text, $params)
    {
        try {
            $loader = new Twig_Loader_Array(['text' => $text]);
            $twig = new Twig_Environment($loader);
            return $twig->render('text', $params);
        } catch (\Twig_Error $e) {
            return '';
        }
    }

    /**
     * @return SeoTagsDataObject
     */
    public function getSeoDataObject()
    {
        return $this->seoDataObject;
    }
}
