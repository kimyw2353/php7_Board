<?php
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli -> set_charset('utf8');

session_start();
$postId = trim($_POST['post_id']);
$inputTitle = trim($_POST['input_title']);
$inputContents = trim($_POST['input_contents']);

$sql = "
UPDATE posts
SET title = '".$inputTitle."',
contents = '".$inputContents."',
updated_at = DEFAULT
WHERE id = $postId
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
