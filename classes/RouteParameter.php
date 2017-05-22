<?php

namespace ruslan89\seo\classes;

use yii\db\ActiveRecord;

/**
 * Class RouteParameter
 * @package ruslan89\seo\classes
 */
interface RouteParameter
{
    /**
     * @param $attribute
     * @return ActiveRecord
     */
    public function getModel($attribute);
}
