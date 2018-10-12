var Pagination = function(countAll, countOnPage, RATING){
	var self = this;
	this.countAll = 30;
	this.countOnPage = 3;
	this.currentPage = 1;
	this.countBtns = 0;
	this.RATING;

	this.init = function(countAll, countOnPage, RATING){
		self.countAll = countAll;
		self.countOnPage = countOnPage;
		// self.currentPage = currentPage;
		self.countBtns = Math.ceil(countAll / countOnPage);
		self.RATING = RATING;
	}

	this.model = function(){

	}

	this.controller = function(){
		self.render();

		$('.pagination .pagination-item.num').click(function(){
			self.currentPage = $(this).attr('data-page');
			self.controller();
			return false;
		});

		$('.pagination .pagination-item.pag-next').click(function(){
			self.currentPage++;
			self.controller();
			return false;
		});

		$('.pagination .pagination-item.pag-prev').click(function(){
			self.currentPage--;
			self.controller();
			return false;
		});

		self.RATING.model(self.currentPage);
	}

	this.render = function(){
		var html = '';
		if(self.countBtns == 1){
			return false;
		}

		if(self.currentPage != 1){
			html += '<a href="#" class="yd-btn pagination-item pag-prev">' +
						'<i class="fa fa-long-arrow-left" aria-hidden="true"></i>' +
					'</a>';
		}

		console.log(self.countBtns);
		for(var i=1; i<=self.countBtns; i++){
			var active = '';
			var visible = false;
			var inverse = false;
			var iverseAndLast = false;

			if(this.currentPage > self.countBtns - 2){
				inverse = true;
			}

			if(self.currentPage == i){
				active = 'current-item';
				visible = true;
			}

			if(!inverse){
				if(i + 1 == self.currentPage || i - 1 == self.currentPage){
					visible = true;
				}
			}
			if(inverse){
				if(i == self.countBtns - 1 || i == self.countBtns - 2 || i == 1){
					visible = true;
					iverseAndLast = true;
				}
			}

			if((this.currentPage == 1 && i == 3) || i == self.countBtns){
				visible = true;
			}

			if(self.countBtns > 4){
				if(i == self.countBtns && !inverse){
					html += '<span class="dots">...</span>';
				}
				if(i == 2 && inverse){
					html += '<span class="dots">...</span>';
				}
			}
			
			if(visible){
				html += '<a href="#" data-page="' + i + '" class="yd-btn pagination-item num ' + active + '">' + i + '</a>';
			}

		}

		if(self.currentPage != self.countBtns){
			html += '<a href="#" class="yd-btn pagination-item pag-next">' +
						'<i class="fa fa-long-arrow-right" aria-hidden="true"></i>' +
					'</a>';
		}


		$('.pagination').html(html);
	}

	self.init(countAll, countOnPage, RATING);

	self.controller();

}