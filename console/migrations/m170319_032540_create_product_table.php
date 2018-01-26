<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170319_032540_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cms_product', [
            'id' => $this->primaryKey(),
            'type'=>$this->integer()->notNull(),
            'meta_keywords'=>$this->string(255)->null(),
            'meta_description'=>$this->string(255)->null(),
            'banner' => $this->string(255)->notNull(),
            'banner_title' => $this->string(20)->null(),
            'banner_subtitle' => $this->string(20)->null(),
            'main_title' => $this->string(20)->null(),
            'second_title' => $this->string(20)->null(),
            'product_detail'=>$this->text()->null(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
        $this->createTable('cms_product_info', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'main_image'=> $this->string(255)->notNull(),
            'main_name'=> $this->string(20)->notNull(),
            'main_description'  => $this->text()->notNull(),
            'address'=> $this->string(20),
            'property_area'=>$this->string(20),
            'available_area'=>$this->string(50),
            'property_properties'=>$this->string(20),
            'price'=>$this->string(20),
            'node_image'=> $this->string(255),
            'node_name'          => $this->string(50),
            'node_description'   => $this->text(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
        $this->createTable('cms_product_pic',[
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'sub_banner'=>$this->string(255),
            'info_img1'=>$this->string(255)->null(),
            'info_title1'=>$this->string(20)->null(),
            'info_img2'=>$this->string(255)->null(),
            'info_title2'=>$this->string(20)->null(),
            'info_img3'=>$this->string(255)->null(),
            'info_title3'=>$this->string(20)->null(),
            'show_pics'=>$this->text()->null(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cms_product');
        $this->dropTable('cms_product_info');
        $this->dropTable('cms_product_pic');
    }
}
