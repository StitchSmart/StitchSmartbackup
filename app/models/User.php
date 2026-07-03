<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->connect();
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $storedHash = $user['password_hash'];
            $hashInfo = password_get_info($storedHash);

            if (password_verify($password, $storedHash)) {
                if ($hashInfo['algo'] === 0) {
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $migrate = $this->conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
                    $migrate->bind_param("si", $newHash, $user['id']);
                    $migrate->execute();
                }

                $update = $this->conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $update->bind_param("i", $user['id']);
                $update->execute();
                return $user;
            }

            if ($hashInfo['algo'] === 0 && $password === $storedHash) {
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $migrate = $this->conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
                $migrate->bind_param("si", $newHash, $user['id']);
                $migrate->execute();

                $update = $this->conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $update->bind_param("i", $user['id']);
                $update->execute();
                return $user;
            }
        }
        return false;
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function getUserByPhone($phone) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function updatePassword($id, $newPasswordHash) {
        $stmt = $this->conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->bind_param("si", $newPasswordHash, $id);
        return $stmt->execute();
    }

    public function register($name, $phone, $email, $passwordHash) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, phone, email, password_hash, is_verified) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("ssss", $name, $phone, $email, $passwordHash);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }
}
?>
