<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            <!-- Flash Message -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success text-center">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('pesan')): ?>
                <div class="alert alert-danger text-center">
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="<?= base_url('login/proseslogin') ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="Username" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="Password" placeholder="Enter your password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
            </form>

            <!-- Additional Links -->
            <div class="mt-3 text-center">
                <a href="<?= base_url('login/register') ?>" class="text-decoration-none">Don't have an account? Register</a>
            </div>
        </div>
    </div>
</div>