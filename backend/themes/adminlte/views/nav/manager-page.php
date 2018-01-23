<?php
/**
 * Created by PhpStorm.
 * User: htshen
 * Date: 2017/6/14
 * Time: 11:27
 */

use yii\helpers\Url;
use common\helpers\ThemeHelper;
use common\helpers\DataHelper;
use backend\themes\adminlte\NavAsset;

$bundle=NavAsset::register($this);
?>
<style>
    ul{list-style: none;}
    .manageItem_list{padding:50px 0 20px}
    .manageItem_list li{width:25%;float:left;text-align: center;margin-bottom:50px;}
    .manageItem_case{display:inline-block;width:70px;height:70px;cursor:pointer;overflow:hidden;}
    .managItem_ico{width:100%;}
    .manageItem_title{color:#333;padding-top:5px;cursor:pointer;}
</style>

<div class="row">
    <div class="col-md-12">
        <ul class="manageItem_list">
        <?php if (!empty($navs)){
       		foreach ($navs as $key=>$nav){ 
       ?>
            <li type=<?= $nav ?>><a class="hover_img" href="<?= ThemeHelper::getManagerUrl($nav)?>"><i class=" manageItem_case"><img class="managItem_ico img_effect" src="<?= $bundle->baseUrl ?>/img/ico_set<?= ($key)%7+1 ?>.png"></i><p class="manageItem_title"><?= ThemeHelper::getFeatureNames($nav)?></p></a></li>
        <?php }}?>
        </ul>
    </div>
</div>