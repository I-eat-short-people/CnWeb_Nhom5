<?php

require_once "models/News.php"; 
require_once "models/Category.php"; 

class HomeController {
    public function index() {
        $news = News::getAll();
        $categories = Category::getAll();
        
        include "views/home/index.php";
    }

    public function search() {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $news = News::searchByKeyword($keyword);
        } else {
            $news = [];
        }

        include "views/home/search.php";
    }

    public function detail() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $news = News::getById($id);
        } else {
            header("Location: index.php?controller=home&action=index");
            exit();
        }

        include "views/news/detail.php";
    }
}

?>
