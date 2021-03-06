let _quill;
$(document).ready(function(){

	var toolbarOptions = [
	  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
	  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
	  [{ 'align': [] }],
	  ['blockquote', /*'code-block'*/],
	  ['image']

	  //[{ 'header': 1 }, { 'header': 2 }],               // custom button values
	  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
	  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
	  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
	  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
	  //[{ 'direction': 'rtl' }],                         // text direction

	  // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
	  // [{ 'font': [] }],

	  ['clean']                                         // remove formatting button
	];
	//$.trumbowyg.svgPath = '/resources/css/libs/icons.svg';
	//$('#content').trumbowyg();
	$('#description').trumbowyg();
	_quill = new Quill('.quill-editor', {
	  modules: { toolbar: '.quill-toolbar-container' },
	  theme: 'snow',
	  placeholder: "Поле для создания",
	});

	// let toolbar = _quill.getModule('toolbar');
	// toolbar.addHandler('image', showImageUI);

	setTimeout(function(){
		let qlImageInside = $('.ql-image').html();
		let cont = $('.ql-image').parent();
		$('.ql-image').remove();
		cont.append('<button class="ql-image">' + qlImageInside + '</button>');
		customMedia();
	}, 200);

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
		let pathToCreate = $(this).attr('data-path-to-create');
		var entityid = $('[name="mid"]').val();
		var val = $(this).val();
		if(val == ''){
			return false;
		}
		var title = $(this).find('[value="' + val + '"]').html();
		val = val.split(':');
		var tagid = val[0];
		var slug = val[1];
		var a = '<span class="badge badge-pill" style="cursor: pointer; padding: 5px; font-size: 16px; color: #FF4136" d-id="' + tagid + '"><i class="fa fa-times-circle" aria-hidden="true"></i></span>';
		var li = '<li class="list-group-item d-flex justify-content-between align-items-center" tag-id="' + tagid + '">' + title + ' /' + slug + '/ ' + a + '</li>';
		if($('#tag-list-out').find('[tag-id="' + tagid + '"]').length){
			return false;
		}
		$('#tag-list-out').append(li);
		// send to serv
		$.get(pathToCreate + entityid + '/' + tagid);
		tagRemoveBtnInit('[d-id="' + tagid + '"]');
	});

	$('#tag-list-out [d-id]').each(function(){
		tagRemoveBtnInit($(this));
	})

	check_site_on_exists();
	if($('.ql-editor').length){
		setInterval(function(){
			let container = $('.ql-editor');
			let content = container.html();
			container.parent().parent().find('.quill-textarea').val(content);
		}, 100);
	}

	custom_file_loader_fix_filename();

	$('button.menu').on('click', function(){
		if($(this).attr('data-menu-status') == 'close'){
			$(this).attr('data-menu-status', 'open');
			$('#aside').addClass('active');
		}else{
			$(this).attr('data-menu-status', 'close');
			$('#aside').removeClass('active');
		}
	});
})

function tagRemoveBtnInit(btn){
	let pathToRemove = $('#tag-list').attr('data-path-to-remove');
	$(btn).on('click', function(){
		var entityid = $('[name="mid"]').val();
		var tagid = $(this).attr('d-id');
		// send to serv
		$.get(pathToRemove + entityid + '/' + tagid);
		$(this).parent().remove();
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

function customMedia(){
	$('.ql-image').on('click', function(e){
		e.preventDefault();
		$('.media-model-btn').trigger('click');
		let modal = $('#mediaModal');
		let img_link = '/binary-img/id/{media_id}/size/{size}';
		let modalBody = modal.find('.modal-body');
		let mediaContainer = modalBody.find('.media-container');
		let closeModal = modal.find('.close:eq(0)');
		let insertField = $(this).parent().parent().parent().find('.ql-editor');
		if(mediaContainer.html() == ''){
			$.getJSON('/api/media-list', function(d){
				let html = '';
				for(let item of d){
					html += '<div class="media-item" data-media-id="' + item.id + '" data-media-alt="' + item.alt + '" data-src="' + item.bin_link + '" style="background-image: url(' + item.bin_link + ')"></div>';
				}
				mediaContainer.html(html);

				// events
				mediaContainer.find('.media-item')
				.on('click', function(){
					let id = $(this).attr('data-media-id');
					let link = img_link.replace('{media_id}', id).replace('{size}', 'lg');
					let alt = $(this).attr('data-media-alt');
					insertField.append('<img src="' + link + '" alt="' + alt + '">');
					closeModal.trigger('click');
				})
				.on('mouseover', function(){
					if($(this).hasClass('quality')){
						return false;
					}
					let id = $(this).attr('data-media-id');
					let link = img_link.replace('{media_id}', id).replace('{size}', 'md');
					$(this).css('background-image', 'url(' + link + ')').addClass('quality');
				});
			});
		}
	});
}

function custom_file_loader_fix_filename(){
	$('.custom-file-input').on('change', function(){
		let filename = $(this).val().split('\\');
		filename = filename[filename.length - 1];
		$(this).parent().find('.custom-file-label').html(filename);
	});
}