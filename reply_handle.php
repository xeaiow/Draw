<?php
    session_start();
    require 'config.php';
    date_default_timezone_set("Asia/Taipei");

    $content  = $_POST['content'];
    $username = $_SESSION['username'];
    $post     = $_POST['post'];
    $date     = date("Y-m-d H:i:s");

    $link->query("INSERT INTO reply (post, username, content, reply_time) VALUES ('$post', '$username', '$content', '$date')");

    ( $link->affected_rows == 1 ? $response['status'] = true : $response['status'] = false );

    echo json_encode($response);
