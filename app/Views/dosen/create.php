<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Dosen</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/dosen/store" method="post">
        <?= csrf_field(); ?>
        <div class="card-body">
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control <?= session('validation.nip') ? 'is-invalid' : '' ?>" id="nip" name="nip" value="<?= old('nip') ?>" required>
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
                <input type="text" class="form-control <?= session('validation.departemen') ? 'is-invalid' : '' ?>" id="departemen" name="departemen" value="<?= old('departemen') ?>" required>
                <div class="invalid-feedback">
                    <?= session('validation.departemen') ?>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tambah Dosen</button>
            <a href="<?= base_url('/admin/dosen/index') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>