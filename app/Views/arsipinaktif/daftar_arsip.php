<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Daftar Arsip
                <div class="card-tools">
                    <a href="<?= base_url('arsipinaktif/exportExcel'); ?>" class="btn scc-btn btn-sm"><i class="bi bi-file-excel mr-2"></i> Excel</a>
                    <a href="" class="btn dgr-btn btn-sm"><i class="bi bi-file-pdf mr-2"></i> PDF</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Berkas</th>
                                <th>Kode Klasifikasi</th>
                                <th>Nama Berkas</th>
                                <th>Judul Item</th>
                                <th>Tanggal Item</th>
                                <th>Media</th>
                                <th>Tk Perkembangan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($daftar as $key => $data) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['no_berkas']; ?></td>
                                    <td><?= $data['kode_klasifikasi']; ?></td>
                                    <td><?= $data['nama_berkas']; ?></td>
                                    <td><?= $data['judul_dokumen']; ?></td>
                                    <td><?= $data['tgl_dokumen']; ?></td>
                                    <td><?= $data['media']; ?></td>
                                    <td><?= $data['tk_perkembangan']; ?></td>
                                    <td><?= $data['jumlah']; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>