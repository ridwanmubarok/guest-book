<?php require_once 'Configs/helpers.php'; ?>
<div class="">
    <form method="GET" class="mb-4">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Cari nama atau instansi..."
                value="<?php echo isset($_GET['search']) ? e($_GET['search']) : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle border rounded-3 overflow-hidden">
            <thead class="table-primary">
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Instansi</th>
                    <th>Tujuan Kedatangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo e($row['nama']); ?></td>
                            <td><?php echo e($row['instansi']); ?></td>
                            <td><?php echo e($row['tujuan']); ?></td>
                            <td><?php echo e($row['tanggal']); ?></td>
                            <td><?php echo e($row['waktu']); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger btn-delete-tamu" data-bs-toggle="modal"
                                    data-bs-target="#deleteTamuModal" data-id="<?php echo attr($row['id']); ?>" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">
                            <i class="fas fa-user-friends fa-2x mb-2"></i><br>
                            <span class="d-block">Belum ada tamu yang tercatat.<br>Jadilah yang pertama mengisi buku
                                tamu!</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="text-end small text-secondary">
                <span class="badge bg-primary">Total Tamu: <?php echo $result->num_rows; ?></span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteTamuModal" tabindex="-1" aria-labelledby="deleteTamuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteTamuModalLabel"><i class="fas fa-trash"></i> Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="delete_tamu_id" id="deleteTamuIdInput">
                    <p>Yakin ingin menghapus data tamu ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteTamuModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var input = deleteModal.querySelector('#deleteTamuIdInput');
            input.value = id;
        });
    });
</script>