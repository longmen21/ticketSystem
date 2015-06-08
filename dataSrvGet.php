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
$request = $_GET ['request'];

// include 'action/'.$action.'.php';

// var_dump($_SESSION['userId']);

if ($request == "accept") {
	$ticketid = $_GET ['ticketid'];
	$operate = $_GET ['operate'];
	if ($operate) {
		$query = "UPDATE ticket SET t_status = 2 WHERE id = $ticketid";
	} else {
		$query = "UPDATE ticket SET t_status = 4 WHERE id = $ticketid";
	}
	$result = mysql_query ( $query );
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=acceptList.php\">";
}

if ($request == "answer") {
	var_dump ( $_GET ['operate'] );
	var_dump ( $_GET ['ticketid'] );
	$operate = $_GET ['operate'];
	$ticketid = $_GET ['ticketid'];
	if ($operate) {
		$query = "UPDATE ticket SET t_status = 3 WHERE id = $ticketid";
	} else {
		$query = "UPDATE ticket SET t_status = 4 WHERE id = $ticketid";
	}
	$result = mysql_query ( $query );
	var_dump ( $result );
}

if ($request == "satisfy") {
	$ticketid = $_GET ['ticket'];
	$back = $_GET ['back'];
	if ($back) {
		$query = "UPDATE ticket SET t_status = 5 WHERE id = $ticketid";
	} else {
		$query = "UPDATE ticket SET t_status = 6 WHERE id = $ticketid";
	}
	$result = mysql_query ( $query );
// 	var_dump ( $result );
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=askList.php\">";
	
}

mysql_close ( $con );

?>