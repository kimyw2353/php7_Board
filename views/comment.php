링<?php
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli -> set_charset('utf8');

$postId = trim($_GET['id']);

$sql = "
SELECT
	u.id AS post_user_id,
	u.name AS post_user_name,
	p.title,
	p.contents,
	p.id as p_id,
	c.comment,
	c.user_id AS comment_user_id,
	cu.name AS comment_user_name
FROM
	users AS u
JOIN posts AS p
ON
	p.user_id = u.id
JOIN comments AS c
ON
	c.post_id = p.id
JOIN users AS cu
ON
	cu.id = c.user_id
WHERE
	p.id = '".$postId."'
";

$result = $mysqli -> query($sql);
$mysqli -> close();
?>
<hr>
<h3>댓글목록</h3>
<?php
if (($result -> num_rows) > 0) {
	while ($row = $result -> fetch_assoc()) {
		$postUserId = $row['post_user_id'];
		$postUserName = $row['post_user_name'];
		$title = $row['title'];
		$contents = $row['contents'];
		$comment = $row['comment'];
		$commentsUserId = $row['comment_user_id'];
		$commentsUserName = $row['comment_user_name']; ?>

		<ul style="display: flex; list-style: none">
			<li><?= $commentsUserName ?>님의 댓글 --</li>
			<li style="font-style: oblique">"<?= $comment ?>"</li>
		</ul>
		<?php
	}
	?>
	
	<?php
} else {
	echo "댓글 없음";
}
?>
<form action="../form/writeCommentForm.php" name="commentF" method="post">
	<input type="text" placeholder="댓글 입력하기" name="input_comment" id="comment">
	<input type="hidden" value="<?= $postId ?>" name="post_id">
	<input type="button" onclick="commentCheck()" value="댓글 달기">
</form>
<script>
    function commentCheck() {
        if (!document.commentF.comment.value) {
            alert("내용을 입력하세요.");
            document.commentF.comment.focus();
            return;
        }
        document.commentF.submit();
    }
</script>