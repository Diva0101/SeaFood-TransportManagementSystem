<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['uname'];
        $password = $_POST['upswd'];
        $servername = "localhost"; 
        $username_db = "root";
        $password_db = ""; 
        $database = "transportsystem"; 

        $conn = new mysqli($servername, $username_db, $password_db, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE uname = ? AND upswd = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            header("Location: home.html");
            exit();
        } else {
            echo '<div class="center"><h2>Invalid username or password.</h2></div>';
        }

     
        $stmt->close();
        $conn->close();
    }
?>