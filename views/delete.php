<?php
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli -> set_charset('utf8');

session_start();
if (isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
	$postId = trim($_GET['postId']);
	
	$sql = "
	SELECT *
	FROM posts
	WHERE id = '".$postId."'
	AND user_id = '".$userId."'
	";
	
	$result = $mysqli -> query($sql);
	
	if (($result -> num_rows) > 0) {
		$sql = "
		DELETE FROM posts
        WHERE id = '".$postId."'
		";
		
		$result = $mysqli -> query($sql);
		$mysqli -> close();
		
		if ($result) {
			header("location:list.php");
		} else {
			?>
			<script>
                alert('삭제 실패.');
                javascript:history.back();
			</script>
			<?php
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
