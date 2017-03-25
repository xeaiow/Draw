<ul class="nav navbar-nav">
    <li><a href="<?=$baseurl?>index.php" class="scroll">首頁</a></li>
    <li><a href="<?=$baseurl?>course.php" class="scroll">單元</a></li>
    <li>
        <?php
            if(empty($_SESSION['firstname']) && empty($_SESSION['username'])){

                echo '<meta http-equiv="refresh" content="0;url='.$baseurl.'login.php" />';
                exit();
            }
            else{
                $myusername = $_SESSION['username'];
                echo '<li><a href="'.$baseurl.'logout.php" class="scroll">'.$_SESSION['firstname'].', 登出</a></li>';
            }
        ?>
    </li>
</ul>
