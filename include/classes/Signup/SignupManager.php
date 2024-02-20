<?php

namespace Alcompare\classes\Signup;

use Alcompare\util\PHP\User\User;
use Alcompare\classes\Database\Database;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class SignupManager
{
    protected static $instance = null;

    public static function getInstance(): SignupManager
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function createUser(string $username, string $pwd, string $email): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPwd($pwd);
        $user->setEmail($email);
        $this->saveUserToDb($user);
        return $user;
    }

    private function saveUserToDb(User $user): void
    {
        $db = Database::getDb();
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
        $stmt = $db->prepare($query);

        $options = [
            "cost" => 12
        ];

        $hashedPwd = password_hash($user->getPwd(), PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $user->getUsername());
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->execute();
    }

    public function isUserLoggedIn(): bool
    {
        return isset($_SESSION["userId"]);
    }
}
