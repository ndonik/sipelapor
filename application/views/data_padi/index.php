<header class="blue accent-3 relative nav-sticky">
	<div class="container-fluid text-white">
		<div class="row p-t-b-10 ">
			<div class="col">
				<h4>
					<i class="icon-table"></i>
					<b>DATA PADI</b>
				</h4>
			</div>
		</div>
		<div class="row ">
			<ul class="nav responsive-tab">
				<li class="nav-item">
					<a class="nav-link active" href="<?= base_url(); ?>home">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url(); ?>bank">Data Padi</a>
				</li>
			</ul>
		</div>
	</div>
</header>

<div class="container-fluid relative animatedParent animateOnce">
	<div class="tab-content pb-3" id="v-pills-tabContent">
		<div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
			<div class="row my-3">

				<div class="col-md-12">
					<div class="card my-3 no-b">
						<div class="card ">
							<div class="card-header white">
								<i class="icon-table blue-text"></i>
								<strong> FILTER BULAN </strong>
							</div>
							<form role="form" method="post" action="<?= base_url('data_padi/filter'); ?>">
								<div class="card-body p-6 bg-light" data-height="100%">
									<div class="row pb-4">
										<label class="col-md-3 col-form-label">Bulan</label>
										<div class="col-md-9">
											<select class="form-control" id="id_bulan" name="id_bulan" required>
												<?php foreach ($bulan as $b) {
													if (@$id_bulan == $b['id']) { ?>
														<option value="<?= $b['id']; ?>" selected><?= $b['bulan']; ?></option>
													<?php } else { ?>
														<option value="<?= $b['id']; ?>"><?= $b['bulan']; ?></option>
												<?php }
												} ?>
											</select>
										</div>
									</div>

									<div class="row pb-4">
										<label class="col-md-3 col-form-label">Provinsi</label>
										<div class="col-md-9">
											<select id="provinsi" class="form-control" name="id_provinsi" required></select>
										</div>
									</div>

									<?php

									if ($tahun_awal) {
										$tahun1 = $tahun_awal->tahun;
										$tahun2 = $tahun_akhir->tahun;
									} else {
										$tahun1 = date('Y');
										$tahun2 = date('Y');
									}

									$years = range($tahun1, strftime("%Y", strtotime('+5 year', strtotime($tahun2))));

									?>

									<div class="row pb-4">
										<label class="col-md-3 col-form-label">Tahun</label>
										<div class="col-md-9">
											<select class="form-control" id="tahun" name="tahun" required>
												<?php foreach ($years as $year) {
													if (@$tahun == $year) { ?>
														<option value="<?= $year; ?>" selected><?= $year; ?></option>
													<?php } else { ?>
														<option value="<?= $year; ?>"><?= $year; ?></option>
												<?php }
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="card-footer white">
									<button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">
										<i class="icon-eye" aria-hidden="true"></i>
										Show Data
									</button>
								</div>
							</form>
						</div>

					</div>
				</div>

				<?php if ($status) { ?>

					<div class="col-md-12">
						<div class="card my-3 no-b">
							<div class="card ">
								<div class="card-header white">
									<i class="icon-table blue-text"></i>
									<strong> TABEL DATA PADI </strong>
								</div>
								<div class="card-body p-6 bg-light" data-height="100%">
									<div class="table-responsive">
										<table id="customer_data" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
											<thead class="thead-light">
												<tr>
													<th class="center" width="10%">No</th>
													<th width="20%">Nomor</th>
													<th width="30%">Alamat</th>
													<th width="10%">Penginput</th>
													<th width="10%">Status</th>
													<th width="10%">Setujui</th>
													<th width="10%">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 1;
												foreach ($data_padi as $value) { ?>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= $value['nomor']; ?></td>
														<td><?= wilayah('kecamatan', $value['id_kecamatan']) . ', ' . wilayah('kabupaten', $value['id_kabupaten']); ?></td>
														<td><?= $value['nama_lengkap']; ?></td>
														<td>
															<?php
															if ($value['status'] == 'Pending') {
																echo '<span class="badge badge-warning">Tunggu</span>';
															} else {
																echo '<span class="badge badge-primary">Selesai</span>';
															}
															?>
														</td>
														<td>
															<?php
															if ($value['status_verifikasi'] == 'Pending') {
																echo '<span class="badge badge-warning">Tunggu</span>';
															} else if ($value['status_verifikasi'] == 'Cancel') {
																echo '<span class="badge badge-danger">Tolak</span>';
															} else {
																echo '<span class="badge badge-primary">Disetujui</span>';
															}
															?>
														</td>

														<td>
															<a href="<?= base_url('detail_padi/detail/' . encrypt_url($value['id']) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>" data-toggle="tooltip" data-placement="bottom" title="Detail">
																<i class="icon-input green-text"></i>
															</a>

															<?php if ($value['status'] != 'Complete' && $value['status_verifikasi'] != 'Complete') { ?>
																&nbsp

																<a href="<?= base_url('data_padi/edit/' . encrypt_url($value['id']) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>" data-toggle="tooltip" data-placement="bottom" title="Edit">
																	<i class="icon-edit"></i>
																</a>
																&nbsp

																<a href="<?= base_url('data_padi/delete/' . encrypt_url($value['id']) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
																	<i class="icon-trash red-text"></i>
																</a>

															<?php } ?>


														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer white">
									<a href="#modal-tambah" data-toggle="modal" class="btn btn-outline-primary btn-xs"><i class="icon-plus"></i> Add New Data</a>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content b-0">
				<div class="modal-header r-0 bg-primary">
					<h6 class="modal-title text-white" id="exampleModalLabel">Tambah Data</h6>
					<a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
				</div>
				<div class="modal-body no-p no-b">
					<form role="form" method="post" action="<?= base_url('data_padi/add'); ?>" id="modalform">
						<input type="hidden" name="id_bulan" value="<?= $id_bulan; ?>">
						<input type="hidden" name="id_provinsi" value="<?= $id_provinsi; ?>">
						<input type="hidden" name="tahun" value="<?= $tahun; ?>">

						<div class="card">
							<div class="card-body b-b">

								<div class="row pb-4">
									<label class="col-md-3 col-form-label">Nomor</label>
									<div class="col-md-9">
										<input class="form-control" type="text" name="nomor" maxlength="100" required>
									</div>
								</div>

								<div class="row pb-4">
									<label class="col-md-3 col-form-label">Kabupaten</label>
									<div class="col-md-9">
										<select id="kabupaten" class="form-control" name="id_kabupaten" required></select>
									</div>
								</div>

								<div class="row pb-4">
									<label class="col-md-3 col-form-label">Kecamatan</label>
									<div class="col-md-9">
										<select id="kecamatan" class="form-control" name="id_kecamatan" required></select>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
									<i class="icon-times" aria-hidden="true"></i>
									Cancel
								</button>
								<button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">
									<i class="icon-save" aria-hidden="true"></i>
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
			.then(response => response.json())
			.then(data => {
				console.log(data.length);
				for (let i = 0; i < data.length; i++) {
					document.getElementById('provinsi').innerHTML += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
				}
			});
	</script>


	<script>
		fetch("http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
			.then(response => response.json())
			.then(Data => {
				console.log(Data.lenght);
				var i = 0;
				for (i = 0; i => Data.lenght; i++) {
					if (Data[i].id == <?= @$id_provinsi ?>) {
						document.getElementById('provinsi').innerHTML += "<option value='" + Data[i].id + "' selected>" + Data[i].name + "</option>";
					} else {
						document.getElementById('provinsi').innerHTML += "<option value='" + Data[i].id + "'>" + Data[i].name + "</option>";
					}
				}
			});

		fetch("http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + <?= $id_provinsi; ?> + ".json")
			.then(response => response.json())
			.then(Data => {
				console.log(Data.lenght);
				var i = 0;
				for (i = 0; i => Data.lenght; i++) {
					document.getElementById('kabupaten').innerHTML += "<option value='" + Data[i].id + "'>" + Data[i].name + "</option>";
				}
			});
	</script>

	<script>
		var xEvent1 = document.getElementById('provinsi');
		xEvent1.addEventListener("click", kabupaten);

		function kabupaten() {
			var provinsi = xEvent1.value;
			fetch("http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + provinsi + ".json")
				.then(response => response.json())
				.then(Data => {
					console.log(Data.lenght);
					var i = 0;
					document.getElementById('kecamatan').innerHTML = '';

					document.getElementById('kabupaten').innerHTML = '';
					for (i = 0; i => Data.lenght; i++) {
						document.getElementById('kabupaten').innerHTML += "<option value='" + Data[i].id + "'>" + Data[i].name + "</option>";
					}
				});
		}

		var xEvent2 = document.getElementById('kabupaten');
		xEvent2.addEventListener("click", kecamatan);

		function kecamatan() {
			var kabupaten = xEvent2.value;
			fetch("http://www.emsifa.com/api-wilayah-indonesia/api/districts/" + kabupaten + ".json")
				.then(response => response.json())
				.then(Data => {
					console.log(Data.lenght);
					var i = 0;

					document.getElementById('kecamatan').innerHTML = '';

					for (i = 0; i => Data.lenght; i++) {
						document.getElementById('kecamatan').innerHTML += "<option value='" + Data[i].id + "'>" + Data[i].name + "</option>";
					}
				});
		}
	</script>