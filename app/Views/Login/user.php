
<div class="login-main-form">
	<div class="container-loginform">
		<div class="login-ac-form">
			<div class="login-form-title">
				<div class="login-form-title-1">
					<img width="70%" src=<?= base_url('FAH/public/assets/images/logofah.png'); ?> alt="Logo">
				</div>
			</div>
			
			<?php if(session()->getTempdata('error')): ?>

				<div class="alert alert-danger"> <?= session()->getTempdata('error'); ?> </div>

			<?php endif; ?>

			<form class="login-form" action=<?= base_url("FAH/UserHome/verify");?> method="post">
				<?= csrf_field(); ?>
				<div class="login-inside">
				<div class="form-input">
					<div class="input-label">Email</div>
					<input type="email" class="form-control" style="margin-bottom: 20px" name="EMAIL" placeholder="Enter Email" required="true">
				</div>

				<div class="form-input">
					<div class="input-label">Password</div>
					<input type="password" class="form-control" name="PASSWORD" placeholder="Enter Password" required="true">
				</div>
				
				<div class="rpass">
					<a href="UserHome/reset_password_view">
						Reset Password?
					</a>
				</div>
				</div>
				<div class="login-btn">
					<button class="login-main-btn" type="submit">
						Login
					</button>
				</div>	
			</form>
		</div>
	</div>
</div>
</body>
</html>