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

$title = 'Ubah Barang';
include 'layout/header.php'; 

// get id from url
$id_barang = (int)$_GET['id_barang'];

$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

if(isset($_POST['ubah'])) {
  if (update_barang($_POST) > 0) {
    echo
    "<script>
        alert('Data barang berhasil diubah');
        document.location.href = 'index.php';
    </script>";
  } else {
    echo
    "<script>
        alert('Data barang gagal diubah');
        document.location.href = 'index.php';
    </script>";
  }
}
?>

<div class="container mt-5">
  <h1>Ubah Barang</h1>
  <hr />

  <form action="" method="post">
    <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>" />
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Barang</label>
      <input
        type="text"
        name="nama"
        placeholder="Nama barang ..."
        class="form-control"
        id="nama"
        value="<?= $barang['nama']?>"
        required
      />
    </div>
    
    <div class="mb-3">
      <label for="jumlah" class="form-label">Jumlah Barang</label>
      <input
        type="number"
        name="jumlah"
        placeholder="0"
        class="form-control"
        id="jumlah"
        value="<?= $barang['jumlah']?>"
        required
      />
    </div>
    
    <div class="mb-3">
      <label for="harga" class="form-label">Harga Barang</label>
      <input
        type="number"
        name="harga"
        placeholder="0"
        class="form-control"
        id="harga"
        value="<?= $barang['harga']?>"
        required
      />
    </div>
    
    <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>
  </form>
</div>

<?php 
include 'layout/footer.php'; 
?>