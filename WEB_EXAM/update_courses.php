<?php
include('connection.php');

// Check ifcourse_id  is set
if(isset($_REQUEST['course_id'])) {
    $course_id = $_REQUEST['course_id'];
    
    $stmt = $connection->prepare("SELECT * FROM courses WHERE course_id =?");
    $stmt->bind_param("s", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['course_name'];
        $s = $row['description'];
        $e = $row['instructor_id'];
        $w = $row['start_date'];
        
    } else {
        echo "courses not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update courses</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payment form -->
    <h2><u>Update Form of courses</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="mname">course_name:</label>
        <input type="text" name="course_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
       <label for="start">  description:</label>
        <input type="text" name="description" value="<?php echo isset($s) ? $s : ''; ?>">
        <br><br>
         <label for="end"> instructor_id :</label>
        <input type="number" name="instructor_id" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="start">start_date:</label>
        <input type="date" name="start_date" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $course_name= $_POST['course_name'];
    $description = $_POST['description'];
    $instructor_id = $_POST['instructor_id'];
    $start_date = $_POST['start_date'];
    
    
    // Update the courses in the database
    $stmt = $connection->prepare("UPDATE courses SET course_name=?, description=?,instructor_id=?, start_date=? WHERE course_id =?");
    $stmt->bind_param("ssisi",  $course_name,  $description , $instructor_id, $start_date, $course_id);
    $stmt->execute();
    
    // Redirect to instructor_id.php
    header('Location: courses.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>