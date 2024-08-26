<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVI - Update Password</title>
    <!-- Tambahkan Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-4">Update Password</h1>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url(); ?>auth/prosesupdatePassword" method="post">
                    <?= csrf_field() ?>
                    <!-- Tambahkan CSRF Field -->
                    <div class="form-group">
                        <label for="nama_user">Email:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-person"></i></span> <!-- Ikon Username -->
                            </div>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_lama">Password Lama:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span> <!-- Ikon Password Lama -->
                            </div>
                            <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_baru">Password Baru:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-key"></i></span> <!-- Ikon Password Baru -->
                            </div>
                            <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                        </div>
                    </div>
                    <input type="hidden" id="lokasi" name="lokasi"> <!-- Hidden field untuk lokasi -->
                    <div class="d-flex">
                        <a href="<?= base_url('auth'); ?>" class="btn btn-danger mr-2"><i class="bi bi-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-repeat"></i> Update Password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Tambahkan Bootstrap 4 JS dan dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    console.log("Latitude: " + latitude + ", Longitude: " + longitude); // Debug: Tampilkan lokasi di konsol
                    document.getElementById('lokasi').value = latitude + ',' + longitude;
                }, function(error) {
                    console.error('Error mendapatkan lokasi: ', error);
                    alert('Gagal mendapatkan lokasi. Pastikan izin lokasi diaktifkan di browser.');
                });
            } else {
                console.error('Geolocation tidak didukung oleh browser ini.');
                alert('Geolocation tidak didukung oleh browser ini.');
            }
        });
    </script>
</body>

</html>