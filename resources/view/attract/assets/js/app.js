$(document).ready(function(){
	$('.carousel').carousel({
		interval: 5000
	});

	$('.danger-link').click(function(){
		var ans = confirm('Удалить?');
		console.log(ans);
		if(!ans){
			return false;
		}
	});

	 // MOBILE MENU 
	 $('.mobile-menu .menu').html($('nav.main').html());

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

	$('.mobile-menu a').on('click', function(){
		$('button[data-menu].close').trigger('click');
	});
	
	// img-radio btn
	$('.img-radio .radio').on('click', function(){
		$(this).parent().find('.radio').removeClass('active');
		$(this).addClass('active');
		$(this).parent().find('input').val($(this).attr('data-val'));
	});

	// profile_comments
	$('#profile .review-item .review-foot a').on('click', function(){
		var count = parseInt($(this).find('span', 0).html().split('(')[1]);
		console.log(count);
		var comments = $(this).parent().parent().parent().parent().find('.comments');
		if(count == 0){
			$(comments).find('.comment-item').hide();
			$(comments).find('.comments-paginator').hide();
			$(comments).find('.block-title').hide();
			$(comments).slideDown('normal');
			return false;
		}

		console.log($(comments).is(':visible'));

		if(!$(comments).is(':visible')){
			// open
			openComments(comments);
		}else{
			// close
			$(comments).slideUp('normal');
		}

		return false;
	});

	// close profile comments
	$('.close-comments').click(function(){
		var comments = $(this).parent();
		if(!$(comments).is(':visible')){
			// open
			openComments(comments);
		}else{
			// close
			$(comments).slideUp('normal');
		}
	});

	// comments pagination
	$('.next-comments-page').on('click', function(){
		comments_pagination($(this).parent().parent(), 'next');
	});
	$('.prev-comments-page').on('click', function(){
		comments_pagination($(this).parent().parent(), 'prev');
	});

	// $('.carousel').carousel('2');
	selectControl('#rating-order');
	selectControl('.new-user .select');

	$('.checkbox .box').on('click', checkbox);
	$('.checkbox .label').on('click', checkbox);

	$('.new-user-open').on('click', function(){
		$('.new-user').addClass('active');
		$('.hidden-bg').show();
	});

	$('.search-open').on('click', function(){
		$('.search').addClass('active');
		$('.hidden-bg').show();
	});

	$('.hidden-bg, .close-popup').on('click', function(){
		$('.hidden-bg').hide();
		$('.popup').removeClass('active');
	});

	$('#rating .load-more').on('click', function(){
		var tag = $(this).attr('data-tag');
		if(typeof tag != 'undefined' && tag != ''){
			getRating(tag);
		}else{
			getRating();
		}
	});

	$('.new-review .input.image input[type="file"]').on('change', function(){
		inpFileToBase64();
	});

	$('.search-input').keydown(function(){
		word = $(this).val();
		$('.search-result').fadeIn('normal');
		$.getJSON('/api/search/' + word, function(d){
			// console.log(d)
			if(d.result.length == 0){
				// html = "<center>Ничего не найдено</center>"
			}

			$('.search-result').html(d.result);
		});
	});

	$('[data-func]').on('click', function(){
		var funcname = $(this).attr('data-func');
		switch(funcname){
			case 'open-search-func':
				$('button.search-open').trigger('click');
			break;
			case 'open-new-profile-form':
				$('button.new-user-open').trigger('click');
			break;
			case 'go-to-news':
				document.location = 'http://news.astralmagic.ru';
			break;
			default: console.log('undefined data-func');
		}
	});

	$('[data-href]').click(function(){
		var href = $(this).attr('data-href');
		$(this).attr('href', href);
	});

	goToReview();

	reviewNewCommentValidate();
	sendNewComment();
	addNewProfile();
	addNewReview();
	check_site_on_exists();
	disable_submit_btn();
	firstLetter();
});

var selectControl = function(selector){
	var sel = $(selector);
	var icon = sel.find('.m-icon', 0);
	var inp = sel.find('input',0);
	var placeholder = sel.find('.placeholder');
	if(sel.hasClass('select')){
		var closeLay = sel.find('.close-layer');
		var optContainer = sel.find('.options');
		var options = optContainer.find('.option');
		$(sel).on('click', function(){
			if(optContainer.hasClass('open')){
				return false;
			}
			optContainer.slideDown('fast');
			optContainer.addClass('open');
			closeLay.show();
		});

		options.on('click', function(){
			var val = $(this).html();
			placeholder.html(val);
			inp.val($(this).attr('data-value'));
			setTimeout(function(){
				optContainer.removeClass('open');
			}, 50);
			optContainer.slideUp('fast');
			closeLay.hide();
		});

		closeLay.on('click', function(){
			setTimeout(function(){
				optContainer.removeClass('open');
			}, 50);
			optContainer.slideUp('fast');
			closeLay.hide();
		});

	}
}

