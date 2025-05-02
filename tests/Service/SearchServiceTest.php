<?php

namespace Tests\Service;

use App\Entity\Course;
use App\Entity\Exam;
use App\Interface\SearchableInterface;
use App\Service\SearchService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Test for SearchService
 */
class SearchServiceTest extends TestCase
{
    /**
     * Scenary: Search method with mocked repositories
     * Expected result: Array of Course and Exam objects
     */
    public function testSearchAcrossRepositories(): void
    {
        // Arrange
        // Create mock for SearchableInterface
        $mockCourseRepo = $this->createMock(SearchableInterface::class);
        $mockExamRepo = $this->createMock(SearchableInterface::class);

        // Setup course repository mock
        $mockCourseRepo->expects($this->once())
            ->method('search')
            ->willReturn([
                new Course(1, 'Curso Test', 4.5)
            ]);

        // Setup exam repository mock
        $mockExamRepo->expects($this->once())
            ->method('search')
            ->willReturn([
                new Exam(1, 'Examen Test', 'selection')
            ]);

        // Create SearchService with reflection to inject mocked repositories
        $service = new SearchService();
        $reflection = new ReflectionClass(SearchService::class);
        $reposProperty = $reflection->getProperty('repositories');
        $reposProperty->setAccessible(true);
        $reposProperty->setValue($service, [$mockCourseRepo, $mockExamRepo]);

        // Act
        $results = $service->search('test');

        // Assert
        $this->assertCount(2, $results);
        $this->assertInstanceOf(Course::class, $results[0]);
        $this->assertInstanceOf(Exam::class, $results[1]);
        $this->assertEquals('Curso Test', $results[0]->getName());
        $this->assertEquals('Examen Test', $results[1]->getName());
    }

    /**
     * Scenary: Search with empty result returns empty array
     * Expected result: Empty array
     */
    public function testSearchWithEmptyResults(): void
    {
        // Arrange
        $mockRepo = $this->createMock(SearchableInterface::class);
        $mockRepo->expects($this->once())
            ->method('search')
            ->willReturn([]);

        $service = new SearchService();
        $reflection = new ReflectionClass(SearchService::class);
        $reposProperty = $reflection->getProperty('repositories');
        $reposProperty->setAccessible(true);
        $reposProperty->setValue($service, [$mockRepo]);

        // Act
        $results = $service->search('nonexistent');

        // Assert
        $this->assertEmpty($results);
    }
}
