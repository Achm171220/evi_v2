<div class="row">
    <div class="col-sm-12">
        <div class="card card-outline card-danger shadow">
            <div class="card-body">
                Unit Kerja : <?= $data_user['nama_es2']; ?>
            </div>
        </div>
        <div class="card card-outline card-danger shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title"><?= $judul; ?> <i class="fe fe-chevron-right"></i> <?= $subjudul; ?></h5>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('berkasinaktif/tambah'); ?>" class="btn-right btn btn-sm btn-outline-primary">
                            Tambah Data
                        </a>
                        <button type="button" class="btn-right btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modal-import">
                            Import Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->has('status')) : ?>
                    <p><?= session('status') ?></p>
                <?php endif; ?>
                <?php
                if (session()->getFlashdata('message')) {
                ?>
                    <div class="alert alert-info">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php
                }
                ?>
                <?php if (session()->has('success')) : ?>
                    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php elseif (session()->has('error')) : ?>
                    <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered p-0" id="berkasInaktif" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Kode Klas</th>
                                <th>Nama Unit</th>
                                <th>Nama Berkas</th>
                                <th>Tahun Berkas</th>
                                <th>Jml item</th>
                                <th>Manage Item</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- json data  -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Confirmation Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>
<!-- modal import  -->
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

                <form action="<?= base_url('berkas/importberkas') ?>" method="post" enctype="multipart/form-data">
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