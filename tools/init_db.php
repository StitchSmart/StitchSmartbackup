<?php
// Database initialization script
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use default mysqli directly without our Database class
$connection = new mysqli('localhost', 'root', '', 'StitchSmart', 3306);

if ($connection->connect_error) {
    // Database doesn't exist, create it
    $adminConn = new mysqli('localhost', 'root', '');
    if ($adminConn->connect_error) {
        die('Failed to connect to MySQL: ' . $adminConn->connect_error);
    }
    
    echo "Creating database 'StitchSmart'...\n";
    if (!$adminConn->query("CREATE DATABASE IF NOT EXISTS StitchSmart")) {
        die('CREATE DATABASE failed: ' . $adminConn->error);
    }
    
    $adminConn->close();
    
    // Now connect to the new database
    $connection = new mysqli('localhost', 'root', '', 'StitchSmart', 3306);
    if ($connection->connect_error) {
        die('Failed to connect to StitchSmart: ' . $connection->connect_error);
    }
}

$connection->set_charset('utf8mb4');

// Read the SQL dump
$sqlFile = __DIR__ . '/db/vigorean (1).sql';
if (!file_exists($sqlFile)) {
    die('SQL dump file not found: ' . $sqlFile);
}

$sql = file_get_contents($sqlFile);

// Remove the "USE vigorean;" line and replace with our database
$sql = str_replace('USE `vigorean`;', 'USE `StitchSmart`;', $sql);

// Split into individual statements
$statements = preg_split('/;[\r\n]+/', $sql);

$count = 0;
$errors = [];

foreach ($statements as $statement) {
    $statement = trim($statement);
    if (empty($statement)) {
        continue;
    }
    
    if ($connection->query($statement) === true) {
        $count++;
    } else {
        $errors[] = 'Error: ' . $connection->error;
    }
}

echo "Database initialization complete!\n";
echo "Executed: " . $count . " statements\n";

if (count($errors) > 0) {
    echo "\nErrors encountered:\n";
    foreach ($errors as $error) {
        echo "- " . $error . "\n";
    }
} else {
    echo "No errors!\n";
}

// Verify tables exist
echo "\nVerifying tables:\n";
$result = $connection->query("SHOW TABLES");
if ($result) {
    $tableCount = $result->num_rows;
    echo "Tables created: " . $tableCount . "\n";
    while ($row = $result->fetch_row()) {
        echo "  - " . $row[0] . "\n";
    }
} else {
    echo 'SHOW TABLES failed: ' . $connection->error;
}

$connection->close();
?>
