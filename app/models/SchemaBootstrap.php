<?php

class SchemaBootstrap
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
        $this->ensureWishlistTableExists();
        $this->ensureEmailLogsTableExists();
        $this->ensureCartTableExists();
        $this->ensureJazzCashTableExists();
    }

    private function ensureJazzCashTableExists(): void
    {
        $result = $this->conn->query("SHOW TABLES LIKE 'jazzcash_accounts'");
        if (!$result || $result->num_rows === 0) {
            $this->conn->query(
                "CREATE TABLE jazzcash_accounts (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    mobile VARCHAR(15) NOT NULL UNIQUE,
                    mpin VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );
        }
    }

    private function ensureWishlistTableExists(): void
    {
        $result = $this->conn->query("SHOW TABLES LIKE 'wishlists'");

        if (!$result || $result->num_rows === 0) {
            $this->conn->query(
                "CREATE TABLE wishlists (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT UNSIGNED NOT NULL,
                    product_id INT NOT NULL,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    UNIQUE KEY uniq_user_product (user_id, product_id),
                    KEY idx_user_id (user_id),
                    KEY idx_product_id (product_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );
        }
    }

    private function ensureEmailLogsTableExists(): void
    {
        $result = $this->conn->query("SHOW TABLES LIKE 'email_logs'");

        if (!$result || $result->num_rows === 0) {
            $this->conn->query(
                "CREATE TABLE email_logs (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    recipient_email VARCHAR(255) NOT NULL,
                    subject VARCHAR(255) NOT NULL,
                    template_name VARCHAR(100) DEFAULT NULL,
                    status ENUM('queued', 'sent', 'failed') NOT NULL DEFAULT 'queued',
                    error_message TEXT DEFAULT NULL,
                    sent_at DATETIME DEFAULT NULL,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    KEY idx_status_created (status, created_at),
                    KEY idx_recipient_email (recipient_email)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );
        }
    }

    private function ensureCartTableExists(): void
    {
        $result = $this->conn->query("SHOW TABLES LIKE 'cart_items'");

        if (!$result || $result->num_rows === 0) {
            $this->conn->query(
                "CREATE TABLE cart_items (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT UNSIGNED NOT NULL,
                    product_id INT NOT NULL,
                    qty INT NOT NULL DEFAULT 1,
                    size VARCHAR(100) DEFAULT '',
                    fabric VARCHAR(100) DEFAULT '',
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    KEY idx_user_id (user_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );
        }
    }

    public function syncCartToDb(int $userId, array $cart): bool
    {
        $this->ensureCartTableExists();

        $stmtDel = $this->conn->prepare("DELETE FROM cart_items WHERE user_id = ?");
        if (!$stmtDel) {
            return false;
        }
        $stmtDel->bind_param('i', $userId);
        $stmtDel->execute();
        $stmtDel->close();

        if (empty($cart)) {
            return true;
        }

        $stmtIns = $this->conn->prepare("INSERT INTO cart_items (user_id, product_id, qty, size, fabric) VALUES (?, ?, ?, ?, ?)");
        if (!$stmtIns) {
            return false;
        }

        foreach ($cart as $productId => $item) {
            $qty = (int)($item['qty'] ?? 1);
            $size = $item['size'] ?? '';
            $fabric = $item['fabric'] ?? '';
            $stmtIns->bind_param('iiiss', $userId, $productId, $qty, $size, $fabric);
            $stmtIns->execute();
        }
        $stmtIns->close();

        return true;
    }

    public function loadCartFromDb(int $userId): array
    {
        $this->ensureCartTableExists();

        $sql = "
            SELECT c.product_id, c.qty, c.size, c.fabric,
                   p.name, p.price, p.image_url
            FROM cart_items c
            LEFT JOIN product p ON p.id = c.product_id
            WHERE c.user_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $cart = [];

        while ($row = $result->fetch_assoc()) {
            $productId = (int)$row['product_id'];
            $cart[$productId] = [
                'id' => $productId,
                'name' => $row['name'] ?? 'Unknown Product',
                'price' => $row['price'] ?? 0.0,
                'image' => $row['image_url'] ?? '',
                'qty' => (int)$row['qty'],
                'size' => $row['size'],
                'fabric' => $row['fabric']
            ];
        }

        $stmt->close();
        return $cart;
    }

    public function addWishlistItem(int $userId, int $productId): bool
    {
        $this->ensureWishlistTableExists();

        $stmt = $this->conn->prepare("INSERT INTO wishlists (user_id, product_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE created_at = CURRENT_TIMESTAMP");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ii', $userId, $productId);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function removeWishlistItem(int $userId, int $productId): bool
    {
        $this->ensureWishlistTableExists();

        $stmt = $this->conn->prepare("DELETE FROM wishlists WHERE user_id = ? AND product_id = ?");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ii', $userId, $productId);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function isWishlisted(int $userId, int $productId): bool
    {
        $this->ensureWishlistTableExists();

        $stmt = $this->conn->prepare("SELECT id FROM wishlists WHERE user_id = ? AND product_id = ? LIMIT 1");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('ii', $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $isWishlisted = $result->num_rows > 0;
        $stmt->close();

        return $isWishlisted;
    }

    public function getWishlistEntries(): array
    {
        $this->ensureWishlistTableExists();

        $sql = "
            SELECT w.id, w.user_id, w.product_id, w.created_at,
                   COALESCE(u.name, 'Unknown Customer') AS customer_name,
                   COALESCE(u.email, 'Unknown Customer') AS customer_email,
                   COALESCE(p.name, 'Unknown Product') AS product_name,
                   COALESCE(p.article_number, 'N/A') AS article_number,
                   COALESCE(p.image_url, '') AS image_url,
                   COALESCE(p.price, 0) AS price,
                   COALESCE(p.quantity, 0) AS quantity,
                   COALESCE(p.parent_cat, 0) AS parent_cat
            FROM wishlists w
            LEFT JOIN users u ON u.id = w.user_id
            LEFT JOIN product p ON p.id = w.product_id
            ORDER BY w.created_at DESC
        ";

        $result = $this->conn->query($sql);
        $entries = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $entries[] = $row;
            }
        }

        return $entries;
    }

    public function getWishlistEntriesForUser(int $userId): array
    {
        $this->ensureWishlistTableExists();

        $stmt = $this->conn->prepare(
            "SELECT w.id, w.user_id, w.product_id, w.created_at,
                    COALESCE(u.name, 'Unknown Customer') AS customer_name,
                    COALESCE(u.email, 'Unknown Customer') AS customer_email,
                    COALESCE(p.name, 'Unknown Product') AS product_name,
                    COALESCE(p.article_number, 'N/A') AS article_number,
                    COALESCE(p.image_url, '') AS image_url,
                    COALESCE(p.price, 0) AS price,
                    COALESCE(p.quantity, 0) AS quantity,
                    COALESCE(p.parent_cat, 0) AS parent_cat
             FROM wishlists w
             LEFT JOIN users u ON u.id = w.user_id
             LEFT JOIN product p ON p.id = w.product_id
             WHERE w.user_id = ?
             ORDER BY w.created_at DESC"
        );

        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $entries = [];

        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }

        $stmt->close();

        return $entries;
    }

    public function getWishlistProductIdsForUser(int $userId): array
    {
        $this->ensureWishlistTableExists();

        $stmt = $this->conn->prepare("SELECT product_id FROM wishlists WHERE user_id = ?");
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $productIds = [];

        while ($row = $result->fetch_assoc()) {
            $productIds[] = (int) $row['product_id'];
        }

        $stmt->close();

        return $productIds;
    }

    public function logEmail(string $recipientEmail, string $subject, string $status = 'queued', ?string $templateName = null, ?string $errorMessage = null): bool
    {
        $this->ensureEmailLogsTableExists();

        $stmt = $this->conn->prepare(
            "INSERT INTO email_logs (recipient_email, subject, template_name, status, error_message) VALUES (?, ?, ?, ?, ?)"
        );

        if (!$stmt) {
            return false;
        }

        $safeTemplateName = $templateName ?? '';
        $safeErrorMessage = $errorMessage ?? '';

        $stmt->bind_param('sssss', $recipientEmail, $subject, $safeTemplateName, $status, $safeErrorMessage);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
