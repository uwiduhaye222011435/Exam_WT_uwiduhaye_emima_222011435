<?php
include('connection.php');

// Check if student_Id is set
if(isset($_REQUEST['student_id'])) {
    $student_id=$_REQUEST['student_id'];
    
    $stmt = $connection->prepare("SELECT * FROM students WHERE student_id=?");
    $stmt->bind_param("i", $student_id); // Assuming student_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['first_name'];
        $z = $row['last_name'];
        $k = $row['email'];
        $w = $row['phone_number'];
    } else {
        echo "students not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update students</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update students form -->
    <h2><u>Update Form of students</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="fname">first_name:</label>
        <input type="text" name="fname" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="lname">last_name:</label>
        <input type="text" name="lname" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="phone">Phone_number:</label>
        <input type="text" name="phone" value="<?php echo isset($k) ? htmlspecialchars($k) : ''; ?>">
        <br><br>

        <label for="eml">Email:</label>
        <input type="text" name="eml" value="<?php echo isset($w) ? htmlspecialchars($w) : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $first_name = $_POST['lname'];
    $last_name = $_POST['lname'];
    $email = $_POST['eml'];
    $phonenumber= $_POST['phone'];
    
    // Update the students in the database
    $stmt = $connection->prepare("UPDATE students SET first_name=?,last_name=?, email=?, phone_number=? WHERE student_id=?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $phonenumber, $student_id);
    $stmt->execute();
    
    // Redirect to students.php
    header('Location: students.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
