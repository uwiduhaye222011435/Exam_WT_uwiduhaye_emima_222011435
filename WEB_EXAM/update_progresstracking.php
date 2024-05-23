<?php
include('connection.php');

// Check if tracking_id   is set
if(isset($_REQUEST['tracking_id'])) {
    $tracking_id=$_REQUEST['tracking_id'];
    
    $stmt = $connection->prepare("SELECT * FROM progresstracking WHERE tracking_id=?");
    $stmt->bind_param("i",$tracking_id  ); // Assuming tracking_id   is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['student_id'];
        $z = $row['module_id'];
        $k = $row['progresss'];
        $w = $row['tracking_date'];
    } else {
        echo "progresstracking not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update progresstracking</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update payments form -->
    <h2><u>Update Form of payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="student_id">student_id:</label>
        <input type="number" name="student_id" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="module_id">module_id:</label>
        <input type="number" name="module_id"value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="progresss">progresss:</label>
        <input type="text" name="progresss" value="<?php echo isset($k) ? htmlspecialchars($k) : ''; ?>">
        <br><br>
        
         <label for="tracking_date">tracking_date:</label>
        <input type="date" name="tracking_date" value="<?php echo isset($w) ? htmlspecialchars($w) : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $student_id=$_POST['student_id'];
    $module_id =$_POST['module_id'];
    $progress=$_POST['progresss'];
    $tracking_date=$_POST['tracking_date'];
    
    // Update the progresstracking in the database
    $stmt = $connection->prepare("UPDATE progresstracking SET student_id=?,module_id=?,progresss=?,tracking_date=? WHERE tracking_id=?");
    $stmt->bind_param("ssssi", $student_id, $module_id, $progress, $tracking_date, $tracking_id  );
    $stmt->execute();
    
    // Redirect to progress_tracking.php
    header('Location:Progress_tracking.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
