<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>提问界面</title>
<script type="text/javascript" src="js/jquery-2.1.0.min.js">
</script>
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<script type="text/javascript" src="js/bootstrap.min.js">
</script>
</head>
<?php
session_start ();
if (isset ( $_SESSION ['admin'] ) && $_SESSION ['admin'] == true && $_SESSION['role']==1) {
	// echo "您已成功登陆";
} else {
	$_SESSION ['admin'] = false;
	die ( "您无权操作" );
}
?>
<body>
	<nav class="navbar navbar-default" role="navigation"> <!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse"
			data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
			<span class="icon-bar"></span> <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">信息中心</a> <span id="name"
			style="width: 250px; display: block; padding-top: 5px;"><span
			class="glyphicon glyphicon-user"></span>&nbsp;<?php echo  $_SESSION['name'] ;?>,欢迎您登录</span>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">退出登录</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="active"><a href="askList.php">答案界面</a></li>
			<li><a href="#">建议</a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle"
				data-toggle="dropdown">个人消息 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#"> <span class="badge pull-right">42</span>回答
					</a></li>
					<li><a href="#"> <span class="badge pull-right">42</span>提问
					</a></li>
					<li class="divider"></li>
					<li><a href="#">设置 <span class="glyphicon glyphicon-cog"
							style="float: right; padding-right: 20px;"></span></a></li>
				</ul></li>
		</ul>
		<form class="navbar-form navbar-right" role="search"
			action="dataSrvPost.php" method="post">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="请输入问题内容"
					style="float: right; width: 200px;">
			
			</div>
			<input type="hidden" name="action" value="ask" />
			<button type="submit" class="btn btn-default ">
				问题&nbsp;&nbsp;<span class="glyphicon glyphicon-search"></span>
			</button>
			<div style="width: 60px; float: right;"></div>
	
	</div>
	<!-- /.navbar-collapse --> </nav>
	<center>
		<div style="height: 400px; width: 800px;">
			<div style="height: 50px;"></div>
			<div class="form-group">
				<label class="col-sm-2 control-label">问题名称</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputName"
						placeholder="请输入问题内容" style="width: 400px;" name="probName" />
					<p style="text-align: left; padding-left: 120px">（不多于20字）</p>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">问题类型</label>
				<div class="col-sm-10">
					<select class="form-control" name="select">
						<option value="1">网络</option>
						<option value="2">社团</option>
						<option value="3">食堂</option>
						<option value="4">自习室</option>
						<option value="5">上课</option>
					</select>
				</div>
			</div>

			<div class="form-group">
			
				<label class="col-sm-2 control-label">问题详情</label>
				<div class="col-sm-10">
					<div style="height: 30px;"></div>
					<textarea class="form-control" rows="10" cols="18"
						name="procontent"></textarea>
					<p style="text-align: left; padding-left: 150px">（不多于300字）</p>
				</div>
			</div>
			<div style="height: 20px;"></div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary btn-lg">提交</button>
				</div>
			</div>
			</form>
		</div>
	</center>
		<br>
	<br>
	<br>
	<br> <br> <br> <footer class="bs-footer" role="contentinfo">
				<center>
					<div id="footer">
						<div class="container">
							<p class="text-muted">iflab</p>
						</div>
					</div>
				</center>
				</footer>
</body>
</html>
