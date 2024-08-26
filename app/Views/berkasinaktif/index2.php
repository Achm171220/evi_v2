<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Detail Berkas
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">ID</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="<?= esc($idBerkas['id']) ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Nomor - Nama Berkas</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="<?= esc($idBerkas['no_berkas']) ?> - <?= esc($idBerkas['nama_berkas']) ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Tahun Berkas</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="<?= esc($idBerkas['tahun_berkas']) ?>" readonly>
                    </div>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">

                <?php if ($success) : ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php elseif ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form action="<?= base_url('trial_bug/updateItems') ?>" method="post">
                    <?= csrf_field() ?> <!-- Menambahkan token CSRF -->

                    <div class="table-responsive">
                        <table id="itemBerkasTable" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th></th>
                                    <th>No Dokumen</th>
                                    <th>Judul Dokumen</th>
                                    <th>Tanggal Dokumen</th>
                                    <th>Media</th>
                                    <th>Jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($itemBerkas as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" name="selected_items[]" value="<?= $item['id'] ?>"></td>
                                        <td><?= $item['no_dokumen'] ?></td>
                                        <td><?= $item['judul_dokumen'] ?></td>
                                        <td><?= $item['tgl_dokumen'] ?></td>
                                        <td><?= $item['media_simpan'] ?></td>
                                        <td><?= $item['jenis_arsip'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group" id="none_visible">
                        <label for="new_id_berkas">ID Berkas Baru:</label>

                        <input class="form-control" name="new_id_berkas" value="<?= $idBerkas['id']; ?>">
                    </div>
                    <a href="<?= base_url('berkas'); ?>" class="btn btn-danger">Kembali ke Menu Berkas</a>
                    <button type="submit" class="btn pmr-btn">Tambah Item Berkas</button>
                </form>
            </div>
        </div>
    </div>
</div>