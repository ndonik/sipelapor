<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="https://assets.zerotion.com/ndonik/paper/img/basic/favicon.ico" type="image/x-icon">
	<title><?= ENV('TITLE_LOGIN'); ?></title>
	<link rel="stylesheet" href="https://assets.zerotion.com/ndonik/paper/css/app.css">
	<style>
		.loader {
			position: fixed;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			background-color: #F5F8FA;
			z-index: 9998;
			text-align: center;
		}

		.plane-container {
			position: absolute;
			top: 50%;
			left: 50%;
		}
	</style>

</head>

<body class="light">
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('alert'); ?>"></div>
	<?php if ($this->session->flashdata('alert')) : ?>
	<?php endif;
	unset($_SESSION['alert']) ?>
	<div id="loader" class="loader">
		<div class="plane-container">
			<div class="preloader-wrapper small active">
				<div class="spinner-layer spinner-blue">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>

				<div class="spinner-layer spinner-red">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>

				<div class="spinner-layer spinner-yellow">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>

				<div class="spinner-layer spinner-green">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="app">
		<main>
			<div id="primary" class="p-t-b-100 height-full ">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 mx-md-auto">
							<div class="text-center">
								<img src="assets/img/logo.png" style="width:50%">
								<h3 class="mt-4"><b>Sistem Pengelolaan Laporan</b></h3>
								<h6>Dinas Pertanian</h6>
								<h6 class="mb-3">Balai Penyuluhan Pertanian</h6>
							</div>
							<form action="<?= base_url('auth/login'); ?>" method="post">
								<div class="form-group has-icon"><i class="icon-user"></i>
									<input type="text" class="form-control form-control-lg" placeholder="Username" name="username" placeholder="Username">
								</div>
								<div class="form-group has-icon"><i class="icon-user-secret"></i>
									<input type="password" class="form-control form-control-lg" placeholder="Password" name="password" placeholder="Password">
								</div>
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Log In">
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="control-sidebar-bg shadow white fixed"></div>
	</div>

	<script src="https://assets.zerotion.com/ndonik/paper/js/app.js"></script>
	<?php $this->load->view($footer); ?>


</body>

</html>