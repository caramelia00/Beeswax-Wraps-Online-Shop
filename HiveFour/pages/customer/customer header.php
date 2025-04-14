<!-- header.php -->
<?php if (!isset($_SESSION)) {
    session_start();
}?>

<table id=header  border="0">
    <tr>
        <th style="padding-left: 20px;">
            <a href="HOME.php">
                HOME
            </a>
        </th>
        <th>
            <a href="search product.php">
                PRODUCTS
            </a>
        </th>
        <th>
            <a href="About Us.php">
            ABOUT US
            </a>
        </th>
        <td colspan=2><img src="design 1.png"  style="width:80px; height:80px; padding-right: 170px;">
        </td>
        <td>
            <a href="order.php">
                <img src="order.png" style="width: 50px;height: 50px;" class="user">
            </a>
        </td>
        <td>
            <a href="cart.php">
                <img src="cart.png" style="width: 50px;height: 50px;" class="user">
            </a>
        </td>
        <td>
            <a href="view account details.php">
                <img src="user.png" style="width:71px; height:40px;" class="user">
            </a>
        </td>
    </tr>
</table>