function disable_submit_btn(){
	setInterval(function(){
		var data = takeData('.add-user-container');
		// console.log(data);
		if(data['agree'] == '1' && data['site'].length > 0 && data['name'].length > 0 && data['catid'] != 0){
			$('.add-user-container .send-form').removeClass('disable');
		}else{
			if(!$('.add-user-container .send-form').hasClass('disable')){
				$('.add-user-container .send-form').addClass('disable');
			}
		}

		data = takeData('.add-comments-form');
		if(typeof data['username'] != 'undefined'){
			// console.log(data);
			if(data['username'].length > 0 && data['email'].length > 0 && data['message'].length > 0 && data['rating'] != '-2'){
				$('.add-comments-form .send-form').removeClass('disable');
			}else{
				if(!$('.add-comments-form .send-form').hasClass('disable')){
					$('.add-comments-form .send-form').addClass('disable');
				}
			}
		}

		data = takeData('.rd-active');
		if(typeof data['email'] != 'undefined'){
			// console.log(data);
			if(data['email'].length > 0 && data['message'].length > 0){
				$('.rd-active .send-form').removeClass('disable');
			}else{
				if(!$('.rd-active .send-form').hasClass('disable')){
					$('.rd-active .send-form').addClass('disable');
				}
			}
		}

	}, 300);
}