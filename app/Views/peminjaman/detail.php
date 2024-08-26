<!-- File: app/Views/pinjam_arsip_detail.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>
    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS for Print and Icons -->
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            .print-container {
                margin: 0;
                padding: 0;
            }

            table {
                border: 1px solid black !important;
                border-collapse: collapse !important;
            }

            th,
            td {
                border: 1px solid black !important;
            }

            .table thead th {
                background-color: #f8f9fa !important;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-3 print-container">
        <h2 class="mb-4 text-center">Form Peminjaman</h2>
        <hr>
        <div class="mb-4">
            <table class="table table-bordered" style="border: none;">
                <tbody>
                    <tr>
                        <td><strong>No Pinjam</strong></td>
                        <td>: &nbsp; <?= $pinjam['no_pinjam'] ?? '-'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nama Peminjam</strong></td>
                        <td>: &nbsp; <?= $pinjam['nama_peminjam'] ?? '-'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>NIP Peminjam</strong></td>
                        <td>: &nbsp; <?= $pinjam['nip_peminjam'] ?? '-'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Pinjam</strong></td>
                        <td>: &nbsp; <?= $pinjam['tgl_pinjam'] ?? '-'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Kembali</strong></td>
                        <td>: &nbsp; <?= $pinjam['tgl_kembali'] ?? '-'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Keterangan</strong></td>
                        <td>: &nbsp; <?= $pinjam['keterangan'] ?? '-'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4 class="mb-4">Lampiran Arsip</h4>
        <table class="table table-striped table-bordered" style="border: 1px;">
            <thead>
                <tr>
                    <th>Judul Dokumen</th>
                    <th>No Dokumen</th>
                    <th>Tanggal Dokumen</th>
                    <th>Jenis Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lampiran as $item) : ?>
                    <tr>
                        <td><?= $item['judul_dokumen'] ?? '-'; ?></td>
                        <td><?= $item['no_dokumen'] ?? '-'; ?></td>
                        <td><?= $item['tgl_dokumen'] ?? '-'; ?></td>
                        <td><?= $item['jenis_arsip'] ?? '-'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row mt-4">
            <div class="col-sm-6">
                Menyetujui,
                <br>
                Subkoordinator BMN, Rumah Tangga dan Kearsipan
                <br>
                <br>
                <br>
                <br>
                ....................................................
            </div>
            <div class="col-sm-3">
                Peminjam Arsip,
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                ....................................................
            </div>
            <div class="col-sm-3">
                Arsiparis,
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                ....................................................
            </div>
        </div>
        <div class="no-print mt-4">
            <a href="<?= base_url('peminjaman'); ?>" class="btn btn-primary">Kembali</a>
            <button class="btn btn-success" onclick="window.print()">Cetak</button>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#lampiranTable').DataTable();
        });
    </script>

</body>

</html>