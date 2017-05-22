<?php

namespace ruslan89\seo\tests\classes;

use ruslan89\seo\classes\RouteParameter;
use yii\db\ActiveRecord;

class ExampleParameter implements RouteParameter
{
    /**
     * @param $attribute
     * @return ActiveRecord
     */
    public function getModel($attribute)
    {
        return Example::findByCode($attribute);
    }
}
