<?php
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sellerName = $_POST['sellerName'];
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $quantity * $price;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "transportsystem";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO purchase (sellerName, productName, quantity, price, totalPrice) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdd", $sellerName, $productName, $quantity, $price, $totalPrice);

    if ($stmt->execute()) {
        $message = "Purchase record inserted successfully.";
    } else {
        $message = "Error inserting purchase record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertion Result</title>
</head>
<body>
    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
</body>
</html>