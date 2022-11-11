<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
	</head>
	<body>
		<form action="../form/joinForm.php" name="joinF" id="joinF" method="post">
			<h1>회원가입</h1>
			<a href="index.php">홈으로</a><br>
			<input type="text" placeholder="이름" id="name" name="input_name"><br>
			<input type="text" placeholder="이메일" id="email" name="input_email"><br>
			<input type="password" placeholder="비밀번호" id="pwd" name="input_pwd"><br>
			<input type="password" placeholder="비밀번호 확인" id="repwd" name="input_repwd"><br>
			<input type="button" value="회원가입" onclick="joinCheck()">
		</form>
	</body>
</html>
<script>
    function joinCheck(){
        if (!document.joinF.name.value){
            alert("이름을 입력하세요.");
            document.joinF.name.focus();
            return;
        }
        if (!document.joinF.email.value){
            alert("이메일을 입력하세요.");
            document.joinF.email.focus();
            return;
        }
        if (!document.joinF.pwd.value){
            alert("비밀번호를 입력하세요.");
            document.joinF.pwd.focus();
            return;
        }
        if (document.joinF.pwd.value != document.joinF.repwd.value){
            alert("비밀번호를 확인해주세요.");
            document.joinF.repwd.focus();
            return;
        }
        document.joinF.submit();
    }
</script>
