<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Mahasiswa</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('/admin/mahasiswa/mahasiswa/update/' . $mahasiswa['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" name="nim" id="nim" value="<?= esc($mahasiswa['nim']) ?>" required disabled>
            </div>
            <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama'] ?>" required>
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select name="jk" class="form-control" id="jk" required>
                    <option value="L" <?= $mahasiswa['jk'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= $mahasiswa['jk'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select name="jurusan" class="form-control" id="jurusan" required>
                    <option value="Teknik Informatika" <?= $mahasiswa['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?= $mahasiswa['jurusan'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                    <option value="Teknik Elektro" <?= $mahasiswa['jurusan'] == 'Teknik Elektro' ? 'selected' : '' ?>>Teknik Elektro</option>
                    <option value="Manajemen" <?= $mahasiswa['jurusan'] == 'Manajemen' ? 'selected' : '' ?>>Manajemen</option>
                </select>
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <?php $years = range(date('Y'), date('Y') - 10); ?>
                <select name="angkatan" class="form-control" id="angkatan" required>
                    <?php foreach ($years as $year): ?>
                        <option value="<?= $year ?>" <?= $mahasiswa['angkatan'] == $year ? 'selected' : '' ?>><?= $year ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/mahasiswa/mahasiswa" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

