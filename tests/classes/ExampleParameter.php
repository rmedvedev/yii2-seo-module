<?php

namespace rusmd89\seo\tests\classes;

use rusmd89\seo\classes\RouteParameter;
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
