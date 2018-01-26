<?php

use yii\db\Migration;

/**
 * Handles the creation of table `about`.
 */
class m170227_142657_create_about_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cms_page_about', [
            'id' => $this->primaryKey(),
            'meta_keywords'=>$this->string(255)->null(),
            'meta_description'=>$this->string(255)->null(),
            'banner' => $this->string()->null(),
            'banner_title' => $this->string()->null(),
            'banner_subtitle' => $this->string()->null(),
            'company_name'=> $this->string()->notNull(),
            'company_desc'=> $this->text()->notNull(),
            'shareholder_title'=>$this->string(50),
            'shareholder_detail'=>$this->string(255)->notNull(),
            'Strategic_title'=>$this->string(50),
            'Strategic_detail'=>$this->string(255)->notNull(),
            'info_main_title'=>$this->string(50),
            'info_subtitle'=>$this->string(50),
            'info_desc1'=>$this->string(25)->notNull(),
            'info_desc2'=>$this->string(25)->notNull(),
            'info_desc3'=>$this->string(25)->notNull(),
            'shareholder_info_title'=>$this->string(50)->notNull(),
            'created_at'=> $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull(),
        ]);
        $this->createTable('cms_listed_company',[
            'id' => $this->primaryKey(),
            'about_id'=>$this->integer()->notNull(),
            'company_name'=>$this->string(20)->notNull()->comment('上市公司'),
            'listing_place'=>$this->string(20)->notNull()->comment('上市地点'),
            'stock_code'=>$this->string(20)->notNull()->comment('股票代码'),
            'rank_field'=>$this->string(255)->notNull()->comment('行业地位'),
            'created_at'=> $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull(),
        ]);
        $this->createTable('cms_page_contact', [
            'id' => $this->primaryKey(),
            'type'=>$this->integer()->notNull(),
            'meta_keywords'=>$this->string(255)->null(),
            'meta_description'=>$this->string(255)->null(),
            'phone'         => $this->string(20)->notNull(),
            'telephone'     => $this->string(20)->null(),
            'longitude'     => $this->string(40)->null(),
            'latitude'      => $this->string(40)->null(),
            'address'       => $this->string(200)->notNull(),
            'map_img'       => $this->string()->null(),
            'email'         => $this->string(60)->null(),
            'qq'            => $this->string(20)->null(),
            'zipcode'       => $this->string(20)->null(),
            'wxopenid'      => $this->string(255)->null(),
            'weibo'         => $this->string(255)->null(),
            'banner' => $this->string()->null(),
            'banner_title' => $this->string()->null(),
            'banner_subtitle' => $this->string()->null(),
            'contact_desc'=> $this->text()->notNull(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
        $this->createTable('cms_company_honor', [
            'id' => $this->primaryKey(),
            'meta_keywords'=>$this->string(255)->null(),
            'meta_description'=>$this->string(255)->null(),
            'banner' => $this->string()->null(),
            'banner_title' => $this->string()->null(),
            'banner_subtitle' => $this->string()->null(),
            'honor_country'         => $this->text()->notNull(),
            'honor_provice'         => $this->text()->notNull(),
            'link_country'         => $this->string(255)->notNull(),
            'link_provice'         => $this->string(255)->notNull(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cms_page_about');
        $this->dropTable('cms_listed_company');
        $this->dropTable('cms_page_contact');
        $this->dropTable('cms_company_honor');
    }
}
