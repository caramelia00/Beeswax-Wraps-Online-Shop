<?php

session_start();
include '../../config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['search'])) {
    $searchTerm = $_POST['search'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Search query
    $sql = "SELECT * FROM product WHERE Product_Name LIKE ? OR Product_ID LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTermWildcard = '%' . $searchTerm . '%';
    $stmt->bind_param('ss', $searchTermWildcard, $searchTermWildcard);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Product_ID'] . '</td>';
            echo '<td>' . $row['Product_Name'] . '</td>';
            echo '<td>' . $row['Product_Image'] . '</td>';
            echo '<td>' . $row['Product_Status_ID'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    header("Location: search product.php");
    exit();
    }
    else
     {
        echo "No items in cart.";
    }
    $stmt->close();
    $conn->close();
?>
