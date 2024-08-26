<!-- Small boxes (Stat box) -->
<div class="card bg-gradient-success">
    <div class="card-header">
        <h3 class="card-title">Selamat Datang <?= session()->get('name'); ?> ! di halaman Admin</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <!-- /.card-body -->
</div>
<div class="row">
    <div class="col-md-3">
        <!-- /.info-box -->
        <div class="info-box mb-3 text-white" style="background-color: #07beb8;">
            <span class="info-box-icon"><i class="far fa-file"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Arsip Aktif</span>
                <span class="info-box-number"><?= number_format($jml_arsip); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-3">
        <!-- /.info-box -->
        <div class="info-box mb-3 text-white" style="background-color: #0d41e1;">
            <span class="info-box-icon"><i class="far fa-file"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Arsip Inaktif</span>
                <span class="info-box-number"><?= number_format($jml_arsip_i); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-3">
        <!-- /.info-box -->
        <div class="info-box mb-3 text-white" style="background-color: #f2542d;">
            <span class="info-box-icon"><i class="far fa-file"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Arsip Vital</span>
                <span class="info-box-number"><?= number_format($jml_arsip_v); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-3">
        <!-- /.info-box -->
        <div class="info-box mb-3 text-white" style="background-color: #b744b8;">
            <span class="info-box-icon"><i class="far fa-file"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah SDM Kearsipan</span>
                <span class="info-box-number"><?= number_format($jml_user); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row">

    <div class="col-sm-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                Data Arsip Aktif
            </div>
            <div class="card-body">
                <table id="aktif" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Unit</th>
                            <th>Arsip Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rekapitulasi) && is_array($rekapitulasi)) : ?>
                            <?php $no = 1;
                            foreach ($rekapitulasi as $row) : ?>
                                <tr>
                                    <td><?= esc($no++) ?></td>
                                    <td><?= esc($row['nama_unit']) ?></td>
                                    <td><?= esc($row['jumlah_arsip']) ?></td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-primary-1">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card card-danger card-outline">
            <div class="card-header">
                Data Arsip InAktif
            </div>
            <div class="card-body">
                <table id="inaktif" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Unit</th>
                            <th>Arsip Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rekapitulasi_i) && is_array($rekapitulasi_i)) : ?>
                            <?php $no = 1;
                            foreach ($rekapitulasi_i as $row) : ?>
                                <tr>
                                    <td><?= esc($no++) ?></td>
                                    <td><?= esc($row['nama_unit']) ?></td>
                                    <td><?= esc($row['jumlah_arsip']) ?></td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-primary-1">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>