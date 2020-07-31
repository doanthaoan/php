<?php
	echo "day la file php";
	$nhanvien = ["giang", "an", "hoa", "bin"];
	$lt = ["giang" => 200000, "an" => 300000, "hoa" => 400000, "bin" => 500000000];
	$lt2 = ["giang" => 400000, "an" => 600000, "hoa" => "800000", "bin" => 10000000];
	$thue = 0.05;
	var_dump($lt2);
	for ($i = 0; $i < 3; $i++) {
		echo "<h1>Luong thang thang thu $i </h1>";
		echo "Luong thang 1:". $lt[$i] . "<br>";
		echo "Luong thang 2: $lt2[$i] <br>";
		echo "Luong tong = ";	
		echo ($lt[$i] + $lt2[$i]);
	}

"<p>aaaaaaaaaaaaaaaaaaaaa<p/>"
	
?>
<?php
// hien thi luong
	for ($j = 0; $j < count($nhanvien); $j++) {
		$luongthang1 = $lt[$nhanvien[$j]];
		$luongthang2 = $lt2[$nhanvien[$j]];
		$luongtong = $lt[$nhanvien[$j]] + $lt2[$nhanvien[$j]];
?>
<h1>Luong thang thu <?php echo $j; ?> cua <?php echo $nhanvien[$j]; ?></h1>
	Luong thang 1: <?php echo $luongthang1; ?>
	Luong thang 2: <?php echo $luongthang2; ?>
	Luong tong = <?php echo $luongtong ?>
<?php
	}
?>	