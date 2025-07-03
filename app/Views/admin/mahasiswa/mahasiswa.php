<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Mahasiswa</h3>
        <div class="card-tools">
            <a href="/admin/mahasiswa/create" class="btn btn-primary btn-sm">Tambah Mahasiswa</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Cari berdasarkan NIM, Nama, Jurusan, Angkatan...">
        </div>
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($mahasiswa as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($row['nim']) ?></td>
                        <td><?= esc($row['nama']) ?></td>
                        <td><?= esc($row['jk'] == 'P' ? 'Perempuan' : 'Laki-laki') ?></td>
                        <td><?= esc($row['jurusan']) ?></td>
                        <td><?= esc($row['angkatan']) ?></td>
                        <td>
                            <a href="/admin/mahasiswa/edit/<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?= site_url('/admin/mahasiswa/mahasiswa/delete/') . $row['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<script>
    document.getElementById("search").addEventListener('input', function() {
        var searchValue = this.value.toLowerCase();
        var tableBody = document.getElementById("table-body");
        var rows = tableBody.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var found = false;
            for (var j = 1; j < cells.length - 1; j++) { // Skip No and Aksi columns
                if (cells[j].innerText.toLowerCase().indexOf(searchValue) > -1) {
                    found = true;
                    break;
                }
            }
            if (found) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
</script>
<?= $this->endSection() ?>

