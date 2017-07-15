<?php

namespace ruslan89\seo\classes;

use ruslan89\seo\models\SeoPage;

/**
 * Class SeoTagsDataObject
 * @package ruslan89\seo\classes
 */
class SeoTagsDataObject
{
    /** @var  string */
    private $title;

    /** @var  string */
    private $description;

    /** @var  string */
    private $keywords;

    /** @var  array */
    private $tags = [];

    /** @var  string */
    private $header;

    /** @var  string */
    private $subheader;

    /** @var  string */
    private $seo_text;

    public function __construct(SeoPage $seoPage = null)
    {
        if(empty($seoPage)){
           return;
        }

        $this->setTitle($seoPage->title);
        $this->setDescription($seoPage->description);
        $this->setKeywords($seoPage->keywords);
        $this->setHeader($seoPage->header);
        $this->setSubheader($seoPage->subheader);
        $this->setSeoText($seoPage->seo_text);
        foreach ($seoPage->tags as $tag) {
            $this->tags[] = $tag->toArray(['name', 'content']);
        }
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param string $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getSubheader()
    {
        return $this->subheader;
    }

    /**
     * @param string $subheader
     */
    public function setSubheader($subheader)
    {
        $this->subheader = $subheader;
    }

    /**
     * @return string
     */
    public function getSeoText()
    {
        return $this->seo_text;
    }

    /**
     * @param string $seo_text
     */
    public function setSeoText($seo_text)
    {
        $this->seo_text = $seo_text;
    }
}
