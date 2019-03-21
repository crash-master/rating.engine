$(document).ready(function(){
	// console.log('app');
	$('.logo').click(function(){
		document.location = '/';
	});
	$('.load-more').click(function(){
		getRating();
	});

	$('.danger-link').click(function(){
		var ans = confirm('Удалить?');
		console.log(ans);
		if(!ans){
			return false;
		}
	});

	if(document.location.toString().split('profile').length > 1){
		let container = $('.screen-container');
		container.css('height', container.innerHeight() + 'px');

		$(document).on('scroll', function() {
			let heightPoint = $('.info-container').innerHeight();
			if(heightPoint < 800){
				heightPoint = 800;
			}
			console.log(heightPoint);
		  	let s = $('html').scrollTop();
		  	if(s > heightPoint && !$(".screen-container .screen").hasClass("fixed")){
		  		$(".screen-container .screen").addClass('fixed').css('display', 'none');
		  		$(".screen-container .screen").fadeIn('fast');
		  	}

		  	if(s < heightPoint && $(".screen-container .screen").hasClass("fixed")){
		  		$(".screen-container .screen").removeClass('fixed');
		  	}
		});
	}


	check_site_on_exists();

	$('.check-block .check-btn').click(function(){
		$('#header .add-user').trigger('click');
	});

	$('.close-add-new-user').click(function(){
		$('.global-background').trigger('click');
	});

	$('.search-input').keydown(function(){
		word = $(this).val();
		$('.search-result').fadeIn('normal');
		$.getJSON('/api/search/clean/' + word, function(d){
			// console.log(d)
			var html = '';
			for(var i in d.result){
				html += '<div class="sr-item"><a href="' + d.result[i]['to_profile'] + '">' + d.result[i].name + '</a></div>';
			}
			if(d.result.length == 0){
				html = "<center>Ничего не найдено</center>"
			}
			$('.search-result').html(html);
		});
	});

	$('button.search-on').on('click',function(){
		$('.close-mob-nav').trigger('click');
		var sc = $('.search-container');
		if($(sc).hasClass('active')){
			$(sc).removeClass('active');
			$('.global-background').removeClass('active');
		}else{
			$(sc).addClass('active');
			$('.global-background').addClass('active');
			$('.search-input').focus();  //?
			$('.search-result').hide();
			$('.search-input').val('');
		}

		var sc = $('.add-user-container');
		$(sc).removeClass('active');
	});

	$('button.add-user').on('click',function(){
		$('.close-mob-nav').trigger('click');
		var sc = $('.add-user-container');
		if($(sc).hasClass('active')){
			$(sc).removeClass('active');
			$('.global-background').removeClass('active');
		}else{
			$(sc).addClass('active');
			$('.global-background').addClass('active');
		}

		var sc = $('.search-container');
		$(sc).removeClass('active');
	});

	$('.global-background').click(function(){
		$('.add-user-container.active').removeClass('active');
		$('.search-container.active').removeClass('active');
		$(this).removeClass('active');
		$('.close-mob-nav').trigger('click');
	})

	$('.checkbox .box').on('click', checkbox);
	$('.checkbox .label').on('click', checkbox);

	$('.select').on('click', function(){
		if(!$(this).hasClass('drop-down')){
			$(this).addClass('drop-down');
			var count = $(this).find('.option').length;
			$(this).css('height', (count * 50 + 50) + 'px' );
		}else{
			$(this).removeClass('drop-down');
			$(this).removeAttr('style');
		}
	});

	$('.select .option').on('click', function(){
		$(this).parent().parent().find('.placeholder').html($(this).html());
		$(this).parent().parent().find('input[type="hidden"]').val($(this).attr('data-value'));
	});

	$('[data-page-part]').on('click', function(){
		var ml = $(this).attr('data-margin-left') + 'px';
		$('.line .page-menu-arrow').css('margin-left', ml);
		var container = $(this).attr('data-page-part');
		$('.page-part-container').hide();
		$('#'+container).show();
		return false;
	})

	$('.open-add-comments-form').on('click', function(){
		if(!$('.add-comments-form').hasClass('active')){
			$('.add-comments-form').slideDown();
			$('.add-comments-form').addClass('active');
		}else{
			$('.add-comments-form').slideUp();
			$('.add-comments-form').removeClass('active');
		}
	});

	$('.img-radio .radio').on('click', function(){
		$(this).parent().find('.radio').removeClass('active');
		$(this).addClass('active');
		$(this).parent().find('input').val($(this).attr('data-val'));
	});

	$('.mobile-nav .main-nav').html($('nav.main').html());

	// $('.mobile-nav .service-nav').html($('.service-btns').html());

	$('.close-mob-nav').on('click', function(){
		$('.mob-menu').fadeIn('normal');
		$('.global-background').removeClass('active');
		$('.mobile-nav').removeClass('active');
		$('.close-mob-nav').hide();
	})

	$('.mob-menu').on('click', function(){
		$(this).fadeOut('normal');
		$('.global-background').addClass('active');
		$('.mobile-nav').addClass('active');
		$('.close-mob-nav').show();
	})

	disable_submit_btn();

	$('.add-comments-form .input.image input[type="file"]').on('change', function(){
		inpFileToBase64();
	});

	$('.add-user-container button.send-form').on('click', function(){
		if($(this).hasClass('disable'))
			return false;
		$(this).addClass('disable');
		var container = '.add-user-container';
		var data = takeData(container);
		data['create-profile'] = true;
		if(data['agree'] != '1'){
			return false;
		}

		$('.add-user-container .send-form').addClass('disable');
		loaderShow('#create-profile-loader');

		$.post('/api/create-profile', data, function(response){
			$(container).find('[name="site"]').val('');
			$(container).find('[name="name"]').val('');
			$(container).find('.agree-label').trigger('click');
			$('.global-background').trigger('click');
			loaderHid('#create-profile-loader');
			setTimeout(function(){
				showNotif('Новый маг отправлен на модерацию', 4000);
			}, 300);
		})
	});

	$('.add-comments-form button.send-form').on('click', function(){
		if($(this).hasClass('disable')){
			return false;
		}
		var container = '.add-comments-form';
		var data = takeData(container);
		data['create-review'] = true;
		if(INPUT_IMAGE){
			data['image'] = INPUT_IMAGE;
		}

		if(INPUT_IMAGE_SIZE / 1024 / 1024 > 2){
			showNotif('Изображение не должно быть больше 2х мегабайт!', 4000, '#E53935', '#B71C1C');
			return false;
		}

		$('.add-comments-form .send-form').addClass('disable');

		$.post('/api/create-review', data, function(response){
			// console.log(response);
			$(container).find('[name="message"]').val('');
			$(container).find('[name="photo"]').val('');
			$(container).find('[name="rating"]').val('-2');
			$(container).find('[name="rating"]').parent().find('.radio').removeClass('active');
			$(container).find('.input.image .placeholder').html($(container).find('.input.image .placeholder').attr('data-default'));
			INPUT_IMAGE = false;
			INPUT_IMAGE_SIZE = 0;
			setTimeout(function(){
				showNotif('Ваш отзыв отправлен на модерацию', 4000);
			}, 100);
		})
	});

	// setInterval(function(){
	// 	// console.log(window.pageYOffset);
	// 	if($('body').height() > ){
	// 		if(!$('#footer').hasClass('footer-fixed')){
	// 			$('#footer').addClass('footer-fixed');
	// 		}
	// 	}else{
	// 		$('#footer').removeClass('footer-fixed');
	// 	}
	// }, 10);
	//

	$('.comment-delete').on('click', function (){
		var review_id = $(this).attr('data-id');
		$('.remove-dialog').fadeOut('normal');
		$('.rd-active').removeClass('rd-active');
		$(this).parent().parent().parent().find('.rd-step-1').fadeIn('normal');
		var item = $(this).parent().parent().parent().parent().attr('data-item-i');
		if(item == 1 || item == 2){
			if(!$(this).parent().parent().parent().find('.remove-dialog').hasClass('rd-bottom')){
				$(this).parent().parent().parent().find('.remove-dialog').addClass('rd-bottom');
			}
		}
	});

	$('[data-ans="cancel"]').click(function(){
		$(this).parent().parent().fadeOut('normal');
	});

	$('[data-ans="yes"]').click(function(){
		$(this).parent().parent().fadeOut('normal', function(){
			$(this).parent().parent().parent().find('.rd-step-yes').fadeIn('normal');
			var self = this;
			setTimeout(function(){
				$(self).parent().parent().parent().find('.rd-step-yes').fadeOut('normal');
			}, 3000);
		});
		var id = $(this).parent().parent().parent().find('.comment-delete').attr('data-id');
		// console.log('send', '/api/review/remove/' + id);
		var self = this;
		$.getJSON('/api/review/create-email-order-for-remove/' + id, function(r){
			// console.log(r)
			$(self).parent().parent().parent().find('.rd-step-yes .rd-email').html(r.email);
		});
	});

	$('[data-ans="no"]').click(function(){
		$(this).parent().parent().fadeOut('normal', function(){
			$(this).parent().parent().parent().find('.rd-step-no').addClass('rd-active').fadeIn('normal');
		});
	});

	$('.rd-step-no .send-form').click(function(){
		if($(this).hasClass('disable'))
			return false;
		$(this).addClass('disable');
		var email = $(this).parent().find('[name="email"]').val();
		$(this).parent().find('[name="email"]').val('');
		var message = $(this).parent().find('[name="message"]').val();
		$(this).parent().find('[name="message"]').val('');

		var id = $(this).parent().parent().parent().find('.comment-delete').attr('data-id');
		// console.log('send', '/api/review/remove/order', id);
		$.post('/api/review/remove/order', {'reviewid': id, 'email': email, 'message': message}, function(r){});

		 $(this).parent().fadeOut('normal', function(){
		 	$(this).parent().parent().find('.rd-step-no-send').fadeIn('normal');
		 	var self = this;
			setTimeout(function(){
				$(self).parent().parent().find('.rd-step-no-send').fadeOut('normal');
			}, 3000);
		 });
	});

	try{
		var nu = $('.new-users .nu-item');
		if(typeof nu != 'undefined'){
			for(var i in nu){
				var nuname = $(nu[i]).find('.nu-name a').html();
				if(nuname == ''){
					continue;
				}
				$(nu[i]).find('.nu-circle').html(nuname[0]);
			}
		}
	}catch(e){}

	if(document.location.pathname == '/'){
		let params = {
		    len: {
		      min: 270,
		      max: 300
		    },
		    numberOfWords: 20,
		    numberOfSentence: 2
		  }
	  let outFormat = 'symbols';

	  let excerpt = new ExcerptJS(params);
	  let comments = $('.last-comments .lc-comment');
	  if(comments.length){
	  	for(let comment of comments){
	  		let inpText = $(comment).html();
	  		excerpt.input(inpText);
	  		let outText = excerpt.out(outFormat);
	  		if(inpText != outText){
	  			let link = $(comment).parent().parent().parent().find('.lc-name a').attr('href');
	  			$(comment).html(outText + '...' + ' <a class="review-read-more" href="' + link + '">Читать дальше</a>');
	  		}
	  	}
	  }
	}

});

