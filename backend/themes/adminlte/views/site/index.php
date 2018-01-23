<?php

use common\helpers\ThemeHelper;
use common\models\CmsCategory;
use common\models\CmsArticle;
use common\models\CmsPage;
use common\models\CmsBanner;
use common\models\CmsCase;
use common\models\CmsAlbum;


/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Dashboard');
?>

<style>
    .table_visit{border: 1px solid #ddd;  width: 100%;  color: #666;  font-size: 13px;}
    .table_visit th{background: #f2f2f2;  border: 1px solid #ddd;  padding: 5px 10px; white-space: nowrap;}
    .table_visit td{background: #fff;  border: 1px solid #ddd;  padding: 5px 10px; white-space: nowrap;}
</style>


<section class="content-header">
      <h1>
        <?php echo Yii::t('app', 'AppName')?>
        <small></small>
      </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box style_box1">
                  <div class="box-header with-border">
                    <h4>近五天访问情况</h4>
                    <table cellpadding="0" cellspacing="1" class="table_visit">
                        <tbody><tr>
                            <th width="25%">日期</th>
                            <th width="25%">访问次数</th>
                            <th width="25%">IP</th>
                            <th width="25%">独立客户</th>
                        </tr>

                        <tr >
                            <td>今天</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>

                        <tr>
                            <td>昨天</td>
                            <td>32</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>

                        <tr>
                            <td>2017-05-30</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>

                        <tr>
                            <td>2017-05-29</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>

                        <tr>
                            <td>2017-05-28</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>

                        </tbody>
                    </table>
                  </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box style_box1">
                <div class="box-header with-border">
                    <h4>历史总览</h4>
                    <table cellpadding="0" cellspacing="1" class="table_visit">
                        <tbody><tr>
                            <th width="25%">名称</th>
                            <th width="25%">访问数量</th>
                            <th width="25%">IP</th>
                            <th width="25%">独立客户</th>
                        </tr>

                        <tr>
                            <td>本周</td>
                            <td>7</td>
                            <td>5</td>
                            <td>5</td>
                        </tr>

                        <tr>
                            <td>本月份</td>
                            <td>100</td>
                            <td>80</td>
                            <td>60</td>
                        </tr>

                        <tr>
                            <td>本季度</td>
                            <td>3200</td>
                            <td>250</td>
                            <td>190</td>
                        </tr>

                        <tr>
                            <td>今年</td>
                            <td>14000</td>
                            <td>1000</td>
                            <td>800</td>
                        </tr>

                        <tr>
                            <td>去年</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<!--        图表-->
<!--        <div class="col-md-12">-->
<!--            <div class="box style_box">-->
<!--                <div class="box-header with-border">-->
<!--                    <h4>近12小时流量趋势</h4>-->
<!--                    <canvas id="canvas"  height="375" width="1200" style="width:100%!important;"></canvas>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</section>

<section class="content">
      <div class="row">
      	<div class="col-md-3">
          <div class="box style_box1">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo Yii::t('app', 'Current theme：').$theme_arr['name']?></h3>
                </div>
                <div class="box-body no-padding">
                	<div class="index-box-1">
                		<img src="<?php echo \Yii::getAlias('@web').$theme_arr['image_pc'];?>" />
                	</div>
                </div>
              </div>
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa  fa-language"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><?php echo Yii::t('app', 'Current lang：');?></span>
                  <span class="info-box-number m-t-10"><?php echo $lang_arr['name'];?></span>
                </div>
              </div>
        </div>
        <div class="col-md-9">
          <div class="box style_box1">
            <!-- /.box-header -->
            <div class="box-body relative">

              <!-- <div class="box-tools box-tools-2">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
              <div class="table-responsive">
                <table class="table no-margin table-vertical-middle">
                  <thead>
                  <tr>
                    <th><?php echo Yii::t('app', 'Statistic')?></th>
                    <th><?php echo Yii::t('app', 'Name')?></th>
                    <th><?php echo Yii::t('app', 'Count')?></th>
                  </tr>
                  </thead>
                  <tbody>
        		  <?php if (in_array(ThemeHelper::$THEME_FEATURE_NAV, $features)){?>
                  <tr>
                    <td><span class="info-box-icon2 bg-aqua"><i class="fa fa-map-signs"></i></span></td>
                    <td><?php echo Yii::t('app', 'Category Num')?></td>
                    <td><?php echo CmsCategory::find()->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'status'=>CmsCategory::STATUS_ACTIVE])->count();?></td>
                  </tr>
                  <?php }?>
                  <?php if (in_array(ThemeHelper::$THEME_FEATURE_ARTICLE, $features)){?>
        	 	  <tr>
                    <td><span class="info-box-icon2 bg-red"><i class="fa fa-file-text-o"></i></span></td>
                    <td><?php echo Yii::t('app', 'Article Num')?></td>
                    <td><?php echo CmsArticle::find()->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'status'=>CmsArticle::STATUS_ACTIVE])->count();?></td>
                  </tr>
        		  <?php }?>
        		  <?php if (in_array(ThemeHelper::$THEME_FEATURE_PAGE, $features)){?>
                  <tr>
                    <td><span class="info-box-icon2 bg-green"><i class="fa fa-files-o"></i></span></td>
                    <td><?php echo Yii::t('app', 'Page Num')?></td>
                    <td><?php echo CmsPage::find()->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'status'=>CmsPage::STATUS_ACTIVE])->count();?></td>
                  </tr>
                  <?php }?>
                  <?php if (in_array(ThemeHelper::$THEME_FEATURE_BANNER, $features)){?>
                  <tr>
                    <td><span class="info-box-icon2 bg-yellow"><i class="fa fa-film"></i></span></td>
                    <td><?php echo Yii::t('app', 'Banner Num')?></td>
                    <td><?php echo CmsBanner::find()->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'status'=>CmsBanner::STATUS_ACTIVE])->count();?></td>
                  </tr>
                  <?php }?>
                  <?php if (in_array(ThemeHelper::$THEME_FEATURE_CASE, $features)){?>
        		  <tr>
                    <td><span class="info-box-icon2 bg-teal"><i class="fa fa-folder"></i></span></td>
                    <td><?php echo Yii::t('app', 'Case Num')?></td>
                    <td><?php echo CmsCase::find()->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'status'=>CmsCase::STATUS_ACTIVE])->count();?></td>
                  </tr>
        		  <?php }?>
        		  <?php if (in_array(ThemeHelper::$THEME_FEATURE_ALBUM, $features)){?>
                  <tr>
                    <td><span class="info-box-icon2 bg-maroon"><i class="fa fa-image"></i></span></td>
                    <td><?php echo Yii::t('app', 'Album Num')?></td>
                    <td><?php echo CmsAlbum::find()->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'status'=>CmsAlbum::STATUS_ACTIVE])->count();?></td>
                  </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
</section>

<?php $this->beginBlock('test') ?>  
setSideBarActive('dashboard');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>

