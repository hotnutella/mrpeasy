<?php

class User
{
    function __construct($username, $password) {
        $this -> mysqli = new mysqli('localhost', 'root', '', 'mrpeasy');
        $this -> data = array();

        if ($this -> mysqli -> connect_errno) {
            echo 'Failed to connect to MySQL: ' . $this -> mysqli -> connect_error;
            exit();
        }

        $this -> login($username, $password);

        $this -> mysqli -> close();
    }

    private function login($username, $password) {
        $query = 'SELECT * from users WHERE username = "' . $username . '" order by id asc limit 1';
        $result = $this -> mysqli -> query($query);

        if ($result -> num_rows > 0) {
            $user = $result -> fetch_array();

            if (password_verify($password, $user['password'])) {
                $this -> data = array('username' => $username, 'counter' => $user['counter']);
            }
            else {
                $this -> createNewUser($username, $password);
            }
        }
        else {
            $this -> createNewUser($username, $password);
        }        
    }

    private function createNewUser($username, $password) {
        $query = 'INSERT INTO users (username, password) VALUES ("' . $username . '", "' . password_hash($password, PASSWORD_BCRYPT) . '")';
        $result = $this -> mysqli -> query($query);
        if (!$result) {
            echo $this -> mysqli -> error;
        }
        else { // attempt to login with newly created user again
            $this -> login($username, $password);
        }
    }

    public static function setCounter($username, $counter) {
        $mysqli = new mysqli('localhost', 'root', '', 'mrpeasy');
        $query = 'UPDATE users SET counter = '. $counter .' WHERE username = "' . $username . '"';
        $result = $mysqli -> query($query);

        if (!$result) {
            echo $mysqli -> error;
        }

        $mysqli -> close();
    }
}

?>