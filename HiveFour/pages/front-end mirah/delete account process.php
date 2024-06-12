<?php
// Include db connection file 
include '../../config/dbconn.php';

session_start();

// If the delete button is clicked
if (isset($_POST['delete'])) {
    // Capture values from the session
    $userId = $_SESSION['User_ID'];

    // Set User_ID to NULL in ORDERS table
    $sql = "UPDATE orders SET User_ID = NULL WHERE User_ID = $userId";
    $stmt = mysqli_prepare($dbconn, $sql);
    if ($stmt === false) {
        echo "<script>
            alert('Account failed to delete! (Order update)');
            window.location.href = 'admin view account.php';
        </script>";
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Delete from USER_DETAILS table
    $sql = "DELETE FROM user_details WHERE User_ID = $userId";
    $stmt = mysqli_prepare($dbconn, $sql);
    if ($stmt === false) {
        echo "<script>
            alert('Account failed to delete! (User details)');
            window.location.href = 'admin view account.php';
        </script>";
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Delete from USERS table
    $sql = "DELETE FROM users WHERE User_ID = $userId";
    $stmt = mysqli_prepare($dbconn, $sql);
    if ($stmt === false) {
        echo "<script>
            alert('Account failed to delete!');
            window.location.href = 'admin view account.php';
        </script>";
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Display a success message
    echo "<script>
        alert('Account has been deleted successfully.');
        window.location.href = 'login.php';
    </script>";
    exit();
}
?>
