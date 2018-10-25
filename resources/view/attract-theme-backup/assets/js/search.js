var Search = function(){
	var self = this;
	this.urlTemplate = '/api/search/';
	this.searchInput = '.search-input';
	this.resultContainer = '.search-result';

	this.controller = function(){
		$(self.searchInput).on('keydown', function(){
			self.model(this);
		});

		$('.search-open').on('click', function(){
			self.open();
			$('.search-result').show();
		});
	}

	this.open = function(){
		$('.search').addClass('active');
		$('.hidden-bg').show();
	}

	this.model = function(el){
		word = $(el).val();
		$.getJSON(self.urlTemplate + word, function(d){
			self.draw(d);
		});
	}

	this.draw = function(d){
		$(self.resultContainer).html(d.result);
	}

	self.controller();
}
