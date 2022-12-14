<?php
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli -> set_charset('utf8');

session_start();
$postId = $_GET['id'];

$sql = "
SELECT p.id as 'p_id', u.id as 'post_user_id', u.name, p.title, p.contents, p.created_at, p.updated_at
FROM posts AS p
JOIN users AS u
ON p.user_id = u.id
WHERE p.id = $postId
";

$result = $mysqli -> query($sql);
$mysqli -> close();

if (($result -> num_rows) > 0) {
	$row = $result -> fetch_object();
	$title = $row -> title;
	$postUserId = $row -> post_user_id;
	$name = $row -> name;
	$contents = $row -> contents;
	$created_at = $row -> created_at;
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
	</head>
	<body>
		<h1>제목 | <?= $title ?></h1>
		<div>
			<h4>작성자 | <?= $name ?> (<?= $created_at ?>)</h4>
			<p>내용 | <?= $contents ?></p>
			<a href="list.php">목록으로</a>
			<?php
			if ($_SESSION['userId'] == $postUserId) : ?>
				<a href="update.php?postId=<?= $postId ?>">수정하기</a>
			<?php
			endif; ?>
		</div>
		<?php
		require_once "comment.php";
		?>
	</body>
</html>