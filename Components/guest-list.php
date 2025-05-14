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
                                <button type="button" class="btn btn-sm btn-warning btn-edit-tamu me-1" data-bs-toggle="modal" data-bs-target="#editTamuModal"
                                    data-id="<?php echo attr($row['id']); ?>"
                                    data-nama="<?php echo e($row['nama']); ?>"
                                    data-instansi="<?php echo e($row['instansi']); ?>"
                                    data-tujuan="<?php echo e($row['tujuan']); ?>"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
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

<div class="modal fade" id="editTamuModal" tabindex="-1" aria-labelledby="editTamuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editTamuModalLabel"><i class="fas fa-edit"></i> Edit Data Tamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="edit_tamu_id" id="editTamuIdInput">
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="editNama" name="edit_nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="editInstansi" class="form-label">Instansi</label>
                        <input type="text" class="form-control" id="editInstansi" name="edit_instansi" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTujuan" class="form-label">Tujuan Kedatangan</label>
                        <textarea class="form-control" id="editTujuan" name="edit_tujuan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
        var editModal = document.getElementById('editTamuModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var instansi = button.getAttribute('data-instansi');
            var tujuan = button.getAttribute('data-tujuan');
            editModal.querySelector('#editTamuIdInput').value = id;
            editModal.querySelector('#editNama').value = nama;
            editModal.querySelector('#editInstansi').value = instansi;
            editModal.querySelector('#editTujuan').value = tujuan;
        });
    });
</script>