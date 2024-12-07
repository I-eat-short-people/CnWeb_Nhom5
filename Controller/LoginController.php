<?php
require 'models/User.php'; // Model quản lý người dùng

class LoginController {
    public function showLoginForm() {
        require 'views/login.php'; // Giao diện đăng nhập
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->getUser ByUsername($username); // Lấy thông tin người dùng

            // Kiểm tra thông tin đăng nhập
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id']; // Lưu ID người dùng vào session
                header('Location: admin/dashboard'); // Chuyển hướng đến dashboard
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
            }
        }
        require 'views/login.php'; // Giao diện đăng nhập
    }
}