<div class="row">
    <div class="col-sm-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Data <?= $judul; ?></h5>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('arsipvital/tambah'); ?>" class="btn-right btn btn-sm btn-outline-primary">
                            Tambah Data
                        </a>
                        <button type="button" class="btn-right btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modal-import">
                            Import Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('error')) : ?>
                    <div class="alert alert-success">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Pilih Unit Pencipta</label>
                    <select id="sub_bidang" class="form-control">
                        <option value="">Semua Sub Bidang</option>
                        <?php foreach ($sub_bidang as $sb) : ?>
                            <option value="<?= $sb['id_sub'] ?>"><?= $sb['id_sub'] ?>- <?= $sb['nama_sub_bidang'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <table id="arsip_vital" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Unit Pencipta</th>
                            <th>No Dokumen</th>
                            <th>Judul Dokumen</th>
                            <th>Tanggal Dokumen</th>
                            <th>Jenis Dokumen</th>
                            <th>Lokasi Simpan</th>
                            <th>Media Simpan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $item) : ?>
                            <tr data-sub-bidang="<?= $item['id_sub_bidang'] ?>">
                                <td><?= $no++; ?></td>
                                <td><?= $item['nama_sub_bidang'] ?></td>
                                <td><?= $item['no_dokumen'] ?></td>
                                <td><?= $item['judul_dokumen'] ?></td>
                                <td><?= $item['tgl_dokumen'] ?></td>
                                <td><?= $item['jenis_arsip'] ?></td>
                                <td><?= $item['lokasi_simpan'] ?></td>
                                <td><?= $item['media_simpan'] ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="" class="btn wrn-btn btn-sm mr-1">Edit</a>
                                        <a href="" class="btn dgr-btn btn-sm">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Excel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('arsipvital/importvital') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input class="form-control" type="file" name="file" accept=".xls,.xlsx" required>
                    <button class="btn btn-sm btn-primary mt-2" type="submit">Upload</button>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>