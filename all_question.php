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
								$query 		 = $link->query("SELECT name FROM class_name WHERE id = '$course_type'");
								$row 		 = $query->fetch_assoc();
								$course_name = $row['name'];
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
							<?=$course_name?>
						</div>
					</h3>
		        </div>
			    <?php
					$query = $link->query("SELECT id, image, subject FROM course ORDER BY id DESC");
					while ($row = $query->fetch_assoc()) {
			    ?>
					   <div class="col-md-3 col-sm-3" style="margin-bottom:40px;">
						   <div style="min-height:100px;">
						   	<img src="<?=$row['image']?>" alt=" " />
						   </div>
						   <h5></h5>
						   <p><?=$row['subject']?></p>
						   <a href="subject.php?id=<?=$row['id']?>"><button type="button" class="btn btn-default">觀看課程</button></a>
					   </div>
			    <?php
					}
			    ?>
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
