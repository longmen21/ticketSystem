<?php
session_start ();
$con = mysql_connect ( "localhost:3306", "root", "123456" );
mysql_set_charset('utf8',$con);
// if (! $con) {
// die ( 'Could not connect:' . mysql_error () );
// } else {
// echo "hello";

// 返回问题类型
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

// 返回问题状态
function prbmStatus($num) {
	$item = null;
	if ($num == 1) {
		$item = "未解决";
	} else if ($num == 2) {
		$item = "已解决";
	} else if ($num == 3) {
		$item = "审核通过";
	} else if ($num == 4) {
		$item = "审核拒绝";
	} else if ($num == 5) {
		$item = "满意";
	}
	return $item;
/**
 * 对于用户：
 * 1、已回答->解决/被拒绝
 * 2、未回答->拒绝
 * ->等待回答
 *
 * 对于受理员
 * 1、通过
 * 2、不通过
 *
 * 对于回答人
 * 1、回答
 * 2、再次回答
 *
 * 未回答 = 不满意 = 已审核
 * 未通过审核
 * 满意
 * 已回答
 *
 * 1.未回答
 * 2.审核通过
 * 3.已回答
 * 4.审核拒绝
 * 5.满意
 * 6.不满意
 */
}
mysql_select_db ( "ticket", $con );

$action = $_POST ['action'];

// include 'action/'.$action.'.php';

// var_dump($_SESSION['userId']);

/*
if ($action == "login") {
	$name = $_POST ['name'];
	$password = $_POST ['pwd'];
	
	$query = "select userid,pwd,roleid,name from users";
	$result = mysql_query ( $query );
	$flag = false;
	
	while ( $row = mysql_fetch_array ( $result ) ) {
		if ($row ['userid'] == $name && $row ['pwd'] == $password) {
			$flag = true;
			$auth = $row ['roleid'];
			$_SESSION ['admin'] = true;
			// var_dump($row['userid']);
			$_SESSION ['userid'] = $row ['userid'];
			$_SESSION ["user"] = $row ['name'];
			break;
		}
	}
	$action = null;
	
	if ($flag) {
		if ($auth == 1) {
			header ( 'Location:askList.php' );
		} else if ($auth == 2) {
			header ( 'Location:acceptList.php' );
		} else if ($auth == 3) {
			header ( 'Location:answerList.php' );
		}
	} else {
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=index.php\">";
	}
}
*/

if ($action == "ask") {
	$proName = trim ( $_POST ['probName'] );
	$select = $_POST ['select'];
	$content = $_POST ['procontent'];
	$num = $_SESSION ['userId'];
	// echo $proName;
	// echo $select;
	// echo $content;
	$query = "INSERT INTO ticket(title,content,t_status,userid,time_submit,t_type) VALUES ('$proName','$content',1,$num,NOW(),$select)";
	echo $query.'<br>';
	//exit();
	$result = mysql_query ( $query );
	if ($result) {
		echo "<script type='text/javascript'>alert('提交问题成功！');</script>";
		// echo $query;
		// echo $_SESSION ['user'];
		// echo $num;
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=askList.php\">";
	} else {
		echo "<script type='text/javascript'>alert('提交问题失败！');</script>";
		// echo $proName;
		// echo $select;
		// echo $content . "<br/>";
		// echo $query;
		// echo $num;
		?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=ask.php"><?php
	}
}

if($action == "answer") {
	$content = $_POST['answers'];
	$id = $_POST['id'];
	//var_dump($content);
	//var_dump($id);
	$query = "SELECT userid FROM ticket WHERE id = $id";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$userid = $row[0];
	
	var_dump($userid);
	
	$query1 = "INSERT INTO discuss(ticketid,content,userid,d_action) VALUES ($id,'$content',$userid,1)";
	$result1 = mysql_query($query1);
	var_dump($query1);
	
	$query2 = "UPDATE ticket SET t_status = 3 WHERE id = $id";
	$result2 = mysql_query($query2);
	var_dump($query2);
	
	//exit();
	if ($result1 && $result2) {
		echo "<script type='text/javascript'>alert('回答问题成功！');</script>";
		// echo $query;
		// echo $_SESSION ['user'];
		// echo $num;
		
	} else {
		echo "<script type='text/javascript'>alert('回答问题失败！');</script>";
		// echo $proName;
		// echo $select;
		// echo $content . "<br/>";
		// echo $query;
		// echo $num;
	}
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=answerList.php\">";
}

mysql_close ( $con );

?>
