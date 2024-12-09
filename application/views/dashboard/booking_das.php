<div class="row mt-5">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6><?= $titlebooking ?></h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1"><?= date('d-F-y') ?></span>
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pemesan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lapangan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Transaksi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Harga</th>
                    </tr>
                  </thead>

                  <tbody>
                        <?php if (!empty($bookings)): ?>
                            <?php foreach ($bookings as $index => $booking): ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= htmlspecialchars($booking['nama_pemesan']); ?></td> <!-- Mencegah XSS -->
                                    <td><?= htmlspecialchars($booking['nama_lapangan']); ?></td>
                                    <td><?= date('d-F-Y', strtotime($booking['tanggal'])); ?></td>
                                    <td>
                                        <?php if ($booking['jenis_transaksi'] === 'offline'): ?>
                                            <span class="badge bg-secondary px-2 py-1">Offline</span>
                                        <?php else: ?>
                                            <span class="badge bg-success px-2 py-1">Online</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>Rp <?= number_format($booking['total_harga'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada booking untuk hari ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>