<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Database Connection class
 * 
 * Implements Singleton pattern for database connections
 */
class Connection
{
    /**
     * @var PDO|null The PDO instance
     */
    private static ?PDO $instance = null;
    
    /**
     * Private constructor to prevent direct instantiation
     */
    private function __construct()
    {
        // Private constructor for singleton pattern
    }
    
    /**
     * Get database connection instance
     * 
     * @return PDO
     * @throws PDOException If connection fails
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../config/database.php';
            
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s;port=%d',
                $config['host'],
                $config['database'],
                $config['charset'],
                $config['port']
            );
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            try {
                self::$instance = new PDO(
                    $dsn,
                    $config['username'],
                    $config['password'],
                    $options
                );
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage() . PHP_EOL;
                throw $e;
            }
        }
        
        return self::$instance;
    }
    
    /**
     * Prevent cloning of the instance
     */
    private function __clone()
    {
        // Prevent object cloning
    }
}
