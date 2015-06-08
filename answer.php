<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include 'common.php';?>
		<script type="text/javascript" src="js/jquery-2.1.0.min.js">
</script>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/bootstrap.min.js">
</script>
		<title>老师回答</title>

</head>
<?php
session_start ();
if (isset ( $_SESSION ["admin"] ) && $_SESSION ["admin"] == true) {
	// echo "您已经成功登陆";
} else {
	$_SESSION ["admin"] = false;
	die ( "您无权操作！" );
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
			class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION['user']?>,欢迎您登录</span>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">退出登录</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="active"><a href="answerList.php">问题界面</a></li>
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
		<form class="navbar-form navbar-right" role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="请输入问题内容"
					style="float: right; width: 200px;">
			
			</div>
			<button type="submit" class="btn btn-default ">
				问题&nbsp;&nbsp;<span class="glyphicon glyphicon-search"></span>
			</button>
			<div style="width: 60px; float: right;"></div>
		</form>
	</div>
	<!-- /.navbar-collapse --> </nav>
	<center>
		<div style="width: 750px;">
			<div class="panel-group" id="accordion">
					<?php
					$ticket = $_GET ['ticketid'];
					$query = "SELECT b.title,b.time_submit,b.t_type,b.content,a.name FROM users a,ticket b WHERE b.id = $ticket";
					$result = mysql_query ( $query );
					if ($row = mysql_fetch_array ( $result )) {
						?>
					<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">问题：<?php echo $row['title']?></h4>
					</div>
					<div>

						<label class="col-sm-2 control-label">问题详情</label>
						</br>
						<div style="float: left;">
								&nbsp;&nbsp;<?php echo $row['content']?></div>
					</div>
					</br>
						<?php }?>
							<hr />
					<div class="panel-body" style="text-align: left"></div>
					<form class="form-horizontal" role="form" action="dataSrvPost.php" method="post">
						<label style="float: left; padding-left: 20px;">回答</label>
						<div class="form-group">
							<input type="hidden" name="action" value="answer"/>
							<input type="hidden" name="id" value="<?php echo $ticket; ?>"/>
							<div style="height: 15px;"></div>
							<textarea class="form-control" rows="10" cols="30" name="answers"></textarea>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default btn-lg">提交</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</center>
	<br> <br> <br> <br> <br> <br> <footer class="bs-footer"
								role="contentinfo">
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



