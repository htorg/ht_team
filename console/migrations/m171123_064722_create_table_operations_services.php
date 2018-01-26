<?php

use yii\db\Migration;

/**
 * Class m171123_064722_create_table_operations_services
 */
class m171123_064722_create_table_operations_services extends Migration
{

    public function up()
    {
        $this->createTable('upload_files', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->null(),
            'file_type'=> $this->string()->notNull(),
            'src' => $this->string()->notNull(),
            'created_at'=> $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull(),
        ]);
        $this->createTable('services_info', [
            'id' => $this->primaryKey(),
            'banner' => $this->string(255)->notNull(),
            'banner_title' => $this->string(20)->null(),
            'banner_subtitle' => $this->string(20)->null(),
            'meta_keywords'=>$this->string(255)->null(),
            'meta_description'=>$this->string(255)->null(),
            'settled_image' => $this->string(255)->notNull(),
            'settled_summary'=> $this->text()->notNull(),
            'settled_desc'=> $this->text()->notNull(),
            'platform_config1'=>$this->string()->notNull(),
            'platform_config2'=>$this->string()->notNull(),
            'platform_config3'=>$this->string()->notNull(),
            'platform_desc'=>$this->string(255)->Null(),
            'platform_image'=>$this->string(255)->notNull(),
            'banner_files'=>$this->text()->notNull(),
            'created_at'=> $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('upload_files');
        $this->dropTable('services_info');
    }
}
