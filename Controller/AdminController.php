
<?php
require 'models/News.php'; // Model quản lý bài viết
require 'models/Category.php'; // Model quản lý danh mục

class AdminController {
    public function dashboard() {
        checkAdmin(); // Đảm bảo chỉ admin mới truy cập được
        require 'views/admin/dashboard.php'; // Giao diện dashboard
    }

    // Quản lý bài viết
    public function manageNews() {
        checkAdmin();
        $newsModel = new News();
        $newsList = $newsModel->getAllNews(); // Lấy danh sách bài viết
        require 'views/admin/news/index.php'; // Hiển thị danh sách bài viết
    }

    public function addNews() {
        checkAdmin();
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories(); // Lấy danh sách danh mục

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $newsModel = new News();
            $newsModel->addNews($title, $content, $category_id); // Thêm bài viết mới
            header('Location: manageNews');
            exit;
        }
        require 'views/admin/news/add.php'; // Giao diện thêm bài viết
    }

    public function deleteNews($id) {
        checkAdmin();
        $newsModel = new News();
        $newsModel->deleteNews($id); // Xóa bài viết theo ID
        header('Location: manageNews');
        exit;
    }
}
