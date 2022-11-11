<?php
session_start();
if (isset($_SESSION['userName']) && isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
	$userName = $_SESSION['userName'];
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
		<h1>게시판</h1>
		<?php
		if (isset($userName)) : ?>
			<p><?= $userName ?>님 로그인중</p>
			<p>
				<a href="logout.php">로그아웃</a>
			</p>
			<a href="write.php">글쓰기</a>
		<?php
		else : ?>
			<a href="login.php">로그인 | </a>
			<a href="join.php">회원가입 | </a>
		
		<?php
		endif; ?>
		<a href="list.php">글목록</a>

	</body>
</html>