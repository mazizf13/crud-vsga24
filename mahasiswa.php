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

$title = 'Daftar Mahasiswa';
include 'layout/header.php'; 

// display data
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
?>

<div class="container mt-5">
  <h1><i class="bi bi-people"></i> Data Mahasiswa</h1>

  <hr>

  <a href="tambah-mahasiswa.php" class="btn btn-primary mb-2 mt-2"><i class="bi bi-plus-circle"></i> Tambah</a>

  <table id="dataTables" class="table table-bordered table-striped mt-3">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Prodi</th>
        <th>Jenis Kelamin</th>
        <th>Telepon</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($data_mahasiswa as $mahasiswa): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $mahasiswa['nama']; ?></td>
          <td><?= $mahasiswa['prodi']; ?></td>
          <td><?= $mahasiswa['jk']; ?></td>
          <td><?= $mahasiswa['telepon']; ?></td>
          <td class="text-center" width="20%">
            <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>" class="btn btn-secondary btn-sm"><i class="bi bi-eye"></i> Detail</a>
            <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Ubah</a>
            <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data mahasiswa ini?')"><i class="bi bi-trash"></i> Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php 
include 'layout/footer.php'
?>