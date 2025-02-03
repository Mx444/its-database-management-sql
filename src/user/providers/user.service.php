<?php

require_once __DIR__ . '/../../database/connection.provider.php';
require_once __DIR__ . '/../repositories/user.repository.php';
require_once __DIR__ . '/../../utils/regex.utilis.php';

class UserService
{
    private $connectionProvider;
    private $db;
    private $userRepository;


    public function __construct()
    {
        $this->connectionProvider = new ConnectionProvider();
        $this->db = $this->connectionProvider->getConnection();
        $this->userRepository = new UserRepository($this->db);
    }

    public function getUsers()
    {
        return $users = $this->userRepository->read();
    }

    public function createUser($nome, $cognome, $email, $telefono)
    {
        validateEmail($email);
        validateString($nome);
        validateString($cognome);
        validatePhone($telefono);

        $existingUser = $this->userRepository->findByEmail($email);
        if ($existingUser->num_rows > 0) {
            throw new Exception("User already exists");
        }

        $this->userRepository->create($nome, $cognome, $email, $telefono);
        return "User created successfully";
    }

    public function updateUser($id, $col, $value)
    {
        if ($col != "nome" && $col != "cognome" && $col != "email" && $col != "telefono") {
            throw new Exception("Invalid column");
        }
        if ($col == "email") {
            validateEmail($value);
        }
        if ($col == "nome" || $col == "cognome") {
            validateString($value);
        }
        if ($col == "telefono") {
            validatePhone($value);
        }

        $this->userRepository->update($id, $col, $value);
        return "User updated successfully";
    }
    public function deleteUser($id)
    {
        $this->userRepository->delete($id);
        return "User deleted successfully";
    }

    public function __destruct()
    {
        $this->connectionProvider->closeConnection();
    }
}
