<?php

define("URL", "http://localhost/yedek");
define("DB_HOST", "localhost");
define("DB_DATABASE", "kabal");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

function getDbConnection() {
	try {
		$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=utf8", DB_USERNAME, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Hata modunu etkinleştir
        return $db;
    } catch (PDOException $e) {
    	error_log("Veritabanı bağlantısı hatası: " . $e->getMessage());
    	die("Veritabanına bağlanılamadı: " . $e->getMessage());
    }
}

// Global veritabanı bağlantısı
global $db;
$db = getDbConnection();

?>