var checkbox = function(){
		var val = $(this).parent().find('input[type="hidden"]').val();
		if(val == 0){
			$(this).parent().find('input[type="hidden"]').val('1');
			$(this).parent().find('.box').addClass('active');
		}else{
			$(this).parent().find('input[type="hidden"]').val('0');
			$(this).parent().find('.box').removeClass('active');
		}
	}

var takeData = function(container){
	var container = $(container);
	var inp = $(container).find('input');
	var textarea = $(container).find('textarea');
	var data = {};
	for(var i = 0; i < inp.length; i++){
		data[$(inp[i]).attr('name')] = $(inp[i]).val();
		if($(inp[i]).attr('data-err')){
			data[$(inp[i]).attr('name')] = '';
		}
	}
	if(textarea.length > 0){
		for(var i = 0; i < textarea.length; i++){
			data[$(textarea[i]).attr('name')] = $(textarea[i]).val();
		}
	}
	return data;
}

var showNotif = function(message, time, bgcolor, brcolor){
	time = (typeof time == 'undefined') ? 3000 : time;
	$('.notification').html(message).fadeIn('normal');
	$('.global-background').addClass('active');
	if(typeof bgcolor != 'undefined' && typeof brcolor != 'undefined')
		$('.notification').css({'background-color': bgcolor, 'border-color': brcolor});
	setTimeout(function(){
		$('.notification').fadeOut('normal', function(){
			$('.notification').removeAttr('style');
		});
		$('.global-background').removeClass('active');
	}, time);
}

