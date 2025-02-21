from PetShop import PetShop

def main():
    toko = PetShop()
    while True:
        print("\nMenu:")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("3. Ubah Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("6. Keluar")
        pilihan = input("Pilih: ")
        
        if pilihan == "1":
            toko.tambah_data()
        elif pilihan == "2":
            toko.tampilkan_data()
        elif pilihan == "3":
            toko.ubah_data()
        elif pilihan == "4":
            toko.hapus_data()
        elif pilihan == "5":
            toko.cari_data()
        elif pilihan == "6":
            print("Keluar...")
            break
        else:
            print("Pilihan tidak valid!")

if __name__ == "__main__":
    main()
