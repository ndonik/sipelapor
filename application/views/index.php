<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="https://assets.zerotion.com/ndonik/paper/img/basic/favicon.ico" type="image/x-icon">
	<title><?= ENV('SYSTEM_NAME'); ?></title>
	<?php $this->load->view($header); ?>
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
		<?php $this->load->view(ENV('ASSETS_SIDEBAR')); ?>
		<?php $this->load->view(ENV('ASSETS_NAVBAR')); ?>
		<div class="page has-sidebar-left height-full">
			<?= $contents; ?>

		</div>
		<div class="control-sidebar-bg shadow white fixed"></div>
	</div>
	<?php $this->load->view(ENV('ASSETS_CHPASSWORD')); ?>
	<?php $this->load->view($footer); ?>
</body>

</html>