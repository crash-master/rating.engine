<? vjoin('attract/layouts/header'); ?>
<div class="container">
	<section class="page" id="text-page">
		<br>
		<h2 class="block-title">Создание нового API key</h2>
		<form action="<?= linkTo('APIAuthController@create_key') ?>" method="post">
			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6">
					<? if(isset($create)): ?>
					<div class="new-api-key">
						<div class="input">
							<i class="m-icon email"></i>
							<input type="text" name="email" placeholder="Ваш E-mail">
						</div>

						<div class="input">
							<i class="m-icon web"></i>
							<input type="text" name="access_url" placeholder="Url которому будет выдан API key">
						</div>

						<!-- 
						<div class="input checkbox">
							<input type="hidden" name="agree" value="0">
							<div class="box agree-box">
								<i class="m-icon main-icon checkbox-blank-outline"></i>
								<i class="m-icon second-icon checkbox-marked"></i>
							</div>
							<div class="placeholder txt-grey">Я согласен/согласна с правилами сайта</div>
						</div> -->
						<br>
						<button class="std-btn icon-fix send-btn disable">Создать <i class="m-icon arrow-right-red"></i> <i class="m-icon arrow-right"></i></button>
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
<? vjoin('attract/layouts/footer'); ?>