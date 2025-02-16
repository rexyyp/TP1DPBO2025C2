#include "petshop.cpp"

int main() {
    petshop toko; // Objek petshop untuk menyimpan daftar
    int pilihan;
    do {
        cout << "\nMenu:\n1. Tambah Data\n2. Tampilkan Data\n3. Ubah Data\n4. Hapus Data\n5. Cari Data\n6. Keluar\nPilih: ";
        cin >> pilihan;
        switch (pilihan) {
            case 1: toko.tambahData(); break;
            case 2: toko.tampilkanData(); break;
            case 3: toko.ubahData(); break;
            case 4: toko.hapusData(); break;
            case 5: toko.cariData(); break;
            case 6: cout << "Keluar..." << endl; break;
            default: cout << "Pilihan tidak valid!" << endl;
        }
    } while (pilihan != 6);
    return 0;
}
