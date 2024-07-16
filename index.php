<?php 
include 'layout/header.php';

$data_barang = select('SELECT * FROM barang ORDER BY id_barang DESC');

?>
    <div class="container mt-5">
      <h1>Data Barang</h1>

      <hr>

      <a href="tambah-barang.php" class="btn btn-primary mb-2 mt-2">Tambah</a>

      <table id="dataTables" class="table table-bordered table-striped mt-3">
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
            <td><?= htmlspecialchars($barang['nama']); ?></td>
            <td><?= htmlspecialchars($barang['jumlah']); ?></td>
            <td>Rp <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
            <td><?= date('d-m-Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
            <td width="15%">
              <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-warning">Ubah</a>
              <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    
<?php 
include 'layout/footer.php'; 
?>
