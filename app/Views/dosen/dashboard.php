<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dashboard Dosen</h3>
        <div class="card-tools">
            <a href="/dosen/jadwal/index" class="btn btn-primary btn-sm">Lihat Jadwal</a>
            <a href="/logout" class="btn btn-danger btn-sm">Log Out</a>
        </div>
    </div>
    <div class="card-body">
        <h4>Informasi Dosen</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td><?= $dosen['nama']; ?></td>
                </tr>
                <tr>
                    <th>NIP</th>
                    <td><?= $dosen['nip']; ?></td>
                </tr>
                <tr>
                    <th>Departemen</th>
                    <td><?= $dosen['departemen']; ?></td>
                </tr>
            </tbody>
        </table>

        <h4 class="mt-4">Mata Kuliah Yang Diajar</h4>
        <?php if (empty($jadwal_perkuliahan)): ?>
            <p>Tidak ada mata kuliah yang diajar.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($jadwal_perkuliahan as $mk): ?>
                    <li class="list-group-item"><?= $mk['kode_mata_kuliah'] ?> - <?= $mk['nama_mata_kuliah'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>


