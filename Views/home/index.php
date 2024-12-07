<?php
include('../../header.php');
include('../../Database.php');

$db = Database::connect();

$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

if ($searchQuery != '') {
    $query = "SELECT * FROM news WHERE title LIKE :query OR content LIKE :query ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute(['query' => "%$searchQuery%"]);
} else {
    $query = "SELECT * FROM news ORDER BY created_at DESC";
    $stmt = $db->query($query);
}

$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1>Trang Người Dùng</h1>
    <p>Chào bạn, đây là danh sách tin tức.</p>
    
    <div class="row">
        <?php if ($news): ?>
            <?php foreach ($news as $item): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($item['content'], 0, 100)) ?>...</p>
                            <a href="../news/detail.php?id=<?= $item['id'] ?>" class="btn btn-primary">Đọc tiếp</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không tìm thấy kết quả nào.</p>
        <?php endif; ?>
    </div>
</div>

<?php include('../../footer.php'); ?>
