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
     * @param array             $resolvedParams
     */
    public function __construct(SeoTagsDataObject $seoDataObject, $resolvedParams)
    {
        $this->seoDataObject = $seoDataObject;
        $this->resolvedParams = $resolvedParams;
    }

    public function run()
    {
        $seoTags = [
            'title' => $this->seoDataObject->getTitle(),
            'description' => $this->seoDataObject->getDescription(),
            'keywords' => $this->seoDataObject->getKeywords(),
            'header' => $this->seoDataObject->getHeader(),
            'subheader' => $this->seoDataObject->getSubheader(),
            'seo_text' => $this->seoDataObject->getSeoText(),
        ];

        foreach ($this->seoDataObject->getTags() as $tag) {
            $seoTags[$tag['name']] = $tag['content'];
        }

        $loader = new Twig_Loader_Array($seoTags);
        $twig = new Twig_Environment($loader);

        $this->seoDataObject->setTitle($twig->render('title', $this->resolvedParams));
        $this->seoDataObject->setDescription($twig->render('description', $this->resolvedParams));
        $this->seoDataObject->setKeywords($twig->render('keywords', $this->resolvedParams));
        $this->seoDataObject->setHeader($twig->render('header', $this->resolvedParams));
        $this->seoDataObject->setSubheader($twig->render('subheader', $this->resolvedParams));
        $this->seoDataObject->setSeoText($twig->render('seo_text', $this->resolvedParams));
        foreach ($this->seoDataObject->getTags() as $tag) {
            $tag['content'] = $twig->render($tag['name'], $this->resolvedParams);
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
