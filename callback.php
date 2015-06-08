<?php
session_start();

include_once( '/var/www/oauth/config.php' );
include_once( '/var/www/oauth/saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
//$o->debug=true;
if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
		var_dump($e);
	}
}

if ($token) {
	$_SESSION['token'] = $token;
	setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
	$cTmp = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
	$user = $cTmp->userinfo();
	$id = $user[0]['userid'];
	$name = $user[0]['username'];
	$type = $user[0]['idtype'];

	include 'common.php';
	//mysql_query("select );
	var_dump($id);
	var_dump($name);
	var_dump($type);

 	$query = 'select * from users';
     	$result = mysql_query ( $query );
     	$flag = false;
     	while ( $row = mysql_fetch_array ( $result ) ) {
			if($row['userid'] == $id) {
				$_SESSION['name'] = $name;
				$_SESSION['role'] = $row['roleid'];
                                $_SESSION ['admin'] = true;
                               $_SESSION['userid'] = $id;
				$flag = true;
				break;
			}
     	}
var_dump($flag);
     	if($flag) {
     		switch ($_SESSION['role']) {
     			case 1:
	     		header ( 'Location:askList.php' );
     			case 2:
     			header ( 'Location:acceptList.php' );
     			case 3:
     			header('Location:answerList.php');
     		}
     	} else {
     		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=https://222.249.250.89:8443/login.jsp\">";
     	}

} else {
?>
授权失败。
<?php
}
?>

