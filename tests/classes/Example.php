<?php

namespace ruslan89\seo\tests\classes;

use yii\db\ActiveRecord;

class Example extends ActiveRecord
{
    public $name;
    public $tags = [];

    public function hasAttribute($name)
    {
        return true;
    }

    public static function findByCode($code)
    {
        if($code == '1') {
            $model = new self;
            $model->name = 'example1';
            return $model;
        }

        return null;
    }
}
