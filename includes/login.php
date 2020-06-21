<?php

session_start();

include "db.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username =  mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE user_name = '{$username}'";
    $executeQuery = mysqli_query($connection, $query);

    if(!$executeQuery){
        die('Query Failed ' . mysqli_error($connection));
    }
    else{
        while($row = mysqli_fetch_assoc($executeQuery)){
            $dbID = $row['user_id'];
            $dbFirstName = $row['user_firstname'];
            $dbLastName = $row['user_lastname'];
            $dbRole = $row['user_role'];
            $dbPassword = $row['user_password'];
            $dbEmail = $row['user_email'];
        }
        $realPass = $password;
        $password = crypt($password, $dbPassword);

        if($dbPassword === $password){
            $_SESSION['user_id'] = $dbID;
            $_SESSION['user_name'] = $username;
            $_SESSION['user_email'] = $dbEmail;
            $_SESSION['user_firstname'] = $dbFirstName;
            $_SESSION['user_lastname'] = $dbLastName;
            $_SESSION['user_role'] = $dbRole;
            $_SESSION['user_password'] = $dbPassword;
            $_SESSION['real_password'] = $realPass;
            header('Location: ../admin');
        }
        else{
            header('Location: ../index.php');
        }
    }
}


?>