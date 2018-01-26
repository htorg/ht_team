<?php

use yii\db\Migration;

/**
 * Handles the creation of table `homepage_config`.
 */
class m171128_062257_create_homepage_config_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function Up()
    {
        $this->createTable('homepage_config', [
            'id' => $this->primaryKey(),
            'meta_title'=>$this->string(50),
            'meta_keywords'=>$this->string(255),
            'meta_description'=>$this->string(255),
            'copyright'=>$this->string(50),
            'record'=>$this->string(50)
        ]);
        $this->createTable('cms_banner_pic', [
            'id' => $this->primaryKey(),
            'pos'=> $this->string()->notNull(),
            'image'=> $this->string()->notNull(),
            'link' => $this->string()->notNull(),
            'sort_val'      => $this->integer()->notNull()->defaultValue(100),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function Down()
    {
        $this->dropTable('homepage_config');
        $this->dropTable('cms_banner_pic');
    }
}
