<div class="wrapper">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-6 m-b-30">
                <div class="btn font-weight shadow rounded-0 text-light position-absolute"
                    style="background:#32485f ;margin-top: -20px; margin-left:-5px">EDIT DATA KENDARAAN</div>
                <div class="card m-b-30 position-static">
                    <div class="card-body">
                        <p class="m-b-30 m-t-10">Mohon untuk mengisi data dengan baik dan benar</p>
                        <form method="POST" id="form_stnk">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nis"
                                        placeholder="Masukan Nomor Induk Siswa"
                                        value="<?=$siswa['nomor_induk_siswa'];?>" readonly />
                                    <span id="nis_error" class="text-danger"></span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Tipe
                                    Kendaraan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="tipe_kendaraan" id="exampleFormControlSelect1" required="">
                                        <option value="<?=$siswa['tipe_kendaraan'];?>"><?=$siswa['tipe_kendaraan'];?>
                                        </option>
                                        <option value="Mobil">Mobil</option>
                                        <option value="Motor">Motor</option>
                                    </select>
                                    <span id="kendaraan_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nomor Polisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_polisi" placeholder="T0000KE"
                                        value="<?=$siswa['nomor_polisi'];?>" required=""/>
                                    <span id="nopol_error" class="text-danger"></span>
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Foto STNK</label>
                                <div class="col-sm-10">
                                    <input name="image" type="file" class="form-control-file"
                                        id="customFileLangHTML" accept=".jpeg,.jpg,.png" required="">
                                    <span id="foto_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm2"></div>
                                <div class="col-sm-10">
                                    <div class="text-center">
                                        <img class="img-responsive" style="width: 215px; height:270px;"
                                            src="<?= base_url('asset/kartu/stnk/').$siswa['foto_stnk']; ?>" alt="Foto siswa">
                                    </div>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        Foto harus jelas dan tampak nomor polisi
                                        <button id="btnUpdateSiswa" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row align-items-center m-b-10">
                                <div class="col">
                                    <div id="file-progress-bar"
                                        class="progress-bar progress-bar-striped progress-bar-animated"></div>

                                </div>
                            </div>
                             <div class="row align-items-center">
                                <div class="col">
                                    <div id="uploaded_file"></div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" name="submit_update" id="btnUpdateSiswa" class="btn btn-primary"
                                    value="Simpan">
                            </div>
                        </form>

                    </div>
                </div>

            </div> <!-- end col -->

        </div>

    </div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->