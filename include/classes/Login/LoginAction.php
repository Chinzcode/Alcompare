<?php

namespace Alcompare\classes\Login;

use Exception;
use PDOException;
use Alcompare\classes\Database\Database;
use Alcompare\util\PHP\User\UserDatabaseQueries;
use Alcompare\util\PHP\ErrorHandler\ErrorHandler;
use Alcompare\util\PHP\SessionManager\SessionManager;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class LoginAction
{
    protected ErrorHandler $errorHandler;
    protected SessionManager $sessionManager;
    protected string $username;
    protected string $pwd;

    public function __construct(ErrorHandler $errorHandler, SessionManager $sessionManager)
    {
        $this->errorHandler = $errorHandler;
        $this->sessionManager = $sessionManager;
        $this->username = $_POST["username"];
        $this->pwd = $_POST["pwd"];
    }

    public function handleLogin(): void
    {
        $errors = [];

        try {
            $errors = $this->validateInput();

            if (empty($errors)) {
                $db = Database::getDb();
                $user = (new UserDatabaseQueries())->getUser($db, $this->username);

                if ($user) {
                    $newSessionId = session_create_id();
                    $sessionId = $newSessionId . "_" . $user["id"];
                    session_id($sessionId);

                    $this->sessionManager->setUser($user);

                    header("Location: /pages/Home.php?login=success");
                    exit;
                } else {
                    $errors["loginIncorrect"] = "Incorrect login info!";
                    $_SESSION["errorsLogin"] = $errors;
                    header("location: /pages/Login.php?login=error");
                    exit;
                }
            } else {
                $_SESSION["errorsLogin"] = $errors;
                header("location: /pages/Login.php?login=error");
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

        if ($this->errorHandler->isLoginInputEmpty($this->username, $this->pwd)) {
            $errors["emptyInput"] = "Please fill in all required fields.";
        }
        if ($this->errorHandler->isUserCredentialsInvalid($db, $this->username, $this->pwd)) {
            $errors["invalidCredentials"] = "Invalid username or password.";
        }

        return $errors;
    }
}
