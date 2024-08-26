<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pindah Arsip</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .form-check-input {
            width: 23px;
            height: 23px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Pindah Arsip</h2>
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('arsipcontroller/pindaharsip') ?>" method="post">
            <table id="arsipTable" class="table table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>ID</th>
                        <th>Judul Dokumen</th>
                        <th>Tanggal Dokumen</th>
                        <th>Status</th>
                        <th class="text-center">Ceklis Verifikasi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arsipAktif as $arsip) : ?>
                        <tr>
                            <td><input type="checkbox" name="id_arsip[]" value="<?= $arsip->id ?>"></td>
                            <td><?= $arsip->id ?></td>
                            <td><?= $arsip->judul_dokumen ?></td>
                            <td><?= $arsip->tgl_dokumen ?></td>
                            <td><?= $arsip->status_siklus ?></td>
                            <td>
                                <div class="form-check text-center">
                                    <input class="form-check-input" type="checkbox" name="cek_verif[]" value="<?= $arsip->id ?>">
                                </div>
                            </td> <!-- Ceklist Verifikasi -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <hr>
            <div class="form-group">
                <label for="no_ba">No BA:</label>
                <input type="text" name="no_ba" class="form-control" id="no_ba" required>
            </div>
            <div class="form-group">
                <label for="tgl_pindah">Tanggal Pindah:</label>
                <input type="date" name="tgl_pindah" class="form-control" id="tgl_pindah" required>
            </div>
            <div class="form-group">
                <label for="tgl_verifikasi">Tanggal Verifikasi:</label>
                <input type="date" name="tgl_verifikasi" class="form-control" id="tgl_verifikasi" required>
            </div>

            <button type="submit" class="btn btn-primary">Pindahkan Arsip</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#arsipTable').DataTable();

            // Select all checkboxes
            $('#selectAll').click(function() {
                $('input[name="id_arsip[]"]').prop('checked', this.checked);
            });
        });
    </script>
</body>

</html>