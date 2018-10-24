function mobileNavInit(){
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
}