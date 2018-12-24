$(document).ready(function(){
  $('.mobile-menu').html($('.nav-main ul').html() + '<div class="mob-sidebar">' + $('.sidebar').html() + '</div>');

  $('button[data-menu]').click(function(){
		if($(this).hasClass('menu')){
			$('.mobile-menu').addClass('active');
			$(this).addClass('close');
			$(this).removeClass('menu');
			$('.mobile-menu').animate({
		        scrollTop: 0
		    }, 400);
		}else{
			$('.mobile-menu').removeClass('active');
			$(this).removeClass('close');
			$(this).addClass('menu');
		}
	})

	$('.mobile-menu a').on('click', function(){
		$('button[data-menu].close').trigger('click');
	});

	var $page = $('html, body');
	$('[href*="#"]').click(function() {
		let href = $(this).attr('href');
		if($(href).length != 0){
		    $page.animate({
		        scrollTop: $(href).offset().top
		    }, 400);
		}
	});
});
