<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_mahasiswa ?></h3>
                <p>Total Mahasiswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <a href="/admin/mahasiswa/mahasiswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $total_dosen ?></h3>
                <p>Total Dosen</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="/admin/dosen/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $total_mata_kuliah ?></h3>
                <p>Total Mata Kuliah</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="/admin/mata_kuliah/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<?= $this->endSection() ?>
