<?php 
// function to display data
function select($query)
{
  global $db;

  $result = mysqli_query($db, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  };

  return $rows;
}

// function to add data
function create_barang($post) {
  global $db;

  $nama = mysqli_real_escape_string($db, $post['nama']);
  $jumlah = mysqli_real_escape_string($db, $post['jumlah']);
  $harga = mysqli_real_escape_string($db, $post['harga']);

  $query = "INSERT INTO barang (nama, jumlah, harga, tanggal) VALUES ('$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// function to update data
function update_barang($post) {
  global $db;

  $id_barang = (int)$post['id_barang'];
  $nama = mysqli_real_escape_string($db, $post['nama']);
  $jumlah = mysqli_real_escape_string($db, $post['jumlah']);
  $harga = mysqli_real_escape_string($db, $post['harga']);

  $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Function to delete data
function delete_barang($id_barang) {
  global $db;

  $id_barang = (int)$id_barang;

  $query = "DELETE FROM barang WHERE id_barang = $id_barang";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Function to add student
function create_mahasiswa($post) {
  global $db;

  $nama = mysqli_real_escape_string($db, $post['nama']);
  $email  = mysqli_real_escape_string($db, $post['email']);
  $prodi = mysqli_real_escape_string($db, $post['prodi']);
  $jk = mysqli_real_escape_string($db, $post['jk']);
  $telepon = mysqli_real_escape_string($db, $post['telepon']);
  $foto = upload_file();

  // check upload photo
  if (!$foto) {
    return false;
  }

  $query = "INSERT INTO mahasiswa (nama, email, prodi, jk, telepon, foto) VALUES ('$nama', '$email', '$prodi', '$jk', '$telepon', '$foto')";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Function to upload file
function upload_file() {
  $nama_file = $_FILES['foto']['name'];
  $ukuran_file = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmp_name = $_FILES['foto']['tmp_name'];

  // check file
  $extensifileValid = ["jpg", "jpeg", "png"];
  $extensifile = explode('.', $nama_file);
  $extensifile = strtolower(end($extensifile));
  
  // check extensifile
  if (!in_array($extensifile, $extensifileValid)) {
    echo "<script>
      alert('file tidak valid');
      document.location.href = 'tambah-mahasiswa.php'
    </script>";
    die();
  }

  // check size
  if ($ukuran_file > 2048888) {
    echo "<script>
      alert('Ukuran file max 2 MB');
      document.location.href = 'tambah-mahasiswa.php'
    </script>";
    die();
  }

  // generate name
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $extensifile;
  move_uploaded_file($tmp_name, 'assets/img/' . $nama_file_baru);
  return $nama_file_baru;

  
}
?>
