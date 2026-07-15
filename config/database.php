<?php
/**
 * Stitch Smart — Database Connection
 *
 * Reads credentials from environment variables (loaded by config.php).
 * Always require config.php before this file.
 */

class Database
{
    private string $host;
    private string $username;
    private string $password;
    private string $dbname;
    private int    $port;

    public mysqli $conn;

    public function __construct()
    {
        $this->host     = env('MYSQLHOST', env('MYSQL_HOST', env('DB_HOST', 'localhost')));
        $this->port     = (int) env('MYSQLPORT', env('MYSQL_PORT', env('DB_PORT', 3306)));
        $this->username = env('MYSQLUSER', env('MYSQL_USER', env('DB_USER', 'root')));
        $this->password = env('MYSQLPASSWORD', env('MYSQL_PASSWORD', env('DB_PASS', '')));
        $this->dbname   = env('MYSQLDATABASE', env('MYSQL_DATABASE', env('DB_NAME', 'StitchSmart')));

        // Self-healing check: Parse MYSQL_URL / DATABASE_URL if the host resolves to a mail server or is localhost (on Railway)
        $mysqlUrl = env('MYSQL_URL', env('DATABASE_URL'));
        if (!empty($mysqlUrl) && (str_contains($this->host, 'gmail.com') || str_contains($this->host, 'smtp') || (env('RAILWAY_ENVIRONMENT') && $this->host === 'localhost'))) {
            $parsed = parse_url($mysqlUrl);
            if ($parsed && !empty($parsed['host'])) {
                $this->host = $parsed['host'];
                if (!empty($parsed['port'])) {
                    $this->port = (int)$parsed['port'];
                }
                if (!empty($parsed['user'])) {
                    $this->username = $parsed['user'];
                }
                if (!empty($parsed['pass'])) {
                    $this->password = $parsed['pass'];
                }
                if (!empty($parsed['path'])) {
                    $this->dbname = ltrim($parsed['path'], '/');
                }
            }
        }
    }

    /**
     * Open and return a mysqli connection.
     * Terminates with an error message if the connection fails.
     */
    public function connect(): mysqli
    {
        try {
            $this->conn = @new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->dbname,
                $this->port
            );

            if ($this->conn->connect_error || mysqli_connect_error()) {
                $err = $this->conn->connect_error ?: mysqli_connect_error();
                $msg = 'Database connection failed: ' . $err . ' | Host: ' . $this->host . ' | Port: ' . $this->port . ' | User: ' . $this->username . ' | DB: ' . $this->dbname;
                die($msg);
            }

            $this->conn->set_charset('utf8mb4');
            return $this->conn;
        } catch (Throwable $e) {
            $envDumps = "MYSQLHOST: " . env('MYSQLHOST') . " | MYSQL_HOST: " . env('MYSQL_HOST') . " | DB_HOST: " . env('DB_HOST') . " | MAIL_HOST: " . env('MAIL_HOST');
            $msg = 'Database connection exception: ' . $e->getMessage() . ' | Host: ' . $this->host . ' | Port: ' . $this->port . ' | User: ' . $this->username . ' | DB: ' . $this->dbname . ' | Env: ' . $envDumps;
            die($msg);
        }
    }
}