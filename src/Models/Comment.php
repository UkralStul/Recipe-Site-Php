<?php

namespace App\Models;



class Comment
{
    public function __construct(
        private int $id,
        private int $userId,
        private string $comment,
        private string $createdAt,
        private User $user,
    )
    {
    }

    /**
     * @return int
     */
    public function userId(): int
    {
        return $this->userId;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function comment(): string
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function createdAt(): string
    {
        return $this->createdAt;
    }
}