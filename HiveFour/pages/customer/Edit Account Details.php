<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>Hive4 Edit Account Details</title>
	<head>
		<style>
			body{
        		margin:0;
      		}
			body{
				background-color:#E6DAD1;
			}
			#acc{
				margin-left: auto;
				margin-right: auto;
				background-color:#8AB49C;
				border-radius:40px;	
				padding-top:40px;
                padding-bottom:40px;
                padding-left: 20px;
                padding-right: 20px;
				font-size:20px;
				width: 70%;
			}
			table{
				font-family:calibri, sans-serif;
				color: #E6DAD1;
			}
            input[type="text"] {
                width: 100%;
                padding: 5px;
                border: 1px solid #C7D8CF;
                background-color: #C7D8CF;
                border-radius: 20px;
                box-sizing: border-box;
                margin-bottom: 5px;
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
			<td colspan=2><img src="design 1.png"  style="width:80px; height:80px; padding-right: 30px;"></td>
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
				<a href="VIEW ACCOUNT DETAILS.php">
					<img src="user.png" style="width:71px; height:40px;" class="user">
				</a>
			</td>
		</tr>
	</table>
		<script>
		  // Function to handle form submission
		  function submitForm() {
			// Get form data
			const fullname = document.getElementById('fullname').value;
			const email = document.getElementById('email').value;
			const pw = document.getElementById('pw').value;
			const ad1 = document.getElementById('ad1').value;
			const ad2 = document.getElementById('ad2').value;
			const pc = document.getElementById('pc').value;
			const city = document.getElementById('city').value;
			const state = document.getElementById('state').value;
			const pn = document.getElementById('pn').value;

			// Create a new FormData object
			const formData = new FormData();
			formData.append('fullname', fullname);
			formData.append('email', email);
			formData.append('pw', pw);
			formData.append('ad1',ad1);
			formData.append('ad2',ad2);
			formData.append('pc',pc);
			formData.append('city',city);
			formData.append('state',state);
			formData.append('pn',pn);

			// Send the form data to the server
			fetch('admin_view_account.php', {
			  method: 'POST',
			  body: formData
			})
			.then(response => {
			  if (response.ok) {
				// Handle success response
				console.log('Form data submitted successfully');
			  } else {
				// Handle error response
				console.log('Error submitting form data');
			  }
			})
			.catch(error => {
			  // Handle network error
			  console.log('Network error:', error);
			});
		  }
		</script>
	<br><br>
	<form id="editForm" action="VIEW ACCOUNT DETAILS.php" method="post">
		<table id=acc border="0">
			<tr>
				<th colspan=3 style="font-size:40px">EDIT ACCOUNT DETAILS</th>
			</tr>
			<tr>
				<td rowspan=3 style="text-align:center"><img src="yawnzzn big.png" style="width:150px;height:150px;"></td>
				<td style="padding:10px;">Full Name</td>
				<td><input type="text" id="fullname" name="fullname"></td>
			</tr>
			<tr>
				<td style="padding:10px;">Email</td>
				<td><input type="text" id="email" name="email"></td>
			</tr>
			<tr>
                <td style="padding:10px;">Password</td>
				<td><input type="text" id="pw" name="pw"></td>
			</tr>
			<tr>
                <td style="text-align:center; font-size:30px">yawnzzn</td>
				<td style="padding:10px;">Confirm Password</td>
				<td><input type="text" id="pw" name="pw"></td>
			</tr>
			<tr>
				<td style="text-align:center">123456</td>
				<td style="padding:10px;">Address 1</td>
				<td><input type="text" id="ad1" name="ad1"></td>
			</tr>
			<tr>
				<td rowspan="5" style="text-align:center;"><input type="image" src="save details.png" alt="Submit"></td>
				<td style="padding:10px;">Address 2</td>
				<td><input type="text" id="ad2" name="ad2"></td>
			</tr>
			<tr>
				<td style="padding:10px;">Postcode</td>
				<td><input type="text" id="pc" name="pc"></td>
			</tr>
			<tr>
				<td style="padding:10px;">City</td>
				<td><input type="text" id="city" name="city"></td>
			</tr>
			<tr>
				<td style="padding:10px;">State</td>
				<td><input type="text" id="state" name="state"></td>
			</tr>
			<tr>
				<td style="padding:10px;">Phone Number</td>
				<td><input type="text" id="pn" name="pn"></td>
			</tr>
		</table>
	</form>
</html>
