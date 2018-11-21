$(document).ready(function(){
	// var textarea = $('#wysivyg');
	// if(typeof textarea != 'undefined'){
	// 	$(textarea).markItUp(myHtmlSettings);
	// }
	$.trumbowyg.svgPath = '/resources/css/libs/icons.svg';
	$('#content').trumbowyg();

	$('.remove').click(function(){
			var answ = confirm("Уверены, что хотите удалить это?");
			if(answ == false){
				return false;
			}
		});

	$('.danger-link').click(function(){
		var ans = confirm('Удалить?');
		console.log(ans);
		if(!ans){
			return false;
		}
	});

	$('.description-update').on('click', function(){
		$(this).parent().find('.description-form').show();
		return false;
	});

	$('.description-form .close').on('click', function(){
		$(this).parent().hide();
	});

	$('.description-form .update').on('click', function(){
		var inp = $(this).parent().find('[name="description"]');
		var val = inp.val();
		var url = $(this).attr('data-url');
		$.post(url, {'description': val}, function(){
			console.log('Success sendig new description');
			$('.description-form').hide();
		});
	});
})