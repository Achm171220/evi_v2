  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="dash-widget-header">
                              <span class="dash-widget-icon bg-1">
                                  <i class="fas fa-file"></i>
                              </span>
                              <div class="dash-count">
                                  <div class="dash-title">Arsip Aktif</div>
                                  <div class="dash-counts">
                                      <p><?= $jml; ?></p>
                                  </div>
                              </div>
                          </div>
                          <div class="progress progress-sm mt-3">
                              <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="dash-widget-header">
                              <span class="dash-widget-icon bg-2">
                                  <i class="fas fa-folder"></i>
                              </span>
                              <div class="dash-count">
                                  <div class="dash-title">Arsip Inaktif</div>
                                  <div class="dash-counts">
                                      <p><?= $jml_i; ?></p>
                                  </div>
                              </div>
                          </div>
                          <div class="progress progress-sm mt-3">
                              <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="dash-widget-header">
                              <span class="dash-widget-icon bg-3">
                                  <i class="fe fe-box"></i>
                              </span>
                              <div class="dash-count">
                                  <div class="dash-title">Arsip Vital</div>
                                  <div class="dash-counts">
                                      <p><?= '0'; ?></p>
                                  </div>
                              </div>
                          </div>
                          <div class="progress progress-sm mt-3">
                              <div class="progress-bar bg-7" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="dash-widget-header">
                              <span class="dash-widget-icon bg-4">
                                  <i class="fe fe-users"></i>
                              </span>
                              <div class="dash-count">
                                  <div class="dash-title">Arsiparis</div>
                                  <div class="dash-counts">
                                      <p><?= '0'; ?></p>
                                  </div>
                              </div>
                          </div>
                          <div class="progress progress-sm mt-3">
                              <div class="progress-bar bg-8" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- NILAI PENGAWASAN  -->
          <div class="row">
              <div class="col-sm-12">
                  <div class="card shadow">
                      <div class="card-header">
                          <div class="row">
                              <div class="col">
                                  <h5 class="card-title">Nilai ASKI</h5>
                              </div>
                              <div class="col-auto">
                                  <a href="" class="btn-right btn btn-sm btn-outline-primary">
                                      <i class="fe fe-printer"></i> Cetak RHAS
                                  </a>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <div class="text-center">
                              <h5>REKAPITULASI NILAI AUDIT SISTEM KEARSIPAN INTERNAL</h5>
                              <h6>UNIT PENGOLAH : <?= $data_user['nama_es2']; ?></h6>
                              <hr>
                          </div>
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Aspek</th>
                                          <th>Sub Aspek</th>
                                          <th>Nilai Standar</th>
                                          <th>Nilai ASKI</th>
                                          <th>Skor (%)</th>
                                          <th>Nilai </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php if ($nilaiAski == null) { ?>
                                          <tr>
                                              <td colspan="8"> Tidak Ada Data</td>
                                          </tr>
                                      <?php } else { ?>
                                          <?php foreach ($nilaiAski as $key => $data) { ?>
                                              <tr>
                                                  <td><i class="fa fa-circle text-sm text-primary"></i></td>
                                                  <td><?= $data['kategori']; ?></td>
                                                  <td><?= $data['sub_kategori']; ?></td>
                                                  <td><?= round($data['nilai_standar_subkategori'], 2); ?></td>
                                                  <td><?= round($data['total_nilai'], 2); ?></td>
                                                  <td><?= round($data['skor_aski'], 2); ?></td>
                                                  <td><?= round($data['skor'], 2); ?></td>
                                              </tr>
                                          <?php } ?>
                                          <tr>
                                              <th colspan="6">Nilai Akhir</th>
                                              <th><?= round($nilai_final['skor'], 2); ?> </th>
                                          </tr>
                                          <tr>
                                              <th colspan="6">Kategori</th>
                                              <th colspan="6">
                                                  <?php
                                                    $kategori = $nilai_final['skor'];
                                                    if ($kategori > 90) {
                                                        echo '<h5 class="text-primary">AA</h5>';
                                                    } elseif ($kategori > 80 && $kategori < 90) {
                                                        # code...
                                                        echo '<h5 class="text-info">A</h5>';
                                                    }
                                                    ?>
                                              </th>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                                  <tfoot>

                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </section>