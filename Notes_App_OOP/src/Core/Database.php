<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $dbname = 'myapp';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4'; // ✅ Fixed syntax error (used `=` instead of `=>`)

    private $conn;

    public function connect() {
        try {
            // ✅ Corrected DSN formatting (removed unnecessary commas)
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            
            // ✅ Removed extra commas and concatenation errors
            $pdo = new PDO($dsn, $this->username, $this->password);

            // ✅ Set error mode for better debugging
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            return $pdo; // ✅ Removed unnecessary `$ $pdo`
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }
}
