<?php
    require 'config.php';

    $firstname = strip_tags($_POST['firstname']);
    $username  = strip_tags($_POST['username']);
    $password  = strip_tags(sha1($_POST['password']));

    $repty_query = $link->query("SELECT id FROM member WHERE username = '$username'");
    $repty       = $repty_query->num_rows;

    if ($repty == 0) {

        $query       = $link->query("INSERT INTO member (username, password, firstname) VALUES ('$username', '$password', '$firstname')");
        $aff_count   = $link->affected_rows;

        if ($aff_count == 1) {
            $response['status']    = true;
        }
        else {
            $response['status']    = false;
        }

    }
    else{
        $response['status']    = false;
    }
    echo json_encode($response);
