<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Cetak Dokumen Padi</title>
</head>

<body onload="window.print()">
    <div class="row">
        <div class="col-md-12">
            <div class="card my-3">
                <div class="card ">
                    <div class="card-header white">
                        <i class="icon-table blue-text"></i>
                        <strong> DATA PADI </strong>
                    </div>
                    <div class="card-body p-6 bg-light" data-height="100%">
                        <div class="row">
                            <div class="col">
                                <div class="row form-group">
                                    <label class="col col-form-label">Nomor</label>
                                    <div class="col-9">
                                        <input class="form-control-plaintext" value="<?= $data_padi->nomor; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col col-form-label">Provinsi</label>
                                    <div class="col-9">
                                        <input class="form-control-plaintext" value="<?= wilayah('provinsi', $data_padi->id_provinsi); ?>" readonly>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col col-form-label">Kabupaten</label>
                                    <div class="col-9">
                                        <input class="form-control-plaintext" value="<?= wilayah('kabupaten', $data_padi->id_kabupaten); ?>" readonly>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col col-form-label">Kecamatan</label>
                                    <div class="col-9">
                                        <input class="form-control-plaintext" value="<?= wilayah('kecamatan', $data_padi->id_kecamatan); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <?php
                                $id_bulan = $data_padi->id_bulan;
                                $this->db->where('id', $id_bulan);
                                $bulan = $this->db->get('bulan')->row();
                                ?>

                                <div class="row form-group">
                                    <label class="col col-form-label">Bulan</label>
                                    <div class="col-9">
                                        <input class="form-control-plaintext" value="<?= $bulan->bulan; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col col-form-label">Tahun</label>
                                    <div class="col-9">
                                        <input class="form-control-plaintext" value="<?= $data_padi->tahun; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <hr />

        <div class="col-md-12">
            <div class="card my-3">
                <div class="card ">
                    <div class="card-header white">
                        <i class="icon-table blue-text"></i>
                        <strong> TABEL DETAIL DATA PADI </strong>
                    </div>
                    <div class="card-body p-6 bg-light" data-height="100%">
                        <table id="customer_data" class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="center" width="10%">No</th>
                                    <th width="30%">Uraian</th>
                                    <th width="10%">Lahan</th>
                                    <th width="10%">Tanaman Akhir Bulan Lalu</th>
                                    <th width="10%">Panen</th>
                                    <th width="10%">Tanam</th>
                                    <th width="10%">Puso/rusak</th>
                                    <th width="10%">Tanaman Akhir Bulan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($detail_padi as $value) {

                                    $id_suburaian = $value['id_suburaian'];

                                    $this->db->where('id', $id_bulan);
                                    $bulan = $this->db->get('bulan')->row();

                                    $id_bulan = $bulan->id;

                                    $this->db->where('id', $id_bulan);
                                    $bulan_sebelumnyaa = $this->db->get('bulan')->row();

                                    $tahun = $tahun;
                                    $id_kecamatan = $data_padi->id_kecamatan;

                                    $this->load->model('error/data');

                                    $select = array('sawah_panen', 'sawah_tanam', 'sawah_rusak');
                                    $tabel = 'detail_padi dt';
                                    $query = $this->db->join('data_padi d', 'dt.id_data_padi=d.id');
                                    $query = $this->db->where('d.id_bulan', @$bulan_sebelumnyaa->id);
                                    $query = $this->db->where('d.tahun', $tahun);
                                    $query = $this->db->where('d.id_kecamatan', $id_kecamatan);
                                    $query = $this->db->where('dt.id_subkategori_padi', $id_suburaian);
                                    $data_sawah_lalu = $this->data->get($select, $tabel, $query)->result_array();

                                    $jumlah_sawah_lalu = 0;
                                    foreach ($data_sawah_lalu as $ds) {
                                        $jumlah_sawah_lalu = $jumlah_sawah_lalu + ($ds['sawah_panen'] + ($ds['sawah_tanam'] - $ds['sawah_rusak']));
                                    }

                                    $total_sawah = $value['sawah_panen'] + ($value['sawah_tanam'] - $value['sawah_rusak']);

                                    if ($jumlah_sawah_lalu > 0) {
                                        $total_sawah_sekarang = $jumlah_sawah_lalu - $total_sawah;
                                    } else {
                                        $total_sawah_sekarang = $total_sawah;
                                    }

                                    if ($value['jenis_sawah'] == 'Bukan') {
                                        $status_sawah = 'style="background-color:#808080;color:white"';
                                    } else {
                                        $status_sawah = '';
                                    }

                                ?>

                                    <tr>
                                        <td rowspan="2"><?= $no++; ?></td>
                                        <td rowspan="2"><?= $value['suburaian'] . ', <p style="font-size:8pt">' . $value['uraian'] . '</p>'; ?></td>
                                        <td>Sawah</td>
                                        <td <?= $status_sawah; ?>><?= $jumlah_sawah_lalu; ?></td>
                                        <td <?= $status_sawah; ?>><?= $value['sawah_panen']; ?></td>
                                        <td <?= $status_sawah; ?>><?= $value['sawah_tanam']; ?></td>
                                        <td <?= $status_sawah; ?>><?= $value['sawah_rusak']; ?></td>
                                        <td <?= $status_sawah; ?>><b><?= $total_sawah_sekarang; ?></b> </td>

                                    </tr>
                                    <?php

                                    $select1 = array('bukan_panen', 'bukan_tanam', 'bukan_rusak');
                                    $tabel1 = 'detail_padi dt';
                                    $query1 = $this->db->join('data_padi d', 'dt.id_data_padi=d.id');
                                    $query1 = $this->db->where('d.id_bulan', @$bulan_sebelumnyaa->id);
                                    $query1 = $this->db->where('d.tahun', $tahun);
                                    $query1 = $this->db->where('d.id_kecamatan', $id_kecamatan);
                                    $query1 = $this->db->where('dt.id_subkategori_padi', $id_suburaian);
                                    $data_bukan_sawah_lalu = $this->data->get($select1, $tabel1, $query1)->result_array();

                                    $jumlah_bukan_sawah_lalu = 0;
                                    foreach ($data_bukan_sawah_lalu as $ds) {
                                        $jumlah_bukan_sawah_lalu = $jumlah_bukan_sawah_lalu + ($ds['bukan_panen'] + ($ds['bukan_tanam'] - $ds['bukan_rusak']));
                                    }

                                    $total_bukan_sawah = $value['bukan_panen'] + ($value['bukan_tanam'] - $value['bukan_rusak']);

                                    if ($jumlah_bukan_sawah_lalu > 0) {
                                        $total_bukan_sawah_sekarang = $jumlah_bukan_sawah_lalu - $total_bukan_sawah;
                                    } else {
                                        $total_bukan_sawah_sekarang = $total_bukan_sawah;
                                    }

                                    if ($value['jenis_sawah'] == 'Sawah') {
                                        $status_bukan_sawah = 'style="background-color:#808080;color:white"';
                                    } else {
                                        $status_bukan_sawah = '';
                                    }

                                    ?>

                                    <tr>
                                        <td>Bukan Sawah</td>
                                        <td <?= $status_bukan_sawah; ?>><?= $jumlah_bukan_sawah_lalu; ?></td>
                                        <td <?= $status_bukan_sawah; ?>><?= $value['bukan_panen']; ?></td>
                                        <td <?= $status_bukan_sawah; ?>><?= $value['bukan_tanam']; ?></td>
                                        <td <?= $status_bukan_sawah; ?>><?= $value['bukan_rusak']; ?></td>
                                        <td <?= $status_bukan_sawah; ?>><b><?= $total_bukan_sawah_sekarang; ?></b></td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer white">
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <div class="col-md-12">
            <div class="card my-3">
                <div class="card ">
                    <div class="card-header white">
                        <i class="icon-table blue-text"></i>
                        <strong> TABEL PEMERIKSA DATA </strong>
                    </div>
                    <div class="card-body p-6 bg-light" data-height="100%">
                        <table id="customer_data" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="center" width="10%">No</th>
                                    <th width="10%">NIP</th>
                                    <th width="20%">Nama Lengkap</th>
                                    <th width="40%">Catatan/Deskripsi</th>
                                    <th width="10%">Status</th>
                                    <th width="20%">Waktu Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($user_padi as $ut) { ?>

                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ut['nip']; ?></td>
                                        <td><?= $ut['nama_lengkap']; ?></td>
                                        <td><?= $ut['catatan']; ?></td>
                                        <td><?= $ut['status']; ?></td>
                                        <td><?= $ut['update_at']; ?></td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer white">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>