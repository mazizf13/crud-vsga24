<?php 
$title = 'Tambah Mahasiswa';
include 'layout/header.php';

if(isset($_POST['tambah'])) {
  if (create_mahasiswa($_POST) > 0) {
    echo
    "<script>
        alert('Data mahasiswa berhasil ditambah');
        document.location.href = 'mahasiswa.php';
    </script>";
  } else {
    echo
    "<script>
        alert('Data mahasiswa gagal ditambah');
        document.location.href = 'mahasiswa.php';
    </script>";
  }
}
?>

<div class="container mt-5">
  <h1>Tambah Mahasiswa</h1>
  <hr />

  <form action="" method="post">
    <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input
        type="text"
        name="nama"
        placeholder="Nama ..."
        class="form-control"
        id="nama"
        required
      />
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input
        type="email"
        name="email"
        placeholder="Email ..."
        class="form-control"
        id="email"
        required
      />
    </div>
    
    <div class="row">
        <div class="mb-3 col-6">
            <label for="prodi" class="form-label">Program Studi</label>
            <select name="prodi" id="prodi" class="form-control" required>
                <option value="">-- pilih program studi --</option>
                <option value="">Teknik Informatika</option>
                <option value="">Sistem Informasi</option>
                <option value="">Data Science</option>
                <option value="">Bisnis Digital</option>
            </select>
        </div>

        <div class="mb-3 col-6">
          <label for="jk" class="form-label">Jenis Kelamin</label>
              <select name="jk" id="jk" class="form-control" required>
                  <option value="">-- pilih jenis kelamin --</option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
              </select>
        </div>
    </div>

    <div class="mb-3">
      <label for="telepon" class="form-label">Telepon</label>
      <input
        type="number"
        name="telepon"
        class="form-control"
        placeholder="Telepon ..."
        id="telepon"
        required
      />
    </div>

    <div class="mb-3">
      <label for="foto" class="form-label">Foto</label>
      <input
        type="text"
        name="foto"
        class="form-control"
        placeholder="Foto ..."
        id="foto"
        required
      />
    </div>
    <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
  </form>
</div>

<?php 
include 'layout/footer.php'; 
?>
