<?php

namespace Tests\Repository;

use App\Entity\Course;
use App\Repository\CourseRepository;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use PDO;
use PDOStatement;

/**
 * Test for CourseRepository
 */
class CourseRepositoryTest extends TestCase
{
    /**
     * Scenary: Search method when term is too short
     * Expected result: Empty array
     */
    public function testSearchWithShortTerm(): void
    {
        // Arrange
        $repository = new CourseRepository();

        // Act
        $result = $repository->search('ab'); // Menos de 3 caracteres

        // Assert
        $this->assertEmpty($result);
    }

    /**
     * Scenary: Execute search method using reflection and mocks
     * Expected result: Array of Course objects
     */
    public function testExecuteSearch(): void
    {
        // Arrange
        $pdoMock = $this->createMock(PDO::class);
        $statementMock = $this->createMock(PDOStatement::class);

        // Setup mocks
        $pdoMock->expects($this->once())
            ->method('prepare')
            ->willReturn($statementMock);

        $statementMock->expects($this->once())
            ->method('bindParam');

        $statementMock->expects($this->once())
            ->method('execute');

        $statementMock->expects($this->exactly(2))
            ->method('fetch')
            ->willReturnOnConsecutiveCalls(
                ['id' => 1, 'name' => 'Curso Test 1', 'rating' => 4.5],
                false
            );

        // Create repository with reflection to inject mocked PDO
        $repository = new CourseRepository();
        $reflection = new ReflectionClass(CourseRepository::class);
        $connectionProperty = $reflection->getProperty('connection');
        $connectionProperty->setAccessible(true);
        $connectionProperty->setValue($repository, $pdoMock);

        // Use reflection to call protected method
        $method = $reflection->getMethod('executeSearch');
        $method->setAccessible(true);

        // Act
        $result = $method->invokeArgs($repository, ['%test%']);

        // Assert
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Course::class, $result[0]);
        $this->assertEquals(1, $result[0]->getId());
        $this->assertEquals('Curso Test 1', $result[0]->getName());
        $this->assertEquals(4.5, $result[0]->getRating());
    }
}
