<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `meta_tags`.
 */
class m170701_182522_add_fields_seo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('seo_page', 'header', Schema::TYPE_STRING);
        $this->addColumn('seo_page', 'subheader', Schema::TYPE_STRING);
        $this->addColumn('seo_page', 'seo_text', Schema::TYPE_TEXT);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('seo_page', 'header');
        $this->dropColumn('seo_page', 'subheader');
        $this->dropColumn('seo_page', 'seo_text');
    }
}
