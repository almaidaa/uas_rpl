<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nilai Mahasiswa</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <h4>Jadwal Mata Kuliah</h4>
        <p><strong>Mata Kuliah:</strong> <?= $jadwal['mata_kuliah'] ?></p>
        <p><strong>Hari:</strong> <?= $jadwal['hari'] ?></p>
        <p><strong>Waktu:</strong> <?= $jadwal['jam_mulai'] ?> - <?= $jadwal['jam_selesai'] ?></p>
        <p><strong>SKS:</strong> <?= $jadwal['sks'] ?></p>

        <?php if (empty($nilai)): ?>
            <div class="alert alert-warning">
                Belum ada mahasiswa yang terdaftar pada mata kuliah ini.
            </div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($nilai as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['nim'] ?></td>
                            <td><?= $item['mahasiswa_nama'] ?></td>
                            <td><?= $item['nilai'] ?: '<a href="' . base_url('dosen/nilai/input_nilai/' . $jadwal['id'] . '/' . $item['id'])  . '" class="btn btn-primary btn-sm">Penilaian</a>' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?= $this->endSection() ?>
