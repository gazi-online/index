<?php
// includes/db.php - PostgreSQL Connection Utility

require_once __DIR__ . '/../.env.php';

class Database
{
    private $pdo;
    private $error;

    public function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $db   = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        // Use pooling URL for PostgreSQL connection
        // Note: Supabase pooler usually works on port 6543
        $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";

        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            error_log("Database Connection Error: " . $this->error);
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function getError()
    {
        return $this->error;
    }

    public function isConnected()
    {
        return $this->pdo !== null;
    }

    // Helper for SELECT queries
    public function query($sql, $params = [])
    {
        if (!$this->isConnected()) return [];
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Query Error: " . $e->getMessage());
            return [];
        }
    }

    // Helper for INSERT/UPDATE/DELETE
    public function execute($sql, $params = [])
    {
        if (!$this->isConnected()) return false;
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Execute Error: " . $e->getMessage());
            return false;
        }
    }
}
?>
