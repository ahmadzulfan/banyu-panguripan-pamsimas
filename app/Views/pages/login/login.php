<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Login PAMISMAS</title>

	<link rel="shortcut icon" href="banyu-panguripan-pamsimas\public\pamsimas.png" type="image/x-icon" />
	<link rel="shortcut icon"
		href="banyu-panguripan-pamsimas\public\pamsimas.png"
		type="image/png" />
	<link rel="stylesheet" href="https://demo.wangkas.mrizkimaulidan.my.id/compiled/css/app.css" />
	<link rel="stylesheet" href="https://demo.wangkas.mrizkimaulidan.my.id/compiled/css/app-dark.css" />
	<link rel="stylesheet" href="https://demo.wangkas.mrizkimaulidan.my.id/compiled/css/auth.css" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
	<script src="https://demo.wangkas.mrizkimaulidan.my.id/static/js/initTheme.js"></script>
	<div id="auth">
		<div class="row h-100">
	<div class="col-lg-5 col-12">
		<div id="auth-left">
			<h1 class="auth-title">Log in.</h1>
			<p class="auth-subtitle mb-5">
				Log in untuk melanjutkan ke dalam dashboard.
			</p>
			<?php if (!empty(session()->getFlashdata('msg'))) : ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('msg') ?>
                  </div>
                <?php endif; ?>
			<form method="POST">
          <div class="form-group position-relative has-icon-left mb-4">
					<input type="email" class="form-control form-control-xl" name="email" placeholder="Email" autofocus />
					<div class="form-control-icon">
						<i class="bi bi-person"></i>
					</div>
				</div>
				<div class="form-group position-relative has-icon-left mb-4">
					<input type="password" class="form-control form-control-xl" name="password" placeholder="Password" />
					<div class="form-control-icon">
						<i class="bi bi-shield-lock"></i>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
					Log in
				</button>
			</form>
		</div>
	</div>
	<div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">
        <img src="banyu-panguripan-pamsimas\public\logo pamsimas.png" alt="Your Image Description" style="width: 100%; height: auto;">
    </div>
</div>
</div>
	</div>

	<script src="https://demo.wangkas.mrizkimaulidan.my.id/compiled/js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>