var COUNT_COMMENTS_ON_PAGE_NOW = 0;
var COUNT_ON_PAGE = 3;
var CURRENT_COMMENTS_PAGE = 0;
var openComments = function(container){
	$(comments).find('.comments-paginator').show();
	$(comments).find('.block-title').show();
	$(container).slideDown('normal');
	var comments = $(container).find('.comment-item');
	COUNT_COMMENTS_ON_PAGE_NOW = COUNT_ON_PAGE;
	CURRENT_COMMENTS_PAGE = 1;
	cp_counter_processor(container, comments.length);

	$(comments).hide();
	var min = Math.min(comments.length, COUNT_ON_PAGE);
	for(var i=0;i<min;i++){
		$(comments[i]).show();
	}
}

var cp_counter_processor = function(container, total){
	var cp_counter = $(container).find('.cp-counter');
	var m = Math.min(COUNT_COMMENTS_ON_PAGE_NOW, total);
	cp_counter.html(m + ' из ' + total);
	if(total <= COUNT_ON_PAGE){
		$(cp_counter).parent().find('button').hide();
	}else{
		$(cp_counter).parent().find('button').show();
	}
}

var comments_pagination = function(container, way){
	var comments = $(container).find('.comment-item');
	var total = comments.length;
	if(way == 'next')
		CURRENT_COMMENTS_PAGE++;
	else{
		CURRENT_COMMENTS_PAGE--;
	}
	COUNT_COMMENTS_ON_PAGE_NOW = COUNT_ON_PAGE * CURRENT_COMMENTS_PAGE;
	if(Math.abs(total - COUNT_COMMENTS_ON_PAGE_NOW) < COUNT_ON_PAGE){
		// next
		console.log('next')
		cp_counter_processor(container, total);
	}else{
		console.log('first')
		// first
		COUNT_COMMENTS_ON_PAGE_NOW = 3;
		CURRENT_COMMENTS_PAGE = 1;
		cp_counter_processor(container, total);
	}

	$(comments).hide();
	var min = Math.min(COUNT_COMMENTS_ON_PAGE_NOW, total);
	var start = COUNT_COMMENTS_ON_PAGE_NOW - COUNT_ON_PAGE;

	for(var i=start;i<min;i++){
		$(comments[i]).show();
	}
}

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

var INPUT_image = false;
var INPUT_image_SIZE = 0;
var CURRENT_COUNT_RATING_LIST = 0;
var RATING_LIST_COUNTER = 1;

