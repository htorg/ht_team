<?php

use yii\db\Migration;

/**
 * Handles the creation of table 'meta_info'.
 */
class m171128_100311_create_meta_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function Up()
    {
        $this->createTable('cms_meta_info', [
            'id' => $this->primaryKey(),
            'pos'=> $this->string(255)->notNull(),
             'title'=>$this->string(255)->notNull(),
              'keywords'=>$this->string(255)->notNull(),
              'description'=>$this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function Down()
    {
        $this->dropTable('cms_meta_info');
    }
}
