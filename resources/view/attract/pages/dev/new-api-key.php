<? vjoin('attract/layouts/header'); ?>
<div class="container">
	<section class="page" id="create-new-api">
		<br>
		<h2 class="block-title">Создание нового API key</h2>
		<form action="<?= linkTo('APIAuthController@create_key') ?>" method="post">
			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6">
					<? if(isset($create)): ?>
					<div class="new-api-key">
						<div class="input">
							<i class="mdi mdi-email input-icon"></i>
							<input type="text" name="email" placeholder="Ваш E-mail">
						</div>

						<div class="input">
							<i class="mdi mdi-web input-icon"></i>
							<input type="text" name="access_url" placeholder="Url которому будет выдан API key">
						</div>
						<br>
						<button class="std-btn send-btn disable">Создать <i class="mdi mdi-arrow-right mdi-fix"></i></button>
					</div>
					<? elseif(isset($success)): ?>
						<span style="font-size: 6rem">На указаную почту было отправлено письмо для<br> подтверждения активации API key</span>
					<? elseif(isset($confirm_success) and $api_key): ?>
						<span style="font-size: 6rem">API key был успешно активирован<br>
						<strong><?= $api_key ?></strong><br><br>
						<small class="txt-red">Потеряный API key восстановлению не подлежит</small></span>
					<? else: ?>
						<script>document.location = '/';</script>
					<? endif; ?>
				</div>
			</div>
		</form>
	</section>
</div>
<script>
	$(document).ready(function(){
		$('#create-new-api .input input').on('change', function(){
			let inps = $('#create-new-api .input input');
			let flag = true;
			for(let input of inps){
				console.log($(input).val());
				if($(input).val() == ''){
					flag = false;
				}
			}
			if(flag){
				let btn = $('#create-new-api .send-btn');
				if(btn.hasClass('disable')){
					btn.removeClass('disable');
				}
			}else{
				let btn = $('#create-new-api .send-btn');
				if(!btn.hasClass('disable')){
					btn.addClass('disable');
				}
			}
		});
	});
</script>
<? vjoin('attract/layouts/footer'); ?>