var inpFileToBase64 = function(){
	var file    = document.querySelector('.input.image input').files[0];
	document.querySelector('.input.image .placeholder').innerHTML = file.name;
	INPUT_IMAGE_SIZE = file.size;
	var reader  = new FileReader();

	reader.onloadend = function () {
		INPUT_IMAGE = reader.result;
	}

	if (file) {
		reader.readAsDataURL(file);
	} else {

	}

}

var INPUT_IMAGE = false;
var INPUT_IMAGE_SIZE = 0;
var CURRENT_COUNT_RATING_LIST = 0;
var RATING_LIST_COUNTER = 1;

var getRating = function(){
	var limit = CURRENT_COUNT_RATING_LIST;
	var order = $('input[name="order"]').val();
	$('.rating-bottom .preloader').show();
	$.getJSON('/api/rating/order/' + order + '/limit/' + limit, function(d){
		$('.rating-bottom .preloader').hide();
		CURRENT_COUNT_RATING_LIST += d.rating.length;
		if(CURRENT_COUNT_RATING_LIST == d.len){
			$('.load-more').hide();
		}else{
			$('.load-more').show();
		}
		drawRating(d.rating);
	});
}

var drawRating = function(data){
	console.log(data);
	var html = '';
	for(var i in data){
		if(typeof data[i]['id'] == 'undefined'){
			$('.load-more').hide();
			continue;
		}
		var count_review = parseInt(data[i].count_like) + parseInt(data[i].count_dislike) + parseInt(data[i].count_neutral);
		html += '<li>' +
			'<div class="top-number">#' + RATING_LIST_COUNTER++ + '</div>' +
			'<div class="top-name"><a href="' + data[i]['to_profile'] + '" class="f-link">' + data[i].name + '</a></div>' +
			'<div class="top-site">' + data[i].site + '</div>' +
			// '<div class="top-site"><a href="' + data[i]['site-link'] + '">' + data[i].site + '</a></div>' +
			'<div class="top-rating"><i class="m-icon like"></i> ' + data[i].count_like + ' ' +
			'<i class="m-icon dislike"></i> ' + data[i].count_dislike + ' '+
			'<i class="m-icon comment-text-multiple-blue"></i> ' + count_review + '</div>' +
			'<div class="top-timestamp">' + data[i].timestamp + '</div>' +
			'<div class="top-btn-show"><a href="' + data[i]['to_profile'] + '" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>' +
			'</li>'
	}

	$('#rating .top-list').append(html);

}

function loaderShow(selector){
	$(selector).removeClass('hid');
}

function loaderHid(selector){
	$(selector).addClass('hid');
}

