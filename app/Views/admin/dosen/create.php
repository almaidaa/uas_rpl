<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Dosen</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/admin/dosen/index/store" method="post">
        <?= csrf_field(); ?>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('failed')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('failed') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control <?= session('validation.nip') ? 'is-invalid' : '' ?>" id="nip" name="nip" value="<?= old('nip') ?>" required minlength="12" maxlength="12">
                <div class="invalid-feedback">
                    <?= session('validation.nip') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control <?= session('validation.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" required>
                <div class="invalid-feedback">
                    <?= session('validation.nama') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="departemen">Departemen</label>
                <select class="form-control <?= session('validation.departemen') ? 'is-invalid' : '' ?>" id="departemen" name="departemen" required>
                    <option value="" disabled selected>Pilih Departemen</option>
                    <option value="Informatika" <?= old('departemen') == 'Informatika' ? 'selected' : '' ?>>Informatika</option>
                    <option value="Elektro" <?= old('departemen') == 'Elektro' ? 'selected' : '' ?>>Elektro</option>
                    <option value="Sipil" <?= old('departemen') == 'Sipil' ? 'selected' : '' ?>>Sipil</option>
                </select>
                <div class="invalid-feedback">
                    <?= session('validation.departemen') ?>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('/admin/dosen/index') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
