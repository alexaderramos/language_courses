<?php

namespace App\Entity;

use App\Enum\ExamTypeEnum;

/**
 * Exam class
 *
 * Represents an online language exam
 */
class Exam extends Resource
{
    /**
     * @var string Exam type (selection, question_answer, completion)
     */
    private string $examType;

    /**
     * Constructor
     *
     * @param int $id Exam ID
     * @param string $name Exam name
     * @param string $examType Exam type
     */
    public function __construct(int $id, string $name, string $examType)
    {
        parent::__construct($id, $name);
        $this->examType = $examType;
        $this->type = 'Examen';
    }

    /**
     * Get exam type
     *
     * @return string
     */
    public function getExamType(): string
    {
        return $this->examType;
    }

    /**
     * Format exam type for display
     *
     * @return string Formatted exam type
     */
    private function formatExamType(): string
    {
        return ExamTypeEnum::from($this->examType)->label();
    }

    /**
     * Format exam for display
     *
     * @return string Formatted string representation
     */
    public function format(): string
    {
        return sprintf("%s: %s | %s", $this->type, $this->name, $this->formatExamType());
    }
}
