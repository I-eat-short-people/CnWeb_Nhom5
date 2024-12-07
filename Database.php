<?php

class Database {
    private static $instance = null;
    private static $host = 'localhost'; 
    private static $dbName = 'tintuc';
    private static $username = 'root'; 
    private static $password = ''; 

    // Hàm kết nối đến cơ sở dữ liệu
    public static function connect() {
        if (self::$instance === null) {
            try {
                // Tạo kết nối PDO
                self::$instance = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=utf8",
                    self::$username,
                    self::$password
                );
                // Thiết lập chế độ báo lỗi
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Thiết lập chế độ lấy dữ liệu mặc định
            } catch (PDOException $e) {
                // Ghi log lỗi vào file thay vì hiển thị ra màn hình
                error_log("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
                die("Không thể kết nối đến cơ sở dữ liệu.");
            }
        }
        return self::$instance;
    }

    // Hàm ngắt kết nối
    public static function disconnect() {
        self::$instance = null;
    }
}

?>