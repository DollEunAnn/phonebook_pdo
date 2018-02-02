<?php include 'functions.php'; ?>


<!DOCTYPE html>
<html>
<head>
	<title>Phonebook</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300i,400,500,600" rel="stylesheet">

</head>
<body>
	<div class="container">
		<div class="container-input">	
			<h1>Phonebook</h1>
			<form method="post" action="functions.php" >

				<input id="first" type="text" name="first" placeholder="First Name"><br>

				<input id="last" type="text" name="last" placeholder="Last Name"><br>

				<input id="nom" type="int" name="connum" placeholder="Contact number"><br>

				<?php if (isset($_SESSION['message'])): ?>
				<div class="msg">
					<?php 
						echo $_SESSION['message']; 
						unset($_SESSION['message']);
					?>
				</div>
				<?php endif ?>
				
				<button id="btn-save" type="submit" name="save" >Add</button> <a href="data.php">Display all contacts</a>

			</form>
		</div>
	</div>
</body>
</html>