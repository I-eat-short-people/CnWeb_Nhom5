class LogoutController {
    public function logout() {
        session_start();
        session_destroy(); // Hủy session
        header('Location: login'); // Chuyển hướng đến trang đăng nhập
        exit;
    }
}