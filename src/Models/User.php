<?php

namespace App\Models;

class User
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $password,
        private int $isAdmin,
    )
    {
    }

    /**
     * @return int
     */
    public function isAdmin(): int
    {
        return $this->isAdmin;
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
    public function password(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }
}