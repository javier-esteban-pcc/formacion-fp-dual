<?php

namespace IESLaCierva\Infrastructure\Database;

use IESLaCierva\Domain\User\User;
use IESLaCierva\Domain\User\UserRepository;
use IESLaCierva\Domain\User\ValueObject\Email;
use IESLaCierva\Domain\User\ValueObject\Role;

class MySqlUserRepository extends AbstractMySqlRepository implements UserRepository
{
    public function findAll(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM user ');
        $stmt->execute();
        $users = [];
        while ($row = $stmt->fetch()) {
            $users[] = $this->hydrate($row);
        }

        return $users;
    }

    public function findById(string $id): ?User
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE id = :userId ');
        $stmt->execute(['userId' => $id]);

        if ($stmt->rowCount() === 0) {
            return null;
        }

        return $this->hydrate($stmt->fetch());
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE email = :email ');
        $stmt->execute(['userId' => $email]);

        if ($stmt->rowCount() === 0) {
            return null;
        }

        return $this->hydrate($stmt->fetch());
    }

    public function save(User $user): void
    {
        $stmt = $this->connection->prepare('REPLACE INTO user(id, name, email, password, role)
                VALUES (:id, :name,  :email, :password, :role)');

        $stmt->execute(
            [
                'id' => $user->id(),
                'name' => $user->name(),
                'email' => $user->email()->value(),
                'password' => $user->password(),
                'role' => $user->role()->value()
            ]
        );
    }

    private function hydrate(array $data): User
    {
        return new User(
            $data['id'],
                $data['name'],
            new Email($data['email']),
            $data['password'],
             new Role($data['role'])
        );
    }

}
