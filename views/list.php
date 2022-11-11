<?php
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli -> set_charset('utf8');
$total = $mysqli -> query("SELECT * FROM posts");
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
if (($total -> num_rows) > 0) {
	$num_row = $total -> num_rows;
	$list = 5;
	$blockCount = 3;
	
	$blockNum = ceil($page / $blockCount); //한페이지 블록
	$blockStart = (($blockNum - 1) * $blockCount) + 1; //블록 시작
	$blockEnd = $blockStart + $blockCount - 1; //블록 마지막
	
	$totalPage = ceil($num_row / $list); //페이징한 페이지 수
	if ($blockEnd > $totalPage) {
		$blockEnd = $totalPage;
	}
	$totalBlock = ceil($totalPage / $blockCount); //블럭 총 갯수
	$startNum = ($page - 1) * $list;
	
	$result = $mysqli -> query("
		SELECT p.id as 'p_id', u.id as 'u_id', u.name, p.title, p.created_at, p.updated_at
		FROM posts AS p
		JOIN users AS u
		ON p.user_id = u.id
		ORDER BY p.id DESC
		LIMIT $startNum, $list
");
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
		<h1>글목록</h1>
		<a href="index.php">홈으로</a>
		<table>
			<thead>
			<tr>
				<td>글번호</td>
				<td>제목</a></td>
				<td>작성자</td>
				<td>작성일</td>
				<td>수정일</td>
			</tr>
			</thead>
			<tbody>
			<?php
			while ($posts = $result -> fetch_object()) {
				$id = $posts -> p_id;
				$title = $posts -> title;
				$name = $posts -> name;
				$created_at = $posts -> created_at;
				$updated_at = $posts -> updated_at;
				?>
				<tr>
					<td><?php
						echo $id ?></td>
					<td><a href="post.php?id=<?=$id?>"><?php
							echo $title ?></a></td>
					<td><?php
						echo $name ?></td>
					<td><a href="delete.php?=//주소창으로 삭제 못하게 막아야함"></a></td>
					<td><?php
						echo $created_at ?></td>
					<td><?php
						echo $updated_at ?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<div>
			<ul style="display: flex; list-style: none">
				<?php
				if ($page <= 1) {
					//echo "<li style='color: red'>[ 처음 ]</li>";
				} else {
					echo "<li><a href='?page=1'>[ 처음 ]</a></li>";
				}
				if ($page <= 1) {
				} else {
					$pre = $page - 1;
					echo "<li><a href='?page=$pre'> [ 이전 ] </a></li>";
				}
				for ($i = $blockStart; $i <= $blockEnd; $i++) {
					if ($page == $i) {
						echo "<li style='color: red'>[ $i ]</li>";
					} else {
						echo "<li><a href='?page=$i'>[ $i ]</a></li>";
					}
				}
				if ($blockNum >= $totalBlock) {
				
				} else {
					$next = $page + 1;
					echo "<li><a href='?page=$next'>[ 다음 ]</a></li>";
				}
				if ($page >= $totalPage) {
					//echo "<li style='color: red'>[ 마지막 ]</li>";
				} else {
					echo "<li><a href='?page=$totalPage'>[ 마지막 ]</a></li>";
				}
				?>
			</ul>
		</div>
	</body>
</html>
