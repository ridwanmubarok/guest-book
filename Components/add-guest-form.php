<form method="POST" autocomplete="off">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama lengkap" autofocus>
    </div>
    <div class="mb-3">
        <label for="instansi" class="form-label">Instansi</label>
        <input type="text" class="form-control" id="instansi" name="instansi" required placeholder="Asal instansi / perusahaan / sekolah">
    </div>
    <div class="mb-3">
        <label for="tujuan" class="form-label">Tujuan Kedatangan</label>
        <textarea class="form-control" id="tujuan" name="tujuan" rows="3" required placeholder="Sebutkan tujuan kedatangan"></textarea>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" name="create_tamu" class="btn btn-primary btn-lg">Simpan</button>
    </div>
</form> 