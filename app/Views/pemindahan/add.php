<div class="row">
    <div class="col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                Unit Kerja : <?= $data_user['nama_es2']; ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Tambah Pemindahan <span class="badge badge-info">Usul Pindah</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pemindahan/addData') ?>" method="post">

                    <div class="form-group">
                        <label for="no_ba">Unit:</label>
                        <select class="form-control" name="id_sub_bidang">
                            <option value="">-pilih-</option>
                            <?php foreach ($subbidang as $key => $value) { ?>
                                <option value="<?= $value['id_sub']; ?>"><?= $value['nama_sub_bidang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_ba">Uraian Singkat:</label>
                        <input type="text" name="uraian" class="form-control" id="no_ba" required>
                    </div>
                    <div class="form-group">
                        <label for="no_ba">No Surat Usulan:</label>
                        <input type="text" name="uraian" class="form-control" id="no_ba" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_pindah">Tanggal Surat Usulan:</label>
                        <input type="date" name="tgl_pindah" class="form-control" id="tgl_pindah" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Usul Pindah</button>
                </form>
            </div>
        </div>
    </div>
</div>