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

    private static ?mysqli $sharedConn = null;
    public mysqli $conn;

    public function __construct()
    {
        $this->host     = env('MYSQLHOST', env('MYSQL_HOST', env('DB_HOST', 'localhost')));
        $this->port     = (int) env('MYSQLPORT', env('MYSQL_PORT', env('DB_PORT', 3306)));
        $this->username = env('MYSQLUSER', env('MYSQL_USER', env('DB_USER', 'root')));
        $this->password = env('MYSQLPASSWORD', env('MYSQL_PASSWORD', env('DB_PASS', '')));
        $this->dbname   = env('MYSQLDATABASE', env('MYSQL_DATABASE', env('DB_NAME', 'StitchSmart')));
    }

    /**
     * Open and return a mysqli connection.
     * Terminates with an error message if the connection fails.
     */
    public function connect(): mysqli
    {
        if (self::$sharedConn !== null) {
            try {
                if (@self::$sharedConn->ping()) {
                    $this->conn = self::$sharedConn;
                    return self::$sharedConn;
                }
            } catch (Exception $e) {
                // Connection dropped, reconnect
            }
        }

        if (!class_exists('mysqli')) {
            die('Database connection failed: PHP extension "mysqli" is not installed or enabled on this server.');
        }

        try {
            if (function_exists('mysqli_report')) {
                mysqli_report(MYSQLI_REPORT_OFF);
            }
            self::$sharedConn = @new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->dbname,
                $this->port
            );

            if (self::$sharedConn->connect_error) {
                die('Database connection failed: ' . self::$sharedConn->connect_error);
            }

            self::$sharedConn->set_charset('utf8mb4');
            $this->conn = self::$sharedConn;
            return self::$sharedConn;
        } catch (Exception $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
}