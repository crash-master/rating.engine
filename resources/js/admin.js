$(document).ready(function(){
	// var textarea = $('#wysivyg');
	// if(typeof textarea != 'undefined'){
	// 	$(textarea).markItUp(myHtmlSettings);
	// }
	$.trumbowyg.svgPath = '/resources/css/libs/icons.svg';
	$('#content').trumbowyg();

	$('.danger-link').click(function(){
		var ans = confirm('Удалить?');
		console.log(ans);
		if(!ans){
			return false;
		}
	});

	$('.description-update').on('click', function(){
		$(this).parent().find('.description-form').show();
		return false;
	});

	$('.description-form .close').on('click', function(){
		$(this).parent().hide();
	});

	$('.description-form .update').on('click', function(){
		var inp = $(this).parent().find('[name="description"]');
		var val = inp.val();
		var url = $(this).attr('data-url');
		$.post(url, {'description': val}, function(){
			console.log('Success sendig new description');
			$('.description-form').hide();
		});
	});

	$('[data-edit]').on('click', function(){
		var val = $(this).html();
		if(val.indexOf('<input') != -1){
			return false;
		}
		$(this).html('<input class="form-control td-edit">');
		var inp = $(this).find('.td-edit');
		inp.val(val);
		inp.attr('data-old-val', val);
		inp.focus();
		inp.on('blur', function(){
			var newval = $(this).val();
			if($(this).attr('data-old-val') != newval){
				var url = $(this).parent().attr('data-edit');
				newval = newval.replace(/\//gi, '**');
				url = url.replace('?', newval);
				console.log(url);
				$.get(url, function(res){
					console.log(res);
				})
			}
			newval = newval.replace(/\*\*/gi, '/');
			$(this).parent().html(newval);
		});

		inp.on('keydown', function(e){
			if(e.keyCode == 13){
				$(this).trigger('blur');
			}
		})
	});

	$('#tag-list').on('change',function(){
		var profileid = $('[name="mid"]').val();
		var val = $(this).val();
		if(val == ''){
			return false;
		}
		var title = $(this).find('[value="' + val + '"]').html();
		val = val.split(':');
		var tagid = val[0];
		var slug = val[1];
		var a = '<div class="col-4"><button class="btn" d-id="' + tagid + '">Удалить</button></div>';
		var li = '<li class="list-group-item" tag-id="' + tagid + '"><div class="row"><div class="col-8">' + title + ' <small>(' + slug + ')</small></div> ' + a + '</div></li>';
		if($('#tag-list-out').find('[tag-id="' + tagid + '"]').length){
			return false;
		}
		$('#tag-list-out').append(li);
		// send to serv
		$.get('/api/profile-tags/create/' + profileid + '/' + tagid);
		tagRemoveBtnInit('[d-id="' + tagid + '"]');
	});

	$('#tag-list-out [d-id]').each(function(){
		tagRemoveBtnInit($(this));
	})

	check_site_on_exists();
})

function tagRemoveBtnInit(btn){
	$(btn).on('click', function(){
		var profileid = $('[name="mid"]').val();
		var tagid = $(this).attr('d-id');
		// send to serv
		$.get('/api/profile-tags/remove/' + profileid + '/' + tagid);
		$(this).parent().parent().parent().remove();
	});
}

function check_site_on_exists(){
	$('#meta [name="site"]').on('change', function(){
		var val = $(this).val();
		if(val == ''){
			return false;
		}
		var self = this;
		$.getJSON('/api/exist?site='+val, function(d){
			if(d.result == true){
				$(self).parent().css('border-color', 'red');
				$(self).attr('data-err', true);
				$(self).parent().append('<br><span class="err-mess" style="font-size: 16px; color: red; position: relative; top: -13px;">Такой адрес уже зарегистрирован в системе</span>');
			}else{
				$(self).removeAttr('data-err');
				$(self).parent().removeAttr('style');
				$(self).parent().find('.err-mess').remove();
			}
		});
	});
}