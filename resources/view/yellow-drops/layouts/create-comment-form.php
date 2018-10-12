<div class="create-comment-form">
	<form method="post">
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-6">
				<input type="text" name="name" class="yd-input" placeholder="Ваше имя" value="">
			</div>
			<div class="col-12 col-lg-6 col-xl-6">
				<input type="text" name="email" class="yd-input" placeholder="Ваш Email">
			</div>
			<div class="col-12">
				<textarea name="message" class="yd-input" placeholder="Ваш коментарий"></textarea>
			</div>
		</div>
		<div class="row create-comment-form-footer">
			<div class="col-12 col-lg-8 col-xl-8">Все поля должны быть заполнены</div>
			<div class="col-12 col-lg-4 col-xl-4 submit-btn-wrap">
				<button class="yd-btn" type="button" 
				<? if(isset($profileid) and $profileid): ?> data-profile-id="<?= $profileid ?>" <? endif; ?>
				<? if(isset($commentid) and $commentid): ?> data-comment-id="<?= $commentid ?>" <? endif; ?>
				>Отправить</button>
			</div>
		</div>
	</form>
</div>