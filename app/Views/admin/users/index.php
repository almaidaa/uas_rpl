<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Manajemen Pengguna</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $key => $user): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['role']) ?></td>
                        <td>
                            <!-- Add action buttons here if needed, e.g., edit, delete -->
                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>