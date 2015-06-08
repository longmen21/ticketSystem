<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title>用户登录</title>
<?php include 'common.php';?>
<?php
session_start();

include_once( '/var/www/oauth/config.php' );
include_once( '/var/www/oauth/saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
<script type="text/javascript">
//this.location=<?php echo $code_url; ?>;

</script>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/signin.css" rel="stylesheet">
</head>

<body>

<?php 
//header('Location:'.$code_url);
?>

<a href="<?php echo $code_url; ?>">link</a>
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">信息中心</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
	
	</div>
	<!-- /.navbar-collapse -->
	</nav>
	<form class="form-signin" role="form" method="post"
		action="dataSrvPost.php">
		<h2 class="form-signin-heading">请登录</h2>
		<input type="hidden" name="action" value="login" /> <input type="text"
			class="form-control" placeholder="用户名" required="required"
			autofocus="autofocus" name="name"> <input type="password"
			class="form-control" placeholder="密码" required="required" name="pwd">

		<label class="checkbox"> <input type="checkbox" value="remember-me">
			记住我
		</label>
		<button class="btn btn-lg btn-primary btn-block" type="submit">登&nbsp;录</button>
	</form>

	</div>
	<br><br><br><br>
<center>
	<div id="footer">
      <div class="container">
        <p class="text-muted">&copy;copyright by <a href="www.iflab.org">iflab</a>&nbsp; 2014</p>
        <p class="text-muted">ticketSystem</p>
        <p>version 1.0</p>
      </div>
    </div>
    </center>
</body>
</html>
