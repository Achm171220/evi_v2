<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman Arsip</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Detail Peminjaman Arsip</h2>
        
        <div class="card mb-4">
            <div class="card-header">
                Informasi Peminjaman
            </div>
            <div class="card-body">
                <p><strong>ID Peminjaman:</strong> <?= $pinjam_arsip['id']; ?></p>
                <p><strong>ID User:</strong> <?= $pinjam_arsip['id_user']; ?></p>
                <p><strong>Nama Peminjam:</strong> <?= $pinjam_arsip['nama_peminjam']; ?></p>
                <p><strong>Tanggal Pinjam:</strong> <?= $pinjam_arsip['tgl_pinjam']; ?></p>
                <p><strong>Tanggal Kembali:</strong> <?= $pinjam_arsip['tgl_kembali']; ?></p>
                <p><strong>Range Pinjam:</strong> <?= $pinjam_arsip['range_pinjam']; ?> hari</p>
                <p><strong>Keterangan:</strong> <?= $pinjam_arsip['keterangan']; ?></p>
            </div>
        </div>

        <h4>Arsip yang Dipinjam</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Arsip</th>
                    <th>Judul Dokumen</th>
                    <th>No Dokumen</th>
                    <th>Tanggal Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arsip_list as $arsip): ?>
                    <tr>
                        <td><?= $arsip['id']; ?></td>
                        <td><?= $arsip['judul_dokumen']; ?></td>
                        <td><?= $arsip['no_dokumen']; ?></td>
                        <td><?= $arsip['tgl_dokumen']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="/pinjamarsip" class="btn btn-secondary mt-3">Kembali</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
