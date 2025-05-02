<?php

namespace App\Service;

use App\Interface\SearchableInterface;
use App\Repository\CourseRepository;
use App\Repository\ExamRepository;

/**
 * Search Service
 *
 * Service to search across multiple repositories
 */
class SearchService
{
    /**
     * @var SearchableInterface[] Array of searchable repositories
     */
    private array $repositories;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Initialize repositories
        $this->repositories = [
            new CourseRepository(),
            new ExamRepository()
        ];
    }

    /**
     * Search across all repositories
     *
     * @param string $term Search term
     * @return array Combined search results
     */
    public function search(string $term): array
    {
        $results = [];

        // Search in each repository
        foreach ($this->repositories as $repository) {
            $repositoryResults = $repository->search($term);
            $results = array_merge($results, $repositoryResults);
        }

        return $results;
    }
}
