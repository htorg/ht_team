<?php
use yii\helpers\Url;
use common\helpers\ThemeHelper;
use backend\themes\adminlte\NavAsset;

$bundle=NavAsset::register($this);
?>
<style>
    .nav_list_item{padding:0;margin-bottom:10px}
    .ht_row{min-height:50px;line-height:50px;display:inline-block;width:100%;padding-left:10px;margin-top: 5px;}
    .ht_row:hover .ht_button{visibility: visible}
    .ht_row:hover .create_subNav_btn{visibility: visible}
    /*.ht_row_input{width:100%;border:solid 1px #c9c9c9;height:30px;padding:0 10px;border-radius:4px;}*/
    .ht_row label:first-child{padding-left:30px}
    .ht_button{visibility:hidden;color:#333;height:34px;line-height:34px ;padding:0 5px;cursor:pointer;margin:0 5px}
    .ht_button:hover{color:#d73925;}
    .ht_button:active{opacity: .7;}
    .ht_rowBox{}
    .ht_row_right{float:right;margin-top:5px;}
    /*.ht_pullDown_menu{display:none;}*/
    /*.ht_rowContent{padding:10px 0 10px 30px;}*/
    .ht_input_case{display:block;padding-left:35px;padding-right:110px;position:relative;padding-bottom:15px;height:44px;}
    .label_name{font-size:12px; color:#858585;position:absolute;left:0;top:5px;font-style: normal;line-height:36px;}
    /*.ht_row_button{position:absolute;right:0;top:-2px;font-style: normal;}*/
    input{outline:none;}
    .subNavItem{}

    .subNavItem_name{padding-left:50px;}
    .subNavItem_thr .subNavItem_name{padding-right:15px;padding-left:70px;}
    /*.subNavItem_content{padding-left:30px;}*/
    .attr_select{padding:5px;font-style: normal;font-size:12px;color:#858585;border-radius:4px;}
    .ico_more{width:20px;height:20px;position:absolute;top:22px;left:0;display:none;vertical-align: middle;text-align: center;cursor:pointer;z-index: 20}
    .more_sub_content{padding-top:5px;background:#f4f4f4;}
    .nav_attr{color:#d2d6de;}
    .row_nav_name{height:30px; width:100%;padding:0 5px;}
    .create_subNav_btn{visibility:hidden;height:30px;vertical-align: middle;margin-top:-4px;}
    .nav_colItem{position:relative;height:50px;}
    .ico_subNav{position:absolute;left:17px;top:10px;}
    .subNavItem_thr .ico_subNav{left:37px;}
    .navTh_title_bar{padding:10px 0;border-bottom:solid 1px #aaa;background:#64a4d8;color:#fff}
    .navTh_item{text-align:center;font-weight:600;border-left:solid 1px #fff;}
    .navTh_title_bar .navTh_item:first-child{border-left:none;}
</style>
<div class="row">
<div class="col-md-12">
		<div class="box style_box1">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Yii::t('app', 'Nav list');?></h3>
            </div>
            <div class="box-body " sub-img="<?= $bundle->baseUrl?>/img/img_column.gif">
              <div id="nav-list" class="box box-solid ">
                 <p>
                     <button class="btn btn-danger" id="add-nav">添加导航栏</button>
                 </p>

                 <div class="navTh_title_bar clearfix">
                      <div class="navTh_item col-md-4">导航栏名称</div>
                      <div class="navTh_item col-md-3">导航栏类型</div>
                      <div class="navTh_item col-md-5">操作</div>
                  </div>


              	<ul class="nav nav-stacked" id="nav-show-stacked">
                    <?= $navsHtml ?>
              	</ul>
                </div>
                
                <button type="button" id="" class="btn btn-danger pull-right" style="margin:5px 15px" onclick="window.location.href='<?= Url::to(["nav/manager"])?>'">返回列表</button>
                <button type="button" id="save-navs-btn" class="btn btn-danger pull-right" style="margin:5px 15px"><?php echo Yii::t('app', 'Save')?></button>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
	<li  id="nav-model" class="nav_list_item"  ext_id="" rel="" url="" type="" style="display:none" > 	
		<div class="ht_rowBox">
			<i class="ico_more glyphicon glyphicon-triangle-right"></i>
	    	<div class="ht_row">
	    		<div class="nav_colItem col-md-4 ">
	    			<input class="row_nav_name" type="text" value="" autocomplete="no" placeholder="请输入（必填）"/>
	    		</div>
		    	<div class="nav_colItem col-md-3">
		    		<i class="ht_input_case">
			    		<span class="label_name">类型：</span>
			    		<select class="attr_select">
			    			<option >请选择</option>
			    			<?php foreach ($navTypeNames as $key=>$navtype){
			    				?>
			    				<option value="<?= $key ?>"><?= $navtype ?></option>
			    			<?php }?>
			    		</select>
		    		</i>
		    	</div>
		    	<div class="nav_colItem col-md-5">
		     		<button id="create-cate" class="btn btn-primary create_subNav_btn">添加子级</button>
		     		<a  class=" ht_button ht_row_right glyphicon glyphicon-remove removeBtn"></a>
		     		<a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-up upBtn"></a>
		     		<a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-down downBtn"></a>
		     	</div>
	     	</div>
     	</div>
    </li>
    <div class="col-md-3" style="display: none">
          <div class="box style_box1">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Yii::t('app', 'Add to nav');?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-footer no-padding no-border">
              <ul id="add-nav" class="nav nav-stacked">
              	<li class="no-border" type="7001" rel="0" name="<?php echo Yii::t('app', 'Homepage')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                    		<span class="name"><?php echo Yii::t('app', 'Homepage')?></span>
                    		<span class="text-gray">-<?php echo Yii::t('app', 'Homepage')?></span>
                    	</div>

                    	<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                </li>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_CATEGORY, $features)){?>
              	<?php foreach ($topCategorys as $c) {?>
                <li class="no-border" type="1001" rel="<?php echo $c['id']?>" name="<?php echo $c['name']?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                    		<span class="name"><?php echo $c['name']?></span>
                    		<span class="text-gray">-<?php echo Yii::t('app', 'Top category')?></span>
                    	</div>
                    	<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                	<?php if (count($c['sub']) > 0) {?>
                	<div class="sub-list hide">
                		<?php foreach ($c['sub'] as $s){?>
                		<div class="sub-item" rel="<?php echo $s['id']?>" name="<?php echo $s['name']?>"></div>
                		<?php }?>
                	</div>
                	<?php }?>
                </li>
                <?php }?>
                <?php }?>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_PAGE, $features)){?>
                <li class="no-border" type="2001" rel="" name="<?php echo Yii::t('app', 'Single page')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                			<span class="name"><?php echo Yii::t('app', 'Single page')?></span>
                			<span class="text-gray">-<?php echo Yii::t('app', 'Single page')?></span>
                		</div>
                		<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                </li>
                <?php }?>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_PAGE_CONTACT, $features)){?>
                <li class="no-border" type="2003" rel="" name="<?php echo Yii::t('app', 'Contact us')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                			<span class="name"><?php echo Yii::t('app', 'Contact us')?></span>
                			<span class="text-gray">-<?php echo Yii::t('app', 'Single page')?></span>
                		</div>
                		<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>

                	</a>
                </li>
                <?php }?>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_PAGE_ABOUT, $features)){ ?>
                <li class="no-border" type="2002" rel="" name="<?php echo Yii::t('app', 'About us')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                			<span class="name"><?php echo Yii::t('app', 'About us')?></span>
                			<span class="text-gray">-<?php echo Yii::t('app', 'Single page')?></span>
                		</div>
                		<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                </li>
                <?php }?>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_ALBUM, $features)){?>
                <li class="no-border" type="5001" rel="0" name="<?php echo Yii::t('app', 'Album')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                    		<span class="name"><?php echo Yii::t('app', 'Album')?></span>
                    		<span class="text-gray">-<?php echo Yii::t('app', 'Album List')?></span>
                    	</div>
                    	<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                </li>
                <?php }?>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_CASE, $features)){?>
                <li class="no-border" type="6001" rel="0" name="<?php echo Yii::t('app', 'Case')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                    		<span class="name"><?php echo Yii::t('app', 'Case')?></span>
                    		<span class="text-gray">-<?php echo Yii::t('app', 'Cms Cases')?></span>
                    	</div>
                    	<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                </li>
                <?php }?>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_PRODUCT, $features)){?>
                <li class="no-border" type="8001" rel="0" name="<?php echo Yii::t('app', 'Product')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                    		<span class="name"><?php echo Yii::t('app', 'Product')?></span>
                    		<span class="text-gray">-<?php echo Yii::t('app', 'Product List')?></span>
                    	</div>
                    	<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                	<?php if (!empty($productCategorys)) {?>
                	<div class="sub-list hide">
                		<?php foreach ($productCategorys as $s){?>
                		<div class="sub-item" rel="<?php echo $s['id']?>" name="<?php echo $s['name']?>"></div>
                		<?php }?>
                	</div>
                	<?php }?>
                </li>
                <?php }?>
                <?php if (in_array(ThemeHelper::$THEME_FEATURE_FRIENDLINK, $features)){?>
                <li class="no-border" type="10001" rel="0" name="<?php echo Yii::t('app', 'Friendlink')?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                    		<span class="name"><?php echo Yii::t('app', 'Friendlink')?></span>
                    		<span class="text-gray">-<?php echo Yii::t('app', 'Friendlink List')?></span>
                    	</div>
                    	<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                </li>
                <?php }?>
                <?php foreach ($preDefinedLinks as $p) {?>
                <li class="no-border" type="4001" rel="<?php echo $p['id']?>" name="<?php echo $p['name']?>" url="<?php echo $p['ext_content']?>">
                	<a class="row row-nomargin">
                		<div class="col-md-9 no-padding cut">
                			<span class="name"><?php echo $p['name']?></span>
                			<span class="text-gray">-<?php echo Yii::t('app', 'Customer link')?></span>
                		</div>
                		<div class="col-md-3 no-padding cut">
                    		<i class="pull-right fa fa-plus pointer"></i>
                    	</div>
                	</a>
                </li>
                <?php }?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          <div class="box style_box1">
                <div class="box-header with-border">
                  <h3 id="customer-link-box-title" class="box-title"><?php echo Yii::t('app', 'Add new customer link');?></h3>
                </div>
                <div id="customer_link_form" class="box-body">
                	<div class="form-group hide">
                      <label><?php echo Yii::t('app', 'ID');?></label>
                      <input type="text" class="form-control inputID">
                    </div>
                    
                  	<div class="form-group">
                      <label><?php echo Yii::t('app', 'Name');?></label>
                      <input type="text" class="form-control inputName" placeholder="<?php echo Yii::t('app', 'Name');?>">
                      <div class="hint-block"><?php echo Yii::t('app', 'Required').', '.Yii::t('app', 'The link\'s name.')?></div>
                    </div>
                    
                    <div class="form-group">
                      <label><?php echo Yii::t('app', 'Url');?></label>
                      <input type="text" class="form-control inputUrl" placeholder="<?php echo Yii::t('app', 'Url');?>">
                      <div class="hint-block"><?php echo Yii::t('app', 'Required').', '.Yii::t('app', 'Foramt like as: ').'http://www.gohoc.com'?></div>
                    </div>
                    
                    <div class="text-right">
                    	<button type="button" id="save-customerlink-btn" class="btn btn-danger "><?php echo Yii::t('app', 'Save')?></button>
                    	<button type="button" id="delete-customerlink-btn" class="btn btn-danger hide"><?php echo Yii::t('app', 'Delete')?></button>
                    </div>
                    
                </div>
                <!-- /.box-body -->
              </div>
          <!-- /.box -->
        </div>
