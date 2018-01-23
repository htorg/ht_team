/**
 * Created by htshen on 2017/6/30.
 */
//*******************animate ****************

$(window).ready(function () {
    var winScrollHeight = $(window).scrollTop();
    var winView = $(window).height();
    var winScale = $(window).width()/1920;

    function scrollDisplay(objectName, className) {
        objectName.each(function () {
            if ($(this) && $(this).offset()) {
                winScrollHeight = $(window).scrollTop();
              
                if ($(this).offset().top * winScale < (winScrollHeight + 4 * winView / 5 ) && ($(this).offset().top * winScale > (winScrollHeight - $(this).innerHeight() + winView / 8))) {
                    $(this).addClass(className);
                }
            }
        });
    }
    // function scrollDisplay_repeat(objectName, className) {
    //     objectName.each(function () {
    //         if ($(this) && $(this).offset()) {
    //             winScrollHeight = $(window).scrollTop();
    //             if ($(this).offset().top < (winScrollHeight + winView ) && ($(this).offset().top > (winScrollHeight - $(this).innerHeight()  ))) {
    //                 $(this).addClass(className);
    //             }
    //             else{
    //                 $(this).removeClass(className);
    //             }
    //         }
    //     });
    // }

    var objectTaget = $('.tag_down ');
    var objectTaget2 = $('.tag_down2 ');
    var objectUp = $('.tag_up ');
    var objectLeft = $('.tag_left ');
    var objectLeft2 = $('.tag_left2 ');
    var objectRight = $('.tag_right ');
    var objectRight2 = $('.tag_right2 ');
    var objectRotate = $('.tag_rotate ');
    var objectFade = $('.tag_fade ');

//init
//objectBanner
    scrollDisplay(objectTaget, 'eft_downLoad');
    scrollDisplay(objectTaget2, 'eft_downLoad2');
    scrollDisplay(objectUp, 'eft_upLoad');
    scrollDisplay(objectLeft, 'eft_left');
    scrollDisplay(objectLeft2, 'eft_left2');
    scrollDisplay(objectRight, 'eft_right');
    scrollDisplay(objectRight2, 'eft_right2');
    scrollDisplay(objectRotate, 'effect_rotateBig');
    scrollDisplay(objectFade, 'effect_fade');


    $(window).scroll(function (event) {
        scrollDisplay(objectTaget, 'eft_downLoad');
        scrollDisplay(objectTaget2, 'eft_downLoad2');
        scrollDisplay(objectUp, 'eft_upLoad');
        scrollDisplay(objectLeft, 'eft_left');
        scrollDisplay(objectLeft2, 'eft_left2');
        scrollDisplay(objectRight, 'eft_right');
        scrollDisplay(objectRight2, 'eft_right2');
        scrollDisplay(objectRotate, 'effect_rotateBig');
        scrollDisplay(objectFade, 'effect_fade');

    });
});

// $(window).unload(function(){
//     $(window).scrollTop(0);
// });



//*********************************
