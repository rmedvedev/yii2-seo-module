<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `meta_tags`.
 */
class m170702_182522_add_priority_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('seo_page', 'priority', Schema::TYPE_INTEGER);
        $this->execute('UPDATE seo_page SET priority=id;');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('seo_page', 'priority');
    }
}