</div>

<div id="nav_cms_box" class="box box-solid nav-edit-box hide bg-color-1 no-shadow no-margin">
                        <div class="form-group">
                          <label><?php echo Yii::t('app', 'Name')?></label>
                          <input type="text" class="form-control inputName bg-color-1" placeholder="<?php echo Yii::t('app', 'Name')?>">
                          <div class="hint-block"><?php echo Yii::t('app', 'Required').', '.Yii::t('app', 'The link\'s name.')?></div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="removeBtn btn btn-danger btn-flat"><i class="fa fa-times"></i></button>
                            <button type="button" class="upBtn btn btn-success btn-flat"><i class="fa fa-arrow-up"></i></button>
                            <button type="button" class="downBtn btn btn-success btn-flat"><i class="fa fa-arrow-down"></i></button>
                            <button type="button" class="leftBtn btn btn-success btn-flat"><i class="fa fa-arrow-left"></i></button>
                            <button type="button" class="rightBtn btn btn-success btn-flat"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>

<div id="nav_customer_box" class="box box-solid nav-edit-box hide bg-color-1 no-shadow no-margin">
                    <div class="form-group">
                      <label><?php echo Yii::t('app', 'Name')?></label>
                      <input type="text" class="form-control inputName bg-color-1" placeholder="<?php echo Yii::t('app', 'Name')?>">
                      <div class="hint-block"><?php echo Yii::t('app', 'Required').', '.Yii::t('app', 'The link\'s name.')?></div>
                    </div>
                    <div class="form-group">
                      <label><?php echo Yii::t('app', 'Url')?></label>
                      <input type="email" class="form-control inputUrl bg-color-1">
                      <div class="hint-block"><?php echo Yii::t('app', 'Required').', '.Yii::t('app', 'Foramt like as: ').'http://www.gohoc.com'?></div>
                    </div>
                    <div class="form-group">
                      <button type="button" class="removeBtn btn btn-danger btn-flat"><i class="fa fa-times"></i></button>
                      <button type="button" class="upBtn btn btn-success btn-flat"><i class="fa fa-arrow-up"></i></button>
                      <button type="button" class="downBtn btn btn-success btn-flat"><i class="fa fa-arrow-down"></i></button>
                      <button type="button" class="leftBtn btn btn-success btn-flat"><i class="fa fa-arrow-left"></i></button>
                      <button type="button" class="rightBtn btn btn-success btn-flat"><i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>

