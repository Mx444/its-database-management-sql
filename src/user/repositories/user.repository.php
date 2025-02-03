<?php

class UserRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create($nome, $cognome, $email, $telefono)
    {
        $query = "INSERT INTO users (nome, cognome, email, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssss", $nome, $cognome, $email, $telefono);
        $stmt->execute();
        $stmt->close();
    }

    public function read()
    {
        $query = "SELECT * FROM users";
        $result = $this->connection->query($query);
        return $result;
    }

    public function update($id, $col, $value)
    {
        $query = "UPDATE users SET $col = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $value, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}
