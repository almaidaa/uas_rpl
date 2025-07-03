<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kartu Rencana Studi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Semester</th>
                    <th>Jadwal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($krs as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($row['nama_mk']) ?></td>
                        <td><?= esc($row['nama_dosen']) ?></td>
                        <td><?= esc($row['semester']) ?></td>
                        <td>
                            <?= esc($row['hari']) ?>, <?= esc($row['jam_mulai']) ?> - <?= esc($row['jam_selesai']) ?><br>
                            Ruang: <?= esc($row['ruangan']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href="/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>
<?= $this->endSection() ?>