<div class="page-data hide">
    <span id="save-navs-url"><?php echo Url::to(['nav/save'],true);?></span>
    <span id="save-customerlink-url"><?php echo Url::to(['nav/save-link'],true);?></span>
    <span id="delete-customerlink-url"><?php echo Url::to(['nav/delete-link'],true);?></span>
    <span id="top-category-lang"><?php echo Yii::t('app', 'Top category')?></span>
    <span id="second-category-lang"><?php echo Yii::t('app', 'Second category')?></span>
    <span id="single-page-lang"><?php echo Yii::t('app', 'Single page')?></span>
    <span id="customer-link-lang"><?php echo Yii::t('app', 'Customer link')?></span>
    <span id="name-blank-error-lang"><?php echo Yii::t('app', 'Name').' '.Yii::t('app', 'can not be blank.');?></span>
    <span id="url-blank-error-lang"><?php echo Yii::t('app', 'Url').' '.Yii::t('app', 'can not be blank.')?></span>
    <span id="url-valid-error-lang"><?php echo Yii::t('app', 'Url').' '.Yii::t('app', 'format error.')?></span>
    <span id="new-customerlink-lang"><?php echo Yii::t('app', 'Add new customer link');?></span>
    <span id="update-customerlink-lang"><?php echo Yii::t('app', 'Update customer link');?></span>
    <span id="sub-category-lang"><?php echo Yii::t('app', 'Sub category');?></span>
    <span id="product-category-lang"><?php echo Yii::t('app', 'Cms Product Category');?></span>
</div>



