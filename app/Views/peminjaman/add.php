<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                tambah data
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>peminjaman/save" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="no_pinjam">No Pinjam</label>
                        <input type="text" class="form-control" id="no_pinjam" name="no_pinjam" value="<?= old('no_pinjam') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nip_peminjam">NIP Peminjam</label>
                        <input type="text" class="form-control" id="nip_peminjam" name="nip_peminjam" value="<?= old('nip_peminjam') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_peminjam">Nama Peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="<?= old('nama_peminjam') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= old('tgl_pinjam') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="<?= old('tgl_kembali') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"><?= old('keterangan') ?></textarea>
                    </div>

                    <hr class="my-2">
                    <p>Pilih Arsip yang akan dipinjam</p>
                    <table id="arsipTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Unit Pencipta</th>
                                <th>Judul Dokumen</th>
                                <th>No Dokumen</th>
                                <th>Tanggal Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($arsipList as $arsip) : ?>
                                <tr>
                                    <td><input type="checkbox" name="id_arsip[]" value="<?= $arsip['id']; ?>"></td>
                                    <td><?= $arsip['id']; ?></td>
                                    <td><?= $arsip['nama_sub_bidang']; ?></td>
                                    <td><?= $arsip['judul_dokumen']; ?></td>
                                    <td><?= $arsip['no_dokumen']; ?></td>
                                    <td><?= $arsip['tgl_dokumen']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>