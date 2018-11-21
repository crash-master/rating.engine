function check_site_on_exists(){
	$('[name="site"]').on('change', function(){
		var val = $(this).val();
		if(val == ''){
			return false;
		}
		var self = this;
		$.getJSON('/check-site-on-exists?site='+val, function(d){
			if(d.result == true){
				$(self).parent().css('border-color', 'red');
				$(self).attr('data-err', true);
				$(self).parent().append('<span class="err-mess" style="font-size: 12px; color: red; position: relative; top: 5px;">Такой адрес уже зарегистрирован в системе</span>');
			}else{
				$(self).removeAttr('data-err');
				$(self).parent().removeAttr('style');
				$(self).parent().find('.err-mess').remove();
			}
		});
	});
}