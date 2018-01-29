<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php if (Yii::$app->user->isGuest){?>
    <?php $form = ActiveForm::begin(['id'=>'frame_forget_form','action'=>Url::to(['auth/signup']),
        'options'=>['class'=>'frame_form'],
        'fieldConfig'=>[
            'template'=> "{input}{hint}\n{error}",
        ]
        ]); ?>
        <!--frame_register_message-->
        <div class="frame_forget  frame_bx " style="display:none">
            <i class=" delete_df btn_df noneSelect"></i>
            <img class="logo_df" src="img/frame_logo.png">
            <p class="error_block" style="color: red;font-size: 14px;"><?= Yii::$app->session->getFlash('register_message_info')?></p>
            <div class="frame_form">
                <div class="input_bx">
                    <i class="ico_number"></i>
                    <input class="writeIn" type="text" name="username" id="frame_forget_username" placeholder="手机号">
                </div>
                <p class="error-help"></p>
                <div class="verify_code">
                    <div class="input_bx">
                        <i class="ico_code"></i>
                        <input class="writeIn" type="text" id="frame_forget_verifyCode" name="verifyCode" placeholder="验证码">
                    </div>
                    <button class="getVerify_btn btn_df" type="button" >获取短信验证码</button>
                </div>
                <span id="frame_forget_next" class="btn_df frame_btn noneSelect">重置密码</span>
            </div>
        </div>
        <!--frame_register_account-->
        <div class="frame_register_account  frame_bx " style="display:none">
            <i class="iconfont delete_df btn_df noneSelect"></i>
            <img class="logo_df" src="<?= \Yii::getAlias('@web')?>/img/frame_logo.png">
            <p class="error_block" style="color: red;font-size: 14px;"></p>
            <div class="frame_form">
                <p class="error_block" style="color: red;font-size: 14px;"><?= Yii::$app->session->getFlash('register_message_info')?></p>
                <div class="input_bx">
                    <i class="ico_account"></i>
                    <input class="writeIn" type="password" id="frame_forget_oldPassword" name="oldPassword" placeholder="原密码">
                </div>
                <p class="error-help"></p>
                <div class="input_bx">
                    <i class="ico_password"></i>
                    <input class="writeIn" type="password" id="frame_forget_password" name="password" placeholder="新密码">
                </div>
                <p class="error-help"></p>
                <div class="input_bx again_input">
                    <i class="ico_password"></i>
                    <input class="writeIn" type="password" id="frame_forget_verifyPassword" name="verifyPassword" placeholder="确认密码">
                </div>
                <p class="error-help"></p>
                <span id="frame_forget_submit" class="btn_df frame_btn noneSelect">完成</span>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
<?php }?>
<?php $this->beginBlock('test') ?>
    var leftTimeForget = 60;
    var timerForget = null;
    $('.frame_forget').find('.getVerify_btn').click(function(){
        var url = "<?= Url::to(['auth/get-forget-code'])?>";
        var phone = $('.frame_forget').find('#frame_forget_username').val();
        if(checkPhone(phone,$('#frame_forget_username'))==false){
            return false;
        };
        $.post(
            url,
            {phone:phone},
            function(data){
                if(data.c==0){
                    $('.frame_forget').find('.getVerify_btn').attr('disabled',true);
                    timerForget = window.setInterval('minusTimeForget();',1000);
                    $('.frame_forget').find('.error_block').text(data.msg);
                }else if(data.c=='-1'||data.c=='-3'){
                    $('.frame_forget').find('.error_block').text(data.msg);
                }else{
                    $('.frame_forget').find('.error_block').text('你的验证码为：'+data.code);
                    leftTimeForget = data.leftTime;
                    timerForget = window.setInterval('minusTimeForget();',1000);
                }
            },
            'json'
        )
    });
    $('#frame_forget_next').click(function(){
        var phone = $('.frame_forget').find('#frame_forget_username').val();
        if(checkPhone(phone,$('#frame_forget_username'))==false){
            return false;
        };
        if($('#frame_forget_verifyCode').val()==''){
            $('#frame_forget').find('.error_block').text('验证码不能为空');
            return false;
        }
        var url="<?= Url::to(['auth/check-verify'])?>";
        $.post(
            url,
            {phone:phone,verifyCode:$('#frame_forget_verifyCode').val(),name:'forgetCode_'},
            function(data){
                console.log(data);
                if(data.c==0){
                    $('#frame_forget_form').find('.frame_forget').hide();
                    $('#frame_forget_form').find('.frame_register_account').show();
                }else{
                    $('.frame_forget').find('.error_block').text(data.msg+phone);
                }
            },
            'json'
        )

    })
    $('#frame_forget_submit').click(function(){
        checkPassword($('#frame_forget_oldPassword').val(),$('#frame_forget_oldPassword'));
        checkPassword($('#frame_forget_password').val(),$('#frame_forget_password'));
        checkPassword($('#frame_forget_verifyPassword').val(),$('#frame_forget_verifyPassword'));
        if($('#frame_forget_verifyPassword').val()!=$('#frame_forget_password').val()){
            $('.frame_register_account').find('.error_block').text('两次输入的密码不一致');
            return false;
        }
        $.post(
            "<?= Url::to(['auth/reset'])?>",
            $('#frame_forget_form').serialize(),
            function(data){
            console.log(data);
            if(data.c==0){
                window.location.reload();
            }else{
                $('.frame_register_account').find('.error_block').text(data.msg);
            }
            },
            'json'
        )
    })
    function minusTimeForget()
    {
        if (leftTimeForget > 0)
        {
            leftTimeForget--;
            $('.frame_forget').find('.getVerify_btn').text(leftTimeForget);
        }
        else
        {
            $('.frame_forget').find('.error_block').text('');
            $('.frame_forget').find('.getVerify_btn').removeAttr('disabled');
            $('.frame_forget').find('.getVerify_btn').text('发送手机验证码');
            window.clearTimeout(timerForget);
        }
    }


<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
