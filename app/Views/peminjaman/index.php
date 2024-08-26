<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Data Peminjaman Arsip
                <div class="card-tools">
                    <a href="<?= base_url('peminjaman/tambah'); ?>" class="btn pmr-btn btn-sm">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <table id="pinjamArsipTable" class="table table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>No Pinjam</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Range Pinjam</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>