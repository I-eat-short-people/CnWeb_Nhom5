<?php
require_once "models/News.php";

class NewsController {
    public function index() {
        $news = News::getAll();
        include "views/admin/news/index.php";
    }

   