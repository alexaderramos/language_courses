<?php

namespace App\Repository;

use App\Database\Connection;
use App\Interface\SearchableInterface;
use PDO;

/**
 * Abstract Resource Repository
 * 
 * Base repository for resource entities
 */
abstract class ResourceRepository implements SearchableInterface
{
    /**
     * @var PDO Database connection
     */
    protected PDO $connection;
    
    /**
     * @var string Table name
     */
    protected string $table;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }
    
    /**
     * Search for resources by name
     * 
     * @param string $term The search term (minimum 3 characters)
     * @return array Array of resources
     */
    public function search(string $term): array
    {
        // Validate term length
        if (strlen($term) < 3) {
            return [];
        }
        
        // Create search pattern with '%' wildcards
        $searchPattern = '%' . $term . '%';
        
        // The specific query will be implemented by child classes
        return $this->executeSearch($searchPattern);
    }
    
    /**
     * Execute the search query
     * 
     * @param string $searchPattern The search pattern to use
     * @return array Search results
     */
    abstract protected function executeSearch(string $searchPattern): array;
}
