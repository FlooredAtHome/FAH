<body>
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
                <?php if(session()->getTempdata('success')): ?>

                <div class="alert alert-success"> <?= session()->getTempdata('success'); ?> </div>

                <?php endif; ?>
				<form class="login-form" action="../UserHome/reset_password" method="post">
					<?= csrf_field(); ?>
					<div class="login-inside">
                    <h1>Reset Password</h1>
					<div class="form-input">
						<div class="input-label">Email</div>
						<input type="email" class="form-control" style="margin-bottom: 20px" name="EMAIL" placeholder="Enter Email" required="true">
					</div>

					</div>
					<div class="login-btn">
						<button class="login-main-btn" type="submit">
							Submit
						</button>
					</div>	
				</form>	
			</div>
		</div>
	</div>
	
</body>
</html>