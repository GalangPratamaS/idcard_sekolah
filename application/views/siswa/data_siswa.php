<div class="wrapper">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-6 m-b-30">
                <div class="btn font-weight shadow rounded-0 text-light position-absolute" style="background:#32485f ;margin-top: -20px; margin-left:-5px">EDIT DATA SISWA</div>
                <div class="card m-b-30 position-static">
                    <div class="card-body">
                        <p class="m-b-30 m-t-10">Mohon untuk mengisi data dengan baik dan benar</p>
                        <form method="POST" id="form_tambah" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nis" placeholder="Masukan Nomor Induk Siswa" value="<?=$siswa['nomor_induk_siswa'];?>" readonly/>
                                    <span id="nis_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" placeholder="Masukan nama" value="<?=$siswa['nama_siswa'];?>"/>
                                    <span id="nama_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Jenis
                                    kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jk" id="exampleFormControlSelect1">
                                        <option value="<?=$siswa['jk'];?>"><?=$siswa['jk'];?></option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <span id="jk_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Tempat lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir" value="<?=$siswa['alamat'];?>"/>
                                    <span id="tempat_lahir_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tanggal_lahir" placeholder="mm/dd/yyyy" id="datepicker-autoclose" value="<?=$siswa['tanggal_lahir'];?>">
                                    <span id="tanggal_lahir_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" placeholder="Sawojajar wanasari brebes"  value="<?=$siswa['alamat'];?>"/>
                                    <span id="alamat_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Tipe Kendaraan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="tipe_kendaraan" id="exampleFormControlSelect1">
                                        <option value="<?=$siswa['tipe_kendaraan'];?>"><?=$siswa['tipe_kendaraan'];?></option>
                                        <option value="Mobil">Mobil</option>
                                        <option value="Motor">Motor</option>
                                    </select>
                                    <span id="kendaraan_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nomor Polisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_polisi" placeholder="T0000KE"  value="<?=$siswa['nomor_polisi'];?>"/>
                                    <span id="nopol_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm2"></div>
                            <div class="col-sm-10">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    Foto harus memiliki background ... dan ukuran height: px width: px
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Foto Siswa</label>
                                <div class="col-sm-10">
                                    <input name="importfile" type="file" class="form-control-file" id="customFileLangHTML" accept=".jpeg,.jpg,.png" required="">
                                </div>
                            </div>
                            
                            <div class="form-group text-right">
                                <input type="submit" name="submit_tambah" id="submit_tambah" class="btn btn-primary" value="Simpan">
                            </div>
                        </form>

                    </div>
                </div>
                
            </div> <!-- end col -->

        </div>

    </div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->