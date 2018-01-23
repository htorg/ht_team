/**
 * Created by htshen on 2017/3/3.
 */
$(document).ready(function(){
    $('.ft_news_slider').bxSlider({
        mode: 'horizontal',
        hideControlOnEnd: true,
        slideMargin: 0,
        controls:false,
        infiniteLoop: true,
        pager:false,
        captions:true,
        minSlides: 4,
        maxSlides: 4,
        speed: 80000,
        startSlides: 0,
        slideWidth: 528,
        responsive: false,
        ticker: true
    });


    var tagSlider =0;
    var oSlider_btn = $(".funSlider_btn_bar ").find('button.funSlider_btn');
    var oSlider  = $('.funSlider').bxSlider({
        slideMargin: 0,
        controls:true,
        infiniteLoop: true,
        pager:false,
        responsive: false,
        speed: 800,
        auto: false,
        onSlideNext:function(){
            tagSlider++;
            if(tagSlider >=3 ){
                tagSlider= 0;
            }

        },
        onSlidePrev:function(){
            tagSlider--;
            if(tagSlider < 0 ){
                tagSlider= 2
            }


        },
        onSlideAfter: function(){
            var  currentG = oSlider.getCurrentSlide();

            if( currentG == tagSlider)
            {}
            else{
                oSlider.goToSlide(tagSlider);
            }
        }
    });

    oSlider_btn.hover(function(){
        tagSlider = ($(this).index());
        setTimeout(function () {
            oSlider.goToSlide(tagSlider)
        },200);
    });

    $('.news_banner_slider').bxSlider({
        mode: 'horizontal',
        infiniteLoop: true,
        pager:true,
        auto: true,
        controls:false,
        responsive: false,
        // slideWidth:1920,
        speed: 1500
    });

});

