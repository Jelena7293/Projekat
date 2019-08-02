<?php

session_start();

if (isset($_POST['logSubmit'])) {

    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Error handlers
    //Check if inputs are empty
    if (empty($uid) || empty($pwd)) {
        header("Location: ../index.html?login=empty");
        exit();
    } else {
        //$sql = "SELECT * FROM users WHERE username = '$uid' OR email = '$uid'";
        $sql = "SELECT * FROM users WHERE username = '$uid' AND password = '$pwd'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../index.html?login=error");
            exit();
        } else {
            /*if ($row = mysqli_fetch_assoc($result)) {
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['password']);
                if ($hashedPwdCheck = false) {
                    header("Location: ../index.html?login=error");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    //Log in the user here
                    $_SESSION['u_id'] = $row['id_user'];
                    $_SESSION['u_first_name'] = $row['first_name'];
                    $_SESSION['u_last_name'] = $row['last_name'];
                    $_SESSION['u_profession'] = $row['profession'];
                    $_SESSION['u_type_user'] = $row['type_user'];
                    $_SESSION['u_email'] = $row['email'];
                    $_SESSION['u_username'] = $row['username'];
                    $_SESSION['u_password'] = $row['password'];*/
                    header("Location: ../index.html?login=success");
                    exit();
                }
            //}
       // }
    }
} else {
    header("Location: ../index.php?login=error");
    exit();
}