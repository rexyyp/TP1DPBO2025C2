<?php
session_start(); // Mulai sesi untuk menyimpan data
require_once 'PetShop.php';  // Pastikan PetShop.php ada di lokasi yang benar

// Jika sesi belum ada, buat daftar produk awal
if (!isset($_SESSION['produkList'])) {
    $_SESSION['produkList'] = [
        ['nama' => 'Wiskas', 'kategori' => 'Makanan Kucing', 'harga' => 'Rp 50.000', 'foto' => 'foto1.jpg'],
        ['nama' => 'Spray kutu Kucing Anjing', 'kategori' => 'Spray', 'harga' => 'Rp 30.000', 'foto' => 'foto2.jpg']
    ];
}
$produkList = &$_SESSION['produkList'];

// Fungsi untuk menampilkan tabel produk dalam HTML
function tampilkanTabelProduk($produkList) {
    echo "<table border='1'>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>";

    foreach ($produkList as $index => $produk) {
        echo "<tr>
                <td>{$produk['nama']}</td>
                <td>{$produk['kategori']}</td>
                <td>{$produk['harga']}</td>
                <td><img src='{$produk['foto']}' alt='Foto' width='100'></td>
                <td>
                    <a href='?edit=$index'>Edit</a> | 
                    <a href='?delete=$index'>Delete</a>
                </td>
              </tr>";
    }

    echo "</table>";
}

// Cek jika form ditambah untuk menambahkan produk baru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah'])) {
    $produkList[] = [
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga' => $_POST['harga'],
        'foto' => $_POST['foto']
    ];
}

// Cek jika ada aksi delete produk
if (isset($_GET['delete'])) {
    $indexToDelete = $_GET['delete'];
    unset($produkList[$indexToDelete]);
    $_SESSION['produkList'] = array_values($produkList);  // Re-index array setelah delete
}

// Cek jika ada aksi edit produk
$isEditing = false;
$produkToEdit = ['nama' => '', 'kategori' => '', 'harga' => '', 'foto' => ''];
$indexToEdit = -1;
if (isset($_GET['edit'])) {
    $indexToEdit = $_GET['edit'];
    if (isset($produkList[$indexToEdit])) {
        $produkToEdit = $produkList[$indexToEdit];
        $isEditing = true;
    }
}

// Cek jika form edit di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $indexToEdit = $_POST['index'];
    $produkList[$indexToEdit] = [
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga' => $_POST['harga'],
        'foto' => $_POST['foto']
    ];
}

// Pencarian Produk
$hasilPencarian = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cari'])) {
    $keyword = strtolower($_POST['keyword']);
    foreach ($produkList as $produk) {
        if (strpos(strtolower($produk['nama']), $keyword) !== false || strpos(strtolower($produk['kategori']), $keyword) !== false) {
            $hasilPencarian[] = $produk;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop Produk</title>
</head>
<body>
    <h1>Daftar Produk di PetShop</h1>

    <!-- Form Pencarian Produk -->
    <h2>Cari Produk</h2>
    <form method="POST">
        <input type="text" name="keyword" placeholder="Masukkan nama atau kategori" required>
        <button type="submit" name="cari">Cari</button>
    </form>

    <!-- Menampilkan hasil pencarian jika ada -->
    <?php if (!empty($hasilPencarian)): ?>
        <h2>Hasil Pencarian</h2>
        <?php tampilkanTabelProduk($hasilPencarian); ?>
    <?php endif; ?>

    <!-- Menampilkan tabel produk -->
    <h2>Produk yang Tersedia</h2>
    <?php tampilkanTabelProduk($produkList); ?>

    <!-- Form Tambah Produk -->
    <h2>Tambah Produk</h2>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" required><br>
        <label>Kategori:</label>
        <input type="text" name="kategori" required><br>
        <label>Harga:</label>
        <input type="text" name="harga" required><br>
        <label>Foto (URL):</label>
        <input type="text" name="foto" required><br>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Form Edit Produk -->
    <?php if ($isEditing): ?>
        <h2>Edit Produk</h2>
        <form method="POST">
            <input type="hidden" name="index" value="<?php echo $indexToEdit; ?>">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo $produkToEdit['nama']; ?>" required><br>
            <label>Kategori:</label>
            <input type="text" name="kategori" value="<?php echo $produkToEdit['kategori']; ?>" required><br>
            <label>Harga:</label>
            <input type="text" name="harga" value="<?php echo $produkToEdit['harga']; ?>" required><br>
            <label>Foto (URL):</label>
            <input type="text" name="foto" value="<?php echo $produkToEdit['foto']; ?>" required><br>
            <button type="submit" name="edit">Simpan Perubahan</button>
        </form>
    <?php endif; ?>
</body>
</html>