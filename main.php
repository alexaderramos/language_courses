<?php

/**
 * Main entry point for the console application
 * 
 * This script handles command line arguments and search functionality
 */

// Require autoload file
require_once __DIR__ . '/vendor/autoload.php';

use App\Service\SearchService;

/**
 * Display the usage instruction
 */
function displayUsage(): void
{
    echo "Uso: php main.php search <término de búsqueda>" . PHP_EOL;
    echo "El término de búsqueda debe tener al menos 3 caracteres." . PHP_EOL;
}

/**
 * Main execution function
 * 
 * @param array $args Command line arguments
 * @return int Exit code
 */
function main(array $args): int
{
    // Validate arguments
    if (count($args) < 3 || $args[1] !== 'search') {
        displayUsage();
        return 1;
    }
    
    // Get search term from arguments
    $term = $args[2];
    
    // Validate search term length
    if (strlen($term) < 3) {
        echo "Error: El término de búsqueda debe tener al menos 3 caracteres." . PHP_EOL;
        displayUsage();
        return 1;
    }
    
    try {
        // Create search service and execute search
        $searchService = new SearchService();
        $results = $searchService->search($term);
        
        // Display results
        if (count($results) > 0) {
            foreach ($results as $result) {
                echo $result->format() . PHP_EOL;
            }
            return 0;
        } else {
            echo "No se encontraron resultados para: '{$term}'" . PHP_EOL;
            return 0;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . PHP_EOL;
        return 1;
    }
}

// Run the application
exit(main($argv));
