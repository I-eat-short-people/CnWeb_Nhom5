<?php
require 'Database.php';

class User {
    public function getUser ByUsername($username) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser ($username, $password, $role) {
        $db = Database::connect();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute(['username' => $username, 'password' => $hashedPassword, 'role' => $role]);
    }

    public function getAllUsers() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser ($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    public function authenticate($username, $password) {
        // Kiểm tra thông tin đăng nhập trong cơ sở dữ liệu
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['username' => $username, 'password' => md5($password)]);
        return $stmt->fetch();
    }
    
}
?>
