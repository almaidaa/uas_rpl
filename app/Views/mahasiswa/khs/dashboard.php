<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?> <?= !empty($khs['khs']) ? ' - ' . esc($khs['khs'][0]['nama']) : '' ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php if (empty($khs)): ?>
            <p class="text-center text-muted">Tidak ada data KHS yang tersedia.</p>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nama Dosen</th>
                        <th>Semester</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($khs['khs'] as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $item['nama_mk'] ?></td>
                            <td><?= $item['sks'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['semester'] ?></td>
                            <td><?= $item['nilai'] ?: 'Belum Ada' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href="/dashboard" class="btn btn-secondary noPrint">Kembali</a>
        <button type="button" class="btn btn-primary noPrint" data-toggle="modal" data-target="#printPreviewModal" onclick="showPrintPreview()">Cetak KHS</button>
    </div>
</div>

<!-- Print Preview Modal -->
<div class="modal fade" id="printPreviewModal" tabindex="-1" aria-labelledby="printPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printPreviewModalLabel">Pratinjau Cetak KHS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="printFrame" style="width: 100%; height: 500px; border: 0;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="printKHS()">Cetak</button>
      </div>
    </div>
  </div>
</div>

<script>
    function showPrintPreview() {
        var printContent = `
            <html>
            <head>
                <title>Kartu Hasil Studi</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
                <style>
                    body { margin: 20px; }
                    h1 { text-align: center; margin-bottom: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #dee2e6; padding: 8px; text-align: left; }
                    th { background-color: #f8f9fa; }
                </style>
            </head>
            <body>
                <h1>Kartu Hasil Studi</h1>
                <p>Nama : <?= $khs['khs'][0]['nama'] ?> <br>
                NIM : <?= $khs['khs'][0]['nim'] ?> <br>
                Jurusan : <?= $khs['khs'][0]['jurusan'] ?> <br>
                Jenis Kelamin : <?= $khs['khs'][0]['jk']== 'L' ? 'Laki-laki' : 'Perempuan' ?> </p>
                <br>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Nama Dosen</th>
                            <th>Semester</th>
                            <th>Nilai</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($khs['khs'] as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $item['nama_mk'] ?></td>
                                <td><?= $item['sks'] ?></td>
                                <td><?= $item['nama'] ?></td>
                                <td><?= $item['semester'] ?></td>
                                <td><?= $item['nilai'] ?: 'Belum Ada' ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </body>
            </html>
        `;

        var iframe = document.getElementById('printFrame');
        iframe.contentWindow.document.open();
        iframe.contentWindow.document.write(printContent);
        iframe.contentWindow.document.close();

        $('#printPreviewModal').modal('show');
    }

    function printKHS() {
        var iframe = document.getElementById('printFrame');
        iframe.contentWindow.print();
    }
</script>

<style>
    @media print {
        .noPrint {
            display: none;
        }
        .card-footer {
            display: none;
        }
        .main-sidebar,
        .main-header,
        .content-header {
            display: none;
        }
        .content-wrapper {
            margin-left: 0 !important;
        }
    }
</style>
<?= $this->endSection() ?>


