<?php
namespace App\Enum;

/**
 * Exam type enum
 *
 * Represents the different types of exams
 */
enum ExamTypeEnum: string
{
    case SELECTION = 'selection';
    case QUESTION_ANSWER = 'question_answer';
    case COMPLETION = 'completion';

    /**
     * Get exam type label
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::SELECTION => 'Selección',
            self::QUESTION_ANSWER => 'Pregunta y respuesta',
            self::COMPLETION => 'Completación',
        };
    }
}
