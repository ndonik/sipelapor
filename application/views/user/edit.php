<header class="blue accent-3 relative nav-sticky">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-table"></i>
                    <b>DATA USER</b>
                </h4>
            </div>
        </div>
        <div class="row ">
            <ul class="nav responsive-tab">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url(); ?>home">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>kategori_staff">User</a>
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
                            <form role="form" method="post" action="<?= base_url('user/update'); ?>" id="modalform">
                                <div class="card-body p-6 bg-light p-4" data-height="100%">
                                    <input type="hidden" name="id" value="<?= $user->id; ?>" />

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">NIP</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="nip" value="<?= $user->nip; ?>" maxlength="100" required>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="nama_lengkap" value="<?= $user->nama_lengkap; ?>" maxlength="200" required>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Jabatan</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="jabatan" value="<?= $user->jabatan; ?>" maxlength="100" required>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Username</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="username" value="<?= $user->username; ?>" maxlength="100" required>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="email" name="email" value="<?= $user->email; ?>" maxlength="200" required>
                                        </div>
                                    </div>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">No HP</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" name="no_hp" value="<?= $user->no_hp; ?>" maxlength="20" required>
                                        </div>
                                    </div>

                                    <?php

                                    $level = $user->level;

                                    if ($level == 'Admin') {
                                        $admin = 'selected';
                                        $penginput = '';
                                        $pengawas = '';
                                    } else if ($level == 'Penginput') {
                                        $admin = '';
                                        $penginput = 'selected';
                                        $pengawas = '';
                                    } else {
                                        $admin = '';
                                        $penginput = '';
                                        $pengawas = 'selected';
                                    }


                                    ?>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Level</label>
                                        <div class="col-md-9">
                                            <select name="level" class="form-control" required>
                                                <option value="Admin" <?= $admin; ?>>Admin</option>
                                                <option value="Penginput" <?= $penginput; ?>>Penginput</option>
                                                <option value="Pengawas" <?= $pengawas; ?>>Pengawas</option>
                                            </select>

                                        </div>
                                    </div>

                                    <?php
                                    $status = $user->status;

                                    if ($status == 'Y') {
                                        $status = 'checked';
                                    } else {
                                        $status = '';
                                    }

                                    ?>

                                    <div class="row pb-4">
                                        <label class="col-md-3 col-form-label">Status</label>
                                        <div class="col-md-9">
                                            <label class="btn btn-primary">
                                                <input type="checkbox" name="status" <?= $status; ?>> Aktif
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer white">
                                    <a href="<?= base_url('user'); ?>">
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