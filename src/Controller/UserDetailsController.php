<?php

namespace Controller;

use Dto\UserDto;
use Dto\UserResponseDto;
use Entity\User;
use Exception;
use Manager\UserManager;

class UserDetailsController
{
    private UserManager $userManager;

    function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function getUserDetails(int $id): ?User
    {
            return null;
    }

    public function postUserDetails(UserDto $user)
    {
        $user =  $this->userManager->addUserDetails($user);
        echo  json_encode( ["success" => !!$user, "user" => $user ],JSON_PRETTY_PRINT);
    }

    public function fetchUsers() : array
    {
        return $this->userManager->fetchUsers();
    }

    public function updateUser(UserDto $user, int $id): bool
    {
        $userExists = $this->userManager->findUserById($id);
        if (!$userExists instanceof UserResponseDto) {
            throw new Exception("User not found");
        }

        if ($userExists->id !== $id) {
            throw new Exception("User not found");
        }


        return $this->userManager->updateUser($user, $id);
    }

    public function deleteUser(int $id): bool
    {
        $userExists = $this->userManager->findUserById($id);
        if (!$userExists instanceof UserResponseDto) {
            http_response_code(409);
            throw new Exception("User not found");
        }

        if ($userExists->id !== $id) {
            http_response_code(409);

            throw new Exception("User not found");
        }
        echo "id is ".$id;
        return $this->userManager->deleteUser($id);
    }
}
