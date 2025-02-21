<?php

class PetShop {
    private $id;
    private $nama;
    private $kategori;
    private $harga;
    private $foto;
    private $produk = [];

    public function __construct($id = 0, $nama = "", $kategori = "", $harga = 0, $foto = "") {
        $this->id = $id;
        $this->nama = $nama;
        $this->kategori = $kategori;
        $this->harga = $harga;
        $this->foto = $foto;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function set_nama($nama) {
        $this->nama = $nama;
    }

    public function set_kategori($kategori) {
        $this->kategori = $kategori;
    }

    public function set_harga($harga) {
        $this->harga = $harga;
    }

    public function set_foto($foto) {
        $this->foto = $foto;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_nama() {
        return $this->nama;
    }

    public function get_kategori() {
        return $this->kategori;
    }

    public function get_harga() {
        return $this->harga;
    }

    public function get_foto() {
        return $this->foto;
    }

    public function tampilkan() {
        echo "ID: {$this->id} | Nama: {$this->nama} | Kategori: {$this->kategori} | Harga: {$this->harga} | Foto: {$this->foto}\n";
    }

    public function upload_foto($foto_file) {
        $target_dir = "uploads/"; // Folder untuk menyimpan foto
        $target_file = $target_dir . basename($foto_file["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file adalah gambar
        if (getimagesize($foto_file["tmp_name"]) === false) {
            echo "File bukan gambar.\n";
            $upload_ok = 0;
        }

        // Cek apakah file sudah ada
        if (file_exists($target_file)) {
            echo "File sudah ada.\n";
            $upload_ok = 0;
        }

        // Cek ukuran file (maksimal 5MB)
        if ($foto_file["size"] > 5000000) {
            echo "File terlalu besar.\n";
            $upload_ok = 0;
        }

        // Cek jenis file (hanya gambar .jpg, .jpeg, .png, .gif)
        if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png" && $image_file_type != "gif") {
            echo "Hanya file gambar yang diperbolehkan.\n";
            $upload_ok = 0;
        }

        // Cek jika flag upload_ok masih 0
        if ($upload_ok == 0) {
            echo "File tidak dapat diunggah.\n";
        } else {
            if (move_uploaded_file($foto_file["tmp_name"], $target_file)) {
                echo "File foto berhasil diunggah.\n";
                return basename($foto_file["name"]);
            } else {
                echo "Terjadi kesalahan saat mengunggah file.\n";
            }
        }
        return null; // Jika gagal mengunggah
    }

    public function tambah_data() {
        $nama = readline("Masukkan Nama: ");
        $kategori = readline("Masukkan Kategori: ");
        $harga = (int) readline("Masukkan Harga: ");

        $foto_file = $_FILES['foto']; // Mendapatkan file foto dari form upload
        $foto = $this->upload_foto($foto_file); // Mengunggah foto

        $id_baru = count($this->produk) + 1;
        $item = new PetShop($id_baru, $nama, $kategori, $harga, $foto);
        $this->produk[] = $item;
        echo "Data berhasil ditambahkan dengan ID {$id_baru}!\n";
    }

    public function tampilkan_data() {
        if (empty($this->produk)) {
            echo "Tidak ada data.\n";
            return;
        }

        foreach ($this->produk as $item) {
            $item->tampilkan();
        }
    }

    public function ubah_data() {
        $id_ubah = (int) readline("Masukkan ID yang ingin diubah: ");
        foreach ($this->produk as $item) {
            if ($item->get_id() === $id_ubah) {
                $nama = readline("Masukkan Nama baru: ");
                $kategori = readline("Masukkan Kategori baru: ");
                $harga = (int) readline("Masukkan Harga baru: ");
                $foto_file = $_FILES['foto']; // Mendapatkan file foto baru
                $foto = $this->upload_foto($foto_file); // Mengunggah foto baru jika ada
                $item->set_nama($nama);
                $item->set_kategori($kategori);
                $item->set_harga($harga);
                if ($foto) {
                    $item->set_foto($foto); // Menyimpan nama file foto baru
                }
                echo "Data berhasil diubah!\n";
                return;
            }
        }
        echo "Data tidak ditemukan!\n";
    }

    public function hapus_data() {
        $id_hapus = (int) readline("Masukkan ID yang ingin dihapus: ");
        foreach ($this->produk as $index => $item) {
            if ($item->get_id() === $id_hapus) {
                unset($this->produk[$index]);
                $this->produk = array_values($this->produk); // Reindex array
                echo "Data berhasil dihapus!\n";
                return;
            }
        }
        echo "Data tidak ditemukan!\n";
    }

    public function cari_data() {
        $nama_cari = readline("Masukkan Nama yang dicari: ");
        foreach ($this->produk as $item) {
            if ($item->get_nama() === $nama_cari) {
                $item->tampilkan();
                return;
            }
        }
        echo "Data tidak ditemukan!\n";
    }
}

// Example usage (testing)
// $petShop = new PetShop();
// $petShop->tambah_data();
// $petShop->tampilkan_data();
// $petShop->ubah_data();
// $petShop->hapus_data();
// $petShop->cari_data();

?>
