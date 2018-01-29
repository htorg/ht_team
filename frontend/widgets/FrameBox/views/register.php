<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php if (Yii::$app->user->isGuest){?>
    <?php $form = ActiveForm::begin(['id'=>'register_message','action'=>Url::to(['auth/signup']),
        'options'=>['class'=>'frame_form'],
        'fieldConfig'=>[
            'template'=> "{input}{hint}\n{error}",
        ],
        'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['auth/register-validate']),     //数据异步校验
    ]); ?>
        <!--frame_register_message-->
        <div class="frame_register_message  frame_bx " style="display:none">
            <i class="iconfont delete_df btn_df noneSelect"></i>
            <img class="logo_df" src="<?= \Yii::getAlias('@web')?>/img/frame_logo.png">
                <div class="frame_form">
                    <p class="error_block" style="color: red;font-size: 14px;"><?= Yii::$app->session->getFlash('register_message_info')?></p>
                    <div class="input_bx">
                        <i class="ico_number"></i>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'id'=>'cellphone','class'=> 'writeIn', 'placeholder'=>"请输入手机号"]) ?>
                    </div>
                    <div class="verify_code">
                        <div class="input_bx">
                            <i class="ico_code"></i>
                            <input class="writeIn" id="verifyCode" name="verifyCode" type="text" placeholder="验证码">
                        </div>
                        <button class="getVerify_btn btn_df" type="button" >获取短信验证码</button>
                    </div>

                    <div class="check_bx">
                        <input id="sigIn_protocol" type="checkbox" >
                        <label class="sigIn_protocol_label noneSelect " for="sigIn_protocol"></label>
                        <span class="words_df noneSelect">我已阅读并同意<a class="btn_df">《新物种用户注册协议》<a></a></span>
                    </div>
                    <span id="register-step" class="btn_df frame_btn noneSelect">注册</span>
                </div>
        </div>
        <!--frame_register_account-->
        <div class="frame_register_account  frame_bx " style="display:none">
            <i class="iconfont delete_df btn_df noneSelect"></i>
            <img class="logo_df" src="<?= \Yii::getAlias('@web')?>/img/frame_logo.png">
            <div class="frame_form">
                <p class="error_block" style="color: red;font-size: 14px;"><?= Yii::$app->session->getFlash('register_message_info')?></p>
                <div class="input_bx">
                    <i class="ico_account"></i>
                    <?= $form->field($model, 'nickname')->textInput(['autofocus' => true,'class'=> 'writeIn', 'placeholder'=>"昵称"]) ?>
                </div>

                <div class="input_bx">
                    <i class="ico_password"></i>
                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'class'=> 'writeIn', 'placeholder'=>"设置密码"]) ?>
                </div>

                <div class="input_bx again_input">
                    <i class="ico_password"></i>
                    <?= $form->field($model, 'verifyPassword')->passwordInput(['autofocus' => true,'class'=> 'writeIn', 'placeholder'=>"确认密码"]) ?>
                </div>
                <button type="submit" class="btn_df frame_btn noneSelect">完成</button>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
<?php }?>
<?php $this->beginBlock('test') ?>
    var leftTime = 60;
    var timer = null;
    $('#register_message').find('.getVerify_btn').click(function(){
        var url = "<?= Url::to(['auth/get-cmscode'])?>";
        var phone = $('#register_message').find('#cellphone').val();
        if(checkPhone(phone)==false){
            return false;
        };
        $.post(
            url,
            {phone:phone},
            function(data){
                console.log(data);
                if(data.c==0){
                    $('#register_message').find('.getVerify_btn').attr('disabled',true);
                    timer = window.setInterval('minusTime();',1000);
                    $('#register_message').find('.error_block').text(data.msg);
                }else if(data.c=='-1'||data.c=='-3'){
                    $('#register_message').find('.error_block').text(data.msg);
                }else{
                    $('#register_message').find('.error_block').text(data.code);
                    leftTime = data.leftTime;
                    timer = window.setInterval('minusTime();',1000);
                }
            },
            'json'
        )
    });
    $('#register-step').click(function(){
        var phone = $('#register_message').find('#cellphone').val();
            if(checkPhone(phone)==false){
            return false;
        };
        if($('#verifyCode').val()==''){
            $('#register_message').find('.error_block').text('验证码不能为空');
            return false;
        }
        var url="<?= Url::to(['auth/check-verify'])?>";
        $.post(
            url,
            {phone:phone,verifyCode:$('#verifyCode').val()},
            function(data){
                console.log(data);
                if(data.c==0){
                    location.reload();
                }else{
                    $('#register_message').find('.error_block').text(data.msg);
                }
            },
            'json'
        )

    })
    function minusTime()
    {
        if (leftTime > 0)
        {
            leftTime--;
            $('#register_message').find('.getVerify_btn').text(leftTime);
        }
        else
        {
            $('#register_message').find('.error_block').text('');
            $('#register_message').find('.getVerify_btn').removeAttr('disabled');
            $('#register_message').find('.getVerify_btn').text('发送手机验证码');
            window.clearTimeout(timer);
        }
    }

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
