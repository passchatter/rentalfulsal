<div class="my-5">
     <!-- Flash Message -->
     <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <h2 class="text-center mb-4">Daftar Lapangan</h2>
    <div class="row">
        <?php if (!empty($lapangan)): ?>
            <?php foreach ($lapangan as $l): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <img src="<?= base_url('assets/img/' . $l['foto']) ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($l['nama_lapangan']) ?>" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($l['nama_lapangan']) ?></h5>
                            <p class="card-text">
                                <strong>Jenis:</strong> <?= htmlspecialchars($l['jenis_lapangan']) ?><br>
                                <strong>Harga/Jam:</strong> Rp <?= number_format($l['harga_per_jam'], 0, ',', '.') ?>
                            </p>
                          
                            <?php if ($l['status'] == 'Tersedia'): ?>
                                <a href="<?= base_url('booking/detailLapangan/' . $l['id']) ?>" 
                                    class="btn btn-success btn-sm w-100">
                                    Booking
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm w-100" disabled>Tidak Tersedia</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">Tidak ada data lapangan yang tersedia.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
