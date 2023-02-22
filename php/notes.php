<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// Select
$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

// Insert
$sql = "INSERT INTO MyGuests (firstname, lastname, email)VALUES ('John', 'Doe', 'john@example.com')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Deleted
$sql = "DELETE FROM MyGuests WHERE id=3";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

// Update
$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close Connection
mysqli_close($conn);
?>

<!--for import dataset (Posts) into website https://www.w3schools.com/PHP/php_ajax_database.asp-->

//Notes to files in db
<?php
//insert
$db = new mysqli("localhost", "root", "", "DbName");
$image = file_get_contents($_FILES['images']['tmp_name']);
$query = "INSERT INTO products (image) VALUES(?)";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $image);
$stmt->execute();
//select
$db = new mysqli("localhost", "root", "", "DbName");
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();
echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';