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
    $query = "SELECT * FROM news WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        die("Bài viết không tồn tại.");
    }
} else {
    die("ID không hợp lệ.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category'];

    // Kiểm tra nếu có hình ảnh mới được tải lên
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    } else {
        $image = $news['image']; // Giữ lại hình ảnh cũ
    }

    // Cập nhật bài viết
    $updateQuery = "UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?";
    $stmt = $db->prepare($updateQuery);
    $stmt->execute([$title, $content, $image, $category_id, $id]);

    // Điều hướng về trang dashboard sau khi cập nhật thành công
    header("Location: ../../admin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Tin Tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Sửa Tin Tức</h1>
        <form action="edit.php?id=<?= $news['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($news['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control" id="content" name="content" required><?= htmlspecialchars($news['content']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="uploads/<?= htmlspecialchars($news['image']) ?>" alt="Hình ảnh cũ" class="img-fluid mt-2" style="max-width: 200px;">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>
</html>