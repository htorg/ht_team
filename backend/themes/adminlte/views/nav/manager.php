<?php

use yii\helpers\Url;
use common\helpers\ThemeHelper;
use common\helpers\DataHelper;
use backend\themes\adminlte\NavAsset;

$bundle=NavAsset::register($this);
?>
<style>
    input{outline:none;}
    .ht_table{border-color:#e2e2e2!important;}
    .ht_table thead{background:#f4f4f4;}
    .ht_table tr{border-color:#e2e2e2!important;}
    .ht_table th{text-align: center;vertical-align: middle!important;border-color:#e2e2e2!important;}
    .ht_table td{text-align: center;vertical-align: middle!important;border-color:#e2e2e2!important;}
    .ht_select{padding:5px;width:90px;height:32px;}
    .table_navName{padding:0 20px 0 50px!important;position:relative;text-align:start!important;}
    .btn_set{cursor:pointer;}
    .color_light{color:#999;}
    .ico_moreSubNav{width:20px;height:20px;position:absolute;top:18px;left:16px;display:inline-block;vertical-align: middle;text-align: center;cursor:pointer;}
    .subNavTr{display:none;background:#f4f4f4;}
    .subNavTr_sub .table_navName{padding-left:90px!important;}
    .col_1{width:10%;}
    .col_2{width:30%;}
    .col_3{width:20%;}
    .col_4{width:20%;}
    .col_5{width:20%;}
    .Goto_add_box{text-align:right;height: 44px;line-height: 44px;margin-bottom: 15px;margin-top:20px; padding:0 15px 0 0}
    .Goto_add_btn{ display: inline-block;text-align: center;width: 200px;color: #fff;background: #3498DB;border-color: #3498DB;}
    .Goto_add_btn:hover{color:#fff;background:#56abe4}
    .Goto_add_ico{ display: inline-block; margin-right: 10px;width: 26px;height: 26px;border-radius: 50%; text-align: center; line-height: 26px;background: #ffff;background: rgba(255,255,255,.3);filter: Alpha(opacity=30);font-size: 16px;font-weight: 600;}
    .btn:focus{color:#fff!important;}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box style_box1">
            <div class=" box-header with-border">
                <label>导航栏列表</label>
            </div>
            <table class="table table-bordered ht_table">
                <colgroup>
                        <col class="col_1" >
                        <col class="col_2" >
                        <col class="col_3" >
                        <col class="col_4" >
                        <col class="col_5" >
                <colgroup>
                       
                <!--title-row-->
                <thead>
                <tr>
                    <th>#</th>
                    <th>栏目名称</th>
                    <th>显示状态</th>
                    <th>所属模块</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <?php if(!empty($navs)){
                	foreach ($navs as $key=>$nav){
                ?>
                		<tr class="navTr">
                		<th scope="row"><?= $key+1 ?></th>
                		<td class="table_navName">
                		<?php if(isset($nav['sub'])){?>
                		<i class="ico_moreSubNav glyphicon glyphicon-triangle-right"></i>
                		<?php }?>
                		<?= $nav['name']?>
                		</td>
                		<td>
                		<select class="ht_select">
                		<option>显示</option>
                		<option>不显示</option>
                		</select>
                		</td>
                		<td class="color_light"><?= DataHelper::getValue(DataHelper::getNavTypeNames(), $nav['type'])?></td>

                        <td >
                        <?php if($nav['type']!='3001'){?>
                		    <a href="<?= DataHelper::getManagerUrl($nav['type'],$nav['ext_id'],$nav['id']) ?>" class="btn_set" ">设置</a></td>
                		<?php }?>
                		</tr>
               <?php if(isset($nav['sub'])){
               		foreach ($nav['sub'] as $s=>$sub){
               ?>
               	<tr class="subNavTr">
                    <td scope="row"></td>
                    <td class="table_navName">
                        <img src="<?= $bundle->baseUrl ?>/img/img_column.gif">
                        		<?= $sub['name'] ?>
                    </td>
                    <td>
                    </td>
                    <td class="color_light"><?= DataHelper::getValue(DataHelper::getNavTypeNames(), $sub['type'])?></td>
                    <td >
                    <?php if($sub['type']!='3001'){?>
                        <a  class="btn_set" href="<?= DataHelper::getManagerUrl($sub['type'],$sub['ext_id'],$sub['id']) ?>" ext="<?= $nav['ext_id'] ?>" >设置</a></td>
                	<?php }?>	
                </tr>
                <?php if(isset($sub['sub'])){
                	foreach ($sub['sub'] as $sub_thr){
                	?>
                	<tr class="subNavTr subNavTr_sub">
                    <td scope="row"></td>
                    <td class="table_navName">
                        <img src="<?= $bundle->baseUrl ?>/img/img_column.gif">
                    	<?= $sub_thr['name'] ?>
                    </td>
                    <td>
                    </td>
                    <td class="color_light"><?= DataHelper::getValue(DataHelper::getNavTypeNames(), $sub_thr['type'])?></td>
                    <td >
                    <?php if($sub_thr['type']!='3001'){?>

                        <a class="btn_set" href="<?= DataHelper::getManagerUrl($sub['type'],$sub['ext_id'],$sub['id']) ?>" ext="<?= $nav['ext_id'] ?>">设置</a>

                    </td>
                    <?php }?>
                </tr>
                <?php }}}}}}?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <p class="Goto_add_box" ><a href="<?php echo Url::toRoute(['nav/index'])?>" class="btn Goto_add_btn "><i class="Goto_add_ico">Go</i>配置导航栏</a></p>
</div>

