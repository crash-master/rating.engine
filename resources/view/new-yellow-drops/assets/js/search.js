var Search = function(){
	var self = this;
	this.urlTemplate = '/api/search/clean/{word}';
	this.searchInput = '.search-field input';
	this.resultContainer = '.search-result-container';

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
			self.draw(d.result);
		})
	}

	this.draw = function(d){
		var html = '';
		$(self.resultContainer).html(html);
		if(d){
			for(var i=0; i<d.length; i++){
				if(d[i].type == 'profile'){
					html += '<a href="' + d[i]['to_profile'] + '" class="search-item s-profile-item">' +
					'<div class="stitle"><i class="mdi mdi-account"></i> ' + d[i]['name'] + '</div>' +
					'<div class="sdesc">' + d[i]['site'] + '</div>' +
					'</a>';
				}else if(d[i].type == 'article'){
					html += '<a href="' + d[i]['link'] + '" class="search-item s-article-item">' + 
					'<div class="stitle"><i class="mdi mdi-text"></i> ' + d[i]['meta']['title'] + '</div>' +
					'<div class="sdesc">' + d[i]['meta']['description'] + '</div>' +
					'</a>';
				}
			}

			$(self.resultContainer).html(html);
		}
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