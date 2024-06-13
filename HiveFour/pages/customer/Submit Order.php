<?php
session_start();

include '../../config/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');
    $order_items = $_POST['order_items']; // This should be an array of items with product_name, quantity, and price

    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'your_database_name');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert order
    $sql = "INSERT INTO orders (user_id, order_date, order_time, status) VALUES (?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issd", $user_id, $order_date, $order_time);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Insert order items
        foreach ($order_items as $item) {
            $sql_item = "INSERT INTO order_details (order_id, product_name, quantity, price, size_Id) VALUES (?, ?, ?, ?)";
            $stmt_item = $conn->prepare($sql_item);
            $stmt_item->bind_param("isid", $order_id, $item['product_name'], $item['quantity'], $item['price'], $item['size']);
            $stmt_item->execute();
            $stmt_item->close();
        }

        // Redirect to invoice page
        header("Location: invoice.php?order_id=" . $order_id);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
