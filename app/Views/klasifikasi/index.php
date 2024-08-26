<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Data Klasifikasi
                <div class="card-tools">
                   
                    <button type="button" class="btn-primary btn btn-sm">
                        <i class="fas fa-plus mr-2"></i> Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="width: 10%">Kode Klasifikasi</th>
                            <th class="width: 30%">Nama Klasifikasi</th>
                            <th>Retensi Aktif</th>
                            <th>Retensi Inaktif</th>
                            <th>JRA</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataKlas as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['kode_klasifikasi'] ?></td>
                                <td><?= $value['nama_klasifikasi'] ?></td>
                                <td>
                                    <button class="btn btn-outline-success btn-block btn-sm">
                                        <?= $value['umur_aktif'] ?>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-block btn-sm">
                                        <?= $value['umur_inaktif'] ?>
                                    </button>
                                </td>
                                <td><?= $value['ket_jra'] ?></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-warning mr-1">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
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