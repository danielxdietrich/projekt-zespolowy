<?php

class User extends Model
{
    private $registerErrors = array();
    private $loginErrors = array();

    public function register($data)
    {
        $email = $data['email'];
        $haslo = $data['haslo'];

        if (empty($email)) {
            array_push($this->registerErrors, "Pole email nie może być puste");
        }
        if (empty($haslo)) {
            array_push($this->registerErrors, "Pole hasło nie może być puste");
        }

        if (count($this->registerErrors) == 0) {
            $hashHaslo = password_hash($haslo, PASSWORD_DEFAULT);

            $query = "INSERT INTO `Uzytkownik` (`idUzytkownik`, `email`, `haslo`) VALUES (NULL, '$email', '$hashHaslo');";

            if ($this->getDatabase()->getConnection()->query($query) === FALSE) {
                echo "Error: " . $query . "<br>" . $this->db->error;
            }

            $_SESSION['email'] = $data['email'];

            header('Location: ' . ROOT_PATH . 'userpage');
            return true;
        }
        return false;
    }

    public function login($data)
    {
        $email = $data['email'];
        $haslo = $data['haslo'];

        if (empty($data['email'])) {
            array_push($this->loginErrors, "Pole email nie może być puste");
        }
        if (empty($data['haslo'])) {
            array_push($this->loginErrors, "Pole hasło nie może być puste");
        }

        if (count($this->loginErrors) == 0) {
            $query = "SELECT haslo FROM Uzytkownik WHERE email= '$email'";
            $result = mysqli_fetch_assoc(mysqli_query($this->getDatabase()->getConnection(), $query));

            if (!is_null($result) && password_verify($haslo, $result['haslo'])) {
                $_SESSION['email'] = $data['email'];

                header('Location: ' . ROOT_PATH . 'userpage');
                return true;
            } else {
                array_push($this->loginErrors, "Email lub hasło jest nieprawidłowe");
            }
        }
        return false;
    }

    public function printLoginErrors()
    {
        if (count($this->loginErrors) > 0) {
            echo '<div class="notice error">';
            foreach ($this->loginErrors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
    }

    public function printRegisterErrors()
    {
        if (count($this->registerErrors) > 0) {
            echo '<div class="notice error">';
            foreach ($this->registerErrors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
    }
}
