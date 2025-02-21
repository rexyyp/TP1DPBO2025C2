import java.util.ArrayList;
import java.util.List;

public class PetShop {
    private int id;
    private String nama;
    private String kategori;
    private int harga;
    private List<PetShop> produk = new ArrayList<>();

    public PetShop() {
        this.id = 0;
        this.nama = "";
        this.kategori = "";
        this.harga = 0;
    }

    public PetShop(int id, String nama, String kategori, int harga) {
        this.id = id;
        this.nama = nama;
        this.kategori = kategori;
        this.harga = harga;
    }

    public void setId(int id) { this.id = id; }
    public void setNama(String nama) { this.nama = nama; }
    public void setKategori(String kategori) { this.kategori = kategori; }
    public void setHarga(int harga) { this.harga = harga; }

    public int getId() { return id; }
    public String getNama() { return nama; }
    public String getKategori() { return kategori; }
    public int getHarga() { return harga; }

    public void tampilkan() {
        System.out.println("ID: " + id + " | Nama: " + nama + " | Kategori: " + kategori + " | Harga: " + harga);
    }

    public void tambahData(String nama, String kategori, int harga) {
        int id = produk.size() + 1;
        PetShop item = new PetShop(id, nama, kategori, harga);
        produk.add(item);
        System.out.println("Data berhasil ditambahkan dengan ID " + id + "!");
    }

    public void tampilkanData() {
        if (produk.isEmpty()) {
            System.out.println("Tidak ada data.");
            return;
        }
        for (PetShop item : produk) {
            item.tampilkan();
        }
    }

    public void ubahData(int id, String nama, String kategori, int harga) {
        for (PetShop item : produk) {
            if (item.getId() == id) {
                item.setNama(nama);
                item.setKategori(kategori);
                item.setHarga(harga);
                System.out.println("Data berhasil diubah!");
                return;
            }
        }
        System.out.println("Data tidak ditemukan!");
    }

    public void hapusData(int id) {
        for (int i = 0; i < produk.size(); i++) {
            if (produk.get(i).getId() == id) {
                produk.remove(i);
                System.out.println("Data berhasil dihapus!");
                return;
            }
        }
        System.out.println("Data tidak ditemukan!");
    }

    public void cariData(String nama) {
        for (PetShop item : produk) {
            if (item.getNama().equalsIgnoreCase(nama)) {
                item.tampilkan();
                return;
            }
        }
        System.out.println("Data tidak ditemukan!");
    }
}
