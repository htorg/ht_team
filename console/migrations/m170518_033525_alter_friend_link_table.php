<?php

use yii\db\Migration;

class m170518_033525_alter_friend_link_table extends Migration
{
    public function up()
    {
		$this->addColumn('friend_link', 'type', $this->smallInteger()->notNull()->defaultValue(0));
    }

    public function down()
    {
        echo "m170518_033525_alter_friend_link_table cannot be reverted.\n ";

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
