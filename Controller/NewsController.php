<?php
require_once "models/News.php";

class NewsController {
    public function index() {
        $news = News::getAll();
        include "views/admin/news/index.php";
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image']['name'];
            $category_id = $_POST['category'];

            // Upload image
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);

            News::add($title, $category_id, $content, $image);
            header("Location: index.php?controller=news&action=index");
        } else {
            include "views/admin/news/add.php";
        }
    }

    public function edit($id) {
        $news = News::getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category'];

            // Check if a new image is uploaded
            if ($_FILES['image']['name']) {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
            } else {
                $image = $news['image']; // Keep the old image
            }

            News::edit($id, $title, $category_id, $content, $image);
            header("Location: index.php?controller=news&action=index");
        }
        include "views/admin/news/edit.php";
    }

    public function delete($id) {
        News::delete($id);
        header("Location: index.php?controller=news&action=index");
    }
}
?>