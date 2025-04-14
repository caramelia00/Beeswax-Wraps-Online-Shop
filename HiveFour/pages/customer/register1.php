<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Register</title>
  <script language="javascript">
    function checkEmptyFields()
    {
      var username = document.forms["registerForm"]["username"].value;
        var email = document.forms["registerForm"]["email"].value;
        var password = document.forms["registerForm"]["password"].value;
        var fullName = document.forms["registerForm"]["fullName"].value;
        var phoneNumber = document.forms["registerForm"]["phoneNumber"].value;
        var address1 = document.forms["registerForm"]["address1"].value;
        var address2 = document.forms["registerForm"]["address2"].value;
        var postcode = document.forms["registerForm"]["postcode"].value;
        var city = document.forms["registerForm"]["city"].value;
        var state = document.forms["registerForm"]["state"].value;

        if (username == "") {
            alert("Please enter username!");
            return false;
        } else if (email == "") {
            alert("Please enter email!");
            return false;
        } else if (email.indexOf("@") == -1) {
            alert("Please enter a valid email!");
            return false;
        } else if (password == "") {
            alert("Please enter password!");
            return false;
        } else if (fullName == "") {
            alert("Please enter full name!");
            return false;
        } else if (phoneNumber == "") {
            alert("Please enter phone number!");
            return false;
        } else if (address1 == "") {
            alert("Please enter address1!");
            return false;
        } else if (address2 == "") {
            alert("Please enter address2!");
            return false;
        } else if (postcode == "") {
            alert("Please enter postcode!");
            return false;
        } else if (city == "") {
            alert("Please enter city!");
            return false;
        } else if (state == "") {
            alert("Please enter state!");
            return false;
        } else {
            return true;
        }
    }
    </script>
	<head>
		<style>
      @keyframes pop {
      0% { transform: scale(0.5); opacity: 0; }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); opacity: 1; }
			}
			.pop-up {
				animation: pop 1s;
			}

      body{
        margin:0;
      }
			body{
				background-image: url(loginbg.png);
        background-repeat: no-repeat;
				background-size: cover;
				background-attachment: fixed;
				background-position: bottom;
			}
			#acc{
				margin-left: auto;
				margin-right: auto;
				background-color:#8AB49C;
				border-radius:40px;	
				padding:20px;
				font-size:20px;
			}
			table{
				font-family:calibri, sans-serif;
				color: #E6DAD1;
			}
      #header{
				width:100%;
				background-image: url('header bg pattern.png');
				background-repeat: repeat;
				background-size: contain;
				background-color: #846228;
				padding-left:10px;	
				font-size:30px;	
				color:#E6DAD1;
			}
			a{
				text-align: center;
				color: #E6DAD1;
				text-decoration: none;
			}
			a:hover{
				color: #DE8E04;
			}
			.user:hover {
				opacity: 0.8;
			}

			.user:hover + p {
				display: block;
			}
      .container {
        width: 400px;
        margin: 0 auto;
        border-radius: 20px;
        background-color:#8AB49C;
        color: #9D5A4D;
      }
      label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        border-radius: 30px;
        padding-left: 20px;
        text-align:left;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"],
      input[type="tel"] {
        width: 100%;
        padding: 5px;
        border: 1px solid #C7D8CF;
        background-color: #C7D8CF;
        border-radius: 10px;
        box-sizing: border-box;
        margin-bottom: 10px;
      }

      input[type="submit"] {
        width: 100%;
        padding: 15px;
        background-color: #C7D8CF;
        color: #9D5A4D;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        font-weight: bold;
      }

      input[type="submit"]:hover {
        background-color: white;
      }
		</style>
	</head>
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
			<td colspan=2><img src="design 1.png"  style="width:80px; height:80px; padding-right: 100px;">
			<th style="padding-left:60px;">
				<a href="login.php">
					LOGIN
				</a>
			</th>
			<th>
				<a href="register1.php">
					REGISTER
				</a>
			</th>
		</tr>
	</table>
	<br><br>
  <div class="pop-up">
  <form name="registerForm" action="register.php" method="POST" onsubmit="return checkEmptyFields()">
	<table id=acc border="0">
			<tr>
			  <td style="text-align: center; color: #E6DAD1; padding: 20px;">
          <b style="font-family: 'Times New Roman'; font-size: 30px;">REGISTER</b>
          <table style="width:300px; margin: 0 auto;">
            <tr>
            <td>
              <div class="container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber">
              </div>
            </td>
            <td>
              <div class="container">
                <label for="address1">Address 1:</label>
                <input type="text" id="address1" name="address1">

                <label for="address2">Address 2:</label>
                <input type="text" id="address2" name="address2">

                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode">

                <label for="city">City:</label>
                <input type="text" id="city" name="city">

                <label for="state">State:</label>
                <input type="text" id="state" name="state">
              <div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div style="width: 300px; margin:0 auto;">
                  <input type="submit" name="Submit" value="REGISTER">
              </div>
            </td>
            <td>
            </td>
          </tr>
          </table>
          Already have an account? <a href="login.php">Login</a>
		  </td>
		  </tr>
	</table>
  </form>
  </div>
</html>