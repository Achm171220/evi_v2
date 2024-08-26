<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Nilai Aski Unit
                <div class="card-tools">
                    <a href="<?= base_url('pengawasan/tambah'); ?>" class="btn scd-btn btn-sm"> Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-stripped" id="default">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unit</th>
                            <th>Nilai Aski</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_es2']; ?></td>
                                <td><?= $value['nilai_akhir']; ?></td>
                                <td>
                                    <?php if ($value['nilai_akhir'] >= 90) {
                                        echo '<button class="btn pmr-btn btn-sm">AA (sangat memuaskan)</button>';
                                    } elseif ($value['nilai_akhir'] < 90 && $value['nilai_akhir'] >= 80) {
                                        echo '<button class="btn inf-btn btn-sm">A (memuaskan)</button>';
                                    } elseif ($value['nilai_akhir'] < 80 && $value['nilai_akhir'] >= 70) {
                                        echo '<button class="btn scd-btn btn-sm">BB (sangat baik)</button>';
                                    } elseif ($value['nilai_akhir'] < 70 && $value['nilai_akhir'] >= 60) {
                                        echo '<button class="btn scc-btn btn-sm">B (baik)</button>';
                                    } elseif ($value['nilai_akhir'] < 60 && $value['nilai_akhir'] >= 50) {
                                        echo '<button class="btn wrn-btn btn-sm">CC (cukup)</button>';
                                    } elseif ($value['nilai_akhir'] < 50 && $value['nilai_akhir'] >= 30) {
                                        echo '<button class="btn dgr-btn btn-sm">C (kurang)</button>';
                                    }; ?>
                                </td>
                                <td>
                                    <a href="" class="btn scc-btn btn-sm"><i class="bi bi-eye" title="detail"></i> detail</a>
                                    <a href="" class="btn scd-btn btn-sm"><i class="bi bi-printer" title="cetak rhas"></i> rhas</a>
                                    <a href="" class="btn dgr-btn btn-sm"><i class="bi bi-trash" title="detail"></i> hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>