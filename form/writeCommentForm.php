<?php
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli -> set_charset('utf8');

session_start();
$userId = $_SESSION['userId'];
$postId = $_POST['post_id'];
$inputComment = trim($_POST['input_comment']);

$sql = "
INSERT INTO comments (user_id, post_id, comment)
VALUES ('".$userId."', '".$postId."', '".$inputComment."')
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
	header("location:../views/post.php?id=".$postId);
}
