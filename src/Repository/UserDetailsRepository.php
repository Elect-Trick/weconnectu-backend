<?php
namespace Repository;

use Dto\UserDto;
use Dto\UserResponseDto;
use Entity\User;
use Exception;
use PDO;

class UserDetailsRepository
{
    private PDO $pdo;
    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function addUserDetails(UserDto $payload): ?UserResponseDto
    {
        $this->pdo
            ->prepare("INSERT INTO user (name, email, contact_number,message) VALUES (:name, :email, :contact_number, :message )")
           ->execute([
            'name' => $payload->name,
            'email' => $payload->email,
            'contact_number' => $payload->contact_number,
            'message' => $payload->message
           ]);

        return  UserResponseDto::fromEntity($this->pdo->lastInsertId(), $payload);
    }

    /**
     * @return array | User[]
     */
    public function getUsers() : array
    {
        return $this->pdo->query("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * @throws Exception
     */
    public function updateUser(UserDto $user, int $id): bool
    {

        try {
            return $this->pdo->prepare("UPDATE user SET name = :name, email = :email, contact_number = :contact_number, message = :message, is_deleted = :is_deleted WHERE id = :id")
                ->execute(
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'contact_number' => $user->contact_number,
                    'message' => $user->message,
                    'is_deleted' => $user->is_deleted ? 1 : 0,
                    'id' => $id
                ]
            );
        }catch (Exception $ex){
            throw new Exception('Something went wrong while updating the user, please contact out support.');
        }


    }

    public function findUserById(int $id): ?UserResponseDto
    {
        $statment = $this->pdo->prepare("SELECT * FROM user WHERE id = :id  limit 1");
            $statment->execute([
                'id' => $id
            ]);
        $row = $statment->fetch(PDO::FETCH_OBJ);
        if(!$row){
            return null;
        }
        return UserResponseDto::fromEntity($id,$row);
    }

    public function deleteUser(int $id): bool
    {
        $statment = $this->pdo->prepare("UPDATE user SET is_deleted = :is_deleted WHERE id = :id");
       return $statment->execute([
            'id' => $id,
            'is_deleted' => true
        ]);

    }
}