
<?php
session_start();
require_once '../../../Database.php'; // Đảm bảo đường dẫn đến Database.php là chính xác

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db = Database::connect();
$newsList = $db->query("SELECT * FROM news ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quản Trị Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="container mt-5">
    <h1>Dashboard - Quản Trị Viên</h1>
    <p>Chào mừng bạn đến với trang quản trị. Đây là nơi quản lý các bài viết tin tức.</p>

    <!-- Nút Đăng Xuất -->
    <a href="../../index.php" class="btn btn-danger mb-4">Đăng Xuất</a>

    <!-- Quản lý tin tức -->
    <div class="row">
        <a href="news/add.php" class="btn btn-primary">Thêm tin tức</a>
    </div>

    <!-- Danh sách tin tức -->
    <h3 class="mt-4">Danh sách tin tức</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Ngày tạo</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($newsList): ?>
                    <?php foreach ($newsList as $news): ?>
                        <tr>
                            <td><?= htmlspecialchars($news['id']) ?></td>
                            <td><?= htmlspecialchars($news['title']) ?></td>
                            <td><?= htmlspecialchars($news['created_at']) ?></td>
                            <td>
                                <a href="news/edit.php?id=<?= $news['id'] ?>" class="btn btn-warning">Sửa</a>
                                <a href="news/delete.php?id=<?= $news['id'] ?>" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có dữ liệu nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>