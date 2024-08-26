<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Nilai Aski
                <div class="card-tools">
                    <a href="<?= base_url('pengawasan/tambah'); ?>" class="btn scd-btn btn-sm"> Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <h6 class="text-center">
                    REKAPITULASI NILAI AUDIT SISTEM KEARSIPAN INTERNAL <br>
                    UNIT PENGOLAH <br>
                    : <?= $data_user['nama_es2']; ?>


                </h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Aspek/Sub Aspek</th>
                            <th>Nilai Standar</th>
                            <th>Nilai</th>
                            <th>Bobot Sub Aspek</th>
                            <th>Nilai Sub Aspek</th>
                            <th>Bobot Aspek</th>
                            <th>Nilai Aspek</th>
                        </tr>
                        <tr class="text-center">
                            <td>(1)</td>
                            <td>(2)</td>
                            <td>(3)</td>
                            <td>(4)</td>
                            <td>(5)</td>
                            <td>(6)</td>
                            <td>(7)</td>
                            <td>(8)</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>