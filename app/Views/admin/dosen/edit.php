<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Dosen</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('/admin/dosen/index/update/' . $dosen['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" name="nip" id="nip" value="<?= esc(old('nip', $dosen['nip'])) ?>" disabled>
            </div>
            <div class="form-group">
                <label for="nama">Nama Dosen</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= esc(old('nama', $dosen['nama'])) ?>">
            </div>
            <div class="form-group">
                <label for="departemen">Departemen</label>
                <select class="form-control" name="departemen" id="departemen">
                    <option value="Informatika" <?= old('departemen', $dosen['departemen']) == 'Informatika' ? 'selected' : '' ?>>Informatika</option>
                    <option value="Elektro" <?= old('departemen', $dosen['departemen']) == 'Elektro' ? 'selected' : '' ?>>Elektro</option>
                    <option value="Sipil" <?= old('departemen', $dosen['departemen']) == 'Sipil' ? 'selected' : '' ?>>Sipil</option>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="/admin/dosen/index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>


