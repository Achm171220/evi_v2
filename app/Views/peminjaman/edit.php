<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                tambah data
            </div>
            <div class="card-body">
                <form action="<?= base_url('peminjaman/update/' . $idarsip['id']); ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="no_pinjam">No Pinjam</label>
                        <input type="text" class="form-control" id="no_pinjam" name="no_pinjam" value="<?= $idarsip['no_pinjam'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nip_peminjam">NIP Peminjam</label>
                        <input type="text" class="form-control" id="nip_peminjam" name="nip_peminjam" value="<?= $idarsip['nip_peminjam'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_peminjam">Nama Peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="<?= $idarsip['nama_peminjam'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= $idarsip['tgl_pinjam'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="<?= $idarsip['tgl_kembali'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"><?= $idarsip['keterangan'] ?></textarea>
                    </div>
                    <h3>Daftar Arsip</h3>
                    <div class="form-group">
                        <table id="arsipTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>Judul Dokumen</th>
                                    <th>No Dokumen</th>
                                    <th>Tanggal Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selectedArsipIds = array_column($lampiran, 'id_arsip');
                                foreach ($arsipList as $item) : ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="arsip_id[]" value="<?= $item['id']; ?>" <?= in_array($item['id'], $selectedArsipIds) ? 'checked' : ''; ?>>
                                        </td>
                                        <td><?= $item['judul_dokumen']; ?></td>
                                        <td><?= $item['no_dokumen']; ?></td>
                                        <td><?= $item['tgl_dokumen']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr class="my-2">

                    <a href="<?= base_url('peminjaman'); ?>" class="btn btn-danger mt-3">Kembali</a>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>