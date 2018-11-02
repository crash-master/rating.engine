$(document).ready(function(){
	$('.carousel').carousel({
		interval: 5000
	});

	mobileNavInit();

	// profile_comments
	let comments = new Comments();

	// $('.carousel').carousel('2');
	var formControl = new FormControl();
	formControl.newSelect('#rating-order');
	formControl.newSelect('.new-user .select');
	formControl.newCheckbox('.checkbox .box');
	formControl.newCheckbox('.checkbox .label');
	formControl.newCheckbox('.checkbox .placeholder');

	$('.new-user-open').on('click', function(){
		$('.new-user').addClass('active');
		$('.hidden-bg').show();
	});

	$('.new-review .input.image input[type="file"]').on('change', function(){
		inpFileToBase64();
	});

	let search = new Search();
	$('#rating .load-more').on('click', function(){
		var tag = $(this).attr('data-tag');
		if(typeof tag != 'undefined' && tag != ''){
			rating.get(tag);
		}else{
			rating.get();
		}
	});

// excerpt news description

	excerptNewsItemsOnHomePage()


	mainEventsInit();
	closePopUpInit();
	dataFuncInit();
	dataHrefInit();

	goToReview();

	addNewProfile();
	addNewReview();
	check_site_on_exists();
	disable_submit_btn();
});

var INPUT_image = false;
var INPUT_image_SIZE = 0;

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
