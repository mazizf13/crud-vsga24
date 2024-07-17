<?php 

session_start();

// restrict pages before logging 
if(!isset($_SESSION["login"])) {
    echo 
      "<script>
      alert('login dulu dong');
        document.location.href = 'login.php';
      </script>";

    exit;
}

$title = 'Daftar Barang';
include 'layout/header.php';

$data_barang = select('SELECT * FROM barang ORDER BY id_barang DESC');

?>
    <div class="container mt-5">
      <h1><i class="bi bi-list-ul"></i> Data Barang</h1>

      <hr>

      <a href="tambah-barang.php" class="btn btn-primary mb-2 mt-2"><i class="bi bi-plus-circle"></i> Tambah</a>

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
            <td width="20%" class="text-center">
              <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Ubah</a>
              <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><i class="bi bi-trash"></i> Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    
<?php 
include 'layout/footer.php'; 
?>
