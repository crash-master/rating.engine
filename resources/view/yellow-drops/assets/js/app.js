$(document).ready(function(){
	// MOBILE MENU 
	 $('.mobile-menu .menu').html($('nav.main').html());

	 $('.danger-link').click(function(){
		var ans = confirm('Удалить?');
		console.log(ans);
		if(!ans){
			return false;
		}
	});

	 $('button[data-menu]').click(function(){
		if($(this).hasClass('menu')){
			$('.mobile-menu').addClass('active');
			$(this).addClass('close');
			$(this).removeClass('menu');
		}else{
			$('.mobile-menu').removeClass('active');
			$(this).removeClass('close');
			$(this).addClass('menu');
		}
	})

	 $('.sitename').click(function(){
	 	document.location = '/';
	 })

	$('.mobile-menu a').on('click', function(){
		$('button[data-menu].close').trigger('click');
	});

	answerFromInit();

	var comments = new Comments();
	var search = new Search();
});

var answerFromInit = function(){
	$('.comment-item-answer, .comment-item-username').on('click', function(){
		var commentContainer = $(this).parent().parent().parent().parent();
		if(commentContainer.hasClass('ans')){
			return false;
		}
		var form = commentContainer.find('.comment-item-answer-form');
		if(!form.is(":visible")){
			form.slideDown('fast');
		}else{
			form.slideUp('fast');
		}

		return false;
	});
}

