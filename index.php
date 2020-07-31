<?php
$db = new mysqli("localhost", "root", "", "testphp");
$testId = 1;
$query = "SELECT * FROM question where FIND_IN_SET(question.id, (select questions from test where test.id = 1))";
$questions = $db->query($query);
$querykq = "SELECT qid,cid, question.point as point from answer, question where qid = question.id and FIND_IN_SET(qid,(select questions from test where test.id = 1))";
$kq = $db->query($querykq);



function tinhdiem($kq, $tl) {
    $diem = 0;
    $total = 0;
    while ($row = $kq->fetch_assoc()) {
        $total += $row["point"];
        $qname = "q".$row["qid"];
        if ($tl[$qname] == $row["cid"]) $diem += $row["point"];
    }
    return $diem . " / " . $total;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <h1>Test Giang - t0001</h1>
        <?php 
        if (isset($_POST["submit"])) {
            echo "Diem so cua ban la: ";
            echo tinhdiem($kq, $_POST);            
        }
        ?>
        <form method="POST" name="testGiang" target="index.php">
        <?php
        while ($row = $questions->fetch_assoc()) {
        ?>
            <div class="card item">
                <div class="card-body">
                    <div class="card-title"><?php echo $row["id"]; ?>: <?php echo $row["text"]; ?></div>
                    <div class="choices">
                        <?php
                        $query = "select * from choice where qid = " . $row["id"];
                        $choices = $db->query($query);
                        while ($rowChoice = $choices->fetch_assoc()) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q<?php echo $row["id"]; ?>" id="q<?php echo $row["id"]; ?>" value="<?php echo $rowChoice["id"]; ?>">
                                <label class="form-check-label" for="q<?php echo $row["id"]; ?>">
                                    <pre><?php echo ($rowChoice["text"]); ?></pre>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <input type="submit" name="submit" value="Gui bai">
        </form>
    </div>
</body>

</html>