<?php

include('../model/User.class.php');

if (strlen($_POST['username']) && strlen($_POST['counter'])) {
    echo User::setCounter($_POST['username'], $_POST['counter']);
}

?>