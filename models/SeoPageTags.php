<?php

namespace rusmd89\seo\models;

use Yii;

/**
 * This is the model class for table "meta_tags".
 *
 * @property integer $id
 * @property integer $seo_page_id
 * @property string $name
 * @property string $content
 */
class SeoPageTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_page_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'string', 'max' => 255],
            [['seo_page_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoPage::className(), 'targetAttribute' => ['seo_page_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'seo_page_id' => Yii::t('app', 'Seo Page'),
        ];
    }
}
