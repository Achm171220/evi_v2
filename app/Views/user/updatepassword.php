<div class="row">
    <div class="col-sm-12">
        <h3 class="page-title">Update Password</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php if (session()->getFlashdata('error')) : ?>
            <div style="color: red;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div style="color: green;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('user/updatePassword') ?>" method="post">
            <?= csrf_field() ?>
            <label for="old_password">Old Password</label>
            <input type="password" name="old_password" id="old_password" required><br><br>

            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" required><br><br>

            <label for="confirm_password">Confirm New Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required><br><br>
            
            <input type="hidden" id="lokasi" name="lokasi">
            <button type="submit">Update Password</button>
        </form>
    </div>
</div>