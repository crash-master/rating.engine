var Rating = function(){
	var self = this;
	this.currentCountRatingList = 0;
	this.countOnPage = 10;
	this.countPages;

	this.controller = function(){
		self.model(1, function(countAll, countOnPage){
			var pagination = new Pagination(countAll, countOnPage, self);
		});
	}

	this.model = function(page, callback){
		// var limit = self.currentCountRatingList;
		var limit = (page - 1) * self.countOnPage;
		var order = 'timestamp';
		$.getJSON('/api/rating/order/' + order + '/limit/' + limit, function(d){
			// console.log(d);
			// self.currentCountRatingList += d.rating.length;

			self.countPages = Math.ceil(d.len / self.countOnPage);
			if(typeof callback != 'undefined'){
				callback(d.len, self.countOnPage);
			}
			self.render(d.rating);
		});
	}

	this.render = function(data){
		var html = '';
		for(var i in data){
			if(typeof data[i]['id'] == 'undefined'){
				// $('.load-more').hide();
				continue;
			}

			data[i].timestamp = data[i].timestamp.split(' ')[0];
			data[i].site_obj.description = data[i].site_obj.description.split('::::')[0];

			html += '<div class="profile-item">' +
		'<div class="profile-item-head">' +
			'<div class="row">' +
				'<div class="col-8">' +
					'<h2 class="profile-title"><a href="' + data[i]['to_profile'] + '">' + data[i].name + '</a></h2>' +
				'</div>' +
				'<div class="col-4">' +
					'<div class="timestamp">' + data[i].timestamp + '</div>' +
				'</div>' +
			'</div>' +
		'</div>' +
		'<div class="profile-item-body">' +
			'<div class="row">' +
				'<div class="col-4">' +
					'<img class="profile-thumb" src="/resources/view/yellow-drops/assets/imgs/screen-site.png" data-site-thumbnail="/get-site-thumbnail/' + data[i]['site_obj']['id'] + '" alt="Скриншот сайта">' +
				'</div>' +
				'<div class="col-8">' +
					'<div class="profile-site-link">' + data[i].site + '</div>' +
					'<div class="profile-description">' +
						'<h4 class="profile-description-title">Краткое описание</h4>' + data[i].site_obj.description +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>' +
		'<div class="profile-item-foot">' +
			'<div class="row">' +
				'<div class="col-7">' +
					'<div class="count-comments">Коментариев: <strong>' + data[i]['count_comments'] + '</strong></div>' +
				'</div>' +
				'<div class="col-5">' +
					'<div class="open-profile-btn-container">' +
						'<a href="' + data[i]['to_profile'] + '" class="yd-btn open-profile">Читать далее</a>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>' +
	'</div>';

		}

		$('#rating').html(html);
		self.loadRatingThumbnails();
		
	}

	this.loadRatingThumbnails = function(){
		var thumb = $('[data-site-thumbnail]:eq(0)');
		if(thumb.length == 0) return false;
		// console.log($(thumb).attr('data-site-thumbnail'));
		$.get($(thumb).attr('data-site-thumbnail'), function(res){
			// console.log(res);
			if(res == ''){
				res = '/resources/view/yellow-drops/assets/imgs/screen-site.png';
			}
			$(thumb).attr('src', res);
			$(thumb).removeAttr('data-site-thumbnail');
			self.loadRatingThumbnails();
		});
	}

	self.controller();
}