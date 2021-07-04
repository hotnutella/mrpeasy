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
        // Use prepared statement to prevent SQL injection
        $query = 'SELECT * from users WHERE username = ? order by id asc limit 1';
        $stmt = $this -> mysqli -> prepare($query);
        $stmt -> bind_param('s', $username);
        $stmt -> execute();
        $result = $stmt -> get_result();

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
        // Use prepared statement to prevent SQL injection
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = 'INSERT INTO users (username, password) VALUES (?, ?)';
        $stmt = $this -> mysqli -> prepare($query);
        $stmt -> bind_param('ss', $username, $hashed_password);
        $stmt -> execute();
        if ($stmt -> errno) {
            echo $this -> mysqli -> error;
        }
        else { // attempt to login with newly created user again
            $this -> login($username, $password);
        }
    }

    public static function setCounter($username, $counter) {
        // Use prepared statement to prevent SQL injection
        $mysqli = new mysqli('localhost', 'root', '', 'mrpeasy');
        $query = 'UPDATE users SET counter = ? WHERE username = ?';
        $stmt = $mysqli -> prepare($query);
        $stmt -> bind_param('is', $counter, $username);
        $stmt -> execute();

        if ($stmt -> errno) {
            echo $mysqli -> error;
        }

        $mysqli -> close();

        return json_encode(array('errors' => $stmt -> errno));
    }
}

?>