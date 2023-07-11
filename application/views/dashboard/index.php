<header class="blue accent-3 relative nav-sticky">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">

            <div class="col">
                <h4>
                    <i class="icon-dashboard2"></i>
                    Dashboard
                </h4>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</header>

<br />

<div class="container-fluid relative animatedParent animateOnce">

    <?php
    $total_padi = $data_padi_tunggu + $data_padi_tolak +  $data_padi_selesai;
    $total_palawija =  $data_palawija_tunggu + $data_palawija_tolak +  $data_palawija_selesai;
    $total_tunggu = $data_padi_tunggu + $data_palawija_tunggu;
    $total_tolak = $data_padi_tolak + $data_palawija_tolak;
    $total_selesai = $data_padi_selesai + $data_palawija_selesai;

    $total_semua = $total_padi + $total_palawija;
    ?>
    <div class="tab-content pb-3" id="v-pills-tabContent">
        <div class="alert alert-primary" style="background-color:#2979ff">
            <h5 style="font-weight: bold;" class="text-white">KESELURUHAN</h5>
        </div>
        <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
            <div class="row my-3">
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-2">
                            <div class="float-right">
                                <span class="icon icon-globe text-light-blue s-48"></span>
                            </div>
                            <div class="counter-title">Total</div>
                            <h5 class="mt-3"><?= $total_semua; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-2">
                            <div class="float-right">
                                <span class="icon icon-clock-o text-light-blue s-48"></span>
                            </div>
                            <div class="counter-title ">Tunggu</div>
                            <h5 class="mt-3"><?= $total_tunggu; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-2">
                            <div class="float-right">
                                <span class="icon icon-cancel text-light-blue s-48"></span>
                            </div>
                            <div class="counter-title">Tolak</div>
                            <h5 class="mt-3"><?= $total_tolak; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-2">
                            <div class="float-right">
                                <span class="icon icon-check text-light-blue s-48"></span>
                            </div>
                            <div class="counter-title">Selesai</div>
                            <h5 class="mt-3"><?= $total_selesai; ?></h5>
                        </div>
                    </div>
                </div>
            </div>


            <div class="alert alert-primary" style="background-color:#2979ff">
                <h5 style="font-weight: bold;" class="text-white">PADI</h5>
            </div>
            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-2">
                                <div class="float-right">
                                    <span class="icon icon-globe text-light-blue s-48"></span>
                                </div>
                                <div class="counter-title">Total</div>
                                <h5 class="mt-3"><?= $total_padi; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-2">
                                <div class="float-right">
                                    <span class="icon icon-clock-o text-light-blue s-48"></span>
                                </div>
                                <div class="counter-title ">Tunggu</div>
                                <h5 class="mt-3"><?= $data_padi_tunggu; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-2">
                                <div class="float-right">
                                    <span class="icon icon-cancel text-light-blue s-48"></span>
                                </div>
                                <div class="counter-title">Tolak</div>
                                <h5 class="mt-3"><?= $data_padi_tolak; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-2">
                                <div class="float-right">
                                    <span class="icon icon-check text-light-blue s-48"></span>
                                </div>
                                <div class="counter-title">Selesai</div>
                                <h5 class="mt-3"><?= $data_padi_selesai; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content pb-3" id="v-pills-tabContent">
                <div class="alert alert-primary" style="background-color:#2979ff">
                    <h5 style="font-weight: bold;" class="text-white">PALAWIJA</h5>
                </div>
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                    <div class="row my-3">
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-2">
                                    <div class="float-right">
                                        <span class="icon icon-globe text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Total</div>
                                    <h5 class="mt-3"><?= $total_palawija; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-2">
                                    <div class="float-right">
                                        <span class="icon icon-clock-o text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title ">Tunggu</div>
                                    <h5 class="mt-3"><?= $data_palawija_tunggu; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-2">
                                    <div class="float-right">
                                        <span class="icon icon-cancel text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Tolak</div>
                                    <h5 class="mt-3"><?= $data_palawija_tolak; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-2">
                                    <div class="float-right">
                                        <span class="icon icon-check text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Selesai</div>
                                    <h5 class="mt-3"><?= $data_palawija_selesai; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="assets/img/logo.png" class="card-body">
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header white">
                                    <h6><b>Dinas Pertanian</b></h6>
                                    <h6><b>Balai Penyuluhan Pertanian</b></h6>
                                </div>
                                <div class="row card-body">
                                    <div class="col icon social">
                                        <ul>
                                            <li>
                                                <a href="#" class="facebook mr-3">
                                                    <i class="icon-facebook"></i>
                                                </a> Facebook
                                            </li>
                                            <li>
                                                <a href="#" class="twitter mr-3">
                                                    <i class="icon-twitter"></i>
                                                </a>Twitter
                                            </li>
                                            <li>
                                                <a href="#" class="instagram mr-3">
                                                    <i class="icon-instagram"></i>
                                                </a>Instagram
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul>
                                            <li class="group-item mb-2"><i class="icon icon-mobile text-primary" style="font-size: 20px;"></i> <strong>Phone</strong></li>
                                            <li class="group-item mb-2"><i class="icon icon-web text-danger" style="font-size: 20px;"></i> <strong>Website</strong></li>
                                            <li class="group-item mb-2"><i class="icon icon-mail text-success" style="font-size: 20px;"></i> <strong>Email</strong></li>
                                            <li class="group-item mb-2"><i class="icon icon-address-card-o text-warning" style="font-size: 20px;"></i> <strong>Address</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>