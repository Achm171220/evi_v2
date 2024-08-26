<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title"><?= $judul; ?></h5>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('pengawasan/store_penciptaan_e'); ?>" class="btn-right btn btn-sm btn-outline-primary">
                            Simpan Data
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#home" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Portofolio Kertas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                            Portofolio Elektronik
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Indikator</th>
                                        <th>Nama. Indikator</th>
                                        <th>Standar</th>
                                        <th>Link Drive</th>
                                        <th>Self Assessment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($form_k as $key => $value) { ?>
                                        <tr>
                                            <th><?= $value['no_indikator']; ?></th>
                                            <td class="<?= $value['style_indikator']; ?>"><span class="<?= $value['style_indikator']; ?>"><?= $value['indikator']; ?></span>
                                                <p class="text-sm text-primary word-wrap"><?= $value['penjelasan_indikator']; ?></p>
                                            </td>
                                            <th><?= $stand = $value['standar_boolean'] == null ? $value['standar_int'] : 'ya'; ?></th>
                                            <th>
                                                <?= $link = $value['link_upload'] == 'e' ? '<input class="form-control" type="url" name="link_drive">' : ''; ?>
                                                <?= $link = $value['tipe_indikator'] == 'c' ? '<input class="" type="checkbox" name="isi_ceklist">' : ''; ?>

                                            </th>
                                            <th>
                                                <?php
                                                if ($value['standar_boolean'] == 'y') {
                                                    echo '<select class="form-select" name="isi_boolean"><option value="y">Ya</option><option>Tidak</option></select>';
                                                } elseif ($value['standar_int'] == '5') {
                                                    echo '<input class="form-control" name="isi_int" type="number">';
                                                } ?>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane show " id="profile">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Indikator</th>
                                        <th>Nama. Indikator</th>
                                        <th>Standar</th>
                                        <th>Link Drive</th>
                                        <th>Self Assessment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($form_e as $key => $value) { ?>
                                        <tr>
                                            <th><?= $value['no_indikator']; ?></th>
                                            <td class="<?= $value['style_indikator']; ?>"><span class="<?= $value['style_indikator']; ?>"><?= $value['indikator']; ?></span>
                                                <p class="text-sm text-primary word-wrap"><?= $value['penjelasan_indikator']; ?></p>
                                            </td>
                                            <th><?= $stand = $value['standar_boolean'] == null ? $value['standar_int'] : 'ya'; ?></th>
                                            <th>
                                                <?= $link = $value['link_upload'] == 'e' ? '<input class="form-control" type="url">' : ''; ?>
                                            </th>
                                            <th>
                                                <?php
                                                if ($value['standar_boolean'] == 'y') {
                                                    echo '<select class="form-select" name="isi_boolean"><option value="y">Ya</option><option>Tidak</option></select>';
                                                } elseif ($value['standar_int'] == '5') {
                                                    echo '<input class="form-control" name="isi_int" type="number">';
                                                } ?>

                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('arsip/tambah'); ?>" class="btn-end btn btn-sm btn-outline-primary">
                    Simpan Data
                </a>
            </div>
        </div>
    </div>
</div>