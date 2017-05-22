<?php

namespace ruslan89\seo;

/**
 * Seo module definition class
 */
class SeoModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'ruslan89\seo\controllers';

    public $params = [
        'routeParamsFilePath' => null,
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
