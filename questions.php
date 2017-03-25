<?php
    require 'config.php';
    date_default_timezone_set("Asia/Taipei");

    $id         =   $_POST['id'];
    $user       =   $_POST['user'];
    $img        =   $_POST['img'];
    $pic        =   $_POST['pic'];
    $currtime   =   $_POST['currtime'];
    $content    =   $_POST['content'];
    $time       =   date("Y-m-d H:i:s");

    $query = $link->query("INSERT INTO question (QuestionId, user, img, CurrTime, pic, content, time) VALUES ('$id', '$user', '$img', '$currtime', '$pic', '$content', '$time')");

    $currid = $link->query("SELECT id FROM question");
    $curr_num = $currid->num_rows;
    echo $curr_num;
