<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Umum</div>
            </div>
            <?php
            echo form_open('pengawasan/update_dt_umum/' . $DtUmum['id_es2']); ?>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Tahun Cipta</th>
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
                </table>
            </div>
            <div class="card-footer">
                <a href="" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fe fe-refresh-ccw"></i> Update</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>