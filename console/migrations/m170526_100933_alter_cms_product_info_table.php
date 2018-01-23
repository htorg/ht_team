<?php

use yii\db\Migration;

class m170526_100933_alter_cms_product_info_table extends Migration
{
    public function up()
    {
    	$this->addColumn('cms_product_info', 'product_other', $this->text()->after('product_content'));
    }

    public function down()
    {
        echo "m170526_100933_alter_cms_product_info_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
