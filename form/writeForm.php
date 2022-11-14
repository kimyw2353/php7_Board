<?php
session_start();
$userId = $_POST['userId'];
$inputTitle = trim($_POST['input_title']);
$inputContents = trim($_POST['input_contents']);

$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli->set_charset('utf8');
$result = $mysqli -> query("
INSERT INTO posts (user_id, title, contents)
VALUES ('".$userId."', '".$inputTitle."', '".$inputContents."')");
error_log($result);
if (!$result) {
	?>
	<script>
        alert("등록 실패");
        //javascript:history.back();
	</script>
	<?php
} else {
	header("location:../views/list.php");
}