var getRating = function(tag){
	tag = (typeof tag == 'undefined') ? 'order' : tag;
	var limit = CURRENT_COUNT_RATING_LIST;
	var order = $('input[name="order"]').val();
	if(order == '' || typeof order == 'undefined'){
		var url = '/api/tag/' + tag + '/limit/' + limit;
	}
	else{
		var url = '/api/rating/order/' + order + '/limit/' + limit;
	}
	console.log(url);
	$('#rating .preloader').show(); 
	$.getJSON(url, function(d){
		$('#rating .preloader').hide(); 
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
	console.log(data)
	var html = '';
	for(var i in data){
		if(typeof data[i]['id'] == 'undefined'){
			$('.load-more').hide();
			continue;
		}
		var count_review = parseInt(data[i].count_like) + parseInt(data[i].count_dislike) + parseInt(data[i].count_neutral);

		var num = RATING_LIST_COUNTER++;
		num = num < 10 ? '0' + num : num;

		if(data[i]['site_obj'] == false){
			data[i]['site_obj'] = {'screen': '/resources/assets/imgs/screens/default-screen.jpg'};
			data[i]['site_obj']['description'] = 'Игорь Леонидович Николаев – потомственный сибирский маг в пятом колене. Работает официально с 1989 года. Зарекомендовал себя как самый сильный и известный колдун не только в Красноярске, но и по всей Сибири. Верховный жрец ковена Волка-Орла. Магистр черной и белой магии.';
		}

		// if(data[i]['site_obj']['screen'] == ''){
		// 	data[i]['site_obj']['screen'] = '/resources/assets/imgs/screens/default-screen.jpg';
		// }

		if(typeof data[i].cat.title == 'undefined'){
			data[i].cat = {'title': 'Без категории'}
		}

		html += '<div class="rating-item">' +
			'<div class="row">' +
				'<div class="col-3 d-none d-xl-block">' +
					'<div class="cover-container">' +
						'<div class="number-container">' +
							'<div class="number txt-grey-dark"><span>' + num + '</span></div>' + 
						'</div>' +
						'<img src="" data-site-thumbnail="/get-site-thumbnail/' + data[i]['site_obj']['id'] + '" class="cover">' +
						// '<img src="' + data[i]['site_obj']['screen'] + '" class="cover">' +
					'</div>' +
				'</div>' +
				'<div class="col-xl-9 col-12 rating-item-content">' + 
					'<div class="row">' + 
						'<div class="col-12 col-lg-8 col-xl-8">' + 
							'<div class="top Profile-info">' + 
								'<a href="' + data[i]['to_profile'] + '" class="std-a Profile-name">' + data[i].name + '</a><span class="txt-grey Profile-site"> - ' + data[i].site + '</span>' + 
							'</div>' +
							'<div class="bottom location txt-grey">' +
								'Общий рейтинг: <strong class="txt-grey-dark">' + data[i].rating + '</strong>' +
								//'Страна <span class="txt-grey-dark">Украина</span>, город <span class="txt-grey-dark">Киев</span>' +
							'</div>' + 
							'<div class="bottom categoty txt-grey">' +
								'Категория: <span class="txt-grey-dark">' + data[i].cat.title + '</span>' +
							'</div>' +
						'</div>' +

						'<div class="col-12 col-lg-4 col-xl-4">' +
							'<div class="top stats txt-grey-dark">' +
								'<i class="m-icon thumb-up-green"></i> ' + data[i].count_like +
								'<i class="m-icon thumb-down-red"></i> ' + data[i].count_dislike +
								'<i class="m-icon thumbs-up-down"></i> ' + data[i].count_neutral +
							'</div>' +
							'<div class="bottom timestamp txt-grey">' +
								'Добавлен ' + data[i].timestamp + 
							'</div>' +
						'</div>' +
					'</div>' +
					'<div class="row">' +
						'<div class="col-12 txt-grey bottom">' +
							data[i]['site_obj']['description'] +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>';
	}

	$('#rating .items-container').append(html);
	loadRatingThumbnails();
}

var loadRatingThumbnails = function(){
	var thumb = $('[data-site-thumbnail]:eq(0)');
	if(thumb.length == 0) return false;
	// console.log($(thumb).attr('data-site-thumbnail'));
	$.get($(thumb).attr('data-site-thumbnail'), function(res){
		// console.log(res);
		if(res == ''){
			res = '/resources/assets/imgs/screens/default-screen.jpg';
		}
		$(thumb).attr('src', res);
		$(thumb).removeAttr('data-site-thumbnail');
		loadRatingThumbnails();
	});
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


var addNewProfile = function(){
	$('.new-user .send-btn').on('click', function(){
		if($(this).hasClass('disable'))
			return false;
		var container = '.new-user';
		var data = takeData(container);
		data['create-profile'] = true;
		if(data['agree'] != '1'){
			return false;
		}

		$('.new-user .send-btn').addClass('disable').attr('disable');

		$.post('/api/create-profile', data, function(response){
			$(container).find('[name="site"]').val('');
			$(container).find('[name="name"]').val('');
			$(container).find('.agree-box').trigger('click');
			$(container).find('.new-user-form').fadeOut('fast', function(){
				$(container).find('.notification').fadeIn('fast');
			});
			setTimeout(function(){
				$('.hidden-bg').trigger('click');
				setTimeout(function(){
					$(container).find('.new-user-form').show();
					$(container).find('.notification').hide();
				}, 600);
			}, 4000);
		})
	});

}

function check_site_on_exists(){
	$('[name="site"]').on('change', function(){
		var val = $(this).val();
		if(val == ''){
			return false;
		}
		var self = this;
		$.getJSON('/api/exist?site='+val, function(d){
			if(d.result == true){
				$(self).parent().css('border-color', 'red');
				$(self).attr('data-err', true);
				$(self).parent().append('<br><span class="err-mess" style="font-size: 3.5rem; color: red; position: relative; top: -3px;">Такой адрес уже зарегистрирован в системе</span>');
			}else{
				$(self).removeAttr('data-err');
				$(self).parent().removeAttr('style');
				$(self).parent().find('.err-mess').remove();
			}
		});
	});
}

function disable_submit_btn(){
	setInterval(function(){
		var data = takeData('.new-user');
		// console.log(data);
		if(data['agree'] == '1' && data['site'].length > 0 && data['name'].length > 0 && data['catid'] != 0){
			$('.new-user .send-btn').removeClass('disable').removeAttr('disable');
		}else{
			if(!$('.new-user .send-btn').hasClass('disable')){
				$('.new-user .send-btn').addClass('disable').attr('disable', 'disable');
			}
		}

		data = takeData('.new-review');
		if(typeof data['username'] != 'undefined'){
			// console.log(data);
			if(data['username'].length > 0 && data['email'].length > 0 && data['message'].length > 0 && data['rating'] != '-2'){
				$('.new-review .send-btn').removeClass('disable').removeAttr('disable');;
			}else{
				if(!$('.new-review .send-btn').hasClass('disable')){
					$('.new-review .send-btn').addClass('disable').attr('disable', 'disable');
				}
			}
		}

	}, 300);
}

var inpFileToBase64 = function(){
	var file    = document.querySelector('.input.image input').files[0];
	document.querySelector('.input.image .placeholder').innerHTML = file.name;
	INPUT_image_SIZE = file.size;
	var reader  = new FileReader();

	reader.onloadend = function () {
		INPUT_image = reader.result;
	}

	if (file) {
		reader.readAsDataURL(file);
	} else {

	}

}

var addNewReview = function(){
	$('.new-review .send-btn').on('click', function(){
		var container = '.new-review';
		var data = takeData(container);
		data['create-review'] = true;
		if(INPUT_image){
			data['image'] = INPUT_image;
		}

		if(INPUT_image_SIZE / 1024 / 1024 > 2){
			// showNotif('Изображение не должно быть больше 2х мегабайт!', 4000, '#E53935', '#B71C1C');
			return false;
		}

		$('.new-review .send-btn').addClass('disable').attr('disable', 'disable');

		$.post('/api/create-review', data, function(response){
			// console.log(response);
			$(container).find('[name="username"]').val('');
			$(container).find('[name="email"]').val('');
			$(container).find('[name="message"]').val('');
			$(container).find('[name="photo"]').val('');
			$(container).find('[name="rating"]').val('0');
			$(container).find('[name="rating"]').parent().find('.radio').removeClass('active');
			$(container).find('.input.image .placeholder').html($(container).find('.input.image .placeholder').attr('data-default'));
			INPUT_image = false;
			INPUT_image_SIZE = 0;
			$(container).find('.add-review-form').fadeOut('fast', function(){
				$(container).find('.notification').fadeIn('fast');
			});
			setTimeout(function(){
				$(container).find('.notification').fadeOut('fast', function(){
					$(container).find('.add-review-form').fadeIn('fast');
				});
			}, 4000);
		})
	});

}

var sendNewComment = function(){
	$('.new-comment .send-btn').on('click', function(){
		var btn = $(this);
		var form = btn.parent();
		if(btn.hasClass('disable')){
			return false;
		}

		var data = takeData(form);
		data['create-comment'] = 1;
		data['reviewid'] = form.attr('data-review-id');

		// clean fields;
		var inps = form.find('[placeholder]').val('');

		// send data to server
		var path = '/api/create-comment';
		$.post(path, data, function(){
			// success
			// need view message and reload page
			form.hide();
			form.parent().find('.notification').slideDown('fast');
			setTimeout(function(){
				document.location = document.location;
			}, 4000);
		});
	});
}

var reviewNewCommentValidate = function(){
	$('.new-comment input, .new-comment textarea').on('change', function(){
		var form = $(this).parent().parent();
		var sendbtn = $(this).parent().parent().find('button');
		var inps = form.find('[placeholder]');
		var currentEl = $(this);
		currentEl.attr('current', 'true');
		for(var i=0;i<inps.length;i++){
			var inp = $(inps[i]);
			var inpContain = inp.parent();
			var val = inp.val();
			if(val.length < 2){
				if(inp.attr('current') == 'true'){
					inpContain.addClass('danger');
					inp.removeAttr('current');
				}
				if(!sendbtn.hasClass('disable')){
					sendbtn.addClass('disable');
				}
			}else{
				if(inp.attr('current') == 'true'){
					inpContain.removeClass('danger');
					inp.removeAttr('current');
				}
				if(sendbtn.hasClass('disable')){
					sendbtn.removeClass('disable');
				}
			}
		}
	});
}

var firstLetter = function(){
	var nu = $('[data-fl-content]');
		if(typeof nu != 'undefined'){
			for(var i in nu){
				var value = $(nu[i]).attr('data-fl-content');
				if(value == ''){
					continue;
				}
				$(nu[i]).html(value[0]);
			}
		}
}

var goToReview = function(){
	var hash = document.location.hash;
	var review = hash.split('#review-');
	if(review.length != 2){
		return false;
	}

	review = review[1];
	var reviewCont = $(hash);
	setTimeout(function(){
		reviewCont.find('.review-foot a', 0).trigger('click');
	}, 500);
}