<?php 

$title = 'Daftar Mahasiswa';
include 'layout/header.php'; 

// display data
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
?>

<div class="container mt-5">
  <h1>Data Mahasiswa</h1>

  <hr>

  <a href="tambah-mahasiswa.php" class="btn btn-primary mb-2 mt-2">Tambah</a>

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
          <td class="text-center" width="15%">
            <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>" class="btn btn-secondary btn-sm">Detail</a>
            <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>" class="btn btn-warning btn-sm">Ubah</a>
            <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa'] ?>" class="btn btn-danger btn-sm">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php 
include 'layout/footer.php'
?>