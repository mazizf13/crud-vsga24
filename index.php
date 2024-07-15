<?php 
include 'layout/header.php';

$data_barang = select('SELECT * FROM barang');

?>
    <div class="container mt-5">
      <h1>Data Barang</h1>

      <hr>

      <a href="tambah-barang.php" class="btn btn-primary mb-2 mt-2">Tambah</a>

      <table class="table table-bordered table-striped mt-3">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($data_barang as $barang): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $barang['nama']; ?></td>
            <td><?= $barang['jumlah']; ?></td>
            <td>Rp <?= number_format($barang['harga'], 0, ',','.') ?></td>
            <td><?= date('d-m-Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
            <td width="15%">
              <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']?>" class="btn btn-warning">Ubah</a>
              <a href="" class="btn btn-danger">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    
<?php 
include 'layout/footer.php' ?>
