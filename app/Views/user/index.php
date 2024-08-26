<div class="row">
    <div class="col-sm-12">
        <h3 class="page-title"><?= $judul; ?></h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><?= $subjudul; ?></a></li>
            <li class="breadcrumb-item active"><?= $subjudul; ?></li>
        </ul>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h5 class="card-title">Data User</h5>
            </div>
            <div class="col-auto">
                <button class="btn-right btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                    <i class="fe fe-user text-white"></i> Tambah User
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <div class="table-responsive">
            <table id="example2" class="datatable table table-stripped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($user as $key => $value) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['name']; ?></td>
                            <td><?= $value['email']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning-1 text-white" data-toggle="modal" data-target="#modal-lg<?= $value['id']; ?>">Edit</button>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                        <!-- modal edit data  -->
                        <div class="modal fade" id="modal-lg<?= $value['id']; ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open('user/update/' . $value['id']); ?>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Nama User</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?= $value['name']; ?>" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Email</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?= $value['email']; ?>" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Password</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="isikan password baru" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Tanggal Input Data</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal add  -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit RBAC</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('user/add_user'); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-2">Nama User</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="isikan nama lengkap" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-2">Email</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="isikan email bpkp/GWS" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-2">Password</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="isikan password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-2">Tanggal Input Data</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>