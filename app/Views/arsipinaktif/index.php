<div class="row mt-3">
    <div class="col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                Unit Kerja : <?= $unit = $data_user['nama_es2'] != NULL ? $data_user['nama_es2'] : $data_user['parameter_unit']; ?>
            </div>
        </div>
        <div class="card card-outline card-danger">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title"><?= $judul; ?> <i class="fe fe-chevron-right"></i> <?= $subjudul; ?></h5>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('arsip/tambah'); ?>" class="btn-right btn btn-sm btn-outline-primary">
                            Tambah Data
                        </a>
                        <button type="button" class="btn-right btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modal-import">
                            Import Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped text-sm" id="tb_arsip_inaktif" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Unit</th>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Nomor</th>
                                <th>Tgl Dokumen</th>
                                <th>Media</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- import data  -->
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

                <form action="<?= base_url('arsipinaktif/importArsip') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="customFile" accept=".xls,.xlsx" required>
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary mt-2" type="submit">Upload</button>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>