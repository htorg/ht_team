/**
 * Created by htshen on 2017/8/7.
 */
//menu click
$(window).ready(function(){
    $('#menu_btn').click(function(){
        $('.flex-frame').toggleClass("page_close");
        $('.mb_nav_page').toggleClass("mbNav_open");
        $('.mask_layout ').fadeToggle('fast');
        navMask();
    });
    $('.subNav_list ').find('.item_title').click(function(){
        $(this).next('.ph_subNav_subBar ').slideToggle();
    });


    function navMask(){
        console.log('a')
        if($('.mb_nav_page').hasClass('mbNav_open')){
            unScroll();
        }
        else{
            removeUnScroll();
        }
    }
    function unScroll() {
        var top = $(document).scrollTop();
        $(document).on('scroll.unable',function (e) {
            $(document).scrollTop(top);
        })
    }

    function removeUnScroll() {
        $(document).unbind("scroll.unable");
    }

    //
    $('.garden_bar').find('.item_df').click(function(){
        var varIndex = $(this).parent('li').index();
        var varHeight = $('.garden_ctt li').eq(varIndex).offset().top - 90;
        $('html').animate({scrollTop:varHeight},'slow');
    })

    //process tab
    $('.do_guide').find('.tab_df').click(function(){
        if(!$(this).hasClass('tab_on')){
            $(this).siblings('.tab_on').removeClass('tab_on');
            $(this).addClass('tab_on');
            var tabIndex = $(this).index();
            console.log(tabIndex)
            var oNotice = $('.do_guide').find('.notice_box');
            var odown = $('.do_guide').find('.down_box');
            switch(tabIndex){
                case 0:
                    oNotice.show();
                    odown.hide();
                    break;
                case 1:
                    odown.show();
                    oNotice.hide();
                    break;
                default:
                    break;
            }
        }
    });

    //vertical-align

    function objectMiddle(){
        if($(window).width() >= 768){
            var tagDes = $('.national_level  .des_df');
            var tagVer = tagDes.siblings('i');
            var tagVerH = tagDes.innerHeight();
            tagVer.height(tagVerH);


            var tagPro = $('.provincial_level');
            var tagProImg = $('.provincial_level .img_df');
            var tagProH = tagPro.height();
            var tagProImgH = tagProImg.height();

            tagProImg.css({'marginTop': Math.abs(tagProH - tagProImgH)/2})
        }

    }
    objectMiddle();
    $(window).resize(function(){
        objectMiddle();
    })
});
