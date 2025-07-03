<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Jadwal Perkuliahan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/admin/jadwal/index/store" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <div class="form-group">
                <label for="mata_kuliah_id">Mata Kuliah</label>
                <select name="mata_kuliah_id" class="form-control" required id="mata_kuliah_id">
                    <option value="">Pilih Mata Kuliah</option>
                    <?php foreach ($mata_kuliah as $mk): ?>
                        <option value="<?= $mk['id'] ?>" data-semester="<?= $mk['semester'] ?>"><?= esc($mk['nama_mk']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="dosen_id">Dosen</label>
                <select name="dosen_id" class="form-control" required>
                    <option value="">Pilih Dosen</option>
                    <?php foreach ($dosen as $d): ?>
                        <option value="<?= $d['id'] ?>"><?= esc($d['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ruangan">Ruangan</label>
                <select name="ruangan" class="form-control" required>
                    <option value="">Pilih Ruangan</option>
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="A4">A4</option>
                    <option value="A5">A5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" class="form-control" required disabled id="semester">
                    <option value="">Semester</option>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/jadwal/index" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectMataKuliah = document.getElementById('mata_kuliah_id');
        const selectSemester = document.getElementById('semester');

        selectMataKuliah.addEventListener('change', function() {
            const semester = this.options[this.selectedIndex].getAttribute('data-semester');
            selectSemester.innerHTML = `<option value="${semester}">${semester}</option>`;
        });
    });
</script>
<?= $this->endSection() ?>
