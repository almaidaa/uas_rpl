<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Mahasiswa</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/admin/mahasiswa/store" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" required minlength="12" maxlength="12">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select name="jk" class="form-control" id="jk" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select name="jurusan" class="form-control" id="jurusan" required>
                    <option value="" disabled selected>Pilih Jurusan</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                    <option value="Manajemen">Manajemen</option>
                </select>
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <?php $years = range(date('Y'), date('Y') - 10); ?>
                <select name="angkatan" class="form-control" id="angkatan" required>
                    <?php foreach ($years as $year): ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/admin/mahasiswa/mahasiswa') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

