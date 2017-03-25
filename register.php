<!DOCTYPE html>
<html>
	<head>
		<title>馬上加入 - Draw</title>
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
							<ul class="nav navbar-nav">
								<li class="active"><a href="index.php" class="scroll">首頁</a></li>
								<li><a href="course.php" class="scroll">所有課程</a></li>
								<li><a href="question.php" class="scroll">問題集</a></li>
								<li><a href="login.php" class="scroll">登入</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>

		<div class="about" id="about">
			<div class="container">
				<h3>馬上加入</h3>
				<div class="col-md-12 col-sm-12">
                    <div class="col-md-4 col-sm-4"></div>
                    <div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label>真實姓名</label>
							<input type="text" id="firstname" class="form-control">
						</div>
						<div class="form-group">
							<label>帳號</label>
							<input type="text" id="username" class="form-control">
						</div>
						<div class="form-group">
							<label>密碼</label>
							<input type="password" id="password" class="form-control">
						</div>
						<div class="form-group">
							<label>確認密碼</label>
							<input type="password" id="ck_password" class="form-control">
						</div>
						<button type="button" class="btn btn-success" id="register">加入</button>
                    </div>
                    <div class="col-md-4 col-sm-4"></div>
				</div>
			</div>
		</div>
		
		<script>

			$("#register").click(function(){
				ck_val();
			});

			$("input").keypress(function(e){
				code = (e.keyCode ? e.keyCode : e.which);
				if (code == 13) {
					ck_val();
				}
			});

			function register() {
				$.ajax({
					type: 'POST',
					dataType: 'json',
					data: {
						firstname : $("#firstname").val(),
						username  : $("#username").val(),
						password  : $("#password").val()
					},
					url: 'register_handle.php',

					error: function (xhr) {
						alert('系統錯誤！');
					},
					success: function (response) {

						var response = $.parseJSON(JSON.stringify(response));

						if (response.status == true) {
							Messenger().post({
								message: "註冊成功！",
								type: 'info',
								hideAfter: 2,
								hideOnNavigate: true
							});
							$("#register").attr('disabled', true);
							setTimeout(
								"window.location.href = 'login.php'",
							1000);
						}
						else{
							Messenger().post({
								message: "帳號已重複，請換個！",
								type: 'error',
								hideAfter: 2,
								hideOnNavigate: true
							});
							$("#username").val('');
							$("#username").parent('div').addClass('has-error');
							$("#username").focus();
						}
					}
				});
			}

			function ck_val() {

				var firstname 	= $("#firstname").val();
				var username  	= $("#username").val();
				var password  	= $("#password").val();
				var ck_password = $("#ck_password").val();

				if (firstname && username && password && ck_password) {
					if (password == ck_password) {
						register();
					}
					else{
						Messenger().post({
							message: "密碼與確認密碼不相符！",
							type: 'error',
							hideAfter: 2,
							hideOnNavigate: true
						});
						$("#password").val('');
						$("#ck_password").val('');
						$("#password").parent('div').addClass('has-error');
						$("#ck_password").parent('div').addClass('has-error');
						$("#password").focus();
					}
				}
				else{
					Messenger().post({
						message: "有欄位未填寫！",
						type: 'error',
						hideAfter: 2,
						hideOnNavigate: true
					});
				}
			}
		</script>

	</body>
</html>
