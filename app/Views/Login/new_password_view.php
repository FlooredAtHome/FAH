<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAH</title>
    <link rel="stylesheet" href=<?= base_url('FAH/public/assets/css/style.css'); ?>>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
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
				<form class="login-form" action="update_password" method="post">
					<?= csrf_field(); ?>
					<div class="login-inside">
                    <h1>New Password</h1>
					<input type="hidden" value="<?=$uid?>" name="UID">
					<div class="form-input">
						<div class="input-label">Enter new password</div>
						<input type="text" class="form-control" style="margin-bottom: 20px" id="npwd" name="npwd" placeholder="New Password" required="true">
					</div>
                    <div class="form-input">
						<div class="input-label">Confirm new password</div>
						<input type="password" class="form-control" style="margin-bottom: 20px" id="cpwd" name="cpwd" placeholder="Confirm New Password" onkeyup="comparepass()" required="true">
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