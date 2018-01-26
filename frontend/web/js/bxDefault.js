/**
 * Created by htshen on 2017/3/3.
 */
$(document).ready(function(){

    $('.banner_slider').bxSlider({
        mode: 'horizontal',
        hideControlOnEnd: true,
        slideMargin: 0,
        autoDelay:500,
        speed:1000,
        pause:7000,
        controls:true,
        infiniteLoop: true,
        pager:true,
        auto: true
    });

    $('.advertise_slider').bxSlider({
        slideWidth:350,
        mode: 'horizontal',
        slideMargin: 0,
        autoDelay:500,
        speed:1000,
        controls:false,
        infiniteLoop: true,
        pager:true,
        auto: true
    });
    //double slider
    var slider_sv =  $('.sv_slider'); //small
    var slider_big =   $('.big_slider'); //big
    var slider_current = 0;

    slider_sv.bxSlider({
        mode: 'horizontal',
        slideWidth: 186,
        slideMargin: 8,
        autoDelay:2000,
        infiniteLoop: true,
        minSlides: 5,
        maxSlides: 5,
        moveSlides: 1,
        pager:false,
        controls:true,
        nextText: '',
        prevText: '',
        nextSelector: '.sv_next',
        prevSelector: '.sv_pre',
        auto: false
    });

    slider_big.bxSlider({
        mode: 'fade',
        autoDelay:2000,
        infiniteLoop: true,
        minSlides: 1,
        maxSlides: 1,
        moveSlides: 1,
        pager:false,
        controls:false,
        auto: false
    });
    slider_sv.on('click',".img_case",function(){
        var slideIndex =$(this).parent('.slide').index();
        var slideCurrent = slider_sv.getSlideCount()
        var varCompare = 5;
        if( slideCurrent <= 4 ){
            varCompare = slideCurrent;
        }
        else{
            varCompare = 5;
        }
        if(slideIndex +1 <= varCompare){
            slider_current = slideIndex -1 ;
			console.log('c')
        }
        else if(slideIndex +1 > varCompare && slideIndex +1 <= slideCurrent+varCompare){
            slider_current = slideIndex - varCompare ;
            console.log("b")
        }
        else if(slideIndex +1 > slideCurrent +varCompare  && slideIndex +1 <= (slideCurrent + varCompare +  varCompare)){
            slider_current = slideIndex  - varCompare - slideCurrent ;
            console.log("a")
        }
		console.log(slideIndex)
		console.log(slider_current)
        slider_big.goToSlide(slider_current);
        $(this).parent().siblings().children('.img_case_click').removeClass('img_case_click');
        $(this).addClass('img_case_click');
    })
});

