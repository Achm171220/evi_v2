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
                        <input type="text" class="form-control" value="<?= esc($idBerkas['no_berkas']) ?> - <?= esc($idBerkas['nama_berkas']) ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Kode Klasifikasi</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="<?= esc($idBerkas['kode_klasifikasi']) ?> - <?= esc($idBerkas['nama_klasifikasi']) ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Pencipta Berkas</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="<?= esc($idBerkas['nama_sub_bidang']) ?>" readonly>
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
            <div class="card-header">
                <div class="card-title">
                    Daftar Item Berkas
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('message')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Nomor Item</th>
                            <th>ID item</th>
                            <th>Judul Item</th>
                            <th>Nomor Item</th>
                            <th>Tgl item</th>
                            <th>Id</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataBerkas == NULL) { ?>
                            <tr>
                                <td colspan="7"><span class="badge badge-outline badge-danger">Tidak ada item berkas</span> </td>
                            </tr>
                        <?php } else { ?>
                            <?php $no = 1;
                            foreach ($dataBerkas as $item) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['judul_dokumen'] ?></td>
                                    <td><?= $item['no_dokumen'] ?></td>
                                    <td><?= $item['tgl_dokumen'] ?></td>
                                    <td><?= $item['id_berkas'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-lg">hapus item</button>
                                        <div class="modal fade" id="modal-lg">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Item</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?= form_open('Berkas/deleteItem/' . $item['id']); ?>
                                                    <div class="modal-body">
                                                        <p>Apa anda yakin hapus item dari Berkas ?</p>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-lg-2 col-form-label">Id Dokumen</label>
                                                            <div class="col-lg-10">
                                                                <input type="text" class="form-control" value="<?= esc($item['id']) ?>" readonly name="id_berkas">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-2 col-form-label">Hapus ID</label>
                                                            <div class="col-lg-10">
                                                                <input type="text" class="form-control" value="NULL" hidden name="id_berkas_new">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-2 col-form-label">Judul Dokumen</label>
                                                            <div class="col-lg-10">
                                                                <textarea rows="3" type="text" class="form-control" value="" readonly><?= esc($item['judul_dokumen']) ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn dgr-btn">hapus</button>
                                                    </div>
                                                    <?= form_close(); ?>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="form-group" hidden>
                    <label for="new_berkas_id">New Berkas ID:</label>
                    <input type="text" id="new_berkas_id" name="new_berkas_id" class="form-control" value="<?= esc($idBerkas['id']) ?>">
                </div>
            </div>
        </div>
    </div>
</div>