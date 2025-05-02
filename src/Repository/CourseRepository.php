<?php

namespace App\Repository;

use App\Entity\Course;
use PDO;

/**
 * Course Repository
 *
 * Handles database operations for courses
 */
class CourseRepository extends ResourceRepository
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = 'courses';
    }

    /**
     * Execute search query for courses
     *
     * @param string $searchPattern Search pattern
     * @return array Array of Course objects
     */
    protected function executeSearch(string $searchPattern): array
    {
        $stmt = $this->connection->prepare(
            "SELECT id, name, rating FROM {$this->table} WHERE name LIKE :pattern"
        );

        $stmt->bindParam(':pattern', $searchPattern, PDO::PARAM_STR);
        $stmt->execute();

        $courses = [];
        while ($row = $stmt->fetch()) {
            $courses[] = new Course(
                $row['id'],
                $row['name'],
                $row['rating']
            );
        }

        return $courses;
    }
}
