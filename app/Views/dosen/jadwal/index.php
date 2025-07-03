<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php if (empty($jadwal)): ?>
            <div class="alert alert-info" role="alert">
                Belum ada jadwal perkuliahan.
            </div>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Ruangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jadwal as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $row['hari']; ?></td>
                            <td><?= $row['jam_mulai']; ?> - <?= $row['jam_selesai']; ?></td>
                            <td><?= $row['nama_mata_kuliah']; ?> (<?= $row['kode_mata_kuliah']; ?>)</td>
                            <td><?= $row['ruangan']; ?></td>
                            <td>
                                <a href="<?= base_url('dosen/nilai/nilai/' . $row['id']) ?>" class="btn btn-primary btn-sm">Mahasiswa</a>
                            </td>
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
