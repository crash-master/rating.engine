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
