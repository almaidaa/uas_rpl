<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dashboard Mahasiswa</h3>
        <div class="card-tools">
            <a href="/mahasiswa/krs/index" class="btn btn-primary btn-sm">KRS</a>
            <a href="/mahasiswa/khs/dashboard" class="btn btn-primary btn-sm">KHS</a>
        </div>
    </div>
    <div class="card-body">
        <h4>Informasi Mahasiswa</h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td><?= $mahasiswa['nama'] ?></td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td><?= $mahasiswa['nim'] ?></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td><?= $mahasiswa['jurusan'] ?></td>
                </tr>
                <tr>
                    <th>Angkatan</th>
                    <td><?= $mahasiswa['angkatan'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
