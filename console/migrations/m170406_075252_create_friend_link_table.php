<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friend_link`.
 */
class m170406_075252_create_friend_link_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('friend_link', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'site_url' => $this->string(),
            'logo' => $this->string()->notNull(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('friend_link');
    }
}
