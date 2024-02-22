<?php

namespace Alcompare\util\PHP\User;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use PDO;

/**
 * Class UserDatabaseQueries
 *
 * Provides database queries related to user operations.
 */
class UserDatabaseQueries
{
    /**
     * Retrieves a username from the database.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $username The username to retrieve.
     * @return array|false The fetched username data as an associative array, or false if no username found.
     */
    public function getUsername(PDO $pdo, string $username): array|false
    {
        $query = "SELECT username FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Retrieves an email from the database.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $email The email to retrieve.
     * @return array|false The fetched email data as an associative array, or false if no email found.
     */
    public function getEmail(PDO $pdo, string $email): array|false
    {
        $query = "SELECT username FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Retrieves a user from the database.
     *
     * @param PDO $pdo The PDO database connection object.
     * @param string $username The username of the user to retrieve.
     * @return array|false The fetched user data as an associative array, or false if no user found.
     */
    public function getUser(PDO $pdo, string $username): array|false
    {
        $query = "SELECT * FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
