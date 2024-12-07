<?php
include('../../header.php');
include('../../Database.php');

$db = Database::connect();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $query = "SELECT * FROM news WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        $news = null;
    }
} else {
    $news = null;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết tin tức</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($news) && $news): ?>
            <h1 class="mb-4"><?= htmlspecialchars($news['title']) ?></h1>
            <p class="text-muted">Ngày đăng: <?= htmlspecialchars($news['created_at']) ?></p>
            <?php if (!empty($news['image'])): ?>
                <img src="<?= htmlspecialchars($news['image']) ?>" class="img-fluid mb-4" alt="<?= htmlspecialchars($news['title']) ?>">
            <?php endif; ?>
            <div class="content">
                <p><?= nl2br(htmlspecialchars($news['content'])) ?></p>
            </div>
            <a href="index.php?controller=home&action=index" class="btn btn-secondary mt-3">Quay lại</a>
        <?php else: ?>
            <div class="alert alert-danger">
                <h4>Không tìm thấy bài viết!</h4>
                <p>Bài viết bạn tìm không tồn tại hoặc đã bị xóa.</p>
                <a href="index.php?controller=home&action=index" class="btn btn-primary">Về trang chủ</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
