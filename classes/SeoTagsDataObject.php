<?php

namespace rusmd89\seo\classes;

use rusmd89\seo\models\SeoPage;

/**
 * Class SeoTagsDataObject
 * @package rusmd89\seo\classes
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

    public function __construct(SeoPage $seoPage = null)
    {
        if(empty($seoPage)){
           return;
        }

        $this->setTitle($seoPage->title);
        $this->setDescription($seoPage->description);
        $this->setKeywords($seoPage->keywords);
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
}
