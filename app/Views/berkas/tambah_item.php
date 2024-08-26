<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Detail Berkas
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Nomor - Nama Berkas</label>
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
                <?php if (!empty($alert)) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $alert ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('arsip/updateIdBerkas'); ?>" method="post">
                    <?= csrf_field() ?> <!-- Menambahkan token CSRF -->
                    <table id="itemTable" class="table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Judul Dokumen</th>
                                <th>Tanggal Dokumen</th>
                                <th>ID Berkas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($idBerkasNull as $item) : ?>
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="<?= $item['id'] ?>"></td>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['judul_dokumen'] ?></td>
                                    <td><?= $item['tgl_dokumen'] ?></td>
                                    <td><?= $item['id_berkas'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <label for="newIdBerkas">Pilih ID Berkas Baru:</label>
                    <select id="newIdBerkas" name="new_id_berkas">
                        <?php foreach ($dataBerkas as $berkas) : ?>
                            <option value="<?= $berkas['id'] ?>"><?= $berkas['nama_berkas'] ?> (<?= $berkas['tahun_berkas'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-sm btn-primary btn-rounded">Tambah Item Berkas</button>
                </form>
            </div>
        </div>
    </div>
</div>