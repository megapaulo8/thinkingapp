<?php
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = sha1($password);
    require_once $_SERVER['DOCUMENT_ROOT'].'./thinkingapp/src/procedures/classes/user.php';
    $user_login = new User();
    session_start();
    if ($user_login->authenticateUser($email,$password)){
        return $user_login;
    }
    else {
        return FALSE;
    }
?>