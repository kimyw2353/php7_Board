<?php
session_start();
$mysqli = new mysqli("localhost", "root", "root", "php_board");
$mysqli -> set_charset('utf8');

//페이징 처리
$category = "";
$keyword = "";
//- 게시물 총 개수 구하기
$totalSql = "SELECT * FROM posts AS p
JOIN users AS u
ON p.user_id = u.id";

if (!empty($_GET['category']) && !empty($_GET['keyword'])) {
	$category = trim($_GET['category']);
	$keyword = trim($_GET['keyword']);
	$totalSql .= " WHERE ".$category." like '%".$keyword."%'";
}
$total = $mysqli -> query($totalSql);

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
if (!$total) {
	//exit();
} else {
	if (($total -> num_rows) > 0) {
		$num_row = $total -> num_rows;
		$list = 10;
		$blockCount = 5;
		
		$blockNum = ceil($page / $blockCount); //한페이지 블록
		$blockStart = (($blockNum - 1) * $blockCount) + 1; //블록 시작
		$blockEnd = $blockStart + $blockCount - 1; //블록 마지막
		
		$totalPage = ceil($num_row / $list); //페이징한 페이지 수
		if ($blockEnd > $totalPage) {
			$blockEnd = $totalPage;
		}
		$totalBlock = ceil($totalPage / $blockCount); //블럭 총 갯수
		$startNum = ($page - 1) * $list;
		
		$sql = "SELECT p.id as 'p_id', u.id as 'u_id', u.name, p.title, p.created_at, p.updated_at
			FROM posts AS p
			JOIN users AS u
			ON p.user_id = u.id";
		
		if (!empty($_GET['category']) && !empty($_GET['keyword'])) {
			$sql .= " WHERE ".$category." like '%".$keyword."%'";
		}
		
		$sql .= " ORDER BY p.id DESC
			LIMIT $startNum, $list";
		
		$result = $mysqli -> query($sql);
		$mysqli -> close();
		
	}
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
		<a href="index.php">홈으로</a><br>
		<div>
			<form action="list.php" method="get">
				<select name="category" id="category">
					<option value="title">제목</option>
					<option value="contents">내용</option>
					<option value="name">작성자</option>
				</select>
				<input type="text" name="keyword" id="keyword"
					value="<?php
					if (!empty($_GET['keyword'])) {
						echo $keyword;
					}
					?>">
				<input type="submit" value="검색">
			</form>
			<a href="list.php">검색필터 지우기</a>
		</div>
		<table border="1">
			<thead>
			<tr>
				<td>글번호</td>
				<td>제목</td>
				<td>작성자</td>
				<td>작성일</td>
				<td>수정일</td>
				<?php
				if (isset($_SESSION['userId'])) :
					?>
					<td></td>
				<?php
				endif;
				?>
			</tr>
			</thead>
			<tbody>
			<?php
			if (isset($result) && $result) {
			while ($row = $result -> fetch_assoc()) {
				$id = $row['p_id'];
				$title = $row['title'];
				$name = $row['name'];
				$postUserID = $row['u_id'];
				$created_at = $row['created_at'];
				$updated_at = $row['updated_at'];
				?>
				<tr>
					<td><?php echo $id ?></td>
					<td>
						<a href="post.php?id=<?= $id ?>"><?php echo $title ?></a>
					</td>
					<td><?php echo $name ?></td>
					<td><?php echo $created_at ?></td>
					<td><?php echo $updated_at ?></td>
					<?php
					if (isset($_SESSION['userId'])) :
						?>
						<td>
							<?php
							if ($_SESSION['userId'] == $postUserID) :
								?>

								<form action="delete.php">
									<input type="button" value="삭제" onclick="deleteConfirm('<?= $id ?>')">
								</form>
							<?php
							endif;
							?>
						</td>
					<?php
					endif;
					?>
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
					echo "<li><a href='?page=1&category=$category&keyword=$keyword'>[ 처음 ]</a></li>";
				}
				if ($page <= 1) {
				} else {
					$pre = $page - 1;
					echo "<li><a href='?page=$pre&category=$category&keyword=$keyword'> [ 이전 ] </a></li>";
				}
				for ($i = $blockStart; $i <= $blockEnd; $i++) {
					if ($page == $i) {
						echo "<li style='color: red'>[ $i ]</li>";
					} else {
						echo "<li><a href='?page=$i&category=$category&keyword=$keyword'>[ $i ]</a></li>";
					}
				}
				if ($blockNum >= $totalBlock) {
				} else {
					$next = $page + 1;
					echo "<li><a href='?page=$next&category=$category&keyword=$keyword'>[ 다음 ]</a></li>";
				}
				if ($page >= $totalPage) {
					//echo "<li style='color: red'>[ 마지막 ]</li>";
				} else {
					echo "<li><a href='?page=$totalPage&category=$category&keyword=$keyword'>[ 마지막 ]</a></li>";
				}
				} else {
					echo "검색 결과 없음";
				}
				?>
			</ul>
		</div>
	</body>
</html>

<script>
    function deleteConfirm(id) {
        let result = confirm(id + '번 글을 삭제하시겠습니까?');
        if (result) {
            location.href = 'delete.php?postId=' + id;
        }
    }
</script>
