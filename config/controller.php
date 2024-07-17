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

  $nama = strip_tags($post['nama']);
  $jumlah = strip_tags($post['jumlah']);
  $harga = strip_tags($post['harga']);

  $query = "INSERT INTO barang (nama, jumlah, harga, tanggal) VALUES ('$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// function to update data
function update_barang($post) {
  global $db;

  $id_barang = (int)$post['id_barang'];
  $nama = strip_tags($post['nama']);
  $jumlah = strip_tags($post['jumlah']);
  $harga = strip_tags($post['harga']);

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

  $nama = strip_tags($post['nama']);
  $email  = strip_tags($post['email']);
  $prodi = strip_tags($post['prodi']);
  $jk = strip_tags($post['jk']);
  $telepon = strip_tags($post['telepon']);
  $foto = upload_file();

  // check upload photo
  if (!$foto) {
    return false;
  }

  $query = "INSERT INTO mahasiswa (nama, email, prodi, jk, telepon, foto) VALUES ('$nama', '$email', '$prodi', '$jk', '$telepon', '$foto')";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Function to update student
function update_mahasiswa($post) {
  global $db;
  
  $id_mahasiswa = (int)$post['id_mahasiswa'];
  $nama = strip_tags($post['nama']);
  $email  = strip_tags($post['email']);
  $prodi = strip_tags($post['prodi']);
  $jk = strip_tags($post['jk']);
  $telepon = strip_tags($post['telepon']);
  $foto_lama = $post['foto_lama'];

  // check upload photo
  if ($_FILES['foto']['error'] !== 4) {
    $foto = upload_file();
    if (!$foto) {
      return false;
    }
  } else {
    $foto = $foto_lama;
  }
  
  $query = "UPDATE mahasiswa SET nama = '$nama', email = '$email', prodi = '$prodi', jk = '$jk', telepon = '$telepon', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";
  
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

// Function to delete student
function delete_mahasiswa($id_mahasiswa) {
  global $db;

  $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
  unlink('assets/img/' . $foto['foto']);

  $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Function to create acccount
function create_akun($post) {
  global $db;

  $nama = strip_tags($post['nama']);
  $username = strip_tags($post['username']);
  $telepon = strip_tags($post['telepon']);
  $email = strip_tags($post['email']);
  $password = strip_tags($post['password']);
  $level = strip_tags($post['level']);

  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO akun (nama, username, telepon, email, password, level) VALUES ('$nama', '$username', '$telepon', '$email', '$password', '$level')";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Function to delete account
function delete_akun($id_akun) {
  global $db;

  $query = "DELETE FROM akun WHERE id_akun = $id_akun";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Function to update account
function update_akun($post) {
  global $db;

  $id_akun = (int)$post['id_akun'];
  $nama = strip_tags($post['nama']);
  $username = strip_tags($post['username']);
  $telepon = strip_tags($post['telepon']);
  $email = strip_tags($post['email']);
  $level = strip_tags($post['level']);
  $password = $post['password'];

  if ($password) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $query = "UPDATE akun SET nama = ?, username = ?, telepon = ?, email = ?, password = ?, level = ? WHERE id_akun = ?";
      $stmt = mysqli_prepare($db, $query);
      mysqli_stmt_bind_param($stmt, "ssssssi", $nama, $username, $telepon, $email, $password, $level, $id_akun);
  } else {
      $query = "UPDATE akun SET nama = ?, username = ?, telepon = ?, email = ?, level = ? WHERE id_akun = ?";
      $stmt = mysqli_prepare($db, $query);
      mysqli_stmt_bind_param($stmt, "sssssi", $nama, $username, $telepon, $email, $level, $id_akun);
  }

  if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_close($stmt);
      return true;  
  } else {
      mysqli_stmt_close($stmt);
      return false; 
  }
}



?>
