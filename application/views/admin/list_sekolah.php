<div class="wrapper">
    <div class="container-fluid ">
        <div class="row">
        <?php foreach($sekolah as $sekolah){ 
        ?>
<div class="col-xl-3 col-md-6">
                <div class="card bg-primary mini-stat text-white">
                    <div class="p-3 mini-stat-desc">
                        <div class="clearfix">
                            <h7 class="text-uppercase mt-0 float-left text-white-50">
                             <a href="<?= base_url('Sekolah/view_sekolah/').$sekolah->id; ?>" class="text-white-50"><?= $sekolah->sekolah ?></a>   
                            </h7>
                            <h4 class="mb-3 mt-0 float-right"><i class="mdi dripicons-user h5"></i></h4>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="float-right">
                            <a href="<?= base_url('Sekolah/view_sekolah/').$sekolah->id; ?>" class="text-white-50"><?= $sekolah->count ?></a>
                        </div>
                        <p class="font-14 m-0">Jumlah Siswa</p>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>