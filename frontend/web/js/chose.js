function setNav(rel) {
    $('.nav_item').each(function(){
        console.log($(this).attr('rel'));
        if ($(this).attr('rel')==rel){
            $(this).addClass('nav_item_on')
        }
    })
    console.log('----');
    console.log(rel);
    $('.item_df').each(function(){
        if ($(this).attr('rel')==rel){
            $(this).addClass('check_on_df')
        }
    })
}