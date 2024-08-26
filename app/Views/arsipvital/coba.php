<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Arsip</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Arsip</h2>
        <div class="form-group">
            <label for="sub_bidang">Filter Sub Bidang:</label>
            <select id="sub_bidang" class="form-control">
                <option value="">Semua Sub Bidang</option>
                <?php foreach ($sub_bidang as $sb) : ?>
                    <option value="<?= $sb['id_sub'] ?>"><?= $sb['id_sub'] ?>- <?= $sb['nama_sub_bidang'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <table id="arsipTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No Dokumen</th>
                    <th>Judul Dokumen</th>
                    <th>Tanggal Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) : ?>
                    <tr data-sub-bidang="<?= $item['id_sub_bidang'] ?>">
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['no_dokumen'] ?></td>
                        <td><?= $item['judul_dokumen'] ?></td>
                        <td><?= $item['tgl_dokumen'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#arsipTable').DataTable();

            $('#sub_bidang').on('change', function() {
                var selectedSubBidang = $(this).val();
                table.rows().every(function() {
                    var row = $(this.node());
                    var subBidangId = row.data('sub-bidang');
                    if (selectedSubBidang === "" || selectedSubBidang == subBidangId) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });
        });
    </script>
</body>

</html>