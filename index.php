<!DOCTYPE html>
<?php session_start();?>
<html>
	<head>
		<title>Draw</title>
		<!-- For-Mobile-Apps -->
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="Business Park a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
			<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- //For-Mobile-Apps -->

		<!-- Custom-Stylesheet-Links -->
			<link  rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all" />
			<link rel="stylesheet"	href="css/style.css" type="text/css" media="all" />
			<link rel="stylesheet" href="css/swipebox.css">
			<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
		<!-- //Custom-Stylesheet-Links -->


		<!-- Web-Fonts -->
			<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
			<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,300italic,900italic,900,800italic,800,700italic,700,600italic,600,500italic,500' rel='stylesheet' type='text/css'>
		<!-- //Web-Fonts -->
			<script src="js/jquery.min.js"> </script>
			<script src="js/bootstrap.js"></script>

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
							<ul class="nav navbar-nav">
							    <li class="active"><a href="index.php" class="scroll">首頁</a></li>
							    <li><a href="course.php" class="scroll">所有課程</a></li>
								<li><a href="all_question.php" class="scroll">問題集</a></li>

								<?php
					                if(empty($_SESSION['firstname']) && empty($_SESSION['username'])){

										echo '
											<li><a href="register.php" class="scroll">馬上加入</a></li>
									    	<li><a href="login.php" class="scroll">登入</a></li>
										';

					                }
					                else{
					                    $myusername = $_SESSION['username'];
					                    echo '<li><a href="logout.php" class="scroll">'.$_SESSION['firstname'].' ,登出</a></li>';
					                }
					            ?>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>

		<div class="banner">
			<h1></h1>
			<h3>Draw Work</h3>
		</div>

		<div class="about" id="about">
			<div class="container">
				<h3>關於本系統</h3>
				<div class="about-grids">
				<div class="about-grid1">
					<div class="col-md-8 col-sm-8 about-text">
						<h4>選取課程</h4>
						<p>
							從課程分類找到您想線上學習的內容，展開遠距學習的旅途。
						</p>
					</div>
					<div class="col-md-4 col-sm-4 aimg aboutimage">
						<img src="images/a1.png" alt=" " />
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="about-grid2">
					<div class="col-md-4 col-sm-4 aimg aboutimage">
						<img src="images/a2.png" alt=" " />
					</div>
					<div class="col-md-8 col-sm-8 about-text about-text2">
						<h4>發現問題</h4>
						<p>
							在影片播放期間，遇到問題可按下暫停，並在影片上繪畫、輸入文字、錄音等功能紀錄問題。
						</p>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="about-grid3 ">
					<div class="col-md-8 col-sm-8 about-text">
						<h4>分享至社群網站</h4>
						<p>
							將紀錄下的文字及圖片，透過網址分享至FaceBook讓大家解惑。
						</p>
					</div>
					<div class="col-md-4 col-sm-4 aboutimage">
						<img src="images/a3.png" alt=" " />
					</div>
					<div class="clearfix"></div>
				</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$().UItoTop({ easingType: 'easeOutQuart' });
			});
			jQuery(document).ready(function($) {
				$(".scroll, .navbar li a, .footer li a").click(function(event){
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
	</body>
</html>
