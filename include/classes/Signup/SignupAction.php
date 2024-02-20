<?php

namespace Alcompare\classes\Signup;

use PDOException;
use Alcompare\classes\Database\Database;
use Alcompare\classes\Signup\SignupManager;
use Alcompare\util\PHP\ErrorHandler\ErrorHandler;
use Alcompare\util\PHP\SessionManager\SessionManager;
use Exception;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class SignupAction
{
    protected ErrorHandler $errorHandler;
    protected SessionManager $sessionManager;
    protected string $username;
    protected string $pwd;
    protected string $email;

    public function __construct(ErrorHandler $errorHandler, SessionManager $sessionManager)
    {
        $this->errorHandler = $errorHandler;
        $this->sessionManager = $sessionManager;
        $this->username = $_POST["username"];
        $this->pwd = $_POST["pwd"];
        $this->email = $_POST["email"];
    }

    public function handleSignup(): void
    {
        $errors = [];

        try {
            $errors = $this->validateInput();

            if (empty($errors)) {
                $loginManager = SignupManager::getInstance();
                $loginManager->createUser($this->username, $this->pwd, $this->email);
                header("location: /pages/Login.php?signup=success");
                exit;
            } else {
                header("location: /pages/Signup.php?signup=error");
                exit;
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        } catch (Exception $e) {
            error_log("Unexpected error: " . $e->getMessage());
            header("Location: /pages/error.php");
            exit;
        }
    }

    public function validateInput(): array
    {
        $errors = [];
        $db = Database::getDb();

        if ($this->errorHandler->isInputEmpty($this->username, $this->pwd, $this->email)) {
            $errors["emptyInput"] = "Fill in all fields!";
        }
        if ($this->errorHandler->isEmailInvalid($this->email)) {
            $errors["invalidEmail"] = "Invalid email used!";
        }
        if ($this->errorHandler->isUsernameTaken($db, $this->username)) {
            $errors["usernameTaken"] = "Username already taken!";
        }
        if ($this->errorHandler->isEmailRegistered($db, $this->email)) {
            $errors["emailUsed"] = "Email already registered!";
        }

        return $errors;
    }
}
