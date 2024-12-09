<div class="row mt-5">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-lg-6 col-7">
            <h6>Daftar Lapangan</h6>
          </div>
          <div class="col-lg-6 col-5 my-auto text-end">
            <button class="btn btn-dark">Tambah Lapangan</button>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lapangan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Lapangan</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Sewa/Jam</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($lapangan)): ?>
                <?php foreach ($lapangan as $index => $l): ?>
                  <tr>
                    <td class="text-center"><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($l['nama_lapangan']); ?></td>
                    <td><?= htmlspecialchars($l['jenis_lapangan']); ?></td>
                    <td class="text-end">Rp <?= number_format($l['harga_per_jam'], 0, ',', '.'); ?></td>
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
                  <td colspan="6" class="text-center">Tidak ada data lapangan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
