<div class="row">
    <div class="col-sm-12">
        <?php if ($DtUmum == NULL) { ?>
          Data Umum Belum diisi
        <?php } else { ?>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Penciptaan Arsip - <?= $metode = $DtUmum['metode_penciptaan'] == 'e' ? '<span class="badge bg-success-light">Elektronik</span>' : 'Konvensional'; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width: 25%;">Indikator</th>
                                    <th>Nilai Standar</th>
                                    <th>Link Drive</th>
                                    <th>Isian Mandiri</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $metode = $DtUmum['metode_penciptaan'];
                                if ($metode == 'e') { ?>
                                    <?php foreach ($form_e as $key => $form) { ?>
                                        <tr>
                                            <td><?= $form['no_indikator']; ?></td>
                                            <td class="<?= $form['style_indikator']; ?>">
                                                <span class="wrap"> <?= $form['indikator']; ?></span>
                                                <p class="wrap text-sm text-primary"><?= $form['penjelasan_indikator']; ?></p>
                                            </td>
                                            <td>
                                                <?= $standar = $form['standar_int'] == 'null' ? $form['standar_boolena'] : $form['standar_int']; ?>
                                            </td>
                                            <td>
                                                <?php if ($form['link_upload'] == 'e') { ?>
                                                    <i class="fas fa-pencil-alt black-icon edit-icon"></i>
                                                    <input type="text" class="form-control edit-input d-none" placeholder="Edit text">
                                                    <!-- <input class="form-control" type="url" name="link_drive"> -->
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($form['standar_int'] != NULL) { ?>
                                                    <input class="form-control" type="number">
                                                <?php } elseif ($form['standar_boolean'] != NULL) { ?>
                                                    <select class="form-select">
                                                        <option value="y">Ya</option>
                                                        <option value="t">Tidak</option>
                                                    </select>
                                                <?php } ?>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                <?php } elseif ($metode == 'k') { ?>
                                    # code...
                                    <?php foreach ($getAi as $key => $value) { ?>
                                        <tr>
                                            <td class="<?= $value['style_indikator']; ?>">
                                                <?= $value['id']; ?>
                                            </td>
                                            <td><?= $value['no_indikator']; ?></td>
                                            <td class="word-wrap"><?= $value['indikator']; ?></td>
                                            <td><?= $value['standar_int']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>