<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Dosen</h3>
        <div class="card-tools">
            <a href="/admin/dosen/create" class="btn btn-primary btn-sm">Tambah Dosen</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="form-group">
            <input type="text" id="search-bar" class="form-control" placeholder="Cari dosen...">
        </div>
        <table id="table-dosen" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dosen as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($row['nip']) ?></td>
                        <td><?= esc($row['nama']) ?></td>
                        <td><?= esc($row['departemen']) ?></td>
                        <td>
                            <a href="/admin/dosen/edit/<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?= site_url('/admin/dosen/index/delete/') . $row['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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
        var rows = document.querySelectorAll('#table-dosen tbody tr');
        rows.forEach(function(row) {
            var showRow = Array.from(row.cells).some(function(cell) {
                return cell.textContent.toLowerCase().includes(searchValue);
            });
            row.style.display = showRow ? '' : 'none';
        });
    });
</script>
<?= $this->endSection() ?>
