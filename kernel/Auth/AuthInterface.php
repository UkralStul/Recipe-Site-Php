<?php

namespace App\Kernel\Auth;

use App\Models\User;

interface AuthInterface
{
    public function attempt(string $username, string $password): bool;
    public function logout(): void;
    public function check(): bool;
    public function user(): ?User;
    public function id(): ?int;
    public function username(): string;
    public function table(): string;
    public function password(): string;
    public function sessionField(): string;

}