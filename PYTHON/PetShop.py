class PetShop:
    def __init__(self, id=0, nama="", kategori="", harga=0):
        self.id = id
        self.nama = nama
        self.kategori = kategori
        self.harga = harga
        self.produk = []

    def set_id(self, id):
        self.id = id

    def set_nama(self, nama):
        self.nama = nama

    def set_kategori(self, kategori):
        self.kategori = kategori

    def set_harga(self, harga):
        self.harga = harga

    def get_id(self):
        return self.id

    def get_nama(self):
        return self.nama

    def get_kategori(self):
        return self.kategori

    def get_harga(self):
        return self.harga

    def tampilkan(self):
        print(f"ID: {self.id} | Nama: {self.nama} | Kategori: {self.kategori} | Harga: {self.harga}")

    def tambah_data(self):
        nama = input("Masukkan Nama: ")
        kategori = input("Masukkan Kategori: ")
        harga = int(input("Masukkan Harga: "))
        
        id_baru = len(self.produk) + 1
        item = PetShop(id_baru, nama, kategori, harga)
        self.produk.append(item)
        print(f"Data berhasil ditambahkan dengan ID {id_baru}!")

    def tampilkan_data(self):
        if not self.produk:
            print("Tidak ada data.")
            return
        
        for item in self.produk:
            item.tampilkan()

    def ubah_data(self):
        id_ubah = int(input("Masukkan ID yang ingin diubah: "))
        for item in self.produk:
            if item.get_id() == id_ubah:
                nama = input("Masukkan Nama baru: ")
                kategori = input("Masukkan Kategori baru: ")
                harga = int(input("Masukkan Harga baru: "))
                item.set_nama(nama)
                item.set_kategori(kategori)
                item.set_harga(harga)
                print("Data berhasil diubah!")
                return
        print("Data tidak ditemukan!")

    def hapus_data(self):
        id_hapus = int(input("Masukkan ID yang ingin dihapus: "))
        for i, item in enumerate(self.produk):
            if item.get_id() == id_hapus:
                del self.produk[i]
                print("Data berhasil dihapus!")
                return
        print("Data tidak ditemukan!")

    def cari_data(self):
        nama_cari = input("Masukkan Nama yang dicari: ")
        for item in self.produk:
            if item.get_nama() == nama_cari:
                item.tampilkan()
                return
        print("Data tidak ditemukan!")
