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

  $query = "INSERT INTO barang (nama, jumlah, harga, tanggal) VALUES ('$nama', '$jumlah', '$harga',  CURRENT_TIMESTAMP())";

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
?>