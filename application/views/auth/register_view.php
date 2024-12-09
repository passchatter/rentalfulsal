    <div class="container mt-5">
        <h2 class="text-center">Registrasi</h2>
        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form action="<?= base_url('login/prosesRegister'); ?>" method="POST">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>">
                <?= form_error('nama_lengkap', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" value="<?= set_value('username'); ?>">
                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-success">Daftar</button>
        </form>

        <!-- Pesan Sukses atau Error -->
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success mt-3"><?= $this->session->flashdata('success'); ?></div>
        <?php elseif ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger mt-3"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
    </div>
