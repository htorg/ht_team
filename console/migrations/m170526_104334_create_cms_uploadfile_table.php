<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cms_uploadfile`.
 */
class m170526_104334_create_cms_uploadfile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cms_uploadfile', [
            'id' => $this->primaryKey(),
        	'lang_id'       => $this->integer()->notNull(),
            'site_id' 		=> $this->integer()->notNull()->defaultValue(0),
        	'product_id'	=>$this->integer(),
            'name'          => $this->string()->notNull(),
            'description'   => $this->string()->notNull(),
        	'cover'			=>$this->string()->notNull(),
        	'filePath'		=>$this->string()->notNull(),
        	'status'		=>$this->integer()->notNull()->defaultValue(10)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cms_uploadfile');
    }
}
