<div class="wrapper">
    <div class="container-fluid ">
        <div class="row">
           
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">
                                Data Siswa
                            </h6>
                            <h4 class="mb-3 mt-0 float-right"></h4>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="<?= base_url('DashboardSiswa/edit_data'); ?>" class="text-white-50"><i class="dripicons-store h5"></i></a>
                        </div>
                        <?php if($siswa['nomor_polisi']== '-' || $siswa['tipe_kendaraan'] == '-') {?>
                        <p class="font-14 m-0">Belum Lengkap</p>
                        <?php } else {
                            echo '<p class="font-14 m-0">Sudah Lengkap</p>';
                         }?>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">
                                Upload STNK
                            </h6>
                            <h4 class="mb-3 mt-0 float-right"></h4>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="<?= base_url('DashboardSiswa/upload_stnk'); ?>" class="text-white-50"><i class="dripicons-store h5"></i></a>
                        </div>
                        <?php if($siswa['nomor_polisi']== '-' || $siswa['tipe_kendaraan'] == '-') {?>
                        <p class="font-14 m-0">Belum Lengkap</p>
                        <?php } else {
                            echo '<p class="font-14 m-0">Sudah Lengkap</p>';
                         }?>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h6 class="text-uppercase mt-0 float-left text-white-50">
                                KARTU
                            </h6>
                            <h4 class="mb-3 mt-0 float-right"></h4>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="<?= base_url('Card'); ?>" class="text-white-50"><i class="dripicons-card h5"></i></a>
                        </div>
                        <p class="font-14 m-0">Lihat Kartu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>