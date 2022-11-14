<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
	</head>
	<body>
		<form action="../form/loginForm.php" name="loginF" id="loginF" method="POST">
			<h1>로그인</h1>
			<a href="index.php">홈으로</a><br>
			<input type="text" placeholder="이메일" name="input_email" id="email"><br>
			<input type="password" placeholder="비밀번호" name="input_pwd" id="pwd"><br>
			<input type="button" value="로그인" onclick="loginCheck()">
		</form>
	</body>
</html>
<script>
    function loginCheck() {
        if (!document.loginF.email.value) {
            alert("이메일을 입력하세요.");
            document.loginF.email.focus();
            return;
        }
        if (!document.loginF.pwd.value) {
            alert("비밀번호를 입력하세요.");
            document.loginF.pwd.focus();
            return;
        }
        document.loginF.submit();
    }
</script>