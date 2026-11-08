<?php

namespace Manager;

use Dto\UserDto;
use Dto\UserResponseDto;
use Entity\User;
use Exception;
use Repository\UserDetailsRepository;


class UserManager
{

    private UserDetailsRepository $userRepository;
    function __construct(UserDetailsRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function addUserDetails(UserDto $payload): ?UserResponseDto
    {
        return $this->userRepository->addUserDetails($payload);

    }

    public function fetchUsers() : array
    {
        return $this->userRepository->getUsers();
    }

    /**
     * @throws Exception
     */
    public function updateUser(UserDto $user, int $id): bool
    {
        return $this->userRepository->updateUser($user,$id);
    }

    public function findUserById(int $id): ?UserResponseDto
    {
        return $this->userRepository->findUserById($id);
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepository->deleteUser($id);
    }

}