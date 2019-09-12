var Comments = function(){
  var self = this;
  this.countCommentsOnPageNow = 0;
  this.countOnPage = 3;
  this.currentCommentPages = 0;
  
  this.openComments = function(container){
    $(comments).find('.comments-paginator').show();
  	$(comments).find('.block-title').show();
  	$(container).slideDown('normal');
  	var comments = $(container).find('.comment-item');
  	self.countCommentsOnPageNow = self.countOnPage;
  	self.currentCommentPages = 1;
  	self.CPCounterProcessor(container, comments.length);
  
  	$(comments).hide();
  	var min = Math.min(comments.length, self.countOnPage);
  	for(var i=0;i<min;i++){
  		$(comments[i]).show();
  	}

    $(container).find('.new-comment').attr('data-comment-id', '0');
  }
  
  this.initProfileComments = function(){
    $('#profile .review-item .review-foot a').on('click', function(){
  		var count = parseInt($(this).find('span', 0).html().split('(')[1]);
  		var comments = $(this).parent().parent().parent().parent().find('.comments');
  		if(count == 0){
  			$(comments).find('.comment-item').hide();
  			$(comments).find('.comments-paginator').hide();
  			$(comments).find('.block-title').hide();
  			$(comments).slideDown('normal');
  			return false;
  		}
  
  		if(!$(comments).is(':visible')){
  			// open
  			self.openComments(comments);
  		}else{
  			// close
  			$(comments).slideUp('normal');
  		}
  
  		return false;
  	});
  }

  this.initAnswerBtn = function(){
    let self = this;
    $('.comment-item .answer').on('click', function(e){
      e.preventDefault();
      let commentID = $(this).attr('data-comment-id');
      let uname = $(this).attr('data-uname');
      let container = $($(this).parent().parent().parent().parent().parent());
      self.cancelAnswer(container);
      $(this).hide();
      container.find('.new-comment').attr('data-comment-id', commentID);
      container.find('.answer-desc .uname').html(uname);
      container.find('.answer-desc').show();
      container.find('.new-comment input', 0).focus();
    });

    $('.answer-cancel').on('click', function(){
      let container = $(this).parent().parent().parent();
      self.cancelAnswer(container);
    });
  }

  this.cancelAnswer = function(container){
    $(container).find('.new-comment').attr('data-comment-id', '0');
    $(container).find('.answer-desc').hide();
    $(container).find('.comment-item .answer').show();
  }
  
  this.commentsPaginationInit = function(){
    $('.next-comments-page').on('click', function(){
  		self.commentsPagination($(this).parent().parent(), 'next');
  	});
  	$('.prev-comments-page').on('click', function(){
  		self.commentsPagination($(this).parent().parent(), 'prev');
  	});
  }
  
  this.closeProfileCommentsInit = function(){
    $('.close-comments').click(function(){
  		var comments = $(this).parent();
  		if(!$(comments).is(':visible')){
  			// open
  			this.openComments(comments);
  		}else{
  			// close
  			$(comments).slideUp('normal');
  		}
  	});
  }
  
  this.commentsPagination = function(container, way){
    var comments = $(container).find('.comment-item');
  	var total = comments.length;
  	if(way == 'next')
  		self.currentCommentPages++;
  	else{
  		self.currentCommentPages--;
  	}
  	self.countCommentsOnPageNow = self.countOnPage * self.currentCommentPages;
  	if(Math.abs(total - self.countCommentsOnPageNow) < self.countOnPage){
  		// next
  		self.CPCounterProcessor(container, total);
  	}else{
  		// first
  		self.countCommentsOnPageNow = 3;
  		self.currentCommentPages = 1;
  		self.CPCounterProcessor(container, total);
    }
    
    $(comments).hide();
  	var min = Math.min(self.countCommentsOnPageNow, total);
  	var start = self.countCommentsOnPageNow - self.countOnPage;
  
  	for(var i=start;i<min;i++){
  		$(comments[i]).show();
  	}
  }
  
  this.CPCounterProcessor = function(container, total){
  	var cp_counter = $(container).find('.cp-counter');
  	var m = Math.min(self.countCommentsOnPageNow, total);
  	cp_counter.html(m + ' из ' + total);
  	if(total <= self.countOnPage){
  		$(cp_counter).parent().find('button').hide();
  	}else{
  		$(cp_counter).parent().find('button').show();
  	}
  }
  
  this.sendNewCommentInit = function(){
  	$('.new-comment .send-btn').on('click', function(){
  		var btn = $(this);
  		var form = btn.parent();
      let commentID = btn.parent().attr('data-comment-id');
  		if(btn.hasClass('disable')){
  			return false;
  		}
  
  		var data = takeData(form);
  		data['create-comment'] = 1;      
      if(typeof commentID == 'undefined'){
        data['reviewid'] = form.attr('data-review-id');
      }else{
  		  data['commentid'] = commentID;
      }
  
  		// clean fields;
  		var inps = form.find('[placeholder]').val('');
  
  		// send data to server
  		var path = '/api/create-comment';
  		$.post(path, data, function(){
  			// success
  			// need view message and reload page
  			form.hide();
  			form.parent().find('.notification').slideDown('fast');
  			setTimeout(function(){
  				document.location = document.location;
  			}, 4000);
  		});
  	});
  }
  
  this.reviewNewCommentValidate = function(){
  	$('.new-comment input, .new-comment textarea').on('change', function(){
  		var form = $(this).parent().parent();
  		var sendbtn = $(this).parent().parent().find('button');
  		var inps = form.find('[placeholder]');
  		var currentEl = $(this);
  		currentEl.attr('current', 'true');
  		for(var i=0;i<inps.length;i++){
  			var inp = $(inps[i]);
  			var inpContain = inp.parent();
  			var val = inp.val();
  			if(val.length < 2){
  				if(inp.attr('current') == 'true'){
  					inpContain.addClass('danger');
  					inp.removeAttr('current');
  				}
  				if(!sendbtn.hasClass('disable')){
  					sendbtn.addClass('disable');
  				}
  			}else{
  				if(inp.attr('current') == 'true'){
  					inpContain.removeClass('danger');
  					inp.removeAttr('current');
  				}
  				if(sendbtn.hasClass('disable')){
  					sendbtn.removeClass('disable');
  				}
  			}
  		}
  	});
  }
  
  this.init = function(){
    self.sendNewCommentInit();
    self.initProfileComments();
    self.commentsPaginationInit();
    self.closeProfileCommentsInit();
    self.reviewNewCommentValidate();
    self.initAnswerBtn();
  }
  
  self.init();
  
}