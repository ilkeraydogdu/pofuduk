<?php
require_once '../../app/config/DB.php';

class urunModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function getAllUrunler() {
        $query = "SELECT u.*, k.kategori_adi FROM urunler u LEFT JOIN kategoriler k ON u.kategori_id = k.id WHERE u.durum = 'aktif'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPasifUrunler() {
        $query = "SELECT * FROM urunler WHERE durum = 'pasif'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function aktifYap($urunId) {
        $stmt = $this->db->prepare("UPDATE urunler SET durum = 'aktif' WHERE id = :urunId");
        $stmt->bindParam(":urunId", $urunId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function pasifYap($urunId) {
        $stmt = $this->db->prepare("UPDATE urunler SET durum = 'pasif' WHERE id = :urunId");
        $stmt->bindParam(":urunId", $urunId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getir($urunId) {
        $stmt = $this->db->prepare("SELECT * FROM urunler WHERE id = :urunId");
        $stmt->bindParam(":urunId", $urunId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchUrunler($searchTerm) {
        $stmt = $this->db->prepare("SELECT * FROM urunler WHERE (isim LIKE :searchTerm OR sKodu LIKE :searchTerm) AND durum = 'aktif'");
        $stmt->execute([':searchTerm' => "%$searchTerm%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUrunlerByKategori($kategori_id) {
        $stmt = $this->db->prepare("SELECT u.*, k.kategori_adi FROM urunler u LEFT JOIN kategoriler k ON u.kategori_id = k.id WHERE u.kategori_id = :kategori_id AND u.durum = 'aktif'");
        $stmt->execute([':kategori_id' => $kategori_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAltKategoriler($kategori_id) {
        $stmt = $this->db->prepare("SELECT * FROM kategoriler WHERE ust_kategori = :kategori_id");
        $stmt->execute([':kategori_id' => $kategori_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
