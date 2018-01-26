<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<?php $form = ActiveForm::begin(['class'=>'frame_form','action'=>Url::to(['user/resume-create']),
    'fieldConfig'=>[
        'template'=> "{input}{hint}\n{error}",
        'inputOptions'=>['class'=>'input_ful'],
        'errorOptions'=>['style'=>'font-size:14px;color:#fe2d4a;margin-top:0;margin-bottom:0']
    ]
]); ?>
    <!--frame_register_message-->
    <div class="frame_register_message  frame_bx "  style="display:none;" >
        <i class="iconfont delete_df btn_df noneSelect">&#xe625;</i>
        <img class="logo_df" src="<?= $url; ?>/img/frame_logo.png">
            <div class="input_bx">
                <i class="ico_number"></i>
                <input class="writeIn" type="text" placeholder="手机号">
            </div>

            <div class="verify_code">
                <div class="input_bx">
                    <i class="ico_code"></i>
                    <input class="writeIn" type="text" placeholder="验证码">
                </div>
                <button class="getVerify_btn btn_df" type="button" >获取短信验证码</button>
            </div>

            <div class="check_bx">
                <input id="sigIn_protocol" type="checkbox" >
                <label class="sigIn_protocol_label noneSelect " for="sigIn_protocol"></label>
                <span class="words_df noneSelect">我已阅读并同意<a class="btn_df">《新物种用户注册协议》<a></a></span>
            </div>

            <span class="btn_df frame_btn noneSelect">注册</span>
    </div>

    <!--frame_register_account-->
    <div class="frame_register_account  frame_bx " style="display:none;">
        <i class="iconfont delete_df btn_df noneSelect">&#xe625;</i>
        <img class="logo_df" src="<?php echo Yii::$app->request->baseUrl; ?>/themes/t00001/dist/img/frame_logo.png">
            <div class="input_bx">
                <i class="ico_account"></i>
                <input class="writeIn" type="text" placeholder="昵称">
            </div>

            <div class="input_bx">
                <i class="ico_password"></i>
                <input class="writeIn" type="password" placeholder="设置密码">
            </div>

            <div class="input_bx again_input">
                <i class="ico_password"></i>
                <input class="writeIn" type="password" placeholder="确认密码">
            </div>
            <a class="btn_df frame_btn noneSelect">完成</a>
    </div>
<?php ActiveForm::end(); ?>