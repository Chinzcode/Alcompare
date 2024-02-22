<?php

namespace Alcompare\util\PHP\User;

use PDO;

class UserDatabaseQueries
{
    public function getUsername(object $pdo, string $username)
    {
        $query = "SELECT username FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getEmail(object $pdo, string $email)
    {
        $query = "SELECT username FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUser(object $pdo, string $username)
    {
        $query = "SELECT * FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
