<?php
include('Database.php');
$db = Database::connect();

$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

if ($searchQuery != '') {
    $query = "SELECT * FROM news WHERE title LIKE :query OR content LIKE :query";
    $stmt = $db->prepare($query);
    $stmt->execute(['query' => "%$searchQuery%"]);
    
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($news) {
        foreach ($news as $item) {
            echo '<div class="card">';
            echo '<img src="' . htmlspecialchars($item['image']) . '" class="card-img-top" alt="' . htmlspecialchars($item['title']) . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($item['title']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars(substr($item['content'], 0, 100)) . '...</p>';
            echo '<a href="detail.php?id=' . $item['id'] . '" class="btn btn-primary">Đọc tiếp</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'Không tìm thấy kết quả nào.';
    }
} else {
    echo 'Vui lòng nhập từ khóa tìm kiếm.';
}
?>
