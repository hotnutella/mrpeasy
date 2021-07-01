<?php

include('User.class.php');

var_dump($_POST);

if (strlen($_POST['username']) && strlen($_POST['counter'])) {
    User::setCounter($_POST['username'], $_POST['counter']);
}

?>