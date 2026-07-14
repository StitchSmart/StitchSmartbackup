<?php
require_once __DIR__ . '/../../config/database.php';

class Admin {
    private $conn;

    public function __construct($database) {
        $this->conn = $database->connect(); // mysqli connection
    }

    public function checkLogin($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows !== 1) {
            return false;
        }

        $admin = $result->fetch_assoc();
        $storedPassword = $admin['password'];
        $hashInfo = password_get_info($storedPassword);

        if (password_verify($password, $storedPassword)) {
            return $admin;
        }

        if ($hashInfo['algo'] === 0 && $password === $storedPassword) {
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $migrate = $this->conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
            $migrate->bind_param("si", $newHash, $admin['id']);
            $migrate->execute();
            return $admin;
        }

        return false; // login failed
    }

    public function getAdminByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function updatePassword($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        return $stmt->execute();
    }

    public function updateResetToken($email, $token, $expiry) {
        // Optional support for reset tokens if the admin table is extended.
        $stmt = $this->conn->prepare("UPDATE admin SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $stmt->bind_param("sis", $token, $expiry, $email);
        return $stmt->execute();
    }

    public function getAdminByResetToken($token) {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE reset_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            return $result->fetch_assoc();
        }
        return false;
    }
}