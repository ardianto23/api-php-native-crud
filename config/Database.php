<?php
class Database {
    private static $instance = null;

    private static $dbHost = '127.0.0.1';
    private static $dbPort = '3306';
    private static $dbName = 'ardianto';
    private static $dbUser = 'root';
    private static $dbPass = '';

    private function __construct() {}
    private function __clone() {}

    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            $dsn = "mysql:host=" . self::$dbHost . ";port=" . self::$dbPort . ";dbname=" . self::$dbName . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instance = new PDO($dsn, self::$dbUser, self::$dbPass, $options);
            } catch (PDOException $e) {
                error_log('Database connection error: ' . $e->getMessage());
                throw new RuntimeException('Gagal terhubung ke database.');
            }
        }
        return self::$instance;
    }
}
