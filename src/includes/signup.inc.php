<?php

if (isset($_POST['submit'])){
    include_once 'dbh.inc.php';

    $first_name = mysqli_real_escape_string($conn, $_POST['first']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last']);
    $profession = mysqli_real_escape_string($conn, $_POST['profession']);
    $type_user = mysqli_real_escape_string($conn, $_POST['userType']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['uid']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Error handlers
    //Check for empty fields
    if (empty($first_name) || empty($last_name) || empty($profession) || empty($type_user) || empty($email) || empty($username) || empty($password)) {
        header("Location: ../signUp.html?signUp=empty");
        exit();
    } else {
        //Check if input characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first_name) || !preg_match("/^[a-zA-Z]*$/", $last_name)) {
            header("Location: ../signUp.html?signUp=invalid");
            exit();
        } else {
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signUp.html?signUp=email");
                exit();
            } else {
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    header("Location: ../signUp.html?signUp=usertaken");
                    exit();
                } else {
                    //Hashing the password
                    //$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (first_name, last_name, profession, type_user, email, username, password) VALUES ('$first_name', '$last_name', '$profession', '$type_user', '$email', '$username', '$password');";
                    mysqli_query($conn, $sql);
                    /*header("Location: ../signUp.html?signUp=success");*/
                    header("Location:../signupRequest.html");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../signUp.html");
    exit();
}