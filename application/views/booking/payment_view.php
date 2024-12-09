<div class="mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white text-center">
            <h1>Konfirmasi Pembayaran</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Pemesan</th>
                    <td><?= $this->session->userdata('username') ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $this->session->userdata('email') ?></td>
                </tr>
                <tr>
                    <th>Lapangan</th>
                    <td><?= $booking['lapangan_id'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= date('d-m-Y', strtotime($booking['tanggal'])) ?></td>
                </tr>
                <tr>
                    <th>Jam</th>
                    <td><?= $booking['jam_awal'] ?> - <?= $booking['jam_akhir'] ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td class="text-success fw-bold">
                        Rp <?= number_format($booking['total_harga'], 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Transaksi</th>
                    <td>
                        <span class="badge 
                            <?= $booking['jenis_transaksi'] === 'online' ? 'bg-success' : 'bg-secondary' ?>">
                            <?= ucfirst($booking['jenis_transaksi']) ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer text-end">
            <form method="post" action="<?= site_url('booking/confirm_booking') ?>" class="d-inline">
                <button type="submit" class="btn btn-success me-2">
                    <i class="bi bi-check-circle"></i> Konfirmasi dan Simpan
                </button>
            </form>
            <?php if($this->session->userdata('level') === 'admin'){ ?>

                <a href="<?= site_url('dashboard/booking') ?>" class="btn btn-danger">
                    <i class="bi bi-x-circle"></i> Batalkan
                </a>
           <?php }else{ ?>
            <a href="<?= site_url('user/booking') ?>" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Batalkan
            </a>
            <?php }?>
        </div>
    </div>
</div>
