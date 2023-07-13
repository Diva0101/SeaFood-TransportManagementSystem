<!DOCTYPE html>
<html>
<head>
<style>
body {
    background:url("img26.JPG");
    background-repeat: no-repeat;
    background-size: cover;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 8px;
    border: 1px solid #ccc;
    text-align: left;
}
</style>
</head>
<body>
  <div class="container">
    <h1>Summary</h1>
    <form method="POST" action="">
      <label for="searchName">Search by Name:</label>
      <input type="text" id="searchName" name="searchName">
      <button type="submit" name="searchButton">Search</button>
    </form>

    <?php
    // Establish a database connection
    $conn = mysqli_connect("localhost", "root", "", "transportsystem");

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    // Search functionality
    if (isset($_POST['searchButton'])) {
      $searchName = $_POST['searchName'];

      // Search in the purchase table
      $purchaseQuery = "SELECT * FROM purchase WHERE sellerName LIKE '%$searchName%'";
      $purchaseResult = mysqli_query($conn, $purchaseQuery);

      // Search in the sales table
      $salesQuery = "SELECT * FROM sales WHERE customerName LIKE '%$searchName%'";
      $salesResult = mysqli_query($conn, $salesQuery);

      // Search in the transport table
      $transportQuery = "SELECT * FROM transport WHERE customerName LIKE '%$searchName%'";
      $transportResult = mysqli_query($conn, $transportQuery);

      // Display search results
      if (mysqli_num_rows($purchaseResult) > 0 || mysqli_num_rows($salesResult) > 0 || mysqli_num_rows($transportResult) > 0) {
        echo "<h2>Search Results</h2>";

        if (mysqli_num_rows($purchaseResult) > 0) {
          echo "<h3>Purchase Table</h3>";
          echo "<table>";
          echo "<thead><tr><th>Seller Name</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total Price</th></tr></thead>";
          echo "<tbody>";
          while ($purchaseRow = mysqli_fetch_assoc($purchaseResult)) {
            $totalPrice = $purchaseRow['quantity'] * $purchaseRow['price'];
            echo "<tr>";
            echo "<td>" . $purchaseRow['sellerName'] . "</td>";
            echo "<td>" . $purchaseRow['productName'] . "</td>";
            echo "<td>" . $purchaseRow['quantity'] . "</td>";
            echo "<td>" . $purchaseRow['price'] . "</td>";
            echo "<td>" . $totalPrice . "</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }

        if (mysqli_num_rows($salesResult) > 0) {
          echo "<h3>Sales Table</h3>";
          echo "<table>";
          echo "<thead><tr><th>Customer Name</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total Price</th></tr></thead>";
          echo "<tbody>";
          while ($salesRow = mysqli_fetch_assoc($salesResult)) {
            $totalPrice = $salesRow['quantity'] * $salesRow['price'];
            echo "<tr>";
            echo "<td>" . $salesRow['customerName'] . "</td>";
            echo "<td>" . $salesRow['productName'] . "</td>";
            echo "<td>" . $salesRow['quantity'] . "</td>";
            echo "<td>" . $salesRow['price'] . "</td>";
            echo "<td>" . $totalPrice . "</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }

        if (mysqli_num_rows($transportResult) > 0) {
          echo "<h3>Transport Table</h3>";
          echo "<table>";
          echo "<thead><tr><th>Customer Name</th><th>Location</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total Price</th></tr></thead>";
          echo "<tbody>";
          while ($transportRow = mysqli_fetch_assoc($transportResult)) {
            $totalPrice = $transportRow['quantity'] * $transportRow['price'];
            echo "<tr>";
            echo "<td>" . $transportRow['customerName'] . "</td>";
            echo "<td>" . $transportRow['location'] . "</td>";
            echo "<td>" . $transportRow['productName'] . "</td>";
            echo "<td>" . $transportRow['quantity'] . "</td>";
            echo "<td>" . $transportRow['price'] . "</td>";
            echo "<td>" . $totalPrice . "</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }
      } else {
        echo "<p>No results found.</p>";
      }
    }
    ?>

    <h2>Purchase Summary</h2>
    <table>
      <thead>
        <tr>
          <th>Seller Name</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Retrieve data from the purchase table
        $purchaseResult = mysqli_query($conn, "SELECT * FROM purchase");

        // Loop through the data and generate table rows dynamically
        while ($purchaseRow = mysqli_fetch_assoc($purchaseResult)) {
          $totalPrice = $purchaseRow['quantity'] * $purchaseRow['price'];
          echo "<tr>";
          echo "<td>" . $purchaseRow['sellerName'] . "</td>";
          echo "<td>" . $purchaseRow['productName'] . "</td>";
          echo "<td>" . $purchaseRow['quantity'] . "</td>";
          echo "<td>" . $purchaseRow['price'] . "</td>";
          echo "<td>" . $totalPrice . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <h2>Sales Summary</h2>
    <table>
      <thead>
        <tr>
          <th>Customer Name</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Retrieve data from the sales table
        $salesResult = mysqli_query($conn, "SELECT * FROM sales");

        // Loop through the data and generate table rows dynamically
        while ($salesRow = mysqli_fetch_assoc($salesResult)) {
          $totalPrice = $salesRow['quantity'] * $salesRow['price'];
          echo "<tr>";
          echo "<td>" . $salesRow['customerName'] . "</td>";
          echo "<td>" . $salesRow['productName'] . "</td>";
          echo "<td>" . $salesRow['quantity'] . "</td>";
          echo "<td>" . $salesRow['price'] . "</td>";
          echo "<td>" . $totalPrice . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <h2>Transport Summary</h2>
    <table>
      <thead>
        <tr>
          <th>Customer Name</th>
          <th>Location</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Retrieve data from the transport table
        $transportResult = mysqli_query($conn, "SELECT * FROM transport");

        // Loop through the data and generate table rows dynamically
        while ($transportRow = mysqli_fetch_assoc($transportResult)) {
          $totalPrice = $transportRow['quantity'] * $transportRow['price'];
          echo "<tr>";
          echo "<td>" . $transportRow['customerName'] . "</td>";
          echo "<td>" . $transportRow['location'] . "</td>";
          echo "<td>" . $transportRow['productName'] . "</td>";
          echo "<td>" . $transportRow['quantity'] . "</td>";
          echo "<td>" . $transportRow['price'] . "</td>";
          echo "<td>" . $totalPrice . "</td>";
          echo "</tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>