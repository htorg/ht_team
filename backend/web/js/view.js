$(function () {
	var viewer = new Viewer(document.getElementById('images'), {
	    url: 'rel'
	});	
	$('.showbig').click(function(e){
		e.stopPropagation();
		$(this).parent().find('img').trigger('click');
	});
});