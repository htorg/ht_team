/**
 * Created by htshen on 2017/8/7.
 */
//menu click
$(window).ready(function(){

    // center-frame
    var winH = $(window).height();
    $(".center-frame").css('minHeight',winH);
    //flex
    function flex(){
        var domFlex = document.getElementsByClassName("flex-frame")[0];

        var bodyWidth = document.documentElement.clientWidth;
        var scaleValue = bodyWidth/1920;
        if(scaleValue < 1){
            domFlex.style.webkitTransform = "scale("+scaleValue+")" ;
            domFlex.style.msTransform = "scale("+scaleValue+")";
            domFlex.style.transform = "scale("+scaleValue+")";

            var valueHeight =  domFlex.clientHeight  * scaleValue ;
            var valueWidth =   domFlex.clientWidth  * scaleValue ;

            // var oHtml = $("html");
            // var oBody = $("body");
            // oHtml.height(valueHeight);
            // oBody.height(valueHeight);
            // oHtml.width(valueWidth);
            // oBody.width(valueWidth);
        }

    }

    flex();

    $(window).resize(function(){
        flex();
    });
});
