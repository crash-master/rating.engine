function dataFuncInit(){
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
}

function dataHrefInit(){
  $('[data-href]').click(function(){
	var href = $(this).attr('data-href');
	$(this).attr('href', href);
  });
}

function mainEventsInit(){
  $('.danger-link').click(function(){
	var ans = confirm('Удалить?');
	console.log(ans);
	if(!ans){
	  return false;
	}
  });

  // img-radio btn
  $('.img-radio .radio').on('click', function(){
	$(this).parent().find('.radio').removeClass('active');
	$(this).addClass('active');
	$(this).parent().find('input').val($(this).attr('data-val'));
  });
}

function closePopUpInit(){
  $('.hidden-bg, .close-popup').on('click', function(){
		$('.hidden-bg').hide();
	$('.search-result').hide();
		$('.popup').removeClass('active');
	});
}

function goToReview(){
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

function excerptNewsItemsOnHomePage(){
  if(document.location.pathname != '/'){
	return false;
  }

  let params = {
	len: {
	  min: 100,
	  max: 110
	},
	numberOfWords: 10,
	numberOfSentence: 1
  }

	let excerpt = new ExcerptJS(params);
	console.log($('.news-item-big .description .news-desc'));
	excerpt.input($('.news-item-big .description .news-desc').html());
	$('.news-item-big .description .news-desc').html(excerpt.out('symbols') + '...');

	let newsItems = $('.news-item');
	for(let i of newsItems){
		let txt = $(i).find('.description .news-desc').html();
		excerpt.input(txt);
		$(i).find('.description .news-desc').html(excerpt.out('symbols') + '...');
	}

	params.len.min = 30;
	params.len.max = 35;
	let excerptNewsTitle = new ExcerptJS(params);
	excerptNewsTitle.input($('.news-item-big a.news-title').html());
	$('.news-item-big a.news-title').html(excerptNewsTitle.out('symbols') + '...')

}

function excerptLastProfiles(){
  if(document.location.pathname != '/'){
	return false;
  }

  let params = {
	len: {
	  min: 250,
	  max: 280
	},
	numberOfWords: 40,
	numberOfSentence: 1
  }

  let excerpt = new ExcerptJS(params);
  let items = $('#last-reviews .review-body');
  for(let i=0; i<items.length; i++){
  	let source = $(items[i]).html();
	excerpt.input(source);
	let result = excerpt.out('symbols');
	if(result != source){
		result += '...';
	}
	$(items[i]).html(result);
  }
}

function loaderShow(selector){
	$(selector).removeClass('hid');
}

function loaderHid(selector){
	$(selector).addClass('hid');
}
