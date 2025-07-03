
<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Jadwal Perkuliahan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/admin/jadwal/update" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="idnya" value="<?= esc($jadwal['id']) ?>">
        <div class="card-body">
            <div class="form-group">
                <label for="mata_kuliah_id">Mata Kuliah</label>
                <select name="mata_kuliah_id" class="form-control" required disabled>
                    <option value="">Pilih Mata Kuliah</option>
                    <?php foreach ($mata_kuliah as $mk): ?>
                        <option value="<?= $mk['id'] ?>" <?= isset($jadwal['id']) && $jadwal['mata_kuliah_id'] == $mk['id'] ? 'selected' : '' ?>><?= esc($mk['nama_mk']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="dosen_id">Dosen</label>
                <select name="dosen_id" class="form-control" required>
                    <option value="">Pilih Dosen</option>
                    <?php foreach ($dosen as $d): ?>
                        <option value="<?= $d['id'] ?>" <?= isset($jadwal['id']) && $jadwal['dosen_id'] == $d['id'] ? 'selected' : '' ?>><?= esc($d['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control" required>
                    <option value="">Pilih Hari</option>
                    <?php 
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    foreach ($days as $day): 
                    ?>
                        <option value="<?= $day ?>" <?= isset($jadwal['hari']) && $jadwal['hari'] == $day ? 'selected' : '' ?>><?= $day ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" value="<?= $jadwal['jam_mulai'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" value="<?= $jadwal['jam_selesai'] ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="ruangan">Ruangan</label>
                <select name="ruangan" class="form-control" required>
                    <option value="">Pilih Ruangan</option>
                    <option value="A1" <?= isset($jadwal['ruangan']) && $jadwal['ruangan'] == 'A1' ? 'selected' : '' ?>>A1</option>
                    <option value="A2" <?= isset($jadwal['ruangan']) && $jadwal['ruangan'] == 'A2' ? 'selected' : '' ?>>A2</option>
                    <option value="A3" <?= isset($jadwal['ruangan']) && $jadwal['ruangan'] == 'A3' ? 'selected' : '' ?>>A3</option>
                    <option value="A4" <?= isset($jadwal['ruangan']) && $jadwal['ruangan'] == 'A4' ? 'selected' : '' ?>>A4</option>
                    <option value="A5" <?= isset($jadwal['ruangan']) && $jadwal['ruangan'] == 'A5' ? 'selected' : '' ?>>A5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" class="form-control" required disabled>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <option value="<?= $i ?>" 
                        <?= isset($jadwal['semester']) && $jadwal['semester'] == $i ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/admin/jadwal/index') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
