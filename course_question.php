<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>課程問題 - Draw</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSS -->
		<link rel="stylesheet" href="//bootswatch.com/lumen/bootstrap.min.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="assets/messenger.css" rel="stylesheet" media="screen">
		<link href="assets/messenger-theme-future.css" rel="stylesheet" media="screen">
		<!-- JS -->
		<script src="js/jquery.min.js"> </script>
		<script src="js/bootstrap.js"></script>
		<script src="assets/messenger.min.js"></script>
		<script src="assets/messenger-theme-flat.js"></script>

	</head>
	<body>

		<div class="header">
			<div class="total-navbar">
				<div class="container">
					<nav class="navbar navbar-default">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<div id="navbar" class="navbar-collapse navbar-right collapse hover-effect">

							<?php
								require 'config.php';
								require 'menu.php';
								$course_type = $_GET['id'];
								$query 		 = $link->query("SELECT subject FROM course WHERE id = '$course_type'");
								$row 		 = $query->fetch_assoc();
								$course_name = $row['subject'];
							?>

						</div>
					</nav>
				</div>
			</div>
		</div>

		<div class="team" id="team">
		    <div class="container">
		        <div class="theader">
		            <h3>
						<div class="alert alert-success" role="alert">
							發問 - <?=$course_name?>
						</div>
					</h3>
		        </div>
                <table class="table table-bordered">
                    <tr>
                        <td>#</td>
                        <td>提問者</td>
                        <td>發問時間</td>
                    </tr>
    			    <?php
                        $questionId    = $_GET['id'];
    					$query         = $link->query("SELECT * FROM question WHERE QuestionId = '$questionId' ORDER BY id DESC");
    					while ($row = $query->fetch_assoc()) {
    			    ?>
                           <tr>
                               <td><a href="question.php?id=<?=$row['id']?>"><span class="glyphicon glyphicon-new-window"></span></a></td>
                               <td><?=$row['user']?></td>
                               <td><?=$row['time']?></td>
                           </tr>
    			    <?php
    					}
    			    ?>
                </table>
		    	<div class="clearfix"></div>
		    </div>
		</div>

		<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll, .navbar li a, .footer li a").click(function(event){
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
					});
				});

		</script>

	</body>
</html>
