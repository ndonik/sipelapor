<aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
	<section class="sidebar">

		<div class="user-panel p-3 light mb-2">
			<div>
				<div class="float-left image">
					<img class="user_avatar" src="assets/img/Logo.png" alt="User Image">
				</div>
				<div class="float-left info">

					<a href="#"><i class="icon-circle text-success blink"></i> Online</a>
					<h6 class="font-weight mt-2 mb-1"><?= $_SESSION['username']; ?></h6>

				</div>
			</div>
			<div class="clearfix"></div>

		</div>
		<ul class="sidebar-menu">
			<li class="header light mt-3"><strong>Main</strong></li>
			<li class="treeview <?= activate_menu('home'); ?>">
				<a href="<?= base_url(); ?>home">
					<i class="icon icon-dashboard2 blue-text s-18"></i> <span>Dashboard</span></i>
				</a>
			</li>

			<?php if ($_SESSION['level'] == 'Admin') { ?>

				<li class="header light mt-3"><strong>Pengaturan</strong></li>
				<li class="treeview <?= activate_menu('kategori_padi') . activate_menu('subkategori_padi') . activate_menu('kategori_palawija') . activate_menu('subkategori_palawija'); ?>">
					<a href="#">
						<i class="icon icon-gears blue-text s-18"></i> <span>Master</span> <i class="icon icon-angle-left s-18 pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li class="header light mt-3 pl-4"><strong>Padi</strong></li>
						<li>
							<a href="<?= base_url(); ?>kategori_padi"><i class="icon icon-circle-o"></i>Uraian</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>subkategori_padi"><i class="icon icon-circle-o"></i>Suburaian</a>
						</li>

						<li class="header light mt-3 pl-4"><strong>Palawija</strong></li>
						<li>
							<a href="<?= base_url(); ?>kategori_palawija"><i class="icon icon-circle-o"></i>Uraian</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>subkategori_palawija"><i class="icon icon-circle-o"></i>Suburaian</a>
						</li>
					</ul>
				</li>

				<li class="treeview <?= activate_menu('bulan'); ?>">
					<a href="<?= base_url(); ?>bulan">
						<i class="icon icon-calendar blue-text s-18"></i> <span>Bulan</span></i>
					</a>
				</li>

			<?php } ?>

			<?php if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Penginput') { ?>
				<li class="header light mt-3"><strong>Pengelolaan</strong></li>

				<li class="treeview <?= activate_menu('data_padi') . activate_menu('detail_padi') . activate_menu('data_palawija') . activate_menu('detail_palawija'); ?>">
					<a href="#">
						<i class="icon icon-input blue-text s-18"></i> <span>Penginputan</span> <i class="icon icon-angle-left s-18 pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li>
							<a href="<?= base_url(); ?>data_padi"><i class="icon icon-circle-o"></i>Padi</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>data_palawija"><i class="icon icon-circle-o"></i>Palawija</a>
						</li>
					</ul>
				</li>

			<?php } ?>

			<?php if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Pengawas') { ?>
				<li class="header light mt-3"><strong>Pengelolaan</strong></li>

				<li class="treeview <?= activate_menu('pengecekan') . activate_menu('pengecekan_palawija'); ?>">
					<a href="#">
						<i class="icon icon-check blue-text s-18"></i> <span>Pengecekan</span> <i class="icon icon-angle-left s-18 pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li>
							<a href="<?= base_url(); ?>pengecekan"><i class="icon icon-circle-o"></i>Padi</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>pengecekan_palawija"><i class="icon icon-circle-o"></i>Palawija</a>
						</li>
					</ul>
				</li>

			<?php } ?>

			<li class="header light mt-3"><strong>Pelaporan</strong></li>

			<li class="treeview <?= activate_menu('monitoring') . activate_menu('monitoring_palawija'); ?>">
				<a href="#">
					<i class="icon icon-laptop blue-text s-18"></i> <span>Monitoring</span> <i class="icon icon-angle-left s-18 pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= base_url(); ?>monitoring"><i class="icon icon-circle-o"></i>Padi</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>monitoring_palawija"><i class="icon icon-circle-o"></i>Palawija</a>
					</li>
				</ul>
			</li>

			<?php if ($_SESSION['level'] == 'Admin') { ?>

				<li class="header light mt-3"><strong>Users</strong></li>
				<li class="treeview <?= activate_menu('user'); ?>">
					<a href="<?= base_url(); ?>user">
						<i class="icon icon-user blue-text s-18"></i> <span>User</span></i>
					</a>
				</li>

			<?php } ?>
		</ul>
	</section>
</aside>