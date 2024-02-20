<?php

namespace Alcompare\util\PHP\ErrorHandler;

use Alcompare\util\PHP\User\UserDatabaseQueries;

class ErrorHandler
{
    protected UserDatabaseQueries $userDbQuery;

    public function __construct()
    {
        $this->userDbQuery = new UserDatabaseQueries();
    }
    public function isInputEmpty(string $username, string $pwd, string $email): bool
    {
        return empty($username) || empty($pwd) || empty($email);
    }

    public function isEmailInvalid(string $email): bool
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isUsernameTaken(object $pdo, string $username): bool
    {
        $result = $this->userDbQuery->getUsername($pdo, $username);
        return !empty($result);
    }

    public function isEmailRegistered(object $pdo, string $email): bool
    {
        $result = $this->userDbQuery->getEmail($pdo, $email);
        return !empty($result);
    }
}
