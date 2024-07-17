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

include 'config/app.php';

// Receive the selected item ID
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

if(delete_mahasiswa($id_mahasiswa) > 0) {
    echo
    "<script>
        alert('Data mahasiswa berhasil dihapus');
        document.location.href = 'mahasiswa.php';
    </script>";
} else {
    echo
    "<script>
        alert('Data mahasiswa gagal dihapus');
        document.location.href = 'mahasiswa.php';
    </script>";
}
?>
