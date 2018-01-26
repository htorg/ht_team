<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cms_article`.
 */
class m170607_023615_create_cms_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cms_article', [
            'id' => $this->primaryKey(),
            'category_id'   => $this->integer()->notNull(),
            'name'          => $this->string()->notNull(),
            'summary'       => $this->string()->notNull(),
            'content'       => $this->text()->notNull(),
            'meta_keywords'         => $this->string(),
            'meta_description'      => $this->string(),
        	'video_cover'=>$this->string(),
        	'video_src'	=>$this->string(),
            'image_main' => $this->string(),
            'image_node' => $this->string(),            
            'view_count' => $this->integer()->notNull()->defaultValue(0),
            'status'        => $this->smallInteger()->notNull()->defaultValue(10)->comment('0：有效 10：失效'),
        	'type'			=>$this->smallInteger(6)->comment('文章类型(0-banner推送)'),
            'sort_val'      => $this->integer()->notNull()->defaultValue(10),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cms_article');
    }
}
