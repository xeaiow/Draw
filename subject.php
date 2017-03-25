<!DOCTYPE html>
<?php session_start(); ?>
<html>
	<head>
		<title>Subject - Draw</title>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
			<!-- CSS -->
			<link rel="stylesheet" href="//bootswatch.com/lumen/bootstrap.min.css" type="text/css" media="all" />
			<link rel="stylesheet"	href="css/style.css" type="text/css" media="all" />
			<link rel="stylesheet"	href="css/draw.css" type="text/css" media="all" />
			<link rel="stylesheet" href="css/swipebox.css">
			<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
			<link href="assets/messenger.css" rel="stylesheet" media="screen">
			<link href="assets/messenger-theme-future.css" rel="stylesheet" media="screen">
			<!-- JS -->
			<script src="js/jquery.min.js"> </script>
			<script src="js/bootstrap.js"></script>
			<script src="assets/messenger.min.js"></script>
			<script src="assets/messenger-theme-flat.js"></script>
			<!-- Draw -->
			<script src="js/modernizr.js"></script>
			<script src="js/sketcher.js"></script>
			<script src="js/jscolor.js"></script>

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
							?>
						</div>
					 </nav>
				 </div>
			</div>
		</div>

        <?php
            $subject_id = $_GET['id'];
            $query = $link->query("SELECT * FROM course WHERE id = '$subject_id'");
            $row = $query->fetch_assoc();
        ?>

		<div class="team" id="team">
		    <div class="container">
				<div class="theader">
					<h3><?=$row['subject']?></h3>
				</div>
				<div class="col-md-6 col-sm-6 team-grid team-grid1">
					<img src="<?=$row['image']?>" alt=" " />
					<h5></h5>
					<p><?=$row['content']?></p>
				</div>
				<div class="col-md-6 col-sm-6">
					<video id="myvideo" controls width="300">
						<source src="<?=$row['video']?>">
					</video>
					<button class="btn btn-success" id="pause_lnk">截圖</button>
					<button class="btn btn-default" id="re_pause_lnk">重新截圖</button>
				</div>

				<hr />
				<div class="col-md-12 col-sm-12" id="draw-image" style="z-index:-5;" hidden>
					<div class="alert alert-info" role="alert">1. 可在圖片上繪畫或標記</div>
					<canvas width="450" height="400" id="mycanvas"></canvas>
				</div>

				<canvas id="sketch" width="450" height="420" style="z-index:1;margin-top:-405px;"></canvas>

				<hr />

				<div class="col-md-12 col-sm-12" id="cleaner" hidden>
					<button class="btn btn-danger" onclick="sketcher.clear()">重畫</button>
					<button type="button" class="btn btn-default jscolor" id="change_color"></button>
					<hr />
				</div>

				<div class="col-md-12 col-sm-12" id="public" hidden>
					<div class="col-md-3 col-sm-3">
				</div>
				<div class="col-md-12 col-sm-6">
					<div class="alert alert-success" role="alert">2. 用文字描述問題</div>
					<textarea id="content" rows="7" class="form-control" placeholder="請描述問題..."></textarea><hr />
					<button type="button" class="btn btn-primary" id="questions">發問</button>

				</div>
				<div class="col-md-3 col-sm-3"></div>

			</div>

			<div class="box paste"></div>

		    <div class="clearfix"></div>
		</div>
	</div>


		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript">

			var v = document.getElementById("myvideo");
			var c = document.getElementById("mycanvas");
			var s = document.getElementById("sketch");
			var ctx = c.getContext("2d");
			var skx = s.getContext("2d");

			var sketcher;
			var dataUrl;

			$(document).ready(function(e) {
				$().UItoTop({ easingType: 'easeOutQuart' });
				$("#re_pause_lnk").hide();
				$("#sketch").hide();
				$(".scroll, .navbar li a, .footer li a").click(function(event){
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});

			// 截圖
			function pause_and_capture() {

				sketcher = new Sketcher("sketch");

				$("#draw-image").fadeIn();
				ctx.drawImage(v, 0, 0, 470, 300);
				v.pause();
				dataUrl = c.toDataURL();
				$("#sketch").show();
				$("#public").show();
				$("#cleaner").show();
				$("#pause_lnk").attr('disabled', true);
				$("#re_pause_lnk").show();
				sketcher.clear(); // clear sketch
			}

			$("#change_color").focusout(function(){
				skx.strokeStyle = "#" + $("#change_color").text();
			});

			// 重新截圖
			function re_pause_and_capture() {
				v.pause();
				ctx.drawImage(v, 0, 0, 470, 300);
				dataUrl = c.toDataURL();
				sketcher.clear(); // clear sketch
			}

			$("#questions").click(function(){

				if ($("#content").val()) {

					$.ajax({
	                    url: 'questions.php',
	                    type: "POST",
	                    data: {
							id   	 : "<?=$_GET['id']?>",
							user 	 : "<?=$myusername?>",
							img  	 : c.toDataURL(),
							pic  	 : s.toDataURL(),
							currtime : v.currentTime,
							content  : $("#content").val(),
						},
	                    success: function(data){

							Messenger().post({
								message: "發問成功！",
								type: 'info',
								hideAfter: 2,
								hideOnNavigate: true
							});
	                        setTimeout(
	                            function(){
	                                window.location.href = 'question.php?id='+data;
	                            }, 500
	                        );
	                    },
	                });
				}
				else{
					Messenger().post({
						message: "請描述問題！",
						type: 'error',
						hideAfter: 2,
						hideOnNavigate: true
					});
					$("#content").focus();
				}


			});

			pause_lnk.addEventListener('click', pause_and_capture, false);
			re_pause_lnk.addEventListener('click', re_pause_and_capture, false);
		</script>
	</body>
</html>
