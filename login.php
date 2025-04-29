<?php include 'include/classes/session.php';

if ($session->logged_in) {
  header("Location: index.php");
} 

 ?>
<!DOCTYPE html>
<!--www.codingflicks.com--> 
<html lang="en">
	
<head>
	<meta charset="UTF-8">
	
	<style>
		* {
	box-sizing: border-box;
}
body {
	font-family: poppins;
	font-size: 55px;
	color: #fff;
}
.form-box {
	background-color: rgba(0, 0, 0, 0.5);
	margin: auto auto;
	padding: 50px;
	border-radius: 20px;
	box-shadow: 0 0 0px ;
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	width: 500px;
	height: 500px;
}
.form-box:before {
	background-image: url("https://wallpaperaccess.com/full/389433.jpg");
	width: 100%;
	height: 100%;
	background-size: cover;
	content: "";
	position: fixed;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	z-index: -1;
	display: block;
	
}
.form-box .header-text {
	font-size: 60px;
	font-weight: 700;
	padding-bottom: 30px;
	text-align: center;
	color: whitesmoke;
}
.form-box input {
	margin: 10px 0px;
	border: none;
	padding: 10px;
	border-radius: 5px;
	width: 100%;
	font-size: 18px;
	font-family: poppins;
	color: black;
}
.form-box input[type=checkbox] {
	display: none;

}
.form-box label {
	position: relative;
	margin-left: 5px;
	margin-right: 10px;
	top: 5px;
	display: inline-block;
	width: 20px;
	height: 20px;
	cursor: pointer;
}
.form-box label:before {
	content: "";
	display: inline-block;
	width: 20px;
	height: 20px;
	border-radius: 5px;
	position: absolute;
	left: 0;
	bottom: 1px;
	background-color: grey;
}
.form-box input[type=checkbox]:checked+label:before {
	content: "\2713";
	font-size: 20px;
	color: grey;
	text-align: center;
	line-height: 20px;
}
.form-box span {
	font-size: 14px;
}
.form-box button {
	background-color: grey;
	color: white;
	border: none;
	border-radius: 25px;
	cursor: pointer;
	width: 50%;
	font-size: 20px;
	padding: 10px;
	margin: 20px 100px;
}
span a {
	color: grey;
}
select{
	margin: 10px 0px;
	border: none;
	padding: 10px;
	border-radius: 5px;
	width: 100%;
	font-size: 18px;
	font-family: poppins;
}
select:hover {

	transform: scale(1.1) !important;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.form-box input:hover{
	transform: scale(1.1) !important;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.form-box button:hover{
	transform: scale(1.1) !important;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

}

	</style>

</head>
<body>
	<div class="form-box">
		<div class="header-text">
			Login Form
		</div>
		<form class="login100-form validate-form" action="process.php" method="POST">
		 <br>
		<select name="user" onchange="show_month_user()" autocomplete="false">
							<?php $database->groupdata("all_usernames","","","","",""); ?>
						</select>
						<?php echo $form->error("user"); ?>
						<input type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="Password"><?php echo $form->error("pass"); ?></span>
						<input type="hidden" name="sublogin" value="0">
						<button >
							Login
						</button>
</form>

	</div>
</body>
</html>