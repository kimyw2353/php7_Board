<?php
	session_start();
if (isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
	$postId = trim($_GET['postId']);
	$mysqli = new mysqli("localhost", "root", "root", "php_board");
	$mysqli -> set_charset('utf8');
	$result = $mysqli -> query("SELECT * FROM posts WHERE id = '".$postId."' AND user_id = '".$userId."'");
	if (($result -> num_rows) > 0) {
		$result = $mysqli -> query("DELETE FROM posts WHERE id = '".$postId."'");
		if ($result) {
			header("location:list.php");
		} else {
			echo "삭제 실패";
		}
	} else {
		?>
		<script>
            alert('존재하지 않는 글입니다.');
            javascript:history.back();
		</script>
		<?php
	}
} else {
	?>
	<script>
		alert('권한이 없습니다.');
        javascript:history.back();
	</script>
<?php

}
?>
