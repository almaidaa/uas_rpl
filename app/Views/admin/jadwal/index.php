<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jadwal Perkuliahan</h3>
        <div class="card-tools">
            <a href="/admin/jadwal/create" class="btn btn-primary btn-sm">Tambah Jadwal</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php if(session()->getFlashdata('message')): ?>
            <div class="alert alert-success" role="alert">
               <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
               <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <input type="text" id="search-bar" class="form-control" placeholder="Cari Jadwal...">
        </div>
        <table id="table-jadwal" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwal as $key => $row): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($row['nama_mk']) ?></td>
                        <td><?= esc($row['dosen']) ?></td>
                        <td><?= esc($row['hari']) ?></td>
                        <td><?= esc($row['jam_mulai']) ?> - <?= esc($row['jam_selesai']) ?></td>
                        <td><?= esc($row['ruangan']) ?></td>
                        <td><?= esc($row['semester']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/jadwal/detail_jadwal/' . $row['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                            <a href="/admin/jadwal/edit/<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?= site_url('/admin/jadwal/index/delete/') . $row['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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
        var rows = document.querySelectorAll('#table-jadwal tbody tr');
        rows.forEach(function(row) {
            var showRow = Array.from(row.cells).some(function(cell) {
                return cell.textContent.toLowerCase().includes(searchValue);
            });
            row.style.display = showRow ? '' : 'none';
        });
    });
</script>
<?= $this->endSection() ?>
