<header class="blue accent-3 relative nav-sticky">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-table"></i>
                    <b>DATA DETAIL PADI</b>
                </h4>
            </div>
        </div>
        <div class="row ">
            <ul class="nav responsive-tab">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url(); ?>home">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>">Data Padi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link">Data Detail Padi</a>
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
                                <strong> DATA PADI </strong>
                            </div>
                            <form role="form" method="post" action="<?= base_url('data_padi/filter'); ?>">
                                <div class="card-body p-6 bg-light" data-height="100%">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col col-form-label">Nomor</label>
                                                <div class="col-md-10">
                                                    <input class="form-control-plaintext" value="<?= $data_padi->nomor; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col col-form-label">Provinsi</label>
                                                <div class="col-md-10">
                                                    <input class="form-control-plaintext" value="<?= wilayah('provinsi', $data_padi->id_provinsi); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col col-form-label">Kabupaten</label>
                                                <div class="col-md-10">
                                                    <input class="form-control-plaintext" value="<?= wilayah('kabupaten', $data_padi->id_kabupaten); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col col-form-label">Kecamatan</label>
                                                <div class="col-md-10">
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

                                            <div class="form-group row">
                                                <label class="col col-form-label">Bulan</label>
                                                <div class="col-md-9">
                                                    <input class="form-control-plaintext" value="<?= $bulan->bulan; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col col-form-label">Tahun</label>
                                                <div class="col-md-9">
                                                    <input class="form-control-plaintext" value="<?= $data_padi->tahun; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col col-form-label">Status</label>
                                                <div class="col-md-9">
                                                    <?php
                                                    if ($data_padi->status == 'Pending') {
                                                        echo '<span class="badge badge-warning">Tunggu</span>';
                                                    } else {
                                                        echo '<span class="badge badge-primary">Selesai</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col col-form-label">Verifikasi</label>
                                                <div class="col-md-9">
                                                    <?php
                                                    if ($data_padi->status_verifikasi == 'Pending') {
                                                        echo '<span class="badge badge-warning">Tunggu</span>';
                                                    } else if ($data_padi->status_verifikasi == 'Cancel') {
                                                        echo '<span class="badge badge-danger">Tolak</span>';
                                                    } else {
                                                        echo '<span class="badge badge-primary">Disetujui</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card my-3 no-b">
                        <div class="card ">
                            <div class="card-header white">
                                <i class="icon-table blue-text"></i>
                                <strong> TABEL DETAIL DATA PADI </strong>
                            </div>
                            <div class="card-body p-6 bg-light" data-height="100%">
                                <div class="table-responsive">
                                    <table id="customer_data" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="center" width="10%">No</th>
                                                <th width="20%">Uraian</th>
                                                <th width="10%">Lahan</th>
                                                <th width="10%">Tanaman Akhir Bulan Lalu</th>
                                                <th width="10%">Panen</th>
                                                <th width="10%">Tanam</th>
                                                <th width="10%">Puso/rusak</th>
                                                <th width="10%">Tanaman Akhir Bulan</th>

                                                <?php if ($data_padi->status != 'Complete') { ?>
                                                    <th width="10%">Aksi</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($detail_padi as $value) { ?>

                                                <tr>
                                                    <td rowspan="2"><?= $no++; ?></td>
                                                    <td rowspan="2"><?= $value['uraian'] . ' <p style="font-size:8pt">' . $value['suburaian'] . '</p>'; ?></td>
                                                    <td>Sawah</td>

                                                    <?php
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

                                                    ?>

                                                    <?php if ($value['jenis_sawah'] == 'Bukan') {
                                                        $status_sawah = 'style="background-color:#808080;color:white"';
                                                    } else {
                                                        $status_sawah = '';
                                                    } ?>


                                                    <td <?= $status_sawah; ?>><?= $jumlah_sawah_lalu; ?></td>
                                                    <td <?= $status_sawah; ?>><?= $value['sawah_panen']; ?></td>
                                                    <td <?= $status_sawah; ?>><?= $value['sawah_tanam']; ?></td>
                                                    <td <?= $status_sawah; ?>><?= $value['sawah_rusak']; ?></td>
                                                    <td <?= $status_sawah; ?>><b><?= $total_sawah_sekarang; ?></b> </td>

                                                    <?php if ($data_padi->status != 'Complete') { ?>
                                                        <td rowspan="2">
                                                            <a href="<?= base_url('detail_padi/edit/' . encrypt_url($value['id']) . '/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            &nbsp

                                                            <a href="<?= base_url('detail_padi/delete/' . encrypt_url($value['id']) . '/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                                <i class="icon-trash red-text"></i>
                                                            </a>
                                                        </td>
                                                    <?php } ?>

                                                </tr>

                                                <?php if ($value['jenis_sawah'] == 'Sawah') {
                                                    $status_sawah = 'style="background-color:#808080;color:white"';
                                                } else {
                                                    $status_sawah = '';
                                                } ?>

                                                <tr>
                                                    <td>Bukan Sawah</td>

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

                                                    ?>


                                                    <td <?= $status_sawah; ?>><?= $jumlah_bukan_sawah_lalu; ?></td>
                                                    <td <?= $status_sawah; ?>><?= $value['bukan_panen']; ?></td>
                                                    <td <?= $status_sawah; ?>><?= $value['bukan_tanam']; ?></td>
                                                    <td <?= $status_sawah; ?>><?= $value['bukan_rusak']; ?></td>
                                                    <td <?= $status_sawah; ?>><?= $total_bukan_sawah_sekarang; ?></td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer white">
                                <?php if ($data_padi->status != 'Complete') { ?>
                                    <a href="#modal-tambah" data-toggle="modal" class="btn btn-outline-primary btn-xs"><i class="icon-plus"></i> Add New Data</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card my-3 no-b">
                        <div class="card ">
                            <div class="card-header white">
                                <i class="icon-table blue-text"></i>
                                <strong> TABEL PEMERIKSA DATA </strong>
                            </div>
                            <div class="card-body p-6 bg-light" data-height="100%">
                                <div class="table-responsive">
                                    <table id="customer_data" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="center" width="10%">No</th>
                                                <th width="10%">NIP</th>
                                                <th width="20%">Nama Lengkap</th>
                                                <th width="40%">Catatan/Deskripsi</th>
                                                <th width="10%">Status</th>
                                                <th width="20%">Waktu Terakhir</th>

                                                <?php if ($data_padi->status != 'Complete') { ?>
                                                    <th width="10%">Aksi</th>
                                                <?php } ?>
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
                                                    <td>
                                                        <?php
                                                        if ($ut['status'] == 'Pending') {
                                                            echo '<span class="badge badge-warning">Tunggu</span>';
                                                        } else if ($ut['status'] == 'Correction') {
                                                            echo '<span class="badge badge-danger">Koreksi</span>';
                                                        } else {
                                                            echo '<span class="badge badge-primary">Disetujui</span>';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td><?= $ut['update_at']; ?></td>

                                                    <?php if ($data_padi->status != 'Complete') { ?>

                                                        <td>
                                                            <a href="<?= base_url('detail_padi/delete_user/' . encrypt_url($ut['id']) . '/' . encrypt_url($id_data_padi) . '/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                                <i class="icon-trash red-text"></i>
                                                            </a>
                                                        </td>

                                                    <?php } ?>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer white">
                                <?php if ($data_padi->status != 'Complete') { ?>
                                    <a href="#modal-tambah-user" data-toggle="modal" class="btn btn-outline-primary btn-xs"><i class="icon-plus"></i> Add Pemeriksa Data</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card my-3 no-b">
                        <div class="card ">
                            <div class="card-header white">
                                <a href="<?= base_url('data_padi/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                        <i class="icon-arrow-left" aria-hidden="true"></i>
                                        Kembali
                                    </button>
                                </a>

                                <?php if ($data_padi->status != 'Complete') { ?>
                                    <button href="#modal-verifikasi" data-toggle="modal" class="btn btn-sm btn-primary">
                                        <i class="icon-save" aria-hidden="true"></i>
                                        Kirim Data
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>


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
                    <form role="form" method="post" action="<?= base_url('detail_padi/add'); ?>" id="modalform">
                        <input type="hidden" name="id_data_padi" value="<?= $id_data_padi; ?>">
                        <input type="hidden" name="id_bulan" value="<?= $id_bulan; ?>">
                        <input type="hidden" name="id_provinsi" value="<?= $id_provinsi; ?>">
                        <input type="hidden" name="tahun" value="<?= $tahun; ?>">

                        <div class="card">
                            <div class="card-body b-b">

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Uraian</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="id_kategori_padi" name="id_kategori_padi" required>
                                            <?php foreach ($kategori_padi as $k) { ?>
                                                <option value="<?= $k['id']; ?>"><?= $k['uraian']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Sub Uraian</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="id_subkategori_padi" name="id_subkategori_padi" required>
                                        </select>
                                    </div>
                                </div>

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Jenis Lahan</label>
                                    <div class="col-md-9">
                                        <select id="jenis_sawah" class="form-control" name="jenis_sawah" required>
                                            <option value="Semua" selected>Semua Lahan</option>
                                            <option value="Sawah">Lahan Sawah</option>
                                            <option value="Bukan">Lahan Bukan Sawah</option>
                                        </select>
                                    </div>
                                </div>

                                <hr />
                                <h4 style="text-align: center;">Lahan Sawah</h4>
                                <hr />

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Panen</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="sawah_panen" id="sawah_panen" value="0" required>
                                    </div>
                                </div>

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Tanam</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="sawah_tanam" id="sawah_tanam" value="0" required>
                                    </div>
                                </div>

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Puso/rusak</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="sawah_rusak" id="sawah_rusak" value="0" required>
                                    </div>
                                </div>

                                <hr />
                                <h4 style="text-align: center;">Lahan Bukan Sawah</h4>
                                <hr />

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Panen</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="bukan_panen" id="bukan_panen" value="0" required>
                                    </div>
                                </div>

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Tanam</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="bukan_tanam" id="bukan_tanam" value="0" required>
                                    </div>
                                </div>

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Puso/rusak</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="number" name="bukan_rusak" id="bukan_rusak" value="0" required>
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

    <div class="modal fade" id="modal-tambah-user" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-primary">
                    <h6 class="modal-title text-white" id="exampleModalLabel">Tambah Pemeriksa Data</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <div class="modal-body no-p no-b">
                    <form role="form" method="post" action="<?= base_url('detail_padi/add_user'); ?>" id="modalform">
                        <input type="hidden" name="id_data_padi" value="<?= $id_data_padi; ?>">
                        <input type="hidden" name="id_bulan" value="<?= $id_bulan; ?>">
                        <input type="hidden" name="id_provinsi" value="<?= $id_provinsi; ?>">
                        <input type="hidden" name="tahun" value="<?= $tahun; ?>">

                        <div class="card">
                            <div class="card-body b-b">

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Pemeriksa</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="id_user" name="id_user" required>
                                            <?php foreach ($user as $u) { ?>
                                                <option value="<?= $u['id']; ?>"><?= $u['nip'] . ' - ' . $u['nama_lengkap']; ?></option>
                                            <?php } ?>
                                        </select>
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

    <div class="modal fade" id="modal-verifikasi" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-primary">
                    <h6 class="modal-title text-white" id="exampleModalLabel">Pemberitahuan !</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <div class="modal-body no-p no-b">
                    <form role="form" method="post" action="<?= base_url('detail_padi/complete'); ?>" id="modalform">
                        <input type="hidden" name="id_data_padi" value="<?= $id_data_padi; ?>">
                        <input type="hidden" name="id_bulan" value="<?= $id_bulan; ?>">
                        <input type="hidden" name="id_provinsi" value="<?= $id_provinsi; ?>">
                        <input type="hidden" name="tahun" value="<?= $tahun; ?>">

                        <div class="card">
                            <div class="card-body b-b">

                                <div class="row pb-4">
                                    <h3 style="color: red;text-align:center">Harap periksa data terlebih dahulu sebelum melakukaan penyelesaian data, karena data yang sudah dinyatakan selesai.</h3>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="icon-times" aria-hidden="true"></i>
                                    Cancel
                                </button>
                                <button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">
                                    <i class="icon-save" aria-hidden="true"></i>
                                    Finish
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
        window.onload = function() {
            $("select[name='id_kategori_padi']").click(function() {
                var url = "<?= base_url('detail_padi/subkategori_padi/'); ?>" + $(this).val();
                $("select[name='id_subkategori_padi']").load(url);
                return false;
            });

            $("select[name='jenis_sawah']").click(function() {
                var jenis_sawah = $(this).val();
                if (jenis_sawah == 'Sawah') {
                    $("#bukan_panen").attr('readonly', 'readonly');
                    $("#bukan_tanam").attr('readonly', 'readonly');
                    $("#bukan_rusak").attr('readonly', 'readonly');
                } else {
                    $("#bukan_panen").removeAttr('readonly');
                    $("#bukan_tanam").removeAttr('readonly');
                    $("#bukan_rusak").removeAttr('readonly');
                }

                if (jenis_sawah == 'Bukan') {
                    $("#sawah_panen").attr('readonly', 'readonly');
                    $("#sawah_tanam").attr('readonly', 'readonly');
                    $("#sawah_rusak").attr('readonly', 'readonly');
                } else {
                    $("#sawah_panen").removeAttr('readonly');
                    $("#sawah_tanam").removeAttr('readonly');
                    $("#sawah_rusak").removeAttr('readonly');
                }
                return false;
            });
        };
    </script>