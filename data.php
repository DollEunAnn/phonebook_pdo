<?php 
	include 'functions.php';

	$phonebook = new Phone('phonebook','yuniseaen','password');
	$contacts = $phonebook->getContacts();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Phonebook</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300i,400,500,600" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="container-data">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Contact Number</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($contacts as $row) : ?>
                        <tr>
                        	<td><?php echo ($row['id']); ?></td>
                            <td><?php echo ($row['first_name']); ?></td>
                            <td><?php echo ($row['last_name']); ?></td>
                            <td><?php echo ($row['contact_number']); ?></td>
                        </tr>
                    <?php endforeach; ?>

				</tbody>
			</table>
		</div>
	</div>
</body>
</html>