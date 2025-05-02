<?php

namespace App\Entity;

/**
 * Abstract Resource class
 * 
 * Base class for all resources (courses and exams)
 */
abstract class Resource
{
    /**
     * @var int Resource ID
     */
    protected int $id;
    
    /**
     * @var string Resource name
     */
    protected string $name;
    
    /**
     * @var string Resource type (class or exam)
     */
    protected string $type;
    
    /**
     * Constructor
     * 
     * @param int $id Resource ID
     * @param string $name Resource name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    
    /**
     * Get resource ID
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * Get resource name
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Get resource type
     * 
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * Format resource for display
     * 
     * @return string Formatted string representation
     */
    abstract public function format(): string;
}
