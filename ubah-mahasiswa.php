<?php 

// restrict pages before logging 
if(!isset($_SESSION["login"])) {
  echo 
    "<script>
    alert('login dulu dong');
      document.location.href = 'login.php';
    </script>";

  exit;
}

$title = 'Ubah Mahasiswa';
include 'layout/header.php';

// get id from url
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

if(isset($_POST['ubah'])) {
  if (update_mahasiswa($_POST) > 0) {
    echo
    "<script>
        alert('Data mahasiswa berhasil diubah');
        document.location.href = 'mahasiswa.php';
    </script>";
  } else {
    echo
    "<script>
        alert('Data mahasiswa gagal diubah');
        document.location.href = 'mahasiswa.php';
    </script>";
  }
}
?>

<div class="container mt-5">
  <h1>Ubah Mahasiswa</h1>
  <hr />

  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
    <input type="hidden" name="foto_lama" value="<?= $mahasiswa['foto']; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input
        type="text"
        name="nama"
        placeholder="Nama ..."
        class="form-control"
        id="nama"
        value="<?= $mahasiswa['nama']; ?>"
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
        value="<?= $mahasiswa['email']; ?>"
        required
      />
    </div>
    
    <div class="row">
        <div class="mb-3 col-6">
            <label for="prodi" class="form-label">Program Studi</label>
            <select name="prodi" id="prodi" class="form-control" required>
              <?php $prodi = $mahasiswa['prodi']; ?>
                <option value="">-- pilih program studi --</option>
                <option value="Teknik Informatika" <?= $prodi == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                <option value="Sistem Informasi" <?= $prodi == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                <option value="Data Science" <?= $prodi == 'Data Science' ? 'selected' : '' ?>>Data Science</option>
                <option value="Bisnis Digital" <?= $prodi == 'Bisnis Digital' ? 'selected' : '' ?>>Bisnis Digital</option>
            </select>
        </div>

        <div class="mb-3 col-6">
          <label for="jk" class="form-label">Jenis Kelamin</label>
              <select name="jk" id="jk" class="form-control" required>
                <?php $jk = $mahasiswa['jk']; ?>
                  <option value="">-- pilih jenis kelamin --</option>
                  <option value="Laki-Laki" <?= $jk == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                  <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
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
        value="<?= $mahasiswa['telepon']; ?>"
        required
      />
    </div>

    <div class="mb-3">
      <label for="foto" class="form-label">Foto</label>
      <input
        type="file"
        name="foto"
        class="form-control"
        id="foto"
        onchange="previewImg()"
      />
      
      <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="preview" width="30%" class="img-thumbnail img-preview mt-3" style="display: block;">
    </div>
    <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>
  </form>
</div>

<script>
  function previewImg() {
    const img = document.querySelector('#foto');
    const img_preview = document.querySelector('.img-preview');

    const file_foto = new FileReader();
    file_foto.readAsDataURL(img.files[0]);

    file_foto.onload = function(e) {
      img_preview.src = e.target.result;
      img_preview.style.display = 'block';
    }
  }
</script>

<?php 
include 'layout/footer.php'; 
?>
