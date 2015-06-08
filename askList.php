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
		<title>学生登录界面</title>

</head>
<?php
session_start ();
if (isset ( $_SESSION ["admin"] ) && $_SESSION ["admin"] == true && ($_SESSION['role'] == 1)) {
	// echo "您已经成功登陆";
} else {
	$_SESSION ["admin"] = false;
	die ( "您无权操作！" );
}
$num = $_SESSION ['userid'];
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
			class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION['name']?>,欢迎您登录</span>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">退出登录</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="active"><a href="ask.php">提问界面</a></li>
			<li><a href="#">建议</a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle"
				data-toggle="dropdown">个人消息 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#"> <span class="badge pull-right">
					<?php 
						$query = "SELECT COUNT(*) FROM ticket WHERE t_status = 3 AND userid = $num ";
						$result = mysql_query($query);
						$row = mysql_fetch_array ( $result );
						echo $row[0];
					?></span>已回答</a>
					</li>
					<li><a href="#"> <span class="badge pull-right"><?php 
						
					?></span>已提问
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
		<div style="font-size: 36px; font-style: inherit; float: left;">提问列表</div>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="ask.php"><button type="button"
				class="btn btn-warning btn-lg">去提问</button></a>
	</div>
	<center>
		<div style="width: 1000px;">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>问题标题</th>
						<th>提问时间<span class="caret"></span></th>
						<th>问题类型<span class="caret"></span></th>
						<th>答案情况</th>
						<th>满意</th>
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
				
			
				
				$query = "select id,title,content,time_submit,t_type,t_status from ticket where userid = $num order by t_status asc";
				$result = mysql_query ( $query );
				$i = 1;
				while ( $row = mysql_fetch_array ( $result ) ) {
					?>
					<tr>
						<td><?php echo $i; $i++;?></td>
						<td><?php echo $row ['title']?>&nbsp;<a href="question.php?ticketid=
								<?php 
								if($row ['t_status'] == 3 || $row['t_status'] == 5) {
									echo $row['id'] ."&ok=1";
								} else {
									echo $row['id'] . "&ok=0";
								}
								?>
								">（详情）</a></td>
						<td><?php echo $row ['time_submit']?></td>
						<td><?php
					
					$type = prbmSelect ( $row ['t_type'] );
					echo $type;
					?>
						</td>
						<td style="padding-top: 4px;">
						<?php
					if ($row ['t_status'] <= 2) {
						echo "未回答";
					} else if ($row ['t_status'] == 3) {
						echo "已回答";
					} else if ($row ['t_status'] == 4) {
						echo "系统拒绝";
					} else if ($row ['t_status'] == 5) {
						echo "满意回答";
					} else if ($row ['t_status'] == 6) {
						echo "等待重新回答";
						}
					?>
						</td>
						<td style="padding-top: 5px;">
					<?php 
						if($row['t_status'] == 3) 
					{
						?>
						<a href="dataSrvGet.php?request=satisfy&ticket=<?php echo $row['id']?>&back=1"><button type="button" class="btn btn-success  btn-sm">已解决</button></a>
						<a href="dataSrvGet.php?request=satisfy&ticket=<?php echo $row['id']?>&back=0"><button type="button" class="btn btn-danger  btn-sm">未解决</button></a>
					<?php
					} else {
						echo  '&nbsp;&nbsp;&nbsp;'.'-';
					}
					?>
						</td>
					</tr>
				<?php
				}
				mysql_close ( $con );
				?>
				</tbody>
			</table>
		</div>
	</center>
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
