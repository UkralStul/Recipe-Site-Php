<?php

namespace App\Models;

class Recipe
{
    public function __construct(
        private int $id,
        private string $name,
        private string $preview,
        private string $createdAt,
        private string $description,
        private array $comments = [],
    )
    {
    }

    /**
     * @return array
     */
    public function comments(): array
    {
        return $this->comments;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function preview(): string
    {
        return $this->preview;
    }

    /**
     * @return string
     */
    public function createdAt(): string
    {
        return $this->createdAt;
    }


}