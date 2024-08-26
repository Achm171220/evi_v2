<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Umum Pengawasan Internal</div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <?php
                    $no = 1;
                    if ($IdDtUmum != NULL) { ?>
                        <?php foreach ($IdDtUmum as $key => $value) { ?>
                            <tr>
                                <th>Unit Cipta</th>
                                <td>
                                    <select class="form-select" name="id_es2" readonly>
                                        <option value="<?= $DtUmum['id_es2']; ?>" selected><?= $DtUmum['nama_es2']; ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Tahun Cipta</th>
                                <td><input class="form-control" type="text" name="tahun_audit" value="<?= $DtUmum['tahun_audit']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Jml Surat Masuk</th>
                                <td><input class="form-control" type="text" name="jml_srt_masuk" value="<?= $DtUmum['jml_srt_masuk']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Jml Surat Keluar</th>
                                <td><input class="form-control" type="text" name="jml_srt_keluar" value="<?= $DtUmum['jml_srt_keluar']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Jml Arsiparis</th>
                                <td><input class="form-control" type="text" name="jml_arsiparis" value="<?= $DtUmum['jml_arsiparis']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Jml Pengelola Arsip</th>
                                <td><input class="form-control" type="text" name="jml_pengelola_arsip" value="<?= $DtUmum['jml_pengelola_arsip']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Volume Arsip Aktif</th>
                                <td><input class="form-control" type="text" name="volume_arsip_aktif" value="<?= $DtUmum['volume_arsip_aktif']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Jml Arsip Aktif Terdaftar</th>
                                <td><input class="form-control" type="text" name="jml_arsip_aktif_terdaftar" value="<?= $DtUmum['jml_arsip_aktif_terdaftar']; ?>"></td>
                            </tr>
                            <tr>
                                <th>Metode Penciptaan</th>
                                <td>
                                    <select class="form-select" name="metode_penciptaan">
                                        <option value="<?= $DtUmum['metode_penciptaan']; ?>" selected><?= $cipa = $DtUmum['metode_penciptaan'] == 'e' ? 'elektronik' : 'konvensional'; ?></option>
                                        <option value="e">elektronik</option>
                                        <option value="k">konvensional</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Metode Penggunaan</th>
                                <td>
                                    <select class="form-select" name="metode_penggunaan">
                                        <option value="<?= $DtUmum['metode_penggunaan']; ?>" selected><?= $cipa = $DtUmum['metode_penggunaan'] == 'e' ? 'elektronik' : 'konvensional'; ?></option>
                                        <option value="e">elektronik</option>
                                        <option value="k">konvensional</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Metode Pemeliharaan</th>
                                <td>
                                    <select class="form-select" name="metode_pemeliharaan">
                                        <option value="<?= $DtUmum['metode_pemeliharaan']; ?>" selected><?= $cipa = $DtUmum['metode_pemeliharaan'] == 'e' ? 'elektronik' : 'konvensional'; ?></option>
                                        <option value="e">elektronik</option>
                                        <option value="k">konvensional</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Metode Penyusutan</th>
                                <td>
                                    <select class="form-select" name="metode_penyusutan">
                                        <option value="<?= $DtUmum['metode_penyusutan']; ?>" selected><?= $cipa = $DtUmum['metode_penyusutan'] == 'e' ? 'elektronik' : 'konvensional'; ?></option>
                                        <option value="e">elektronik</option>
                                        <option value="k">konvensional</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Metode SDM</th>
                                <td>
                                    <select class="form-select" name="metode_sdm">
                                        <option value="<?= $DtUmum['metode_sdm']; ?>" selected><?= $cipa = $DtUmum['metode_sdm'] == 'e' ? 'elektronik' : 'konvensional'; ?></option>
                                        <option value="e">elektronik</option>
                                        <option value="k">konvensional</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Metode Sarpras</th>
                                <td>
                                    <select class="form-select" name="metode_sarpras">
                                        <option value="<?= $DtUmum['metode_sarpras']; ?>" selected><?= $cipa = $DtUmum['metode_sarpras'] == 'e' ? 'elektronik' : 'konvensional'; ?></option>
                                        <option value="e">elektronik</option>
                                        <option value="k">konvensional</option>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr class="text-center">
                            <td colspan="8">tidak ada data silakan klik
                                <div>
                                    <a class="btn btn-success btn-sm waves-effect waves-light mt-1" data-bs-toggle="modal" data-bs-target="#addDataUmum" href="<?= base_url('pengawasan/dataUmum/add'); ?>"> <i class="fe fe-plus"></i> Tambah Data</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="card-footer">
                <a href="" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fe fe-refresh-ccw"></i> Update</button>
            </div>
        </div>
    </div>
</div>
<!-- modal add  -->
<div id="addDataUmum" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Umum</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open('pengawasan/store_dt_umum'); ?>
            <div class="modal-body p-4">
                <table class="table table-sm">
                    <tr>
                        <th>Unit Kerja</th>
                        <td>
                            <input class="form-control" type="text" value="<?= $data_user['id']; ?>" readonly name="id_es2" hidden>
                            <input class="form-control" type="text" value="<?= $data_user['nama_es2']; ?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <th>Tahun Audit</th>
                        <td><input class="form-control" type="text" name="tahun_audit" value="2024" readonly></td>
                    </tr>
                    <tr>
                        <th>Jml Surat Masuk</th>
                        <td><input class="form-control" type="text" name="jml_srt_masuk"></td>
                    </tr>
                    <tr>
                        <th>Jml Surat Keluar</th>
                        <td><input class="form-control" type="text" name="jml_srt_keluar"></td>
                    </tr>
                    <tr>
                        <th>Jml Arsiparis</th>
                        <td><input class="form-control" type="text" name="jml_arsiparis"></td>
                    </tr>
                    <tr>
                        <th>Jml Pengelola Arsip</th>
                        <td><input class="form-control" type="text" name="jml_pengelola_arsip"></td>
                    </tr>
                    <tr>
                        <th>Volume Arsip Aktif</th>
                        <td><input class="form-control" type="text" name="volume_arsip_aktif"></td>
                    </tr>
                    <tr>
                        <th>Jml Arsip Aktif Terdaftar</th>
                        <td><input class="form-control" type="text" name="jml_arsip_aktif_terdaftar"></td>
                    </tr>
                    <tr>
                        <th>Metode Penciptaan</th>
                        <td>
                            <select class="form-select" name="metode_penciptaan">
                                <option selected value="">-Pilih-</option>
                                <option value="e">elektronik</option>
                                <option value="k">konvensional</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Penggunaan</th>
                        <td>
                            <select class="form-select" name="metode_penggunaan">
                                <option selected value="">-Pilih-</option>
                                <option value="e">elektronik</option>
                                <option value="k">konvensional</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Pemeliharaan</th>
                        <td>
                            <select class="form-select" name="metode_pemeliharaan">
                                <option selected value="">-Pilih-</option>
                                <option value="e">elektronik</option>
                                <option value="k">konvensional</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Penyusutan</th>
                        <td>
                            <select class="form-select" name="metode_penyusutan">
                                <option selected value="">-Pilih-</option>
                                <option value="e">elektronik</option>
                                <option value="k">konvensional</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Metode SDM</th>
                        <td>
                            <select class="form-select" name="metode_sdm">
                                <option selected value="">-Pilih-</option>
                                <option value="e">elektronik</option>
                                <option value="k">konvensional</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Sarpras</th>
                        <td>
                            <select class="form-select" name="metode_sarpras">
                                <option selected value="">-Pilih-</option>
                                <option value="e">elektronik</option>
                                <option value="k">konvensional</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>