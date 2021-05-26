<?php

namespace IESLaCierva\Application\User\CreateNewUser;

use IESLaCierva\Domain\User\User;
use IESLaCierva\Domain\User\UserRepository;
use IESLaCierva\Domain\User\ValueObject\Email;
use IESLaCierva\Domain\User\ValueObject\Role;

class CreateNewUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(string $name, string $email, string $password, string $role)
    {
        $user = User::create($name, new Email($email), $password, new Role($role));
        $this->userRepository->save($user);
    }
}
