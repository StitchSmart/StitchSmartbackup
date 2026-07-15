<?php
echo "DB_HOST: " . (getenv('DB_HOST') ?: 'not set') . "\n";
echo "MYSQLHOST: " . (getenv('MYSQLHOST') ?: 'not set') . "\n";
echo "MYSQL_HOST: " . (getenv('MYSQL_HOST') ?: 'not set') . "\n";
echo "MAIL_HOST: " . (getenv('MAIL_HOST') ?: 'not set') . "\n";
?>
