<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/headers.php';
require_once __DIR__ . '/Database/DatabaseConfig.php';
require_once __DIR__ . '/Entity/User.php';
require_once __DIR__ . '/Manager/UserManager.php';
require_once __DIR__ . '/Controller/UserDetailsController.php';
require_once __DIR__ . '/Repository/UserDetailsRepository.php';
require_once __DIR__ . '/ExceptionHandler/ExceptionHandler.php';
require_once __DIR__ . '/Validator/UserDetailsValidator.php';
require_once __DIR__ . '/Dto/UserDto.php';
require_once __DIR__ . '/Dto/UserResponseDto.php';

use Controller\UserDetailsController;
use Database\DatabaseConfig;
use Dto\UserDto;
use Manager\UserManager;
use Repository\UserDetailsRepository;
use Validator\UserDetailsValidator;

$db = DatabaseConfig::getPdoConnection();
$userRepository = new UserDetailsRepository($db);
$userManager = new UserManager($userRepository);
$userController = new UserDetailsController($userManager);
$request = require __DIR__ . '/../src/ServerConfig/RequestParser.php';
header('Content-Type: application/json');


switch (true)
{
    case $request['method'] =='POST' && $request['path'] == '/add-user':
        $validator = new UserDetailsValidator($request['data']);

        $validationErrors = $validator->validate();
        if(!empty($validationErrors)){
            http_response_code(400);
            echo json_encode(['validation_errors' => $validationErrors]);
            return;
        }

        $user = UserDto::fromArray($request['data']);
        $userController->postUserDetails($user);
        break;

        case $request['method'] =='GET' && $request['path'] == '/users':
            $users = $userController->fetchUsers();
            echo json_encode($users);
            break;

    case $request['method'] =='PUT' && sscanf($request['path'], '/user/%d', $userId) === 1:

        $user = UserDto::fromArray($request['data']);
        $updatedUser = $userController->updateUser($user, $userId);

        break;

    case $request['method'] =='DELETE' && sscanf($request['path'], '/user/%d', $userId) === 1:
        $result = $userController->deleteUser($userId);
        break;

    default:
        echo "default";
        var_dump($request['data']);
        var_dump($request['path']);
        break;
}