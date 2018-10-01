<?php vjoin('admin-layouts/head') ?>
<div class="container">
	<div class="page" id="login">
		<div class="row">
			<div class="col-4 offset-4" style="margin-top: 200px">
				<div class="card" style="width: 18rem;">
				  <div class="card-body">
				    <h5 class="card-title">Вход в админ панель</h5>
				    <h6 class="card-subtitle mb-2 text-muted">Пользователь с root правами</h6>
				    <p class="card-text">
				    	<form action="/admin/login" method="post">
						  <div class="form-group">
						    <label for="exampleInputPassword1">Password</label>
						    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
						  </div>
						  <button type="submit" class="btn btn-primary">Войти</button>
						</form>
				    </p>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php vjoin('admin-layouts/footer') ?>