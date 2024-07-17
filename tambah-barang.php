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

$title = 'Tambah Barang';
include 'layout/header.php';

if(isset($_POST['tambah'])) {
  if (create_barang($_POST) > 0) {
    echo
    "<script>
        alert('Data barang berhasil ditambah');
        document.location.href = 'index.php';
    </script>";
  } else {
    echo
    "<script>
        alert('Data barang gagal ditambah');
        document.location.href = 'index.php';
    </script>";
  }
}
?>

<div class="container mt-5">
  <h1>Tambah Barang</h1>
  <hr />

  <form action="" method="post">
    <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Barang</label>
      <input
        type="text"
        name="nama"
        placeholder="Nama barang ..."
        class="form-control"
        id="nama"
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
        required
      />
    </div>
    
    <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
  </form>
</div>

<?php 
include 'layout/footer.php'; 
?>
