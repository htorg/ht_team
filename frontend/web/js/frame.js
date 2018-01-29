function checkPhone(phone,obj)
{
    if(phone=='')
    {
        obj.parent().next().text('手机号码不能为空');
        return false;
    }else{
        var reg = /^1[3|4|5|7|8][0-9]{9}$/; //验证规则
        var flag = reg.test(phone);
        if(flag==false){
            obj.parent().next().text('手机号码格式不正确');
            return false;
        }
        obj.parent().next().text('');
    }
}
function checkPassword(val,obj)
{
    if(val=='')
    {
        obj.parent().next().text('密码不能为空');
        return false;
    }else{
        if(val.length<6){
            obj.parent().next().text('密码不能少于6位');
            return false;
        }
        obj.parent().next().text('');
    }
}
$(window).ready(function(){
    //用户登录
    $('.login-btn').click(function(){
        $('.mask_layout').show();
        $('.frame_signIn').show();
    })
    $('.register-btn').click(function(){
        $('.mask_layout').show();
        $('.frame_register_message').show();
    })
    $('#frame_signIn_username').blur(function(){
        checkPhone($(this).val(),$(this));
    })
    $('#frame_signIn_register').click(function(){
        $('.frame_signIn').hide();
        $('.frame_register_message').show();
    })
    //忘记密码
    $('#frame_signIn_reset').click(function(){
        $('.frame_signIn').hide();
        $('.frame_forget').show();
    })
    $('#frame_forget_oldPassword').blur(function () {
        checkPassword($(this).val(),$(this));
    })
    $('#frame_forget_password').blur(function () {
        checkPassword($(this).val(),$(this));
    })
    $('#frame_forget_verifyPassword').blur(function () {
        checkPassword($(this).val(),$(this));
    })
    $('.delete_df').click(function(){
        $(this).parent().hide();
        $('.mask_layout').hide();
    })
});
