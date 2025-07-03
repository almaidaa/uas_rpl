<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Input Nilai</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('dosen/nilai/input_nilai/update/') ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <h4>Jadwal: <?= $jadwal['mata_kuliah'] ?> (<?= $jadwal['hari'] ?>, <?= $jadwal['jam_mulai'] ?> - <?= $jadwal['jam_selesai'] ?>)</h4>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($krs as $item): ?>
                        <tr>
                            <input type="hidden" name="jadwalId" value="<?= $jadwal['id'] ?>">
                            <input type="hidden" name="userId" value="<?= $item['mahasiswa_id'] ?>">
                            <td><?= $item['nim'] ?></td>
                            <td><?= $item['mahasiswa_nama'] ?></td>
                            <td>
                                <select name="nilai[<?= $item['krs_id'] ?>]" class="form-control" required>
                                    <option value="">-- Pilih Nilai --</option>
                                    <option value="A" <?= $item['nilai'] == 'A' ? 'selected' : '' ?>>A</option>
                                    <option value="B" <?= $item['nilai'] == 'B' ? 'selected' : '' ?>>B</option>
                                    <option value="C" <?= $item['nilai'] == 'C' ? 'selected' : '' ?>>C</option>
                                    <option value="D" <?= $item['nilai'] == 'D' ? 'selected' : '' ?>>D</option>
                                    <option value="E" <?= $item['nilai'] == 'E' ? 'selected' : '' ?>>E</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan Nilai</button>
            <a href="<?= base_url('dosen/nilai/nilai/' . $jadwal['id']) ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

