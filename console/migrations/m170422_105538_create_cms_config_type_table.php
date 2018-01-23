<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cms_config_type`.
 */
class m170422_105538_create_cms_config_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cms_config_type', [
            'id' => $this->primaryKey(),
        	'feature'=>$this->string(100)->notNull(),
        	'name'=>$this->string(20)->notNull(),
        	'code'=>$this->string(20)->notNull(),	
      		'type'=>$this->integer()->defaultValue(1)->notNull(),	
        	'status'=>$this->integer()->defaultValue(10)->notNull()	
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cms_config_type');
    }
}
