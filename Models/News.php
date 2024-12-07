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

    public static function add($title, $category_id, $content, $image) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO news (title, category_id, content, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $category_id, $content, $image]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM news WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function edit($id, $title, $category_id, $content, $image) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE news SET title = ?, category_id = ?, content = ?, image = ? WHERE id = ?");
        $stmt->execute([$title, $category_id, $content, $image, $id]);
    }

    public function index() {
        $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

        $db = Database::connect();

        if ($searchQuery != '') {
            $query = "SELECT * FROM news WHERE title LIKE :query OR content LIKE :query ORDER BY created_at DESC";
            $stmt = $db->prepare($query);
            $stmt->execute(['query' => "%$searchQuery%"]);
        } else {
            $query = "SELECT * FROM news ORDER BY created_at DESC";
            $stmt = $db->query($query);
        }

        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'views/home/index.php';
    }
}
?>