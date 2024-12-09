<div class="container my-5">
    <h1 class="text-center mb-4">Detail Lapangan</h1>
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 class="card-title text-dark"><?= $lapangan['nama_lapangan']; ?></h3>
            
            <!-- Menambahkan gambar lapangan -->
            <div class="text-center mb-4">
                <img src="<?= base_url('assets/img/' . $lapangan['foto']); ?>" alt="Gambar Lapangan" class="img-fluid rounded" style="max-width: 100%; height: auto;">
            </div>
            
            <p class="card-text">
                <strong>ID Lapangan:</strong> <?= $lapangan['id']; ?><br>
                <strong>Harga per Jam:</strong> Rp <?= number_format($lapangan['harga_per_jam'], 0, ',', '.'); ?><br>
            </p>
          
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-dark">
            <h4 class="mb-0 text-white">Form Booking Lapangan</h4>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('booking/submit_booking'); ?>">
                <input type="hidden" value="<?= $lapangan['id'] ?>" name="lapangan_id" id="lapangan_id">
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">Tanggal:</label>
                        <input 
                            type="date" 
                            class="form-control" 
                            id="tanggal" 
                            name="tanggal" 
                            required
                            value="<?= date('Y-m-d'); ?>" 
                            min="<?= date('Y-m-d'); ?>"
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="harga" class="form-label">Harga per Jam:</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            value="Rp <?= number_format($lapangan['harga_per_jam'], 0, ',', '.'); ?>" 
                            readonly
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Jam Booking:</label>
                    <div class="row gy-3 gx-3" id="slots-container">
                        <!-- Slot Jam akan dimasukkan di sini -->
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 py-2">Booking</button>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan jQuery untuk AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function () {
    var lapangan_id = '<?= $lapangan['id']; ?>';
    var tanggal = $('#tanggal').val();

    function getAvailableSlots() {
        $.ajax({
            url: '<?= base_url('booking/get_available_slots'); ?>',
            type: 'POST',
            data: {
                lapangan_id: lapangan_id,
                tanggal: tanggal
            },
            dataType: 'json',
            success: function (response) {
                $('#slots-container').empty();

                $.each(response, function (slot, isAvailable) {
                    var slotClass = isAvailable ? 'bg-success' : 'bg-danger';
                    var disabledAttr = isAvailable ? '' : 'disabled';
                    var cursorStyle = isAvailable ? 'pointer' : 'not-allowed';

                    $('#slots-container').append(
                        '<div class="col-6 col-md-4 col-lg-3 mb-3">' +
                        '<label class="form-check-label w-100 position-relative">' +
                        '<input type="checkbox" class="form-check-input slot-checkbox d-none" name="jam_booking[]" value="' + slot + '" ' + disabledAttr + '>' +
                        '<div class="slot-card badge ' + slotClass + ' text-white py-3 px-2 d-flex align-items-center justify-content-center w-100" style="cursor:' + cursorStyle + ';">' +
                        '<i class="bi bi-clock-fill me-2"></i>' + slot +
                        '</div>' +
                        '</label>' +
                        '</div>'
                    );

                });

                // Tambahkan event handler untuk perubahan warna saat dipilih
                $('.slot-checkbox').change(function () {
                    if ($(this).is(':checked')) {
                        $(this).next('.slot-card').removeClass('bg-success').addClass('bg-warning text-dark');
                    } else {
                        $(this).next('.slot-card').removeClass('bg-warning text-dark').addClass('bg-success text-white');
                    }
                });
            }
        });
    }

    // Panggil fungsi saat halaman dimuat
    getAvailableSlots();

    // Panggil ulang fungsi saat tanggal berubah
    $('#tanggal').on('change', function () {
        tanggal = $(this).val();
        getAvailableSlots();
    });
});

</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

