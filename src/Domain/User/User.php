<?php

namespace IESLaCierva\Domain\User;

use IESLaCierva\Domain\User\Exceptions\EmailNotValidException;
use IESLaCierva\Domain\User\ValueObject\Email;
use IESLaCierva\Domain\User\ValueObject\Role;

class User implements \JsonSerializable
{
    private string $id;
    private string $name;
    private Email $email;
    private string $password;
    private Role $role;

    public function __construct(string $id, string $name, Email $email, string $password, Role $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function create(string $name, Email $email, string $password, Role $role): User
    {
        return new self(uniqid(), $name, $email, $password,  $role );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function role(): Role
    {
        return $this->role;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'email' => $this->email()->value(),
            'role' => $this->role()->value()
        ];
    }


}
