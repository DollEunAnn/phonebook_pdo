<?php
session_start();

class Phone
{
    protected $conn;
    

    public function __construct($dbname,$username,$password)
    {
        $this->conn = new PDO("pgsql:dbname=$dbname;host=127.0.0.1", $username, $password);
    }

    public function display($fname,$lname,$no)
    {
        try {
            $queri = $this->conn->query('SELECT first_name,last_name,contact_number FROM contacts');
            $results = [];
            while ($row = $queri->fetch(\PDO::FETCH_ASSOC)) {

                $data[] = [
                    'id' => $row['id'],
                    'fname' => $row['first_name'],
                    'lname' => $row['last_name'],
                    'no' => $row['contact_number'] 
                ];
            }
            return $results;
        } catch (PDOException $a) {
            $_SESSION ['message'] = "Sorry, Contact not saved.";
            echo "Error is: " .$a->getMessage();
        }

    }
    
    public function getContacts(){

        try {

            $queri = $this->conn->query('SELECT * FROM contacts');
            $queri->setFetchMode(PDO::FETCH_ASSOC);
            $results = [];
            while ($row = $queri->fetch(\PDO::FETCH_ASSOC)) {

                $results[] = [
                    'id' => $row['id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'contact_number' => $row['contact_number'] 
                ];
            }
            return $results;
        }
        catch (PDOException $a) {
            echo "Error is: " .$a->getMessage();
        }

    }
    public function add($fname,$lname,$no)
    {
        try {
           
            $queri = $this->conn->prepare("INSERT INTO contacts (first_name,last_name,contact_number) VALUES (:fname,:lname,:no)");
            $queri->bindParam(':fname', $fname, PDO::PARAM_STR);       
            $queri->bindParam(':lname', $lname, PDO::PARAM_STR); 
            $queri->bindParam(':no', $no, PDO::PARAM_STR);
            // $id = $_POST['id'];     
            $queri->execute();

            $_SESSION ['message'] = "Contact saved!";
            echo "Inserted Data!"; //terminal message
           

        }
        catch (PDOException $a)
        {
            $_SESSION ['message'] = "Sorry, Contact not saved.";
            echo "Error is: " .$a->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            
            $queri = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");
            $queri->bindParam(':id', $id, PDO::PARAM_STR);
            $queri->execute();

            $_SESSION ['message'] = "Contact Deleted";
            echo "Data Delete"; //terminal message

        }
        catch (PDOException $a)
        {
            echo "Error: " .$a->getMessage();
        }
    }

    public function update($id,$fname,$lname,$no)
    {
        try {
            
            $queri = $this->conn->prepare("UPDATE contacts SET first_name = :fname, last_name = :lname, contact_number = :no WHERE id = :id ");
            // $queri = $db->prepare("INSERT INTO contacts (first_name,last_name,contact_number) VALUES (:fname,:lname,:no)");
            $queri->bindParam('id', $id, PDO::PARAM_STR);
            $queri->bindParam(':fname', $fname, PDO::PARAM_STR);       
            $queri->bindParam(':lname', $lname, PDO::PARAM_STR); 
            $queri->bindParam(':no', $no, PDO::PARAM_STR);       
            $queri->execute();

            $_SESSION ['message'] = "Contact Update";
            echo "Update Data!"; //terminal message
        }
        catch (PDOException $a)
        {
          echo "Error: " .$a->getMessage();
        }
    }


}
//SAVING DATA
If(isset($_POST['save'])) {

    $conn = new Phone('phonebook','yuniseaen','password');

    $fname = $_POST['first'];
    $lname = $_POST['last'];
    $no = $_POST['connum']; 

    $conn->add($fname,$lname,$no);
     header("location:index-home.php");
}
//DELETING DATA
If(isset($_POST['delete'])) {

    $conn = new Phone('phonebook','yuniseaen','password');

    $id = $_POST['id'];

    $conn->delete($id);
     header("location:index-home.php");
}
//UPDATING DATA
If(isset($_POST['update'])) {

    $conn = new Phone('phonebook','yuniseaen','password');
    $id = $_POST['id'];
    $fname = $_POST['first'];
    $lname = $_POST['last'];
    $no = $_POST['connum']; 

    $conn->add($fname,$lname,$no);
     header("location:index-home.php");
}

// $conn = new Phone('phonebook','yuniseaen','password');
// $info->update('9','Yoongi','Minseok','03121993');
// $info->delete('6');
// $conn->add('Jimin','Park','0120355493');

?>