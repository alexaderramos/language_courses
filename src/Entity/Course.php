<?php

namespace App\Entity;

/**
 * Course class
 *
 * Represents an online language course
 */
class Course extends Resource
{
    /**
     * @var float Course rating (out of 5)
     */
    private float $rating;

    /**
     * Constructor
     *
     * @param int $id Course ID
     * @param string $name Course name
     * @param float $rating Course rating
     */
    public function __construct(int $id, string $name, float $rating)
    {
        parent::__construct($id, $name);
        $this->rating = $rating;
        $this->type = 'Clase';
    }

    /**
     * Get course rating
     *
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * Format course for display
     *
     * @return string Formatted string representation
     */
    public function format(): string
    {
        return sprintf("%s: %s | %.1f/5", $this->type, $this->name, $this->rating);
    }
}
