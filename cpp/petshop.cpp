#include <iostream>
#include <list>
#include <string>

using namespace std;

class petshop
{
private:
  int id;
  string nama;
  string kategori;
  int harga;
  list<petshop> produk;

public:
  petshop() : id(0), nama(""), kategori(""), harga(0) {}

  petshop(int id, string nama, string kategori, int harga) : id(id), nama(nama), kategori(kategori), harga(harga) {}

  void setId(int id) { this->id = id; }
  void setNama(string nama) { this->nama = nama; }
  void setKategori(string kategori) { this->kategori = kategori; }
  void setHarga(int harga) { this->harga = harga; }

  int getId() { return id; }
  string getNama() { return nama; }
  string getKategori() { return kategori; }
  int getHarga() { return harga; }

  void tampilkan()
  {
    cout << "ID: " << id << " | Nama: " << nama << " | Kategori: " << kategori << " | Harga: " << harga << endl;
  }

  void tambahData()
  {
    int harga;
    string nama, kategori;
    cin.ignore();
    cout << "Masukkan Nama: ";
    getline(cin, nama);
    cout << "Masukkan Kategori: ";
    getline(cin, kategori);
    cout << "Masukkan Harga: ";
    cin >> harga;

    int id = produk.size() + 1; // ID berdasarkan jumlah elemen

    // Buat objek dan atur nilai
    petshop item;
    item.setId(id);
    item.setNama(nama);
    item.setKategori(kategori);
    item.setHarga(harga);

    produk.push_back(item); // Tambahkan ke list produk milik objek
    cout << "Data berhasil ditambahkan dengan ID " << id << "!\n";
  }

  void tampilkanData()
  {
    if (produk.empty())
    {
      cout << "Tidak ada data." << endl;
      return;
    }

    for (auto &item : produk)
    {
      item.tampilkan();
    }
  }

  void ubahData()
  {
    int id;
    cout << "Masukkan ID yang ingin diubah: ";
    cin >> id;

    for (auto &item : produk)
    {
      if (item.getId() == id)
      {
        string nama, kategori;
        int harga;
        cin.ignore();
        cout << "Masukkan Nama baru: ";
        getline(cin, nama);
        cout << "Masukkan Kategori baru: ";
        getline(cin, kategori);
        cout << "Masukkan Harga baru: ";
        cin >> harga;
        item.setNama(nama);
        item.setKategori(kategori);
        item.setHarga(harga);
        cout << "Data berhasil diubah!\n";
        return;
      }
    }

    cout << "Data tidak ditemukan!\n";
  }

  void hapusData()
  {
    int id;
    cout << "Masukkan ID yang ingin dihapus: ";
    cin >> id;

    for (auto it = produk.begin(); it != produk.end(); ++it)
    {
      if (it->getId() == id)
      {
        produk.erase(it);
        cout << "Data berhasil dihapus!\n";
        return;
      }
    }

    cout << "Data tidak ditemukan!\n";
  }

  void cariData()
  {
    string nama;
    cin.ignore();
    cout << "Masukkan Nama yang dicari: ";
    getline(cin, nama);

    for (auto &item : produk)
    {
      if (item.getNama() == nama)
      {
        item.tampilkan();
        return;
      }
    }

    cout << "Data tidak ditemukan!\n";
  }
};
