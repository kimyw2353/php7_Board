<?php
$inputEmail = trim($_POST['input_email']);
$inputPwd = trim($_POST['input_pwd']);

$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli->set_charset('utf8');
$result = $mysqli -> query("SELECT * FROM users WHERE email = '"."$inputEmail"."' AND password = '"."$inputPwd"."'");
$mysqli -> close();

if (($result -> num_rows) > 0) {
	session_start();
	$row = $result -> fetch_object();
	$_SESSION['userId'] = $row -> id;
	$_SESSION['userEmail'] = $row -> email;
	$_SESSION['userName'] = $row -> name;
	header("location:../views/index.php");
} else {
	?>
	<script>
        alert("로그인 실패");
        javascript:history.back();
	</script>
	<?php
}
?>
