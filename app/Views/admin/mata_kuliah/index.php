<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Mata Kuliah</h3>
        <div class="card-tools">
            <a href="/admin/mata_kuliah/create" class="btn btn-primary btn-sm">Tambah Mata Kuliah</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="form-group">
            <input type="text" id="search-bar" class="form-control" placeholder="Cari mata kuliah...">
        </div>
        <table id="table-mata-kuliah" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mata_kuliah as $mk => $row): ?>
                    <tr>
                        <td><?= $mk + 1 ?></td>
                        <td><?= esc($row['kode_mk']) ?></td>
                        <td><?= esc($row['nama_mk']) ?></td>
                        <td><?= esc($row['sks']) ?></td>
                        <td><?= esc($row['semester']) ?></td>
                        <td>
                            <a href="/admin/mata_kuliah/edit/<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?= site_url('/admin/mata_kuliah/index/delete/') . $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<script>
    document.getElementById('search-bar').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var rows = document.querySelectorAll('#table-mata-kuliah tbody tr');
        rows.forEach(function(row) {
            var showRow = Array.from(row.cells).some(function(cell) {
                return cell.textContent.toLowerCase().includes(searchValue);
            });
            row.style.display = showRow ? '' : 'none';
        });
    });
</script>
<?= $this->endSection() ?>

