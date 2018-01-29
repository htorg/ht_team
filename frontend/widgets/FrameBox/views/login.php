<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--frame_signIn-->
<div class="frame_signIn  frame_bx " style="display:none;">
    <i class=" delete_df btn_df noneSelect"></i>
    <img class="logo_df" src="<?= \Yii::getAlias('@web')?>/img/frame_logo.png">
    <p class="frame_signIn_error_block"></p>
    <?php $form = ActiveForm::begin(['id'=>'frame_signIn_form','action'=>Url::to(['auth/login']),
        'options'=>['class'=>'frame_form'],
    ]); ?>
        <div class="input_bx">
            <i class="ico_account"></i>
            <input class="writeIn" name="username" id="frame_signIn_username" type="text" placeholder="用户名">
        </div>
        <p class="error-help"></p>
        <div class="input_bx">
            <i class="ico_password"></i>
            <input class="writeIn" type="password" name="password" id="frame_signIn_password" placeholder="登录密码">
        </div>
        <p class="btn_row">
            <span class="btn_df" id="frame_signIn_register">立即注册</span>|<span class="btn_df" id="frame_signIn_reset">忘记密码</span>
        </p>
        <span id="frame_signIn_submit" class="btn_df frame_btn noneSelect">登录</span>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->beginBlock('test') ?>
$('#frame_signIn_submit').click(function(){
    checkPhone($(this).val(),$('#frame_signIn_username'));
    var url = "<?= Url::to(['auth/login'])?>"
    $.post(
        url,
        $('#frame_signIn_form').serialize(),
        function(data){
            if(data.c==0){
                location.reload();
            }else{
                $('.frame_signIn_error_block').text(data.msg);
            }
            console.log(data);
        },
        'json'
    )
})


<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
