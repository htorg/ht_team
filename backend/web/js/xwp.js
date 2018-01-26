var upload=true;
var raply=false;
if($('.file-delete').length>0){
	upload=true;
}
$('.change-type').on('click',function(){
	var id=$(this).attr('rel');
	var type=$(this).attr('type');
	$('#change-type').show();
	$('#user-type-sure').attr('rel',id);
	$('#change-type input[name="type"]').eq(type).attr('checked','checked');
})
$('.user-close').on('click',function(){
	$(this).parent().hide();
})
function setSideBarActive(rel)
{
	$('.sidebar-menu').find('li').each(function(){
		if ($(this).attr('rel') == rel)
		{
			$(this).addClass('active');
		}
	});
}
$('#user-type-sure').on('click',function(){
	var id=$(this).attr('rel');
	var type=$('#change-type input[name="type"]:checked').val();
	var url=$('#change-type').attr('url');
	console.log(url);
	$.post(
			url,
			{
				id:id,
				type:type
			},
			function(data){
				$('#change-type').hide();
				 location.reload() ;
			},
			'json'
	);
})
 
function imgShow(outerdiv, innerdiv, bigimg, _this){  
    var src = _this.attr("src").split('?')[0];//获取当前点击的pimg元素中的src属性  
    $(bigimg).attr("src", src);//设置#bigimg元素的src属性  
  
        /*获取当前点击图片的真实大小，并显示弹出层及大图*/  
    $("<img/>").attr("src", src).load(function(){  
        var windowW = $(window).width();//获取当前窗口宽度  
        var windowH = $(window).height();//获取当前窗口高度  
        var realWidth = this.width;//获取图片真实宽度  
        var realHeight = this.height;//获取图片真实高度  
        var imgWidth, imgHeight;  
        var scale = 0.8;//缩放尺寸，当图片真实宽度和高度大于窗口宽度和高度时进行缩放  
          
        if(realHeight>windowH*scale) {//判断图片高度  
            imgHeight = windowH*scale;//如大于窗口高度，图片高度进行缩放  
            imgWidth = imgHeight/realHeight*realWidth;//等比例缩放宽度  
            if(imgWidth>windowW*scale) {//如宽度扔大于窗口宽度  
                imgWidth = windowW*scale;//再对宽度进行缩放  
            }  
        } else if(realWidth>windowW*scale) {//如图片高度合适，判断图片宽度  
            imgWidth = windowW*scale;//如大于窗口宽度，图片宽度进行缩放  
                        imgHeight = imgWidth/realWidth*realHeight;//等比例缩放高度  
        } else {//如果图片真实高度和宽度都符合要求，高宽不变  
            imgWidth = realWidth;  
            imgHeight = realHeight;  
        }  
                $(bigimg).css("width",imgWidth);//以最终的宽度对图片缩放  
          
        var w = (windowW-imgWidth)/2;//计算图片与窗口左边距  
        var h = (windowH-imgHeight)/2;//计算图片与窗口上边距  
        $(innerdiv).css({"top":h, "left":w});//设置#innerdiv的top和left属性  
        $(outerdiv).fadeIn("fast");//淡入显示#outerdiv及.pimg  
    });  
      
    $(outerdiv).click(function(){//再次点击淡出消失弹出层  
        $(this).fadeOut("fast");  
    });  
}

$('.yanpan-add').on('click',function(){
	$('.write-reply').slideDown();
	$(this).hide();
})
$('#file-add').on('click',function(){
	$('#fileupload').click();
})
$('.raply_sure').on('click',function(){
		var info=$('.reply-font').find('textarea').val();
		var url=$('.raply_sure').attr('url');
		var id=$('.raply_sure').attr('rel');
		var _this=$(this);
		if(info==''){
			alert('请添加回复内容');
		}else{
			$.post(
					url,
					{
							'info':info,
							'id':id
					},
					function(data){
						console.log(data);
						if(data.c==0){
							$('.raply_sure b').text('回复成功');
							$('.raply_sure i').show();
							showRaply();
						}else if(data.c==6){
							alert(data.msg);
							location.reload();
						}else{
							alert(data.msg);
						}
					},
					'json'
					)
		}
	
}) 
$('.write-reply').on('click','.file-delete',function(){
	var url=$('.write-reply').attr('url');
	var id=$(this).attr('rel');
	var _this=$(this);
	console.log(id);
	$.post(
		url,
		{
			id:id
		},
		function(data){
			if(data.c==0){
				_this.parent().remove();
			}
		},
		'json'
	)
})
/*$('#login-btn').on('click',function(){
	$('.login-btn').remove();
	$(this).html('确认');
	var username=$('#loginform-username').val();
	var password=$('#loginform-password').val();
	var url=$(this).attr('url');
	$.post(
			url,
			{
				username:username,
				password:password
			},
			function(data){
				console.log(data);
			},
			'json'
	)
})*/
var i=5;
function showRaply(){
	if(i>0){
		var ht=i+'s';
		$('.raply_sure i').html(ht);
		i--;
		setTimeout("showRaply()", 1000);
		
	}else{			
		 location.reload();
	}
	
}

