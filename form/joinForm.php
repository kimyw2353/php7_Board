<?php
$inputName = trim($_POST['input_name']);
$inputEmail = trim($_POST['input_email']);
$inputPwd = trim($_POST['input_pwd']);

$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli->set_charset('utf8');
$checkEmail = $mysqli -> query("SELECT * FROM users WHERE email = '".$inputEmail."'");
if (($checkEmail -> num_rows) > 0) {
	$mysqli -> close();
	?>
	<script>
        alert("이미 가입된 이메일입니다.");
        javascript:history.back();
	</script>
	<?php
} else {
	
	$result = $mysqli -> query("INSERT INTO php_board.users VALUES (DEFAULT, '".$inputEmail."', '".$inputName."', '".$inputPwd."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
	echo $mysqli -> error;
	
	if (!$result) {
		?>
		<script>
            alert("회원가입 실패");
            javascript:history.back();
		</script>
		<?php
	} else {
		?>
		<script>
            alert("회원가입 성공");
		</script>
		<?php
		header("location:../views/login.php");
	}
}
?>
