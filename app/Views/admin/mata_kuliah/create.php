<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Mata Kuliah</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/admin/mata_kuliah/index/store" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="kode_mk">Kode Mata Kuliah</label>
                <input type="text" name="kode_mk" class="form-control" id="kode_mk" required maxlength="5">
            </div>
            <div class="form-group">
                <label for="nama_mk">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" id="nama_mk" required>
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <select name="sks" class="form-control" id="sks" required>
                    <option value="">Pilih SKS</option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" class="form-control" id="semester" required>
                    <option value="">Pilih Semester</option>
                    <?php for ($i = 1; $i <= 14; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/mata_kuliah/index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

