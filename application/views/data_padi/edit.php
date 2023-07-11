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
					<a class="nav-link" href="<?= base_url(); ?>data_padi">Data Padi</a>
				</li>
				<li class="nav-item">
					<a class="nav-link">Edit</a>
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
								<strong> EDIT DATA </strong>
							</div>
							<form role="form" method="post" action="<?= base_url('data_padi/update'); ?>" id="modalform">
								<div class="card-body p-6 bg-light p-4" data-height="100%">
									<input type="hidden" name="id" value="<?= $data_padi->id; ?>">
									<input type="hidden" name="id_bulan" value="<?= $id_bulan; ?>">
									<input type="hidden" name="id_provinsi" value="<?= $id_provinsi; ?>">
									<input type="hidden" name="tahun" value="<?= $tahun; ?>">

									<div class="row pb-4">
										<label class="col-md-3 col-form-label">Nomor</label>
										<div class="col-md-9">
											<input class="form-control" type="text" name="nomor" maxlength="100" value="<?= $data_padi->nomor; ?>" required>
										</div>
									</div>

									<div class="row pb-4">
										<label class="col-md-3 col-form-label">Provinsi</label>
										<div class="col-md-9">
											<select id="provinsi" class="form-control" name="id_provinsi" onclick="kabupaten()" required readonly></select>
										</div>
									</div>

									<div class="row pb-4">
										<label class="col-md-3 col-form-label">Kabupaten</label>
										<div class="col-md-9">
											<select id="kabupaten" class="form-control" name="id_kabupaten" onclick="kecamartan()" required></select>
										</div>
									</div>

									<div class="row pb-4">
										<label class="col-md-3 col-form-label">Kecamatan</label>
										<div class="col-md-9">
											<select id="kecamatan" class="form-control" name="id_kecamatan" required></select>
										</div>
									</div>

								</div>
								<div class="card-footer white">
									<a href="<?= base_url('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>">
										<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
											<i class="icon-times" aria-hidden="true"></i>
											Cancel
										</button>
									</a>
									<button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">
										<i class="icon-save" aria-hidden="true"></i>
										Update Data
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$id_provinsi = $data_padi->id_provinsi;
$id_kabupaten = $data_padi->id_kabupaten;
$id_kecamatan = $data_padi->id_kecamatan;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	fetch("http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
		.then(response => response.json())
		.then(Data => {
			console.log(Data.lenght);
			var i = 0;
			for (i = 0; i => Data.lenght; i++) {
				if (Data[i].id == <?= $id_provinsi ?>) {
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
				if (Data[i].id == <?= $id_kabupaten ?>) {
					document.getElementById('kabupaten').innerHTML += "<option value='" + Data[i].id + "' selected>" + Data[i].name + "</option>";
				} else {
					document.getElementById('kabupaten').innerHTML += "<option value='" + Data[i].id + "'>" + Data[i].name + "</option>";
				}
			}
		});

	fetch("http://www.emsifa.com/api-wilayah-indonesia/api/districts/" + <?= $id_kabupaten; ?> + ".json")
		.then(response => response.json())
		.then(Data => {
			console.log(Data.lenght);
			var i = 0;
			for (i = 0; i => Data.lenght; i++) {
				if (Data[i].id == <?= $id_kecamatan ?>) {
					document.getElementById('kecamatan').innerHTML += "<option value='" + Data[i].id + "' selected>" + Data[i].name + "</option>";
				} else {
					document.getElementById('kecamatan').innerHTML += "<option value='" + Data[i].id + "'>" + Data[i].name + "</option>";
				}
			}
		});



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