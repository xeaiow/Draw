<?php
    session_start();
    require 'config.php';
    $post = $_POST['post'];

    $query = $link->query("SELECT * FROM reply WHERE post = '$post' ORDER BY id DESC");

    while ($row = $query->fetch_assoc()) {
        $response[] = $row;
    }
    echo json_encode($response);
