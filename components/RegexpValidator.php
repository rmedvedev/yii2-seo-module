<?php

namespace rusmd89\seo\components;

use rusmd89\seo\classes\RegExpDecorator;
use yii\validators\Validator;

class RegexpValidator extends Validator
{
    public $allowEmpty = false;

    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        $attributeValue = $model->$attribute;
        if ($this->allowEmpty && empty($attributeValue)) {
            return;
        }

        $pregTestResult = RegExpDecorator::match($attributeValue, '');

        if ($pregTestResult === false) {
            $this->addError($model, $attribute, \Yii::t('app', 'Error in regular expression.'));
            return;
        }
    }
}