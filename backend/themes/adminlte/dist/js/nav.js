$(function () {
	setSideBarActive('nav');
	
	$('#nav-list').find('li.nav-li').find('.click-layout').click(function(e){
		showEditBox($(this).parent().parent());
		e.stopPropagation();
	});
	
	$('#add-nav').find('li').click(function(){
		if ($(this).attr('type') == '4001')
		{
			$('#customer-link-box-title').text($('#update-customerlink-lang').text());
			$('#customer_link_form').find('.inputID').val($(this).attr('rel'));
			$('#customer_link_form').find('.inputName').val($(this).attr('name'));
			$('#customer_link_form').find('.inputUrl').val($(this).attr('url'));
			$('#delete-customerlink-btn').removeClass('hide');
		}
		else
		{
			$('#customer-link-box-title').text($('#new-customerlink-lang').text());
			$('#customer_link_form').find('.inputID').val('');
			$('#customer_link_form').find('.inputName').val('');
			$('#customer_link_form').find('.inputUrl').val('');
			$('#delete-customerlink-btn').addClass('hide');
		}
		return false;
	});
	
	$('#add-nav').click(function(e){
		addNav();
		e.stopPropagation();
	});
	
	$('#save-navs-btn').click(function(){
		saveNavs();
	});
	
	$('#save-customerlink-btn').click(function(){
		saveCustomerLink();
	});
	
	$('#delete-customerlink-btn').click(function(){
		deleteCustomerLink();
	});
	
	var newNavIndex = 0;
	var deleteNavIds = [];
	
	function showEditBox(obj)
	{
		var type = obj.attr('type');
		var id = obj.attr('rel');
		var a =  obj.find('a:eq(0)');
		var upDownIcon = a.find('.up-down-icon');
		
		if (id == '')
		{
			newNavIndex++;
			id = '_new'+newNavIndex;
			obj.attr('rel',id);
		}
		
		if (type != 3001)
		{
			var editBoxId = 'nav_cms_box'+id;
		}
		else
		{
			var editBoxId = 'nav_customer_box'+id;
		}
		
		if ($('#'+editBoxId).length == 0)
		{
			if (type != 3001)
			{
				var cloneEditBox = $('#nav_cms_box').clone();
				cloneEditBox.find('.inputName').val(obj.attr('name'));
			}
			else
			{
				var cloneEditBox = $('#nav_customer_box').clone();
				cloneEditBox.find('.inputName').val(obj.attr('name'));
				cloneEditBox.find('.inputUrl').val(obj.attr('url'));
			}
			cloneEditBox.attr('id',editBoxId);
			a.after(cloneEditBox);
			editBoxBtnFunc(cloneEditBox);
		}
		showBtn($('#'+editBoxId));
		
		if ($('#'+editBoxId).hasClass('hide'))
		{
			$('#nav-list').find('li.nav-li').removeClass('bg-color-1');
			obj.addClass('bg-color-1');
			$('.nav-edit-box').addClass('hide');
			$('.up-down-icon').removeClass('fa-chevron-up');
			$('.up-down-icon').addClass('fa-chevron-down');
			
			$('#'+editBoxId).removeClass('hide');
			upDownIcon.removeClass('fa-chevron-down');
			upDownIcon.addClass('fa-chevron-up');
		}
		else
		{
			obj.removeClass('bg-color-1');
			$('#'+editBoxId).addClass('hide');
			upDownIcon.removeClass('fa-chevron-up');
			upDownIcon.addClass('fa-chevron-down');
		}
	}
	
	function showBtn(editBox)
	{
		var prev = editBox.parent().prev().not('.ht_row');
		if (prev.length > 0)
		{
			editBox.find('.upBtn').first().removeClass('hide');
		}
		else
		{
			editBox.find('.upBtn').first().addClass('hide');
		}
		var next = editBox.parent().next()
		;
		if (next.length > 0)
		{
			editBox.find('.downBtn').first().removeClass('hide');
		}
		else
		{
			editBox.find('.downBtn').first().addClass('hide');
		}
		if(editBox.parents('li').first().attr('type')=='7001'){
			editBox.find('.removeBtn').first().addClass('hide');
		}
	}
	
	function editBoxBtnFunc(editBox)
	{
		editBox.find('input').change(function(e){
			if ($(this).hasClass('inputName'))
			{
				if (validateName($(this)))
				{
					$('#save-navs-btn').removeAttr('disabled');
					editBox.parent().attr('name',$(this).val());
					editBox.parent().find('span.name').first().text($(this).val());
				}
				else
				{
					$('#save-navs-btn').attr('disabled',true);
				}
			}
			if ($(this).hasClass('inputUrl'))
			{
				if (validateUrl($(this)))
				{
					$('#save-navs-btn').removeAttr('disabled');
					editBox.parent().attr('url',$(this).val());
				}
				else
				{
					$('#save-navs-btn').attr('disabled',true);
				}
			}
		});
		
		editBox.find('.removeBtn').first().click(function(e){
			deleteNavIds.push(editBox.parent().attr('rel'));
			editBox.parent().remove();
			showIcoMore($('.box-body'));
			//e.stopPropagation();
		});
		
		editBox.find('.upBtn').first().click(function(e){
			var prev = editBox.parent().prev().not('.sub-category');
			if (prev.length > 0)
			{
				prev.before(editBox.parent());
				showBtn(editBox);
			}
			//e.stopPropagation();
		});
		
		editBox.find('.downBtn').first().click(function(e){
			var next = editBox.parent().next();
			if (next.length > 0)
			{
				next.after(editBox.parent());
				showBtn(editBox);
			}
			//e.stopPropagation();
		});
		
		editBox.find('.rightBtn').click(function(e){
			var prev = editBox.parent().prev().not('.sub-category');
			if (prev.length > 0)
			{
				var navSubList = prev.find('.nav-sub-list').first();
				navSubList.find('ul').first().append(editBox.parent());
				showBtn(editBox);
			}
			//e.stopPropagation();
		});
		
		editBox.find('.leftBtn').click(function(e){
			var box = editBox.parent().parent().parent();
			if (box.hasClass('nav-sub-list'))
			{
				box.parent().after(editBox.parent());
				showBtn(editBox);
			}
			//e.stopPropagation();
		});
	}
	
	function addNav()
	{
		if($("#nav-show-stacked [type='7001']").length>0){
			$(".attr_select [value='7001']").remove();
		}
		var nav=$('#nav-model').clone();
		nav.attr('id','');
		nav.show();
		var nav_li=$('#nav-list').find('.nav:eq(0)').children('li').first();
		$('#nav-list').find('.nav:eq(0)').append(nav);
		nav.find('input').focus();
		showIcoMore(nav);
		nav.find('.ht_rowBox').each(function(){
			editBoxBtnFunc($(this));
		});
	}
	
	function saveNavs()
	{
		var navs = getNavs($('#nav-list').find('ul').first().children('li'));
		newCallout('info',$('#info-title').text(),$('#saving-text').text());
		$.post(
			$('#save-navs-url').text(),
			{navs:navs,deleteNavIds:deleteNavIds},
			function(data){
				//console.log(data);
				if (data.c == 0)
				{
					newCallout('success',$('#success-title').text(),data.msg);
					timerRefresh();
				}
				else
				{
					newAlert('danger',$('#danger-title').text(),data.msg);
				}
			},
			'json'
		);
	}
	
	function getNavs(liList)
	{
		var navs = [];	
		liList.each(function(){
			if(!$(this).attr('name')||!$(this).attr('type')){
				return true;
			}
			var a = {
				'type':$(this).attr('type'),
				'rel':$(this).attr('rel'),
				'name':$(this).attr('name'),
				'ext_id':$(this).attr('ext_id'),
				'url':$(this).attr('url'),
				'sub':'',
			};
			var sub_navs=$(this).find('.more_sub_content');
			if(sub_navs.length>0){
				var nav_subs = [];
				sub_navs.each(function(){
					var nav_sub=getSubNav($(this));					
					sub_navs_thrs=$(this).find('.subNavItem_thr');
					if(sub_navs_thrs.length>0){
						var nab_sub_thrs=[];
						sub_navs_thrs.each(function(){
							nab_sub_thrs.push(getSubNav($(this)));						
						})
						nav_sub.sub=nab_sub_thrs;
					}
					nav_subs.push(nav_sub);
				})
				a.sub=nav_subs;
			}
			/*if ($(this).find('#sub_nav_item').find('.subNavItem').first().length > 0)
			{
				a.sub = getNavs($(this).find('.more_sub_content').first());
			}*/
			navs.push(a);
		});
		console.log(navs);
		return navs;
	}
	function getSubNav(subList){
		if(subList.length>0){
			if(!subList.attr('name')||!subList.attr('type')){
				return true;
			}
			return a ={
					'type':subList.attr('type'),
					'rel':subList.attr('rel'),
					'name':subList.attr('name'),
					'ext_id':subList.attr('ext_id'),
					'url':subList.attr('url'),
					'sub':'',
			}
		}
	}
	function saveCustomerLink()
	{
		var id = $('#customer_link_form').find('.inputID');
		var inputName = $('#customer_link_form').find('.inputName');
		var inputUrl = $('#customer_link_form').find('.inputUrl');
		
		if (validateName(inputName) && validateUrl(inputUrl))
		{
			$.post(
					$('#save-customerlink-url').text(),
					{
						id:id.val(),
						name:inputName.val(),
						url:inputUrl.val()
					},
					function(data){
						if (data.c == 0)
						{
							window.location.reload();
						}
						else
						{
							newAlert('danger',$('#danger-title').text(),data.msg);
						}
					},
					'json'
				);
		}
	}
	
	function deleteCustomerLink()
	{
		var id = $('#customer_link_form').find('.inputID');
		
		if (id.val() == '')
		{
			return false;
		}
		else
		{
			$.post(
					$('#delete-customerlink-url').text(),
					{
						id:id.val()
					},
					function(data){
						if (data.c == 0)
						{
							window.location.reload();
						}
						else
						{
							newAlert('danger',$('#danger-title').text(),data.msg);
						}
					},
					'json'
				);
		}
	}
	
	function validateName(input)
	{
		input.parent().removeClass('has-error');
		input.parent().find('.help-block').remove();
		
		if (input.val() == '')
		{
			input.parent().addClass('has-error');
			input.after('<div class="help-block">'+$('#name-blank-error-lang').text()+'</div>');
			return false;
		}
		else
		{
			input.parent().removeClass('has-error');
			input.parent().addClass('has-success');
			input.parent().find('.help-block').remove();
			return true;
		}
	}
	
	function validateUrl(input)
	{
		input.parent().removeClass('has-error');
		input.parent().find('.help-block').remove();
		
		if (input.val() == '')
		{
			input.parent().addClass('has-error');
			input.after('<div class="help-block">'+$('#url-blank-error-lang').text()+'</div>');
			return false;
		}
		else if (isValidURL(input.val()) == false)
		{
			input.parent().addClass('has-error');
			input.after('<div class="help-block">'+$('#url-valid-error-lang').text()+'</div>');
			return false;
		}
		else
		{
			input.parent().removeClass('has-error');
			input.parent().addClass('has-success');
			input.parent().find('.help-block').remove();
			return true;
		}
	}
	
	function getnavHtml(type, obj){
		var html='';
		var value=obj.find('.nav_attr').html();
		var optype=obj.attr('type')
		if(optype=='8001'){
			optype='8002';
		}
		var select='';
				select+='<option value="">请选择</option><option value="'+optype+'">'+value+'</option>';
				select+='<option value="3001">自定义链接</option>';
		switch(type){
		case 0:html='<div class="more_sub_content subNavItem" style="display:none" type="'+obj.attr('type')+'" url="" rel="" ext_id="0" name="sub"><div class="ht_row ht_sub"><div class="nav_colItem col-md-4 subNavItem_name">'
					+'<img class="ico_subNav" ><input class="row_nav_name" type="text" value="" autocomplete="no" placeholder=""/></div>'
					+'<div class="nav_colItem col-md-3"><i class="ht_input_case"><span class="label_name">类型：</span><select class="attr_select">'+select+'</select></i></div>'
					+'<div class="nav_colItem col-md-5"><button id="create-cate" class="btn btn-primary create_subNav_btn">添加子级</button><a  class=" ht_button ht_row_right glyphicon glyphicon-remove removeBtn"></a>'
					+'<a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-up upBtn"></a><a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-down downBtn"></a></div></div></div>';
			break;
		case 1:html='<div class="subNavItem subNavItem_thr" type="'+obj.attr('type')+'" url="" rel="" ext_id="0" name="sub"><div class="ht_row ht_sub"><div class="nav_colItem col-md-4 subNavItem_name">'
					+'<img class="ico_subNav" src="<?= $bundle->baseUrl?>/img/img_column.gif"><input class="row_nav_name" type="text" value="" autocomplete="no" placeholder="请输入（必填）"/></div>'
					+'<div class="nav_colItem col-md-3"><i class="ht_input_case"><span class="label_name">类型：</span><select class="attr_select">'+select+'</select></i></div>'
					+'<div class="nav_colItem col-md-5"><a  class=" ht_button ht_row_right glyphicon glyphicon-remove removeBtn "></a>'
					+'<a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-up upBtn"></a><a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-down downBtn"></a></div></div></div>';
				break;
		default:
			html ='';
        	break;
		}
		return html;
	}
	
	//******** ht pullDown ************
	$('.box-body ').on('click','.ht_pullDown',function () {
	    $(this).parent().next('.ht_pullDown_menu').slideToggle();
	});
	$('.box-body ').on('click','.ico_more',function () {
	    $(this).siblings('.subNavItem').slideToggle();
	    $(this).toggleClass(' glyphicon-triangle-bottom')
	});
	$('.ico_moreSubNav').click(function () {
	    $(this).parents('tr').nextUntil('.navTr' ,'.subNavTr').slideToggle(300);
	    $(this).toggleClass(' glyphicon-triangle-bottom');
	});
	$('.box-body').on('blur','input',function(){
		if($(this).val()!=''){
			if($(this).parent().parent().parent().not('.ht_rowBox').length>0){
				if($(this).attr('class')=='defined_link'){
					$(this).parent().parent().parent().attr('url',$(this).val());
				}else{
					$(this).parent().parent().parent().attr('name',$(this).val());	
				}			
			}else{
				if($(this).attr('class')=='defined_link'){
					$(this).parent().parent().parent().parent().attr('url',$(this).val());
				}else{
					$(this).parent().parent().parent().parent().attr('name',$(this).val());
				}
			}			
		}
	})
	$('.box-body').on('change','select',function(){
		if($(this).val()!=''){
			if($(this).parents('.more_sub_content').length>0){
				$(this).parent().parent().parent().parent().attr('type',$(this).val());
			}else{
				$(this).parents('.nav_list_item').first().attr('type',$(this).val());
			}
		}
		if($(this).val()=='3001'){
			var add_input=$(this).parent().parent().next().children('button');
			if(add_input.length>0){
                $(this).parent().parent().next().children('button').before('<input class="defined_link" placeholder="请输入自定义链接">').remove();
			}else{
                $(this).parent().parent().next().append('<input class="defined_link" type="3001" placeholder="请输入自定义链接">');
			}
		}
	})
	$('.box-body').on('mouseover','.ht_rowBox',function(){
		$('.ht_sub').each(function(){
			showBtn($(this));
		})
		$('.ht_rowBox').each(function(){
			showBtn($(this));
		})
	})
	$('.ht_sub').each(function(){
			editBoxBtnFunc($(this));
		})
	$('.ht_rowBox').each(function(){
			editBoxBtnFunc($(this));
		})	
	//editBoxBtnFunc($('.ht_row').eq(0));
	$('.box-body').on('click','#create-cate',function(){
		var value=$(this).parent().prev().find('option:selected').text();
		if(value){
			var html='<span class="nav_attr">'+value+'</span>';
			$(this).parent().prev().html(html);
		}
		var obj=$(this).parents('li').first();
		var parent=$(this).parent().parent().parent().parent('li');
		var sub_html='';
		sub_html=getnavHtml(0,obj);
		if(parent.length==0){
			sub_html=getnavHtml(1,obj);
		}
		sub_html=$(sub_html);
		sub_html.find('.ht_row').each(function(){
			editBoxBtnFunc($(this));
		});
		if($(this).parent().parent().nextAll().length>0){
			$(this).parent().parent().nextAll().last().after(sub_html);	
		}else{
			$(this).parent().parent().after(sub_html);	
		}
		
		//showIcoMore(sub_html);	
		showIcoMore($('.box-body'));
		$(this).parent().parent().siblings('.more_sub_content').slideDown();
		$(this).parent().parent().prev().addClass('glyphicon-triangle-bottom');
		$('.box-body img').attr('src',$('.box-body').attr('sub-img'));
	})
	showIcoMore($('.box-body'));
	function showIcoMore(obj){
		obj.find('.ico_more').each(function(){
			var subs=$(this).siblings('.more_sub_content');
			if(subs.length==0){
				$(this).hide();
			}else{
				$(this).show();
			}
		})
	}
	$('.box-body img').attr('src',$('.box-body').attr('sub-img'));
});