<?php
session_start();
require_once '../../../Database.php'; // Đảm bảo đường dẫn đến Database.php là chính xác

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = Database::connect();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Truy vấn để xóa bài viết
    $deleteQuery = "DELETE FROM news WHERE id = ?";
    $stmt = $db->prepare($deleteQuery);
    $stmt->execute([$id]);

    // Điều hướng về trang dashboard sau khi xóa thành công
    header("Location: ../../admin/dashboard.php");
    exit();
} else {
    die("ID không hợp lệ.");
}