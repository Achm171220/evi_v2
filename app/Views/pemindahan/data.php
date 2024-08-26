<div class="row">
    <div class="col-sm-12">
        <div class="card shadow">
            <div class="card-header">
                Data Pemindahan Arsip
                <div class="card-tools">
                    <a href="<?= base_url('pemindahan/usul_pindah'); ?>" class="btn pmr-btn btn-sm">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="default">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="25%">Unit</th>
                            <th>No Usulan</th>
                            <th>Informasi</th>
                            <th>No BA</th>
                            <th>Lampiran</th>
                            <th>Proses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataPindah as $key => $data) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_sub_bidang']; ?></td>
                                <td><?= $data['no_dokumen']; ?></td>
                                <td><?= $data['judul_dokumen']; ?></td>
                                <td><?= $data['no_ba_pindah'] ? $data['no_ba_pindah'] : 'belum ada' ?></td>
                                <td><?= $data['no_penetapan'] ? $data['no_penetapan'] : 'belum ada' ?></td>
                                <td><?= $data['status_proses'] ? $data['status_proses'] : 'usulan' ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="" class="btn btn-sm wrn-btn mr-1">Edit</a>
                                        <a href="" class="btn btn-sm dgr-btn">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>