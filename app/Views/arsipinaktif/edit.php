 <div class="row">
     <div class="col-md-12">

         <div class="card">
             <div class="card-header">
                 <h5 class="card-title">Tambah Data <?= session()->get('id'); ?></h5>
             </div>
             <?= form_open('arsipinaktif/update/' . $dataId['id']); ?>
             <div class="card-body">

                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Unit Pencipta</label>
                     <div class="col-md-4">
                         <select class="js-example-basic-single select2" name="id_sub_bidang">
                             <option value="<?= $IdData['id_sub_bidang']; ?>"><?= $IdData['nama_sub_bidang']; ?></option>
                             <?php
                                foreach ($dataSubBidang as $key => $value) { ?>
                                 <option value="<?= $value['id_sub']; ?>"><?= $value['id_sub']; ?> - <?= $value['nama_sub_bidang']; ?></option>
                             <?php } ?>
                         </select>
                     </div>

                     <label class="col-form-label col-md-2">Kode Klasifikasi</label>
                     <div class="col-md-4">
                         <select class="js-example-basic-single select2" name="id_klasifikasi">
                             <option selected="selected" value="<?= $IdData['id_klasifikasi']; ?>"><?= $IdData['kode_klasifikasi']; ?></option>
                             <?php foreach ($klasifikasi as $key => $klas) { ?>
                                 <option value="<?= $klas['id']; ?>"><?= $klas['kode_klasifikasi']; ?> - <?= $klas['nama_klasifikasi']; ?></option>
                             <?php } ?>
                         </select>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Nomor Dokumen</label>
                     <div class="col-md-10">
                         <input type="text" class="form-control" name="no_dokumen" value="<?= $dataId['no_dokumen']; ?>">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Judul Dokumen</label>
                     <div class="col-md-10">
                         <textarea type="text" class="form-control" name="judul_dokumen"><?= $dataId['judul_dokumen']; ?></textarea>
                     </div>
                 </div>
                 <div class="form-group row" id="tanggalform">
                     <label class="col-form-label col-md-2">Tanggal Dokumen</label>
                     <div class="col-md-6">
                         <input class="form-control" type="date" value="<?= $dataId['tgl_dokumen']; ?>" name="tgl_dokumen" id="dateInput">
                     </div>
                     <div class="col-md-4">
                         <input class="form-control" type="text" placeholder="tahun cipta" id="yearInput" name="tahun_cipta" value="<?= $dataId['tahun_cipta']; ?>" readonly>
                     </div>
                 </div>
                 <div class=" form-group row">
                     <label class="col-form-label col-md-2">Jumlah Item</label>
                     <div class="col-md-10">
                         <input class="form-control" type="number" value="<?= $dataId['jumlah']; ?>" name="jumlah">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Lokasi Simpan</label>
                     <div class="col-md-10">
                         <input class="form-control" type="text" value="<?= $dataId['lokasi_simpan']; ?>" name="lokasi_simpan">
                     </div>
                 </div>

                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Status Aktif</label>
                     <div class="col-md-4">
                         <select class="form-control" name="status_arsip">
                             <option value="<?= $dataId['status_arsip']; ?>"><?= $dataId['status_arsip']; ?></option>
                             <option value="aktif">Aktif</option>
                             <option value="inaktif">Inaktif</option>
                             <option value="vital">Vital</option>
                         </select>
                     </div>

                     <label class="col-form-label col-md-1">Jenis Arsip</label>
                     <div class="col-md-5">
                         <select class="form-control" name="jenis_arsip">
                             <option value="<?= $dataId['jenis_arsip']; ?>"><?= $dataId['jenis_arsip']; ?></option>
                             <option value="regular">Regular</option>
                             <option value="vital">Vital</option>
                             <option value="terjaga">Terjaga</option>
                         </select>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Status TL</label>
                     <div class="col-md-4">
                         <select class="form-control" name="tl_temuan">
                             <option value="<?= $dataId['tl_temuan']; ?>"><?= $tl = $dataId['tl_temuan'] = 0 ? 'tidak ada' : 'ada TL'; ?></option>
                             <option value="0">Tidak TL</option>
                             <option value="1">Masih TL</option>
                             <option value="2">Belum diketahui</option>
                         </select>
                     </div>
                     <label class="col-form-label col-md-1">Dasar Catat</label>
                     <div class="col-md-5">
                         <select class="form-control" name="dasar_catat">
                             <option value="<?= $dataId['dasar_catat']; ?>"><?= $dataId['dasar_catat']; ?></option>
                             <option value="daftar_arsip">Daftar Arsip</option>
                             <option value="sadwewa">Sadewa</option>
                             <option value="map">MAP</option>
                             <option value="srikandi">Srikandi</option>
                             <option value="bisma">Bisma</option>
                             <option value="agenda">Agenda</option>
                             <option value="inventarisir">Inventarisir</option>
                         </select>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label class="col-form-label col-md-2">Tk Perkembangan</label>
                     <div class="col-md-10">
                         <select class="form-control" name="tk_perkembangan">
                             <option selected><?= $dataId['tk_perkembangan']; ?></option>
                             <option value="asli">Asli</option>
                             <option value="konsep">Konsep</option>
                             <option value="copy">Copy</option>
                             <option value="pertinggal">Pertinggal</option>
                         </select>
                     </div>
                 </div>
                 <!-- jenis arsip jika elektronik maka boks disabled  -->
                 <div id="myForm">
                     <div class="form-group row">
                         <label class="col-form-label col-md-2">Media Simpan</label>
                         <div class="col-md-10">
                             <select class="form-control" name="media_simpan" id="media">
                                 <option selected><?= $dataId['media_simpan']; ?></option>
                                 <option value="kertas">Kertas</option>
                                 <option value="elektronik">Elektronik</option>
                                 <option value="lainnya">Lainnya</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div id="target">
                     <div class="form-group row">
                         <label class="col-form-label col-md-2">No Boks</label>
                         <div class="col-md-10">
                             <input class="form-control" type="text" name="no_box" value="<?= $dataId['no_box']; ?>" id="boks">
                         </div>
                     </div>

                     <!-- selesai  -->
                     <hr>
                     <p class="text-center">- Penyimpanan File Elektronik <span class="text-danger">(*)</span> -</p>

                     <div class="form-group mt-2">
                         <label>Nama File</label>
                         <input type="text" class="form-control" id="simpan" name="nama_file">
                     </div>
                     <div class="form-group mt-2">
                         <label>Nama Folder</label>
                         <input type="text" class="form-control" id="simpan2" name="nama_folder">
                     </div>
                     <div class="form-group mt-2">
                         <label>Nama Link</label>
                         <input type="url" class="form-control" id="simpan3" name="nama_link">
                     </div>
                 </div>
             </div>
             <div class="card-footer">
                 <button class="btn btn-danger-1 btn-sm" onclick="goBack()">Kembali</button>
                 <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
             </div>
             <?= form_close(); ?>
         </div>
     </div>
 </div>