<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cms_category`.
 */
class m170607_023700_create_cms_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cms_category', [
       			'id' => $this->primaryKey(),
        		'parent_id' => $this->integer()->defaultValue(0)->notNull(),       		
        		'name'          => $this->string()->notNull(),
                'banner_title' => $this->string()->null(),
                'banner_subtitle' => $this->string()->null(),
        		'description'   => $this->string()->notNull(),
        		'meta_keywords'         => $this->string(),
        		'meta_description'      => $this->string(),        		
        		'image_main' => $this->string(),
        		'image_node' => $this->string(),
        		'banner' => $this->string()->null(),       		
        		'sort_val'      => $this->integer()->notNull()->defaultValue(100),
        		'status'        => $this->smallInteger()->notNull()->defaultValue(10),
        		'type' => $this->string(20)->null()->comment('1-推荐'),
        		'created_at'    => $this->integer()->notNull(),
        		'updated_at'    => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cms_category');
    }
}
