<?php
    session_start();
    require 'config.php';

    // POST資料
    $username  = $_POST['username'];
    $password  = sha1($_POST['password']);

    $stmt      = $link->prepare("SELECT username, firstname FROM member WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($username, $firstname);
    $stmt->store_result();
    $num = $stmt->num_rows;
    $stmt->fetch();

    // 登入判斷
    if ($num == 1) {

        $_SESSION['username']  = $username;
        $_SESSION['firstname'] = $firstname;
        $response['status']    = true;
    }
    else {

        $response['status']    = false;

    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
