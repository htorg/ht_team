/**
 * Created by htshen on 2017/8/7.
 */
//menu click
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
    $(".service_tab").find(".btn_df").click(function(){
        var tab_index = $(this).index();
        if (tab_index == '0' ){
            $(this).addClass("afterSale_service");
            $(this).siblings().removeClass('tab_faq');
            $(".afterSale_describe").show();
            $(".faq_describe").hide();

        }
        else if(tab_index =='1'){
            $(this).siblings().removeClass('afterSale_service')
            $(this).addClass("tab_faq");
            $(".afterSale_describe").hide();
            $(".faq_describe").show();

        }
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
            domFlex.style.webkitTransform = "scale("+scaleValue+")";
            domFlex.style.msTransform = "scale("+scaleValue+")";
            // //ie8
            // var browser=navigator.appName;
            // var b_version=navigator.appVersion;
            // var version=b_version.split(";");
            // var trim_Version=version[1].replace(/[ ]/g,"");
            // if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE8.0")
            // {
            //     domFlex.style.zoom=bodyWidth/1920;
            //     alert("IE8")
            // }



        }

    }

    flex();

    $(window).resize(function(){
        flex();
    });




});
