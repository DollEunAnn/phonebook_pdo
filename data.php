<?php 
	include 'functions.php';

	if (!isset($_GET['edit'])) {
		$contact['id'] = null;
		$contact['first_name'] = null;
		$contact['last_name'] = null;
		$contact['contact_number'] = null;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>table</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300i,400,500,600" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style-data.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body>
	<div class="container-input">
		<div class="info">
			<h1>Edit<br>Contact</h1>
		</div>	
		<form method="post" action="functions.php" >
			<input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
			<div class="bind">
				<i class="material-icons">account_circle</i><input id="firstname" type="text" name="firstname" placeholder="First Name" value="<?php echo $contact['first_name']; ?>" >
			</div>
				
			<div class="bind">
				<i class="material-icons">account_box</i><input id="lastname" type="text" name="lastname" placeholder="Last Name" value="<?php echo $contact['last_name']; ?>" ><br>
			</div>

			<div class="bind">
				<i class="material-icons">local_phone</i><input id="contactnumber" type="int" name="contactnumber" placeholder="Contact number" value="<?php echo $contact['contact_number']; ?>" ><br>
			</div>

			<?php if (isset($_SESSION['message'])): ?>
			<div class="msg">
				<?php 
					echo $_SESSION['message']; 
					unset($_SESSION['message']);
				?>
			</div>
			<?php endif ?>
				
			<button id="btn-update" type="submit" name="update" >Update</button>
				<!-- <a href="data.php">Display all contacts</a> -->
			</form>
	</div>
	<div class="container-table">
		<div class="thead">
				<span>ID</span>	<span>First Name</span>	<span>Last Name</span><span>Contact Number</span><span>Actions	</span>
		</div>
		<div class="scroll-table">
			<table>
				<thead>
					<!-- empty -->
				</thead>
				<tbody>
					<?php foreach ($contacts as $row) : ?>
                        <tr>
                        	<td><?php echo ($row['id']); ?></td>
                            <td><?php echo ($row['first_name']); ?></td>
                            <td><?php echo ($row['last_name']); ?></td>
                            <td><?php echo ($row['contact_number']); ?></td>
                            <td>
                     
							<a href="data.php?edit=<?php echo $row['id']; ?>">Edit</a>
							<a href="data.php?delete=<?php echo $row['id']; ?>">Delete</a>
							</td>
                        </tr>
                    <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>