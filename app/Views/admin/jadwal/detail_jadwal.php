<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Detail Jadwal</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Mata Kuliah</strong></td>
                            <td><?= $jadwal['mata_kuliah'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dosen</strong></td>
                            <td><?= $jadwal['nama'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Hari</strong></td>
                            <td><?= $jadwal['hari'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Waktu</strong></td>
                            <td><?= $jadwal['jam_mulai'] ?> - <?= $jadwal['jam_selesai'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Tambah Mahasiswa</h3>
            </div>
            <form action="<?= base_url('admin/jadwal/detail_jadwal/tambah') ?>" method="post">
                <?= csrf_field() ?>
                <div class="card-body">
                    <input type="hidden" name="jadwal_id" value="<?= $jadwal['id_jadwal'] ?>">
                    <div class="form-group">
                        <label for="mahasiswa_id">Pilih Mahasiswa:</label>
                        <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                            <option value="">Pilih Mahasiswa</option>
                            <?php foreach ($allMahasiswa as $mhs): ?>
                                <option value="<?= $mhs['id'] ?>"><?= $mhs['nim'] ?> - <?= $mhs['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
                    <a href="<?= base_url('/admin/jadwal/index') ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mahasiswa Terdaftar</h3>
                <div class="card-tools">
                    <input type="text" class="form-control" id="search-bar" placeholder="Cari Mahasiswa...">
                </div>
            </div>
            <div class="card-body">
                <?php if (!empty($mahasiswa)): ?>
                    <table id="data-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $mhs['nim'] ?></td>
                                    <td><?= $mhs['nama'] ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/jadwal/detail_jadwal/hapus/' . $mhs['id'] . '/' . $jadwal['id_jadwal']) ?>" method="post" onsubmit="return confirm('Apakah yakin ingin menghapus mahasiswa dari jadwal ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Belum ada mahasiswa yang terdaftar pada jadwal ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('search-bar').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search-bar");
        filter = input.value.toUpperCase();
        table = document.getElementById("data-table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            tdNim = tr[i].getElementsByTagName("td")[1]; // NIM column
            tdNama = tr[i].getElementsByTagName("td")[2]; // Nama column
            if (tdNim && tdNama) {
                txtValueNim = tdNim.textContent || tdNim.innerText;
                txtValueNama = tdNama.textContent || tdNama.innerText;
                if (
                    txtValueNim.toUpperCase().indexOf(filter) > -1 ||
                    txtValueNama.toUpperCase().indexOf(filter) > -1
                ) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    });
</script>
<?= $this->endSection() ?>
