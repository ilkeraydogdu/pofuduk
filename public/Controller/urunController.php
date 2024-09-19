<?php
require_once '../Model/urunModel.php';
require_once '../../app/config/DB.php';

class urunController {
    private $urunModel;

    public function __construct() {
        $this->urunModel = new urunModel();
    }

    public function urunBilgileriniCek($urunId) {
        return $this->urunModel->getir($urunId);
    }

    public function search($searchTerm) {
        return $this->urunModel->searchUrunler($searchTerm);
    }

    public function getAllUrunler() {
        return $this->urunModel->getAllUrunler();
    }

    public function getPasifUrunler() {
        return $this->urunModel->getPasifUrunler();
    }

    public function detay($urunId) {
        return $this->urunModel->getir($urunId);
    }

    public function aktifYap($urunId) {
        return $this->urunModel->aktifYap($urunId);
    }

    public function pasifYap($urunId) {
        return $this->urunModel->pasifYap($urunId);
    }

    public function filterByKategori($kategori_id) {
        $urunler = $this->urunModel->getUrunlerByKategori($kategori_id);
        
        if (empty($urunler)) {
            $altKategoriler = $this->urunModel->getAltKategoriler($kategori_id);
            if (!empty($altKategoriler)) {
                $urunler = [];
                foreach ($altKategoriler as $altKategori) {
                    $altKategoriUrunler = $this->urunModel->getUrunlerByKategori($altKategori['id']);
                    if (!empty($altKategoriUrunler)) {
                        $urunler = array_merge($urunler, $altKategoriUrunler);
                    }
                }
            }
        }
        return $urunler;
    }
}
