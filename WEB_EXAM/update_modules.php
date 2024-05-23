<?php
include('connection.php');

// Check if module_id is set
if(isset($_REQUEST['module_id'])) {
    $module_id= $_REQUEST['module_id'];
    
    $stmt = $connection->prepare("SELECT * FROM modules WHERE module_id=?");
    $stmt->bind_param("s", $module_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['module_name'];
        $s = $row['start_date'];
        $e = $row['end_date'];
        $w = $row['course_id'];
        
    } else {
        echo "modules not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update modules</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payment form -->
    <h2><u>Update Form of modules</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="mname">module_name:</label>
        <input type="text" name="mdame" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
       <label for="start">start_date:</label>
        <input type="date" name="start" value="<?php echo isset($s) ? $s : ''; ?>">
        <br><br>
         <label for="end">end_date:</label>
        <input type="date" name="end" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>

        <label for="cid">courses_id:</label>
        <input type="text" name="cid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $module_name= $_POST['mdame'];
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $course_id = $_POST['cid'];
    
    
    // Update the modules in the database
    $stmt = $connection->prepare("UPDATE modules SET module_name=?, start_date=?, end_date=?, course_id=?WHERE course_id=?");
    $stmt->bind_param("ssssi", $module_name, $ $start_date, $end_date, $course_id,  $module_id);
    $stmt->execute();
    
    // Redirect to modules_id.php
    header('Location: Modules.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>