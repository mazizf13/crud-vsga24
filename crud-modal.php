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

$title = 'Daftar Akun';
include 'layout/header.php';

$data_akun = select("SELECT * FROM akun");

if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
                alert('Data Akun Berhasil Ditambahkan');
                document.location.href = 'crud-modal.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Akun Gagal Ditambahkan');
                document.location.href = 'crud-modal.php';
            </script>";
    }
}    

if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
                alert('Data Akun Berhasil Diubah');
                document.location.href = 'crud-modal.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Akun Gagal Diubah');
                document.location.href = 'crud-modal.php';
            </script>";
    }
}  

?>

<div class="container mt-5">
    <h1><i class="bi bi-people"></i> Data Akun</h1>

    <hr>

    <a type="button" class="btn btn-primary mb-2 mt-2" data-bs-toggle="modal" data-bs-target="#modalTambahAkun"><i class="bi bi-plus-circle"></i> Tambah</a>

    <table id="dataTables" class="table table-bordered table-striped mt-3">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Password</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $no = 1;?>
          <?php foreach($data_akun as $akun): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $akun['nama'] ?></td>
                <td><?= $akun['username'] ?></td>
                <td><?= $akun['telepon'] ?></td>
                <td><?= $akun['email'] ?></td>
                <td>************</td>
                <td class="text-center">
                    <a type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbahAkun<?= $akun['id_akun'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                    <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusAkun<?= $akun['id_akun'] ?>"><i class="bi bi-trash"></i> Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalTambahAkun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username :</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon :</label>
                        <input type="number" class="form-control" name="telepon" id="telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" name="password" id="password" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level :</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="">-- pilih level --</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach($data_akun as $akun): ?>
<div class="modal fade" id="modalHapusAkun<?= $akun['id_akun'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin Ingin Menghapus Data Akun : <?= $akun['nama'];?>.?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="hapus-akun.php?id_akun=<?= $akun['id_akun'] ?>" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php foreach($data_akun as $akun): ?>
    <div class="modal fade" id="modalUbahAkun<?= $akun['id_akun'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_akun" value="<?= $akun['id_akun'] ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama :</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $akun['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username :</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $akun['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon :</label>
                        <input type="number" class="form-control" name="telepon" id="telepon" value="<?= $akun['telepon']?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $akun['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password baru/lama" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level :</label>
                        <select name="level" id="level" class="form-control" required>
                            <?php $level = $akun['level']; ?>
                                <option value="1" <?= $level == '1' ? 'selected' : null?>>Admin</option>
                                <option value="2" <?= $level == '2' ? 'selected' : null?>>Operator</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php
include 'layout/footer.php'; 
?>
