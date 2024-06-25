<!-- header.php -->
 <?php if (!isset($_SESSION)) {
    session_start();
}?>

<body>
    <table id="header" border="0">
        <tr>
            <th style="padding-left: 20px;">
                <a href="admin users list.php">USERS</a>
            </th>
            <th>
                <a href="admin product list.php">PRODUCTS</a>
            </th>
            <th>
                <a href="admin orders.php">ORDERS</a>
            </th>
            <td colspan="2"><img src="design 1.png" style="width: 80px; height: 80px;"></td>
            <th style="padding-left: 60px;">
                <a href="admin dashboard.php">DASHBOARD</a>
            </th>
            <td>
                <a href="admin view account.php">
                    <img src="user.png" style="width: 71px; height: 40px;" class="user">
                </a>
            </td>
        </tr>
    </table>
</body>
</html>
