<?php

namespace Tests\Entity;

use App\Entity\Course;
use PHPUnit\Framework\TestCase;

/**
 * Test for Course entity
 */
class CourseTest extends TestCase
{
    /**
     * Scenary: Course creation and getters
     * Expected result: Course object with id, name, rating and type
     */
    public function testCourseCreation(): void
    {
        // Arrange
        $id = 1;
        $name = 'Inglés Básico';
        $rating = 4.5;

        // Act
        $course = new Course($id, $name, $rating);

        // Assert
        $this->assertEquals($id, $course->getId());
        $this->assertEquals($name, $course->getName());
        $this->assertEquals($rating, $course->getRating());
        $this->assertEquals('Clase', $course->getType());
    }

    /**
     * Scenary: Course format method
     * Expected result: Course formatted string
     */
    public function testCourseFormat(): void
    {
        // Arrange
        $course = new Course(1, 'Inglés Básico', 4.5);

        // Act
        $formatted = $course->format();

        // Assert
        $this->assertEquals('Clase: Inglés Básico | 4.5/5', $formatted);
    }
}
