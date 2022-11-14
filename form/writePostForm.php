<?php
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli->set_charset('utf8');

session_start();
$userId = $_POST['userId'];
$inputTitle = trim($_POST['input_title']);
$inputContents = trim($_POST['input_contents']);

$sql = "
INSERT INTO posts (user_id, title, contents)
VALUES ('".$userId."', '".$inputTitle."', '".$inputContents."')
";

$result = $mysqli -> query($sql);
$mysqli -> close();

if (!$result) {
	?>
	<script>
        alert("등록 실패");
        javascript:history.back();
	</script>
	<?php
} else {
	header("location:../views/list.php");
}
