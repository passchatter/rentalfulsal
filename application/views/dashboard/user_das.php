<div class="row mt-5">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-lg-6 col-7">
            <h6>Daftar Users</h6>
          </div>
          <div class="col-lg-6 col-5 my-auto text-end">
            <button class="btn btn-dark">Tambah User</button>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Level</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($users)): ?>
                <?php foreach ($users as $index => $user): ?>
                  <tr>
                    <td class="text-center"><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($user['nama_lengkap']); ?></td>
                    <td><?= htmlspecialchars($user['username']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                    <td class="text-center">
                      <?php if ($user['level'] == 'Admin'): ?>
                        <span class="badge bg-primary px-2 py-1">Admin</span>
                      <?php else: ?>
                        <span class="badge bg-secondary px-2 py-1"><?= htmlspecialchars($user['level']); ?></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <button class="btn btn-warning btn-sm me-2">
                        <i class="bi bi-pencil-square"></i> Edit
                      </button>
                      <button class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Hapus
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center">Tidak ada data users.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
