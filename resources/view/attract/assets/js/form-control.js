var FormControl = function(){
  var self = this;
  
  this.newSelect = function(selector){
    self.selectControl(selector);
  }
  
  this.selectControl = function(selector){
  	var sel = $(selector);
  	var icon = sel.find('.m-icon', 0);
  	var inp = sel.find('input',0);
  	var placeholder = sel.find('.placeholder');
  	if(sel.hasClass('select')){
  		var closeLay = sel.find('.close-layer');
  		var optContainer = sel.find('.options');
  		var options = optContainer.find('.option');
  		$(sel).on('click', function(){
  			if(optContainer.hasClass('open')){
  				return false;
  			}
  			optContainer.slideDown('fast');
  			optContainer.addClass('open');
  			closeLay.show();
  		});
  
  		options.on('click', function(){
  			var val = $(this).html();
  			placeholder.html(val);
  			inp.val($(this).attr('data-value'));
  			setTimeout(function(){
  				optContainer.removeClass('open');
  			}, 50);
  			optContainer.slideUp('fast');
  			closeLay.hide();
  		});
  
  		closeLay.on('click', function(){
  			setTimeout(function(){
  				optContainer.removeClass('open');
  			}, 50);
  			optContainer.slideUp('fast');
  			closeLay.hide();
  		});
  
  	}
  }
  
  this.checkboxControl = function(el){
    var val = $(el).parent().find('input[type="hidden"]').val();
    if(val == 0){
      $(el).parent().find('input[type="hidden"]').val('1');
      $(el).parent().find('.box').addClass('active');
    }else{
      $(el).parent().find('input[type="hidden"]').val('0');
      $(el).parent().find('.box').removeClass('active');
    }
  }
  
  this.newCheckbox = function(selector){
    $(selector).on('click', function(){
      self.checkboxControl(this);
    });
  }
  
}