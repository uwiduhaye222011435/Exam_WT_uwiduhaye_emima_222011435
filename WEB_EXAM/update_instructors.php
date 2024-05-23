<?php
include('connection.php');

// Check if instructor_id is set
if(isset($_REQUEST['instructor_id'])) {
    $instructor_id = $_REQUEST['instructor_id'];
    
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE instructor_id=?");
    $stmt->bind_param("i", $instructor_id); // Assuming instructor_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['first_name'];
        $z = $row['last_name'];
        $k = $row['expertise_area'];
        $w = $row['email'];
    } else {
        echo "Instructor not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update instructors</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update instructors form -->
    <h2><u>Update Form of instructors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="eml">Email:</label>
        <input type="text" name="eml" value="<?php echo isset($w) ? htmlspecialchars($w) : ''; ?>">
        <br><br>
        
        <label for="exp">Expertise Area:</label>
        <input type="text" name="exp" value="<?php echo isset($k) ? htmlspecialchars($k) : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $first_name=$_POST['fname'];
    $last_name =$_POST['lname'];
    $email=$_POST['eml'];
    $expertise_area=$_POST['exp'];
    
    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE instructors SET first_name=?,last_name=?,email=?,expertise_area=? WHERE instructor_id=?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $expertise_area, $instructor_id);
    $stmt->execute();
    
    // Redirect to instructors.php
    header('Location: Instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
