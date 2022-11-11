<?php
session_start();
$userId = $_SESSION['userId'];
$postId = $_GET['postId'];

$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli->set_charset('utf8');
$result = $mysqli->query("
SELECT title, contents
FROM posts
WHERE id = $postId");
$mysqli->close();
if (($result -> num_rows) > 0){
	$row = $result -> fetch_object();
	$title = $row -> title;
	$contents = $row -> contents;
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
		<h1>글 수정하기</h1>
		<form action="../form/updateForm.php" name="updateF" id="updateF" method="post">
			<input type="hidden" value="<?=$postId?>" name="post_id">
			<input type="text" placeholder="제목" name="input_title" id="title" value="<?=$title?>"><br>
			<textarea placeholder="내용" name="input_contents" id="contents"><?=$contents?></textarea><br>
			<input type="button" onclick="updateCheck()" value="수정">
			<input type="button" onclick="location:history.back()" value="뒤로가기">
		</form>
	</body>
</html>
<script>
    function updateCheck(){
        if (!document.updateF.title.value){
            alert("제목을 입력하세요.");
            document.updateF.title.focus();
            return;
        }
        if (!document.updateF.contents.value){
            alert("내용을입력하세요.");
            document.updateF.contents.focus();
            return;
        }
        document.updateF.submit();
    }
</script>