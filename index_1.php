<?php
	
	// Mang liet ke phan tu theo thu tu
	$items = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, "aaaaaa", 23, 24, 25, 26];
		
	// Bien so trang
	$page = 1; // $page = $_POST["page"]
	if (isset($_POST["page"])) {
		$page = $_POST["page"];
	}
	// so phan tu trong 1 trang
	$itemPerPage = 5;

	// Tong so phan tu mang
	$itemTotal = count($items);
	$phannguyen = $itemTotal / $itemPerPage;
	$phandu = $itemTotal % $itemPerPage;
	$tongsotrang = floor($itemTotal / $itemPerPage);
	if ($itemTotal % $itemPerPage > 0) {
		$tongsotrang++;
	}
	echo "Phan nguyen: ". floor($phannguyen) . "    Phan du:" . $phandu . "<br>";
	echo "Tong so trang: ". $tongsotrang . "<br>";
	// Phan to lon nhat trong trang
	$pageMax = $page * $itemPerPage;
	$pageMin = $pageMax - $itemPerPage + 1;echo $pageMin . "<br>";
	echo $pageMax. "<br>";
	if ($pageMax > $itemTotal) {
		$pageMax = $itemTotal;
	}
	// pageMax = 5
	// Phan tu nho nhat trong trang
	
	
	// #pageMin = ($page - 1) * $aitemPerPage + 1;
	// pageMin = 5 - 5 + 1 = 1
	// Dung vong for de hien thi phan tu trong trang

	echo "Cac gia tri trong trang thu $page la: ";
	if ($page > $tongsotrang || $page < 0) {
		echo "Khong co trang nay, vui long nhap lai";
	} else {
		echo "<br>$pageMin - $pageMax";
		for ($i=$pageMin; $i <= $pageMax; $i++) { 
			$arrayIndex = $i-1;
			echo $items[$arrayIndex] . " - ";

		}	
	}
	$db = new mysqli("localhost", "root", "", "test");
	// $stt = "ASC";
	// $name = "ASC";
	// $inv = "ASC";
	// $price = "ASC";
	$orderby = "id";
	$order = "ASC";
	if (isset($_GET['stt'])) {
		$orderby = "id";
		$order = $_GET['stt'];
	}
	if (isset($_GET['name'])) {
		$orderby = "description";
		$order = $_GET['name'];
	}
	if (isset($_GET['inv'])) {
		$orderby = "inventory";
		$order = $_GET['inv'];
	}
	if (isset($_GET['price'])) {
		$orderby = "price";
		$order = $_GET['price'];
	}
	$query = "Select * from product order by $orderby $order";
	if (isset($_GET['top'])) {
		$query =  $query . " LIMIT " . $_GET['top'];
	
	}
	if (isset($_GET['page']) && isset($_GET['top'])) {
		$offset = ($_GET['page'] - 1) * $_GET['top'];
		$query = $query . " OFFSET " . $offset;
	}
		echo $query;
	$result = $db->query($query);
	// $resultAll = $result->fetch_fields();
	// echo "===============<br>";
	// var_dump($resultAll);
	// echo "===============<br>";
	$count = 0;
	// while($row = $result->fetch_object() ) {
	// 	// var_dump($row);
	// 	// echo "ID:". $row['id'] . "<br>";
		
	// 	if ($count % 3 === 0 ) {
	// 		if ($count === 0) {
	// 			echo "<br>=======day la trang thu: 1========<br>";
	// 		} else {
	// 			echo "<br>=======day la trang thu: $count ========<br>";
	// 		}
	// 	}

	// 	$count++;
	// 	echo "ID:". $row->id . "<br>";
	// }
	$MANG1 = [
		"SP1" => [
			"name" => "name sp1",
			"price" => 10000
		],
		"SP2" => [
			"name" => "name sp2",
			"price" => 20000
		]
	];
var_dump($MANG1["SP1"]);
?>
<form method="POST" action="index_1.php">
	<input type="text" name="page">
	<input type="submit" name="Nhap lieu">
</form>
<table border="1">
	<thead>
		<th>STT (<a href="index_1.php?stt=ASC">^</a> | <a href="index_1.php?stt=DESC">v</a>)</th>
		<th><a href="index_1.php?name=DESC">Name</a></th>
		<th><a href="index_1.php?inv=DESC">Inv</a></th>
		<th><a href="index_1.php?price=DESC">Price</a></th>
	</thead>
	<?php 
		while($row = $result->fetch_object() ) {
	?>
	<tr>
		<td><?php echo $row->id; ?></td>
		<td><?php echo $row->description; ?></td>
		<td><?php echo $row->inventory; ?></td>
		<td><?php echo $row->price; ?></td>
	</tr>
	<?php
		}
	 ?>
</table>
<div>
	<ul>
		<li><a href="index_1.php?top=3&page=1">page 1</a></li>
		<li><a href="index_1.php?top=3&page=2">page 2</a></li>
	</ul>
</div>