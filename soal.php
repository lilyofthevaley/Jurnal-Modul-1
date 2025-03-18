<?php
session_start();
$nama = $email = $nim = $jurusan = $fakultas = "";
$namaErr = $emailErr = $nimErr = $jurusanErr = $fakultasErr = "";
$successMsg = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    if (empty($nama)) {
        $namaErr = "Nama tidak boleh kosong!";
        $errors[] = $namaErr;
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $namaErr = "Nama hanya boleh berisi huruf";
        $errors[] = $namaErr;
    }

    $email = trim($_POST['email']);
    if (empty($email)) {
        $emailErr = "Email tidak boleh kosong!";
        $errors[] = $emailErr;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
        $errors[] = $emailErr;
    }

    $nim = trim($_POST['nim']);
    if (empty($nim)) {
        $nimErr = "NIM tidak boleh kosong!";
        $errors[] = $nimErr;
    } elseif (!ctype_digit($nim)) {
        $nimErr = "NIM harus berupa angka";
        $errors[] = $nimErr;
    }

    $jurusan = trim($_POST['jurusan']);
    if (empty($jurusan)) {
        $jurusanErr = "Jurusan tidak boleh kosong!";
        $errors[] = $jurusanErr;
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $jurusan)) {
        $jurusanErr = "Jurusan hanya boleh berisi huruf";
        $errors[] = $jurusanErr;
    }

    $fakultas = trim($_POST['fakultas']);
    if (empty($fakultas)) {
        $fakultasErr = "Fakultas tidak boleh kosong!";
        $errors[] = $fakultasErr;
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fakultas)) {
        $fakultasErr = "Fakultas hanya boleh berisi huruf";
        $errors[] = $fakultasErr;
    }

    // Hanya tampilkan pesan sukses jika tidak ada error
    if (empty($errors)) {
        $successMsg = "Data pendaftaran telah diterima.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa Baru</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Formulir Pendaftaran Mahasiswa Baru</h2>

        <!-- Tampilkan error jika ada -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($errors)) { ?>
            <div class="alert alert-danger">
                <strong>Kesalahan!</strong> Harap perbaiki data yang salah.
            </div>
        <?php } ?>

        <!-- Tampilkan pesan sukses jika tidak ada error -->
        <?php if (!empty($successMsg)) { ?>
            <div class="alert alert-success">
                <strong>Berhasil!</strong> <?php echo $successMsg; ?>
            </div>
        <?php } ?>

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
                <span class="error"><?php echo $namaErr; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?php echo htmlspecialchars($nim); ?>">
                <span class="error"><?php echo $nimErr; ?></span>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($jurusan); ?>">
                <span class="error"><?php echo $jurusanErr; ?></span>
            </div>

            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <input type="text" id="fakultas" name="fakultas" value="<?php echo htmlspecialchars($fakultas); ?>">
                <span class="error"><?php echo $fakultasErr; ?></span>
            </div>

            <div class="button-container">
                <button type="submit">Daftar</button>
            </div>
        </form>

        <!-- Tampilkan tabel data setelah berhasil submit -->
        <?php if (!empty($successMsg)) { ?>
        <div class="container">
            <h3>Data Pendaftaran</h3>
            <div class="table-container">
                <table border="1">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Fakultas</th>
                    </tr>
                    <tr>
                        <td><?php echo htmlspecialchars($nama); ?></td>
                        <td><?php echo htmlspecialchars($email); ?></td>
                        <td><?php echo htmlspecialchars($nim); ?></td>
                        <td><?php echo htmlspecialchars($jurusan); ?></td>
                        <td><?php echo htmlspecialchars($fakultas); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>