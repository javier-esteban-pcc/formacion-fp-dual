<?php

namespace IESLaCierva\Infrastructure\Files;

use IESLaCierva\Domain\User\User;
use IESLaCierva\Domain\User\UserRepository;
use IESLaCierva\Domain\User\ValueObject\Email;
use IESLaCierva\Domain\User\ValueObject\Role;

class CsvUserRepository implements UserRepository
{
    private array $users;

    public function __construct() {

        $file = fopen(__DIR__.'/users.csv', "r");
        if (false === $file) {
            throw new Exception('File not found');
        }

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            $user = $this->hydrate($data);
            $this->users[$user->id()] = $user;
        }

        fclose($file);
    }

    public function findAll(): array
    {
        return array_values($this->users);
    }

    public function findById(string $id): ?User
    {
        foreach ($this->users as $user) {
            if ($user->id() === $id) {
                return $user;
            }
        }

        return null;
    }

    public function save(User $user): void
    {
        $file = fopen(__DIR__.'/users.csv', "a");
        if (false === $file) {
            throw new Exception('File not found');
        }
        fputcsv($file, [
            $user->id(), $user->name(), $user->email()->value(), $user->password(), $user->role()->value()
        ]);
        fclose($file);
    }

    private function hydrate($data): User
    {
        return new User(
            $data[0],
            $data[1],
            new Email( $data[2]),
            $data[3],
            new Role( $data[4])
        );
    }

}
