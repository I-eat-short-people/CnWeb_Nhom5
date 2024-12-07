<?php
require_once "Database.php";

class News {
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM news ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   