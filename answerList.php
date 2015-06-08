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
session_start();
if(isset($_SESSION["admin"] ) && $_SESSION["admin"] == true) {
	//echo "您已经成功登陆";
}else {
	$_SESSION["admin"] = false;
	die("您无权操作！");
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
			<li class="active"><a href="#">回答</a></li>
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
	<div style="height: 100px;">
		<p>&nbsp;</p>
		<div style="width: 100px; float: left;">&nbsp;</div>
		<div style="font-size: 36px; font-style: inherit; float: left;">问题列表</div>
	</div>
	<center>
		<div style="width: 1000px;">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>问题标题</th>
						<th>提问人</th>
						<th>提问时间<span class="caret"></span></th>
						<th>问题类型<span class="caret"></span></th>
						<th>进行回答</th>
					</tr>
				</thead>
				<tbody>
					<?php
					function prbmSelect($num) {
						$item = null;
						if ($num == 1) {
							$item = "网络";
						} else if ($num == 2) {
							$item = "社团";
						} else if ($num == 3) {
							$item = "食堂";
						} else if ($num == 4) {
							$item = "自习室";
						} else if ($num == 5) {
							$item = "上课";
						}
						return $item;
					}
					
					$query = "SELECT b.id,b.title,b.time_submit,b.t_type,a.name FROM users a,ticket b WHERE  a.userid = b.userid AND t_status = 2 OR t_status = 6";
					$result = mysql_query ( $query );
					$i = 1;
					while ( $row = mysql_fetch_array ( $result ) ) {
						?>
					<tr>
						<td><?php echo $i; $i++;?></td>
						<td ><?php echo $row ['title']?>&nbsp;&nbsp;<a href="answer.php?ticketid=<?php echo $row['id']?>">（详情）</a></td>
						<td><?php echo $row['name']	?></td>
						<td><?php echo $row ['time_submit']?></td>
						<td><?php
						
						$type = prbmSelect ( $row ['t_type'] );
						echo $type;
						?>
						</td>
						<td style="padding-top: 4px;">
							<a href="answer.php?ticketid=<?php echo $row['id']?>"><button type="button" class="btn btn-success  btn-sm">回答</button></a>
						</td>
					</tr>
				<?php
					}
				?>
								
				</tbody>
			</table>
		</div>
	</center>
		<br>
	<br>
	<br><br> <br> <br> <footer class="bs-footer" role="contentinfo">
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
