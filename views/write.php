<?php
session_start();
$userId = $_SESSION['userId'];
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
		<h1>글 작성하기</h1>
		<form action="../form/writeForm.php" name="writeF" id="writeF" method="post">
			<input type="hidden" value="<?=$userId?>" name="userId">
			<input type="text" placeholder="제목" name="input_title" id="title"><br>
			<textarea placeholder="내용" name="input_contents" id="contents"></textarea><br>
			<input type="button" onclick="writeCheck()" value="저장">
			<input type="button" onclick="location:history.back()" value="뒤로가기">
		</form>
	</body>
</html>
<script>
	function writeCheck(){
        if (!document.writeF.title.value){
            alert("제목을 입력하세요.");
            document.writeF.title.focus();
            return;
        }
        if (!document.writeF.contents.value){
            alert("내용을입력하세요.");
            document.writeF.contents.focus();
            return;
        }
        document.writeF.submit();
	}
</script>