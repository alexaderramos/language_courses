<?php

namespace Tests\Entity;

use App\Entity\Exam;
use App\Enum\ExamTypeEnum;
use PHPUnit\Framework\TestCase;

/**
 * Test for Exam entity
 */
class ExamTest extends TestCase
{
    /**
     * Scenary: Exam creation and getters
     * Expected result: Exam object with id, name, exam type and type
     */
    public function testExamCreation(): void
    {
        // Arrange
        $id = 1;
        $name = 'Vocabulario Avanzado';
        $examType = ExamTypeEnum::SELECTION->value;

        // Act
        $exam = new Exam($id, $name, $examType);

        // Assert
        $this->assertEquals($id, $exam->getId());
        $this->assertEquals($name, $exam->getName());
        $this->assertEquals($examType, $exam->getExamType());
        $this->assertEquals('Examen', $exam->getType());
    }

    /**
     * Scenary: Exam format method
     * Expected result: Exam formatted string
     */
    public function testExamFormat(): void
    {
        // Arrange
        $exam = new Exam(1, 'Vocabulario Avanzado', ExamTypeEnum::SELECTION->value);

        // Act
        $formatted = $exam->format();

        // Assert
        $this->assertEquals('Examen: Vocabulario Avanzado | Selección', $formatted);
    }

    /**
     * Scenary: Test all exam types are formatted correctly
     * Expected result: Exam formatted string
     */
    public function testAllExamTypesFormatting(): void
    {
        // Test selection type
        $selectionExam = new Exam(1, 'Test', ExamTypeEnum::SELECTION->value);
        $this->assertStringContainsString('Selección', $selectionExam->format());

        // Test question_answer type
        $qaExam = new Exam(2, 'Test', ExamTypeEnum::QUESTION_ANSWER->value);
        $this->assertStringContainsString('Pregunta y respuesta', $qaExam->format());

        // Test completion type
        $completionExam = new Exam(3, 'Test', ExamTypeEnum::COMPLETION->value);
        $this->assertStringContainsString('Completación', $completionExam->format());
    }
}
