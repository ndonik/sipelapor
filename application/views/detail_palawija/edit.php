<header class="blue accent-3 relative nav-sticky">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-table"></i>
                    <b>DATA DETAIL PALAWIJA</b>
                </h4>
            </div>
        </div>
        <div class="row ">
            <ul class="nav responsive-tab">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url(); ?>home">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('data_palawija/filter/' . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>">Data Palawija</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/'  . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>">Data Detail Palawija</a>
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
                            <form role="form" method="post" action="<?= base_url('detail_palawija/update'); ?>" id="modalform">
                                <div class="card-body p-6 bg-light p-4" data-height="100%">
                                    <input type="hidden" name="id" value="<?= $detail_palawija->id; ?>">
                                    <input type="hidden" name="id_data_palawija" value="<?= $id_data_palawija; ?>">
                                    <input type="hidden" name="id_bulan" value="<?= $id_bulan; ?>">
                                    <input type="hidden" name="id_provinsi" value="<?= $id_provinsi; ?>">
                                    <input type="hidden" name="tahun" value="<?= $tahun; ?>">

                                    <?php
                                    $id_kategori_palawija = $detail_palawija->id_kategori_palawija;
                                    $this->db->where('id', $id_kategori_palawija);
                                    $kategori_palawija = $this->db->get('kategori_palawija')->row();
                                    ?>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Uraian</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" value="<?= $kategori_palawija->uraian; ?>" readonly>
                                        </div>
                                    </div>

                                    <?php
                                    $id_subkategori_palawija = $detail_palawija->id_subkategori_palawija;
                                    $this->db->where('id', $id_subkategori_palawija);
                                    $subkategori_palawija = $this->db->get('subkategori_palawija')->row();
                                    ?>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Sub Uraian</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" value="<?= $subkategori_palawija->uraian; ?>" readonly>
                                        </div>
                                    </div>

                                    <?php

                                    $status_sawah = '';
                                    $status_bukan_sawah = '';

                                    if ($detail_palawija->jenis_sawah == 'Bukan') {
                                        $status_sawah = 'readonly';
                                    } else if ($detail_palawija->jenis_sawah == 'Sawah') {
                                        $status_bukan_sawah = 'readonly';
                                    }

                                    ?>

                                    <hr />
                                    <h4 style="text-align: center;">Lahan Sawah</h4>
                                    <hr />

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Panen</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="sawah_panen" id="sawah_panen" value="<?= $detail_palawija->sawah_panen; ?>" required <?= $status_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Panen Muda</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="sawah_panen_muda" id="sawah_panen_muda" value="<?= $detail_palawija->sawah_panen_muda; ?>" required <?= $status_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Panen Ternak</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="sawah_panen_ternak" id="sawah_panen_ternak" value="<?= $detail_palawija->sawah_panen_ternak; ?>" required <?= $status_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Tanam</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="sawah_tanam" id="sawah_tanam" value="<?= $detail_palawija->sawah_tanam; ?>" required <?= $status_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Puso/rusak</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="sawah_rusak" id="sawah_rusak" value="<?= $detail_palawija->sawah_rusak; ?>" required <?= $status_sawah; ?>>
                                        </div>
                                    </div>

                                    <hr />
                                    <h4 style="text-align: center;">Lahan Bukan Sawah</h4>
                                    <hr />

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Panen</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="bukan_panen" id="bukan_panen" value="<?= $detail_palawija->bukan_panen; ?>" required <?= $status_bukan_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Panen Muda</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="bukan_panen_muda" id="bukan_panen_muda" value="<?= $detail_palawija->bukan_panen_muda; ?>" required <?= $status_bukan_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Panen Ternak</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="bukan_panen_ternak" id="bukan_panen_ternak" value="<?= $detail_palawija->bukan_panen_ternak; ?>" required <?= $status_bukan_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Tanam</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="bukan_tanam" id="bukan_tanam" value="<?= $detail_palawija->bukan_tanam; ?>" required <?= $status_bukan_sawah; ?>>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Puso/rusak</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="bukan_rusak" id="bukan_rusak" value="<?= $detail_palawija->bukan_rusak; ?>" required <?= $status_bukan_sawah; ?>>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer white">
                                    <a href="<?= base_url('detail_palawija/detail/' . encrypt_url($id_data_palawija) . '/'  . encrypt_url($id_bulan) . '/' . encrypt_url($id_provinsi) . '/' . encrypt_url($tahun)); ?>">
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