<!DOCTYPE html>
<?php session_start(); ?>
<html>
	<head>
		<title>Draw</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta property="fb:app_id" content="102043503569226">
		<?php
			require 'config.php';

			// $currentFile = $_SERVER['PHP_SELF'];
			// $parts = explode('/', $currentFile);
			// $question_id = $parts[count($parts)-1];
			$question_id = $_GET['id'];

			// 問題資料
			$question 	= $link->query("SELECT * FROM question WHERE id = '$question_id'");
			$q_row 		= $question->fetch_assoc();
			$subject_id = $q_row['QuestionId'];
			$CurrTime 	= $q_row['CurrTime'];
			$q_content  = $q_row['content'];

			// 題目資料
            $query 		= $link->query("SELECT * FROM course WHERE id = '$subject_id'");
            $s_row 		= $query->fetch_assoc();
			$sid   		= $s_row['id'];
			$subject 	= $s_row['subject'];
		?>
		<meta name="og:title" content="<?=$subject?>">
		<meta name="og:url" content="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
		<meta name="og:description" content="<?=$q_content?>">

		<!-- CSS -->
		<link rel="stylesheet" href="//bootswatch.com/lumen/bootstrap.min.css" type="text/css" media="all" />
		<link rel="stylesheet" href="<?=$baseurl?>css/style.css" type="text/css" media="all" />
		<link rel="stylesheet" href="<?=$baseurl?>css/draw.css" type="text/css" media="all" />
		<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?=$baseurl?>assets/messenger.css" rel="stylesheet" media="screen">
		<link href="<?=$baseurl?>assets/messenger-theme-future.css" rel="stylesheet" media="screen">
		<!-- JS -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
		<script src="<?=$baseurl?>js/bootstrap.js"></script>
		<script src="<?=$baseurl?>assets/messenger.min.js"></script>
		<script src="<?=$baseurl?>assets/messenger-theme-flat.js"></script>
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
								require 'menu.php';
							?>
						</div>
					 </nav>
				 </div>
			</div>
		</div>

		<div class="team" id="team">
		    <div class="container">
		        <div class="theader">
		            <h3><?=$s_row['subject']?></h3>
 					    <hr />
						<a href="http://line.naver.jp/R/msg/text/?http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" type="button" class="btn btn-success btn-lg">Line 分享</a>
						︱
						<a href="javascript: void(window.open('http://www.facebook.com/share.php?u='.concat(encodeURIComponent('http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>'))));" type="button" class="btn btn-primary btn-lg">FB 分享</a>
						︱
						<a href="<?=$baseurl?>subject.php?id=<?=$sid?>"><button type="button" class="btn btn-default btn-lg">進入此問題課程</button></a>
 						︱
						<a href="<?=$baseurl?>course_question.php?id=<?=$sid?>"><button type="button" class="btn btn-default btn-lg">此課程其他問題</button></a>
						<hr />
		        </div>

                   <div class="col-md-12 col-sm-12 team-grid team-grid1">
					   <video id="myvideo" controls width="300">
					   		<source src="<?=$baseurl?><?=$s_row['video']?>">
					   </video>
				   </div>

				   <hr />
				   <div class="col-md-12 col-sm-12" id="draw-image" style="z-index:-5;">
					   <canvas width="450" height="400" id="mycanvas"></canvas>
				   </div>

				   	<canvas id="sketch" width="450" height="420" style="z-index:1;margin-top:-405px;"></canvas>

					<hr />
					<span class="label label-success">截圖時間：<?=gmdate("H:i:s", $CurrTime)?> 秒</span>
					<div class="panel panel-success">
						<div class="panel-heading">問題敘述</div>
						<div class="panel-body" id="q-content">
							<?=$q_row['content']?>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">問題回覆</div>
						<div id="reply_block"></div>
						<div class="panel-body" id="r-content">

							<textarea class="form-control" id="reply_content" rows="3"></textarea>
							<button type="button" id="reply_submit" class="btn btn-default">回覆</button>
						</div>
					</div>

		    </div>
		</div>

		<script>

			function loadreply() {

				$.ajax({
					async: false,
					type: 'POST',
					dataType: 'json',
					data: {
						post : "<?=$_GET['id']?>",
					},
					url: 'reply_load.php',

					error: function (xhr) {
						Messenger().post({
							message: "系統錯誤！",
							type: 'error',
							hideAfter: 2,
							hideOnNavigate: true
						});
					},
					success: function (response) {

						var response = $.parseJSON(JSON.stringify(response));

						$.each(response, function(i) {
							$("#reply_block").append(
								 '<div class="panel panel-default">' +
								   '<div class="panel-heading">' +
									 '<h5 class="panel-title" style="text-align:left;">回覆者：' + response[i].username + '</h5>' +
								   '</div>' +
								   '<div class="panel-body" style="text-align:left;">' +
										response[i].content +
								   '</div>' +
								 '</div>'
							);
						});
					}
				});
			}

			var v = document.getElementById("myvideo");
			var c = document.getElementById("mycanvas");
			var s = document.getElementById("sketch");
			var ctx = c.getContext("2d");
            var ctz = s.getContext("2d");

            img = new Image();
            pic = new Image();

            img.src="<?=$q_row['img']?>";
            pic.src="<?=$q_row['pic']?>";

            img.onload = function(){
                ctx.drawImage(img, 0, 0);
            }
            pic.onload = function(){
                ctz.drawImage(pic, 0, 0);
            }

			jQuery(document).ready(function($) {
				$(".scroll, .navbar li a, .footer li a").click(function(event){
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});

			loadreply();

			// reply submit
			$("#reply_submit").click(function(){
				$.ajax({
					type: 'POST',
					dataType: 'json',
					data: {
						content : $("#reply_content").val(),
						post 	: "<?=$_GET['id']?>",
					},
					url: 'reply_handle.php',

					error: function (xhr) {
						Messenger().post({
							message: "系統錯誤！",
							type: 'error',
							hideAfter: 2,
							hideOnNavigate: true
						});
					},
					success: function (response) {
						Messenger().post({
							message: "回覆完成！",
							type: 'success',
							hideAfter: 2,
							hideOnNavigate: true
						});
						$("#reply_content").val('');
						$("#reply_block").text('');
						loadreply();
					}
				});
			});
		</script>

	</body>
</html>
