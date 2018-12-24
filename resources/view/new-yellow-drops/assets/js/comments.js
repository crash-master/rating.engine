var Comments = function(){
	var self = this;
	this.url = '/api/create-comment';
	this.container = false;

	// methods
	this.toCollectData = function(el){
		var container = $(el).parent().parent().parent();
		self.container = container;
		var fields = $(container).find('.yd-input');
		data = {};
		for(var i=0; i<fields.length; i++){
			if(typeof fields[i] != 'undefiend'){
				var field = $(fields[i]);
				data[$(field).attr('name')] = $(field).val();
				$(field).val('');
			}
		}

		data['commentid'] = typeof $(el).attr('data-comment-id') == 'undefined' ? 0 : $(el).attr('data-comment-id');
		data['profileid'] = typeof $(el).attr('data-profile-id') == 'undefined' ? 0 : $(el).attr('data-profile-id');
		data['articleid'] = typeof $(el).attr('data-article-id') == 'undefined' ? 0 : $(el).attr('data-article-id');
		data['create-comment'] = true;
		
		return data;
	}

	this.dataIsCorrect = function(data){
		// if(data.name.length < 2){
		// 	return false;
		// }
		// if(data.email.length < 4){
		// 	return false;
		// }
		if(data.message.length < 3){
			return false;
		}

		return true;
	}

	this.dump = function(data){
		if(self.dataIsCorrect(data)){
			self.sendingState();
			$.post(self.url, data, function(d){
				self.sendingSuccessState();
			});
		}else{
			self.viewErr();
		}
	}

	this.sendingState = function(){
		$('.form-state').hide().parent().find('button').hide();
		$('.form-state.sending').show();
	}

	this.sendingSuccessState = function(){
		$('.form-state').hide().parent().find('button').hide();
		$('.form-state.sending-success').show();
		setTimeout(function(){
			$('.form-state').hide().parent().find('button').show();
		}, 4000);
	}

	this.controller = function(){
		$('.create-comment-form button.yd-btn').on('click', function(){
			var data = self.toCollectData(this);
			self.dump(data);
		});

		// count comments to disp
		// var comments = $('.comments-container .comment-item');
		// $('#count-comments-container').html(comments.length);
	}

	this.viewErr = function(){
		console.log('ERR');
		// var mess = '<span style="color: red">' + 'Не все поля корректно заполнены' + '</span>';
		// $(self.container).find('.create-comment-form-footer div:eq(0)').html(mess);
	}

	self.controller();
}