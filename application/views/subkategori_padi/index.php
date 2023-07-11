<header class="blue accent-3 relative nav-sticky">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-table"></i>
                    <b>DATA SUBKATEGORI PADI</b>
                </h4>
            </div>
        </div>
        <div class="row ">
            <ul class="nav responsive-tab">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url(); ?>home">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>kategori_padi">Subkategori Padi</a>
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
                                <strong> FILTER KATEGORI PADI </strong>
                            </div>
                            <form role="form" method="post" action="<?= base_url('subkategori_padi/filter'); ?>">
                                <div class="card-body p-6 bg-light" data-height="100%">
                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Kategori Padi</label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="id_kategori_padi" name="id_kategori_padi" required>
                                                <?php foreach ($kategori_padi as $k) {
                                                    if (@$id_kategori_padi == $k['id']) { ?>
                                                        <option value="<?= $k['id']; ?>" selected><?= $k['uraian']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $k['id']; ?>"><?= $k['uraian']; ?></option>
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
                                    <strong> TABEL SUBKATEGORI PADI </strong>
                                </div>
                                <div class="card-body p-6 bg-light" data-height="100%">
                                    <div class="table-responsive">
                                        <table id="customer_data" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="center" width="10%">No</th>
                                                    <th width="80%">Uraian</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($data_padi as $value) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $value['uraian']; ?></td>
                                                        <td>
                                                            <a href="<?= base_url('subkategori_padi/delete/' . encrypt_url($value['id']) . '/' . encrypt_url($id_kategori_padi)); ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                                <i class="icon-trash red-text"></i>
                                                            </a>
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
                    <h6 class="modal-title text-white" id="exampleModalLabel">New Data</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <div class="modal-body no-p no-b">
                    <form role="form" method="post" action="<?= base_url('subkategori_padi/add'); ?>" id="modalform">
                        <input type="hidden" name="id_kategori_padi" value="<?= $id_kategori_padi; ?>">
                        <div class="card">
                            <div class="card-body b-b">

                                <div class="row pb-4">
                                    <label class="col-md-3 col-form-label">Uraian</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="uraian" maxlength="200" required>
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