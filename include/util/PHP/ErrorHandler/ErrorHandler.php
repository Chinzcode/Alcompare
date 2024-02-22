<?php

namespace Alcompare\util\PHP\ErrorHandler;

use Alcompare\util\PHP\User\UserDatabaseQueries;
use PDO;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class ErrorHandler
{
    protected UserDatabaseQueries $userDbQuery;

    /**
     * ErrorHandler constructor.
     */
    public function __construct()
    {
        $this->userDbQuery = new UserDatabaseQueries();
    }

    /**
     * Checks if any of the input fields are empty.
     */
    public function isInputEmpty(string $username, string $pwd, string $email): bool
    {
        return empty($username) || empty($pwd) || empty($email);
    }

    /**
     * Checks if the email is invalid.
     */
    public function isEmailInvalid(string $email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Checks if the username is already taken.
     */
    public function isUsernameTaken(PDO $pdo, string $username): bool
    {
        $result = $this->userDbQuery->getUsername($pdo, $username);
        return !empty($result);
    }

    /**
     * Checks if the email is already registered.
     */
    public function isEmailRegistered(PDO $pdo, string $email): bool
    {
        $result = $this->userDbQuery->getEmail($pdo, $email);
        return !empty($result);
    }

    /**
     * Checks if the login input fields are empty.
     */
    public function isLoginInputEmpty(string $username, string $pwd): bool
    {
        return empty($username) || empty($pwd);
    }

    /**
     * Checks if the username or password is invalid.
     */
    public function isUserCredentialsInvalid(PDO $pdo, string $username, string $pwd): bool
    {
        $user = $this->userDbQuery->getUser($pdo, $username);
        if (!$user) {
            return true;
        }
        $hashedPwd = $user["pwd"];
        return !password_verify($pwd, $hashedPwd);
    }
}
