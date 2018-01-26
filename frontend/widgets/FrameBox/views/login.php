<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--frame_signIn-->
<div class="frame_signIn  frame_bx " style="display:none;">
    <i class="iconfont delete_df btn_df noneSelect">&#xe625;</i>
    <img class="logo_df" src="<?= $url; ?>/img/frame_logo.png">
    <?php $form = ActiveForm::begin(['id'=>'resume_baic','class'=>'frame_form','action'=>Url::to(['user/resume-create']),
        'fieldConfig'=>[
            'template'=> "{input}{hint}\n{error}",
            'inputOptions'=>['class'=>'input_ful'],
            'errorOptions'=>['style'=>'font-size:14px;color:#fe2d4a;margin-top:0;margin-bottom:0']
        ]
    ]); ?>
        <div class="input_bx">
            <i class="ico_account"></i>
            <input class="writeIn" type="text" placeholder="用户名">
        </div>
        <div class="input_bx">
            <i class="ico_password"></i>
            <input class="writeIn" type="password" placeholder="登录密码">
        </div>
        <p class="btn_row">
            <a class="btn_df" href="#">立即注册</a>|<a class="btn_df" href="#">忘记密码</a>
        </p>

        <a class="btn_df frame_btn noneSelect">登录</a>
    <?php ActiveForm::end(); ?>
</div>