  <section class="content">
      <div class="container-fluid">
          <div class="row mt-3">
              <div class="col-sm-12">
                  <div class="card">
                      <div class="card-header text-light bg-2">
                          <div class="row">
                              <div class="col">
                                  <h5 class="card-title">Setting User</h5>
                              </div>
                              <div class="col-auto">
                                  <button class="btn-right btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                                      <i class="fe fe-user text-white"></i> Tambah User
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <?php if (session()->has('success')) : ?>
                              <div class="alert alert-success" role="alert">
                                  <?= session()->getFlashdata('success') ?>
                              </div>
                          <?php endif; ?>
                          <div class="table-responsive">
                              <table id="example2" class="table table table-hover">
                                  <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Name</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Key</th>
                                          <th>Level</th>
                                          <th>Nama Unit</th>
                                          <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($dd_hak_unit as $key => $value) { ?>
                                          <tr>
                                              <td><?= $no++; ?></td>
                                              <td><?= $value['name']; ?></td>
                                              <td><?= $value['nama_grup']; ?></td>
                                              <td><?= $value['email']; ?></td>
                                              <td><?= $value['key_unit']; ?></td>
                                              <td><?= $value['level_unit']; ?></td>
                                              <td>
                                                  <?= $unit = $value['parameter_unit'] == 'all'  ? $value['parameter_unit'] : $value['nama_es2']; ?>
                                              </td>
                                              <td>
                                                  <div class="d-flex">
                                                      <button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#modal-lg<?= $value['id']; ?>"><i class="fe fe-edit-3"></i> Ubah Data</button>
                                                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#standard-modal<?= $value['id']; ?>"><i class="fe fe-settings"></i> Setting RBAC</button>
                                                  </div>
                                                  <!-- modal ubah data rbac  -->
                                                  <div class="modal fade" id="modal-lg<?= $value['id']; ?>">
                                                      <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h4 class="modal-title">Ubah Data - RBAC</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                              </div>
                                                              <?= form_open('user/add_rbac'); ?>
                                                              <div class="modal-body">
                                                                  <div class="form-group row">
                                                                      <label class="col-form-label col-md-2">Nama User</label>
                                                                      <div class="col-md-10">
                                                                          <select class="form-control select2bs4" style="width: 100%;" name="id_user">
                                                                              <option value="<?= $value['id_user']; ?>"><?= $value['name']; ?></option>

                                                                              <?php foreach ($user as $key => $data) { ?>
                                                                                  <option value="<?= $data['id']; ?>"><?= $data['name']; ?></option>
                                                                              <?php } ?>
                                                                          </select>
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-form-label col-md-2">Nama Group</label>
                                                                      <div class="col-md-10">
                                                                          <select class="form-control" name="nama_grup">
                                                                              <option value="<?= $value['nama_grup']; ?>" selected><?= $value['nama_grup']; ?></option>
                                                                              <option value="kepala">Kepala BPKP</option>
                                                                              <option value="pim2">Pimpinan Eselon 2</option>
                                                                              <option value="pengolah">Pengolah</option>
                                                                          </select>
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-form-label col-md-2">Nama Key Unit</label>
                                                                      <div class="col-md-10">
                                                                          <select class="form-control" name="key_unit">
                                                                              <option value="<?= $value['key_unit']; ?>" selected><?= $value['key_unit']; ?></option>
                                                                              <option value="all">all</option>
                                                                              <option value="id_es2">Eselon 2</option>
                                                                          </select>
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-form-label col-md-2">Level Unit</label>
                                                                      <div class="col-md-10">
                                                                          <select class="form-control" name="level_unit">
                                                                              <option value="<?= $value['level_unit']; ?>" selected><?= $value['level_unit']; ?></option>
                                                                              <option value="all">all</option>
                                                                              <option value="es2">Eselon 2</option>
                                                                          </select>
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-form-label col-md-2">Unit Kerja</label>
                                                                      <div class="col-md-10">
                                                                          <select class="form-control select2bs4" style="width: 100%;" name="parameter_unit">
                                                                              <option value="<?= $value['parameter_unit']; ?>" selected><?= $value['parameter_unit']; ?></option>
                                                                              <option value="all">Admin</option>
                                                                              <?php foreach ($es2 as $key => $data) { ?>
                                                                                  <option value="<?= $data['id']; ?>"><?= $data['nama_es2']; ?></option>
                                                                              <?php } ?>
                                                                          </select>
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
                                                  <!-- modal rbac  -->
                                                  <!-- modal add  -->
                                                  <div id="standard-modal<?= $value['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-lg">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h4 class="modal-title" id="standard-modalLabel">Edit RBAC</h4>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <form action="">
                                                                      <div class="form-group row">
                                                                          <label class="col-form-label col-md-2">Nama Group</label>
                                                                          <div class="col-md-10">
                                                                              <select class="form-select">
                                                                                  <option selected><?= $value['nama_grup']; ?></option>
                                                                                  <option>Kepala BPKP</option>
                                                                                  <option>Pimpinan Eselon 2</option>
                                                                                  <option>Pengolah</option>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group row">
                                                                          <label class="col-form-label col-md-2">Email</label>
                                                                          <div class="col-md-10">
                                                                              <input type="text" class="form-control" value="<?= $value['email']; ?>">
                                                                          </div>
                                                                      </div>
                                                                  </form>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                  <button type="button" class="btn btn-primary">Save changes</button>
                                                              </div>
                                                          </div>
                                                      </div>
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
          </div>
          <!-- modal add  -->
          <div class="modal fade" id="modal-lg">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Tambah Data User - RBAC</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <?= form_open('user/add_rbac'); ?>
                      <div class="modal-body">
                          <div class="form-group row">
                              <label class="col-form-label col-md-2">Nama User</label>
                              <div class="col-md-10">
                                  <select class="form-control select2bs4" style="width: 100%;" name="id_user">
                                      <option value="all">-- pilih user --</option>

                                      <?php foreach ($user as $key => $data) { ?>
                                          <option value="<?= $data['id']; ?>"><?= $data['name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-form-label col-md-2">Nama Group</label>
                              <div class="col-md-10">
                                  <select class="form-control" name="nama_grup">
                                      <option value="all">-- pilih nama grup--</option>
                                      <option value="kepala">Kepala BPKP</option>
                                      <option value="pim2">Pimpinan Eselon 2</option>
                                      <option value="pengolah">Pengolah</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-form-label col-md-2">Nama Key Unit</label>
                              <div class="col-md-10">
                                  <select class="form-control" name="key_unit">
                                      <option>-- pilih nama key unit--</option>
                                      <option value="all">all</option>
                                      <option value="id_es2">Eselon 2</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-form-label col-md-2">Level Unit</label>
                              <div class="col-md-10">
                                  <select class="form-control" name="level_unit">
                                      <option>-- pilih level unit--</option>
                                      <option value="all">all</option>
                                      <option value="es2">Eselon 2</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-form-label col-md-2">Unit Kerja</label>
                              <div class="col-md-10">
                                  <select class="form-control select2bs4" style="width: 100%;" name="parameter_unit">
                                      <option>-- pilih unit kerja --</option>
                                      <option value="all">Admin</option>
                                      <?php foreach ($es2 as $key => $data) { ?>
                                          <option value="<?= $data['id']; ?>"><?= $data['nama_es2']; ?></option>
                                      <?php } ?>
                                  </select>
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
      </div><!-- /.container-fluid -->
  </section>