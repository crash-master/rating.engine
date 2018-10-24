var Rating = function(){
	var self = this;
	this.currentCountRatingList = 0;
  this.ratingListCounter = 1;
  
  this.get = function(tag){
    self.controller(tag);
  }

	this.controller = function(){
    tag = (typeof tag == 'undefined') ? 'order' : tag;
    var limit = self.currentCountRatingList;
    var order = $('input[name="order"]').val();
    if(order == '' || typeof order == 'undefined'){
      var url = '/api/tag/' + tag + '/limit/' + limit;
    }else{
      var url = '/api/rating/order/' + order + '/limit/' + limit;
    }
    console.log(url);
    $('#rating .preloader').show();
    self.model(url, function(){
      self.loadRatingThumbnails();
    });
	}

	this.model = function(url, callback){
    $.getJSON(url, function(d){
  		$('#rating .preloader').hide();
  		self.currentCountRatingList += d.rating.length;
  		if(self.currentCountRatingList == d.len){
  			$('.load-more').hide();
  		}else{
  			$('.load-more').show();
  		}
  		self.render(d.rating);
      callback();
  	});
	}

	this.render = function(data){
    var html = '';
    for(var i in data){
      if(typeof data[i]['id'] == 'undefined'){
        $('.load-more').hide();
        continue;
      }
      var count_review = parseInt(data[i].count_like) + parseInt(data[i].count_dislike) + parseInt(data[i].count_neutral);
  
      var num = self.ratingListCounter++;
      num = num < 10 ? '0' + num : num;
  
      if(data[i]['site_obj'] == false){
        data[i]['site_obj'] = {'screen': '/resources/assets/imgs/screens/default-screen.jpg'};
        data[i]['site_obj']['description'] = 'Игорь Леонидович Николаев – потомственный сибирский маг в пятом колене. Работает официально с 1989 года. Зарекомендовал себя как самый сильный и известный колдун не только в Красноярске, но и по всей Сибири. Верховный жрец ковена Волка-Орла. Магистр черной и белой магии.';
      }
  
      let description_tmp = data[i]['site_obj']['description'].split('.');
      let description = description_tmp[0] + '.' + description_tmp[1];
      if(description.split(' ').length < 30){
        description += description_tmp[2] + '...';
      }else{
        description += '...';
      }
  
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
                description +
              '</div>' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>';
    }
  
    $('#rating .items-container').append(html);
	}

	this.loadRatingThumbnails = function(){
		var thumb = $('[data-site-thumbnail]:eq(0)');
		if(thumb.length == 0) return false;
		$.get($(thumb).attr('data-site-thumbnail'), function(res){
			if(res == ''){
				res = '/resources/view/attract/assets/imgs/screens/default-screen.jpg';
			}
			$(thumb).attr('src', res);
			$(thumb).removeAttr('data-site-thumbnail');
			self.loadRatingThumbnails();
		});
	}

}