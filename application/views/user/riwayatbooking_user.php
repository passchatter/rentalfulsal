<div class="mt-5">
  <h1 class="text-center mb-4">Riwayat Booking Anda</h1>
  <?php if (!empty($bookings)): ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Jam Awal</th>
            <th>Jam Akhir</th>
            <th>Lapangan</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($bookings as $index => $booking): ?>
            <tr>
              <td><?= $index + 1; ?></td>
              <td><?= date('d-m-Y', strtotime($booking['tanggal'])); ?></td>
              <td><?= $booking['jam_awal']; ?></td>
              <td><?= $booking['jam_akhir']; ?></td>
              <td><?= $booking['nama_lapangan']; ?></td>
              <td>Rp <?= number_format($booking['total_harga'], 0, ',', '.'); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center" role="alert">
      Tidak ada riwayat booking.
    </div>
  <?php endif; ?>
</div>
