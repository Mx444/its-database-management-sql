<?php

include_once __DIR__ . '/../../user/providers/user.service.php';

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getUsers()
    {
        return $this->userService->getUsers();
    }

    public function createUser($nome, $cognome, $email, $telefono)
    {
        return $this->userService->createUser($nome, $cognome, $email, $telefono);
    }

    public function updateUser($id, $col, $value)
    {
        return $this->userService->updateUser($id, $col, $value);
    }

    public function deleteUser($id)
    {
        return $this->userService->deleteUser($id);
    }
}
