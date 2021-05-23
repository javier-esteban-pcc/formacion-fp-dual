<?php

namespace IESLaCierva\Application\User\GetAllUsers;

use IESLaCierva\Domain\User\UserRepository;

class GetAllUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(): array {
        return $this->userRepository->findAll();
    }
}
