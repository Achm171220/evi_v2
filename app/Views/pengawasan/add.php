<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Unit</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Nilai untuk Unit</h2>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('pengawasan/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="unit_id">Pilih Unit:</label>
                <select class="form-control" id="unit_id" name="id_es2" required>
                    <option value="">-- Pilih Unit --</option>
                    <?php foreach ($units as $unit) : ?>
                        <option value="<?= $unit['id'] ?>"><?= $unit['nama_es2'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Aspek</th>
                        <th>Bobot</th>
                        <th>Bobot</th>
                        <th>Nilai Isian</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aspeks as $aspek) : ?>
                        <tr>
                            <td><?= $aspek['sub_kategori'] ?></td>
                            <td><?= $aspek['bobot_subkategori'] ?> %</td>
                            <td><?= $aspek['nilai_standar_subkategori'] ?></td>
                            <td>
                                <input type="number" class="form-control" name="aspek[<?= $aspek['id'] ?>]" step="any" required>
                            </td>
                            <td>
                                <?php
                                // Hitung nilai akhir secara langsung dalam view
                                $nilai_standar = $aspek['nilai_standar_subkategori'];
                                $bobot = $aspek['bobot_subkategori'] / 100;
                                ?>
                                <span class="nilai-akhir" data-nilai-standar="<?= $nilai_standar ?>" data-bobot="<?= $bobot ?>">-</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="<?= base_url('pengawasan/admin'); ?>" class="btn btn-danger">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <hr>
        <form>
            <h5>Upload RHAS dan LAKI</h5>
            <table class="table table-bordered">
                <tr>
                    <th>RHAS</th>
                    <th><input type="file" name="rhas" class="form-control"></th>
                </tr>
                <tr>
                    <th>LAKI</th>
                    <th><input type="file" name="rhas" class="form-control"></th>
                </tr>
            </table>
            <button type="submit" class="btn btn-danger">Simpan</button>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name^="aspek"]').on('input', function() {
                let input = $(this);
                let nilaiIsian = parseFloat(input.val());
                let row = input.closest('tr');
                let nilaiStandar = parseFloat(row.find('.nilai-akhir').data('nilai-standar'));
                let bobot = parseFloat(row.find('.nilai-akhir').data('bobot'));

                if (!isNaN(nilaiIsian)) {
                    let nilaiAkhir = (nilaiIsian / nilaiStandar) * bobot * 100;
                    row.find('.nilai-akhir').text(nilaiAkhir.toFixed(2));
                } else {
                    row.find('.nilai-akhir').text('-');
                }
            });
        });
    </script>
</body>

</html>