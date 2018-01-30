<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
?>
    <div class="userInfo_bx">
        <?php $form = ActiveForm::begin(['id'=>'user-info','action'=>Url::to(['auth/detail']),
            'options'=>['class'=>'frame_form','enctype' => 'multipart/form-data'],
            'fieldConfig'=>[
                'template'=> "<div class='row_df'>"."{label}{input}{hint}\n"."</div>",
                'labelOptions'=>['class'=>'label_df'],
            ]
        ]); ?>
        <?= $form->field($model, 'nickname')->textInput(['autofocus' => true, 'id'=>'nickname','class'=>'input_df'])->label('昵称') ?>
        <?= $form->field($model, 'fullname')->textInput(['autofocus' => true, 'id'=>'fullname','class'=>'input_df'])->label('姓名') ?>
        <?= $form->field($model, 'sex')->dropDownList(['男','女'],['prompt'=>'','class'=>'select_sex'])->label('性别') ?>
        <div class="row_df" id="birthday">
            <label class="label_df">生日</label>

            <select class="select_year" name="year" id="sel1">
                <option value=""><?= isset($birthday[0])?$birthday[0]:''?></option>
            </select>
            <select  class="select_month" name="month" id="sel2">
                <option value=""><?= isset($birthday[0])?$birthday[1]:''?></option>
            </select>
            <select  class="select_day" name="day" id="sel3">
                <option value=""><?= isset($birthday[0])?$birthday[2]:''?></option>
            </select>
        </div>
        <div class="row_df">
            <label class="label_df">头像</label>
            <i class="upload_case"><img id="preview"  src="<?= \common\helpers\DataHelper::getUserAvatar($model->avatar)?>"/></i>
            <i class="upload_action">
                <em class="btn_upload">
                    <input id="btn_upload_hide" type="file" name="avatar" placeholder="" onchange="javascript:setImagePreview();">
                    <label  class=" btn_upload_visible noneSelect" for="btn_upload_hide">上传头像</label>
                </em>
                <span class="txt_df">jpg或png，大小不超过2M</span>
            </i>
        </div>

        <button class="btn_submit btn_df" type="submit">保存</button>
        <?php ActiveForm::end(); ?>
    </div>
<script>
    function setImagePreview(avalue) {
        var docObj=document.getElementById("btn_upload_hide");
        var imgObjPreview=document.getElementById("preview");
        if(docObj.files &&docObj.files[0])
        {
        //火狐下，直接设img属性
                    imgObjPreview.style.display = 'block';
                    imgObjPreview.style.width = '150px';
                    imgObjPreview.style.height = '180px';
        //imgObjPreview.src = docObj.files[0].getAsDataURL();

        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        }
        return true;
    }
    //生成日期
    function creatDate()
    {
        var y = new Date().getFullYear();
        //生成1900年-2100年
        for(var i = y; i >= y-100; i--)
        {
            //创建select项
            var option = document.createElement('option');
            option.setAttribute('value',i);
            option.innerHTML = i;
            sel1.appendChild(option);
        }
        //生成1月-12月
        for(var i = 1; i <=12; i++){
            var option1 = document.createElement('option');
            option1.setAttribute('value',i);
            option1.innerHTML = i;
            sel2.appendChild(option1);
        }
        //生成1日—31日
        for(var i = 1; i <=31; i++){
            var option2 = document.createElement('option');
            option2.setAttribute('value',i);
            option2.innerHTML = i;
            sel3.appendChild(option2);
        }
    }
    creatDate();
    //保存某年某月的天数
    var days;

    //年份点击 绑定函数
    sel1.onclick = function()
    {
        //月份显示默认值
        sel2.options[0].selected = true;
        //天数显示默认值
        sel3.options[0].selected = true;
    }
    //月份点击 绑定函数
    sel2.onclick = function()
    {
        //天数显示默认值
        sel3.options[0].selected = true;
        //计算天数的显示范围
        //如果是2月
        if(sel2.value == 2)
        {
            //判断闰年
            if((sel1.value % 4 === 0 && sel1.value % 100 !== 0) || sel1.value % 400 === 0)
            {
                days = 29;
            }
            else
            {
                days = 28;
            }
            //判断小月
        }else if(sel2.value == 4 || sel2.value == 6 ||sel2.value == 9 ||sel2.value == 11){
            days = 30;
        }else{
            days = 31;
        }

        //增加或删除天数
        //如果是28天，则删除29、30、31天(即使他们不存在也不报错)
        if(days == 28){
            sel3.remove(31);
            sel3.remove(30);
            sel3.remove(29);
        }
        //如果是29天
        if(days == 29){
            sel3.remove(31);
            sel3.remove(30);
            //如果第29天不存在，则添加第29天
            if(!sel3.options[29]){
                sel3.add(new Option('29','29'),null)
            }
        }
        //如果是30天
        if(days == 30){
            sel3.remove(31);
            //如果第29天不存在，则添加第29天
            if(!sel3.options[29]){
                sel3.add(new Option('29','29'),null)
            }
            //如果第30天不存在，则添加第30天
            if(!sel3.options[30]){
                sel3.add(new Option('30','30'),null)
            }
        }
        //如果是31天
        if(days == 31){
            //如果第29天不存在，则添加第29天
            if(!sel3.options[29])
            {
                sel3.add(new Option('29','29'),null)
            }
            //如果第30天不存在，则添加第30天
            if(!sel3.options[30])
            {
                sel3.add(new Option('30','30'),null)
            }
            //如果第31天不存在，则添加第31天
            if(!sel3.options[31])
            {
                sel3.add(new Option('31','31'),null)
            }
        }
    }
</script>

