var Search = function(){
	var self = this;
	this.urlTemplate = '/api/search/clean/{word}';
	this.searchInput = '.search input';
	this.resultContainer = '.search-result';

	this.controller = function(){
		this.active = function(e){
			var search = $(this).val();
			if(search.length > 1){
				self.model(search);
			}
		}

		$(self.searchInput).keyup(this.active).focus(this.active).blur(function(){
			self.resultHide();
		});
	}

	this.model = function(search){
		console.log(this.urlTemplate.replace("{word}", search));
		$.getJSON(this.urlTemplate.replace("{word}", search), function(d){
			console.log(d);
			if(typeof d.result != 'undefined' && d.result != false){
				self.draw(d.result);
			}
		})
	}

	this.draw = function(d){
		var html = '';
		$(self.resultContainer).html(html);
		for(var i=0; i<d.length; i++){
			html += '<a href="' + d[i]['to_profile'] + '">' + d[i]['name'] + '</a>';
		}
		console.log(html);
		$(self.resultContainer).html(html);
		self.resultShow();
	}

	this.resultHide = function(){
		$(self.resultContainer).slideUp('fast');
	}

	this.resultShow = function(){
		$(self.resultContainer).slideDown('fast');
	}

	self.controller();
}