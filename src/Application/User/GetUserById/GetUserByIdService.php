<?php

namespace IESLaCierva\Application\User\GetUserById;

use IESLaCierva\Domain\User\Exceptions\UserNotFoundException;
use IESLaCierva\Domain\User\User;
use IESLaCierva\Domain\User\UserRepository;

class GetUserByIdService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function execute(string $id): User {
        $user =  $this->userRepository->findById($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
