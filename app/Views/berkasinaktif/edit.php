<div class="row">
    <div class="col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                Unit Kerja : <?= $unit = $data_user['nama_es2'] != NULL ? $data_user['nama_es2'] : $data_user['parameter_unit']; ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title"><?= $judul; ?> <i class="fe fe-chevron-right"></i> <?= $subjudul; ?></h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('berkasinaktif/update/' . $getId['id']); ?>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Nama Unit Kerja /Es II</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="id_es2" value="<?= $data_user['nama_es2']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Unit Pencipta</label>
                    <div class="col-md-9">
                        <select class="form-control select2" style="width: 100%;" name="id_sub_bidang">
                            <option selected="selected" value="<?= $getId['id_sub_bidang']; ?>"><?= $getId['nama_sub_bidang']; ?></option>
                            <?php foreach ($getIdSub as $key => $subbid) { ?>
                                <option value="<?= $subbid['id_sub']; ?>"><?= $subbid['id_sub']; ?> - <?= $subbid['nama_sub_bidang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Kode Klasifikasi</label>
                    <div class="col-md-9">
                        <select class="js-example-basic-single select2" name="id_klasifikasi">
                            <option selected="selected" value="<?= $getId['id_klasifikasi']; ?>"><?= $getId['kode_klasifikasi']; ?> - <?= $getId['nama_klasifikasi']; ?></option>

                            <?php foreach ($klasifikasi as $key => $klas) { ?>
                                <option value="<?= $klas['id']; ?>"><?= $klas['kode_klasifikasi']; ?> - <?= $klas['nama_klasifikasi']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">ID Berkas</label>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="id_berkas" value="<?= $getId['id']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">No Berkas</label>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="no_berkas" value="<?= $getId['no_berkas']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Nama Berkas</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="nama_berkas" value="<?= $getId['nama_berkas']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Tahun Berkas</label>
                    <div class="col-lg-9">
                        <input type="year" class="form-control" name="tahun_berkas" value="<?= $getId['tahun_berkas']; ?>">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Update Data</button>
                </div>
                <?= form_close(); ?>
                <!-- abaikan  -->

                <!-- selesai abaikan  -->
            </div>
        </div>
    </div>
</div>