$('.time-search').datetimepicker({
    language:  'zh-CN',
    weekStart: 1,
    todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	minView:2,
});

$('#tblsectiontipssearch-time').datetimepicker({
    language:  'zh-CN',
    weekStart: 1,
    todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	minView:2,
});
$('#tblyanpansearch-updated_at').datetimepicker({
    language:  'zh-CN',
    weekStart: 1,
    todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	minView:2,
});
//切换
$('.content-header').find('li').click(function(){
	var index=$(this).index();
	$(this).addClass('list-choice').siblings().removeClass('list-choice');
	$('.baojian-content').hide();
	$('.baojian-content').eq(index).show();
})
//报建
$('.tbl-baojian-view .check-line').find('span').on('click',function(){
	$(this).toggleClass('span-choice');
	var id=$(this).attr('rel');
	var url=$(this).parent().attr('url');
	var status=$(this).parent().attr('rel');
	var type=$(this).attr('type');
	$.post(
			url,
			{id:id,status:status,type:type},
			function(data){
				if(data.c==0){
					$(this).toggleClass('span-choice');
					location.reload();
				}else if(data.c==3){
					alert(data.msg);
					location.reload();
				}else{
					alert(data.msg);
				}
			},
			'json'			
	)
})

//section_tips
$('#tblsectiontips-area_id').on('change',function(){
	var area=$(this).val();
	var url=$(this).attr('url');
	console.log(area);
	$.post(
			url,
			{area:area},
			function(data){
				$('#tblsectiontips-section').empty().append(data);
			},
			'html'
			)
	
})
$('#tblsectiontips-section').on('change',function(){
	var area=$('#tblsectiontips-area_id').val();
	var section=$(this).val();
	var url=$(this).attr('url');
	console.log(section);
	$.post(
			url,
			{section:section,area:area},
			function(data){
				$('#tblsectiontips-step').empty().append(data);
			},
			'html'
			)
	
})
/*//expert
$('#expert-add').on('click',function(){
	$('.expert-info').show();
})

$('.expert-update').on('click',function(){
	$('.expert-info').show();
	$('#newname').val($(this).parent().prev().prev().html());
	$('#expertdesc').val($(this).parent().prev().html());
	$('#erpert-add-btn').attr('rel',$(this).attr('rel'))
})
$('#erpert-add-btn').on('click',function(){	
	var id='';
	if($(this).attr('rel')){
		id=$(this).attr('rel');
	}
	saveExpert(id);
})
function saveExpert(id=''){
	var url=$('.expert-info').attr('url');
	var name=$('#newname').val();
	var desc=$('#expertdesc').val();
	if(name!=''&&desc!=''){
		$.post(
				url,
				{id:id,name:name,desc:desc},
				function(data){
					if(data.c==0){
						location.reload()
					}else{
						alert('保存失败，请重新保存');
					}
				},
				'json'
		)
	}
}*/
//question
$('.question-add').click(function(){
	$('#question-add-btn').show();
	$('.question-info').show();
	console.log($(this).attr('rel'));
	$('#question-add-btn').attr('rel',$(this).attr('rel'));
})
$('.question-view').click(function(){
	$('#question-add-btn').hide();
	$('.question-info').show();
	var url=$(this).attr('url');
	$.post(
			url,
			{},
			function(data){
				if(data.c==0){
					$('#quesdesc').val(data.msg);
				}
			},
			'json'
		)
})
$('.question-delete').click(function(){
	var url=$(this).attr('url');
	$.post(
			url,
			{},
			function(data){
				if(data.c==0){
					location.reload();
				}
			},
			'json'
		)
})
$('#question-add-btn').click(function(){
	var id=$(this).attr('rel');
	var desc=$('#quesdesc').val();
	saveQuestion(id,desc);
})
function saveQuestion(id,desc){
	var url=$('.question-info').attr('url');
	$.post(
			url,
			{id:id,desc:desc},
			function(data){
				if(data.c==0){
					location.reload();
				}else{
					alert('回复失败');
				}
			},
			'json'
	)
}
