<?php

namespace App\Interface;

/**
 * Interface for searchable resources
 * 
 * Defines methods that must be implemented by searchable resources
 */
interface SearchableInterface
{
    /**
     * Search for resources matching the given term.
     */
    public function search(string $term): array;
}
