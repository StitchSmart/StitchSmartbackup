<?php

class Voucher {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->ensureTableExists();
    }

    private function ensureTableExists()
    {
        $result = $this->conn->query("SHOW TABLES LIKE 'vouchers'");
        if (!$result || $result->num_rows === 0) {
            $this->conn->query(
                "CREATE TABLE vouchers (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    customer_name VARCHAR(255) NULL,
                    code VARCHAR(60) NOT NULL UNIQUE,
                    discount_percent INT NOT NULL,
                    redeemed TINYINT(1) NOT NULL DEFAULT 0,
                    order_id INT NULL,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    redeemed_at DATETIME NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
            );
        }
    }

    public function createVoucher(string $email, string $customerName, string $code, int $discountPercent): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO vouchers (email, customer_name, code, discount_percent) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sssi', $email, $customerName, $code, $discountPercent);
        return $stmt->execute();
    }

    public function getVoucherByCode(string $code): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM vouchers WHERE code = ? LIMIT 1");
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public function markRedeemed(int $id, int $orderId): bool
    {
        $stmt = $this->conn->prepare("UPDATE vouchers SET redeemed = 1, order_id = ?, redeemed_at = NOW() WHERE id = ?");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ii', $orderId, $id);
        return $stmt->execute();
    }

    public function generateUniqueCode(string $seed = 'STITCH'): string
    {
        $prefix = strtoupper(preg_replace('/[^A-Z0-9]/', '', $seed));
        if ($prefix === '') {
            $prefix = 'STITCH';
        }

        for ($attempt = 0; $attempt < 10; $attempt++) {
            $code = $prefix . rand(10, 99) . chr(rand(65, 90)) . chr(rand(65, 90));
            if (!$this->getVoucherByCode($code)) {
                return $code;
            }
        }

        do {
            $code = $prefix . strtoupper(bin2hex(random_bytes(3)));
        } while ($this->getVoucherByCode($code));

        return $code;
    }
}
