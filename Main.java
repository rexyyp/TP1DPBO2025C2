import java.util.Scanner;

class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        PetShop toko = new PetShop();
        int pilihan;

        do {
            System.out.println("\nMenu:\n1. Tambah Data\n2. Tampilkan Data\n3. Ubah Data\n4. Hapus Data\n5. Cari Data\n6. Keluar\nPilih: ");
            pilihan = scanner.nextInt();
            scanner.nextLine(); // Mengonsumsi newline

            switch (pilihan) {
                case 1:
                    System.out.print("Masukkan Nama: ");
                    String nama = scanner.nextLine();
                    System.out.print("Masukkan Kategori: ");
                    String kategori = scanner.nextLine();
                    System.out.print("Masukkan Harga: ");
                    int harga = scanner.nextInt();
                    toko.tambahData(nama, kategori, harga);
                    break;
                case 2:
                    toko.tampilkanData();
                    break;
                case 3:
                    System.out.print("Masukkan ID yang ingin diubah: ");
                    int idUbah = scanner.nextInt();
                    scanner.nextLine(); // Mengonsumsi newline
                    System.out.print("Masukkan Nama baru: ");
                    String namaBaru = scanner.nextLine();
                    System.out.print("Masukkan Kategori baru: ");
                    String kategoriBaru = scanner.nextLine();
                    System.out.print("Masukkan Harga baru: ");
                    int hargaBaru = scanner.nextInt();
                    toko.ubahData(idUbah, namaBaru, kategoriBaru, hargaBaru);
                    break;
                case 4:
                    System.out.print("Masukkan ID yang ingin dihapus: ");
                    int idHapus = scanner.nextInt();
                    toko.hapusData(idHapus);
                    break;
                case 5:
                    System.out.print("Masukkan Nama yang dicari: ");
                    String namaCari = scanner.nextLine();
                    toko.cariData(namaCari);
                    break;
                case 6:
                    System.out.println("Keluar...");
                    break;
                default:
                    System.out.println("Pilihan tidak valid!");
            }
        } while (pilihan != 6);

        scanner.close();
    }
}
