<?php

namespace App\Repository;

use App\Entity\Exam;
use PDO;

/**
 * Exam Repository
 *
 * Handles database operations for exams
 */
class ExamRepository extends ResourceRepository
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = 'exams';
    }

    /**
     * Execute search query for exams
     *
     * @param string $searchPattern Search pattern
     * @return array Array of Exam objects
     */
    protected function executeSearch(string $searchPattern): array
    {
        $stmt = $this->connection->prepare(
            "SELECT id, name, type FROM {$this->table} WHERE name LIKE :pattern"
        );

        $stmt->bindParam(':pattern', $searchPattern, PDO::PARAM_STR);
        $stmt->execute();

        $exams = [];
        while ($row = $stmt->fetch()) {
            $exams[] = new Exam(
                $row['id'],
                $row['name'],
                $row['type']
            );
        }

        return $exams;
    }
}
