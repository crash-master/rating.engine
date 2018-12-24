$(document).ready(function(){
	$('[data-click-open]').on('click', function(){
		document.location = $(this).attr('data-click-open');
	});

	// go up btn
	$('.go-up').click(function() {
		let $page = $('html, body');
	    $page.animate({
	        scrollTop: 0
	    }, 400);
	});

	// comments
	let comments = new Comments();
	let search = new Search();

	$('.answer').on('click', function(e){
		e.preventDefault();
		let commentID = $(this).attr('href');
		let submitBtn = $('.create-comment-form .submit-container button:eq(0)');
		let backupID = submitBtn.attr('data-profile-id');
		let type = 'profile';
		if(typeof backupID == 'undefined'){
			backupID = submitBtn.attr('data-article-id');
			type = 'article';
		}

		submitBtn.removeAttr('data-' + type + '-id').attr('data-comment-id', commentID);

		let username = $(this).parent().parent().find('.user-name').html();
		let answerDisplay = '<div class="answer-display-user">Ответ пользователю <strong>' + username + '</strong> ' +
		'<a class="answer-close" data-backup-id="' + backupID + '" data-type="' + type + '" href="#"><i class="mdi mdi-close"></i></a> </div>';
		$('.create-comment-form #message').trigger('focus').parent().prepend(answerDisplay)
		.find('.answer-close').on('click', function(e){
			e.preventDefault();
			let type = $(this).attr('data-type');
			let backupID = $(this).attr('data-backup-id');
			$('.create-comment-form .submit-container button:eq(0)').removeAttr('data-comment-id').attr('data-' + type + '-id', backupID);
			$(this).parent().remove();
			$('.comment-item .answer').show();
		});
		$('.comment-item .answer').hide();
		console.log(commentID, username);
	});
});