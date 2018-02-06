<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Phonebook</title>
	<link rel="stylesheet" type="text/css" href="style-home.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="container-input">
		<div class="info">
			<h1>Add<br>Contact</h1>
		</div>	
		<form method="post" action="functions.php" >
			<div class="bind">
				<i class="material-icons">account_circle</i><input id="firstname" type="text" name="firstname" placeholder="First Name">
			</div>
				
			<div class="bind">
				<i class="material-icons">account_box</i><input id="lastname" type="text" name="lastname" placeholder="Last Name"><br>
			</div>

			<div class="bind">
				<i class="material-icons">local_phone</i><input id="contactnumber" type="int" name="contactnumber" placeholder="Contact number"><br>
			</div>

			<?php if (isset($_SESSION['message'])): ?>
			<div class="msg">
				<?php 
					echo $_SESSION['message']; 
					unset($_SESSION['message']);
				?>
			</div>
			<?php endif ?>
				
			<button id="btn-save" type="submit" name="save" >Add</button>
				<!-- <a href="data.php">Display all contacts</a> -->
			</form>
		</div>
	</div>
</body>
</html>