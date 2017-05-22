<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `meta_tags`.
 */
class m160529_182522_create_table_meta_tags extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('seo_page', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'code' => Schema::TYPE_STRING,
            'route' => Schema::TYPE_STRING,
            'title' => Schema::TYPE_TEXT,
            'description' => Schema::TYPE_TEXT,
            'keywords' => Schema::TYPE_TEXT,
        ]);

        $this->createTable('seo_page_tags', [
            'id' => Schema::TYPE_PK,
            'seo_page_id' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'content' => Schema::TYPE_TEXT
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('seo_page');
        $this->dropTable('seo_page_tags');
    }
}
