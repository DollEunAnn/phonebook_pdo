<?php 
// session_start();

class Phone
{
	protected $conn;

	public function __construct($dbname,$username,$password) {
		$this->conn = new PDO("pgsql:dbname=$dbname;host=127.0.0.1", $username, $password);
	}

	public function getContacts(){

		try {

			$query = $this->conn->query('SELECT * FROM contacts ORDER BY id ASC');
			$query->setFetchMode(PDO::FETCH_ASSOC);
			$results = [];
			while ($row = $query ->fetch(\PDO::FETCH_ASSOC)) {

				$results[] = [
                    'id' => $row['id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'contact_number' => $row['contact_number'] 
                ];
			}
			return $results;
		}
		catch(PDOException $e) {
			echo "Error is: " .$e->getMessage();
		}
	}

	public function addContact($fname,$lname,$cnumber)
	{
		try {
           
            $query = $this->conn->prepare("INSERT INTO contacts (first_name,last_name,contact_number) VALUES (:fname,:lname,:cnumber)");
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);       
            $query->bindParam(':lname', $lname, PDO::PARAM_STR); 
            $query->bindParam(':cnumber', $cnumber, PDO::PARAM_STR);    
            $query->execute();

            $_SESSION ['message'] = "Contact saved!";
            echo "Inserted Data!"; //terminal message

        }
        catch (PDOException $e)
        {
            $_SESSION ['message'] = "Sorry, Contact not saved.";
            echo "Error is: " .$e->getMessage();
        }

	}

	public function deleteContact($id)
	{
		try {

			$query = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");
			$query->bindParam(':id',$id,PDO::PARAM_STR);
			// $query->bindParam(':fname', $fname, PDO::PARAM_STR);       
  			//$query->bindParam(':lname', $lname, PDO::PARAM_STR); 
   			//$query->bindParam(':cnumber', $cnumber, PDO::PARAM_STR); 
			$query->execute();

			$_SESSION['message'] = "Contact Deleted";
			echo "Data Deleted";
		}
		catch (PDOException $e)
        {
          echo "Error: " .$e->getMessage();
        }
	}

	public function editContact($id)
	{
		try {

			$query = $this->conn->prepare('SELECT * FROM contacts WHERE id = :id LIMIT 1');
			$query->bindParam(':id', $id);
			$query->execute();

			$contact = [];

			while($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$contact = $row;
			}

			return $contact;
		}
			
		catch(PDOException $e) {
			echo "Error is: " .$e->getMessage();
		}
	}
}

if(isset($_POST['save'])) {

    $conn = new Phone('phonebook','yuniseaen','password');

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $cnumber = $_POST['contactnumber']; 

    $conn->addContact($fname,$lname,$cnumber);
     header("location:index.php");
}

if(isset($_POST['delete'])) {

    $conn = new Phone('phonebook','yuniseaen','password');

    $id = $_POST['id'];


    $conn->deleteContact($id);
     header("location:data.php");
}

if(isset($_POST['update'])) {

    $conn = new Phone('phonebook','yuniseaen','password');
    $id = $_POST['id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $cnumber = $_POST['contactnumber']; 

    $conn->addContact($fname,$lname,$cnumber);
     header("location:data.php");
}

if(isset($_GET['edit'])) {

    $conn = new Phone('phonebook','yuniseaen','password');
    $id = $_GET['edit'];

    $contact = $conn->editContact($id);
}

$conn = new Phone('phonebook','yuniseaen','password');

$contacts = $conn->getContacts();

?>