<?php
include('connection.php');

// Check if enrollment_Id is set
if(isset($_REQUEST['enrollment_id'])) {
    $enrollment_id = $_REQUEST['enrollment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM enrollments WHERE enrollment_id=?");
    $stmt->bind_param("i", $enrollment_id); // Assuming enrollment_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['student_id'];
        $z = $row['course_id'];
        $k = $row['enrollment_date'];
    } else {
        echo "Enrollment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update enrollments</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update enrollments form -->
    <h2><u>Update Form of enrollments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="sid">Student ID:</label>
        <input type="text" name="sid" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="cid">Course ID :</label>
        <input type="text" name="cid" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">

        <br><br>
        <label for="date">Enrollment Date:</label>
        <input type="date" name="enr" value="<?php echo isset($k) ? htmlspecialchars($k) : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $student_id = $_POST['sid'];
    $course_id  = $_POST['cid'];
    $enrollment_date = $_POST['enr'];
    
    // Update the enrollment in the database
    $stmt = $connection->prepare("UPDATE enrollments SET student_id=?, course_id=?, enrollment_date=? WHERE enrollment_id=?");
    $stmt->bind_param("iisi", $student_id, $course_id, $enrollment_date, $enrollment_id);
    $stmt->execute();
    
    // Redirect to enrollments.php
    header('Location:Enrollements.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
