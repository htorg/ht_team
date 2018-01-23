/**
 * Created by htshen on 2017/8/7.
 */
//menu click
function setNavActive(rel)
    {
        $('.nav_item').each(function(){
            if ($(this).attr('rel') == rel)
            {
                $(this).css('color','#fff');
            }
        });
    }
$(window).ready(function(){
    $('#menu_btn').click(function(){
        $('.flex-frame').addClass("page_close");
        $('.mb_nav_page').addClass("mbNav_open");
    });
    $('#cancle_btn').click(function(){
        $('.flex-frame').removeClass("page_close");
        $('.mb_nav_page').removeClass("mbNav_open");
     
    });


    //news_tab

    $('.service_tab').find('.btn_df').click(function(){
        var tab_index=$(this).index();
        $('.service_tab').find('.btn_df').attr('class','btn_df');
        $(this).addClass('btn-color'+tab_index);
        $('.tab_service_des').eq(tab_index).show().siblings('.tab_service_des').hide();
    });
 
    
    //阻止冒泡
    // $(".list_subNav ").find('.btn_more').mousedown(function(event){
    //     event.stopPropagation();
    // });
    //

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

           var oHtml = $("html");
           var oBody = $("body");
            oHtml.height(valueHeight);
            oBody.height(valueHeight);
            oHtml.width(valueWidth);
            oBody.width(valueWidth);


            // solve ie
            // var domHtml = document.getElementById("body_wrap");

            // domHtml.style.width = bodyWidth;
            // domHtml.style.height = domFlex.clientHeight+"px";
            // domHtml.style.overflow = "hidden";
            // console.log("width:" + bodyWidth);
            // console.log("height:" + domFlex.clientHeight)
            // // //ie8
            // var browser=navigator.appName;
            // var b_version=navigator.appVersion;
            // var version=b_version.split(";");
            // var trim_Version=version[1].replace(/[ ]/g,"");
            // if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE8.0")
            // {
            //        domFlex.style.zoom = scaleValue;

            // }



        }

    }

    flex();

    $(window).resize(function(){
        flex();
    });




});
