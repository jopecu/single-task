<!DOCTYPE HTML>
<html lang="en">
<head><meta charset="UTF-8">
<title>Getting Started With PHP</title>
</head>
<body>
<?php
$a = 4;
$b = 8;

$result = $a + $b; echo "Addition: $result <br/>";
$result = $a - $b; echo "Subtraction: $result <br/>";
$result = $a * $b; echo "Multiplication: $result <br/>";
$result = $a / $b; echo "Division: $result <br/>";
$result = $a % $b; echo "Modulo: $result <br/>";

$a++; echo "Increment: $a <br/>";
$b--; echo "Decrement: $b <br/>";

?>
</body>
</html>