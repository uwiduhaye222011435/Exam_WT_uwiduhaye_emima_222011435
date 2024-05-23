<?php
include('connection.php');

// Check if payment_id  is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE payment_id =?");
    $stmt->bind_param("i",$payment_id ); // Assuming payment_id  is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['student_id'];
        $z = $row['amount'];
        $k = $row['payment_date'];
        $w = $row['payment_method'];
    } else {
        echo "payment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update payments</title>
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
        <input type="text" name="student_id" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="amount">amount:</label>
        <input type="text" name="amount"value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="payment_date">payment_date:</label>
        <input type="text" name="payment_date" value="<?php echo isset($k) ? htmlspecialchars($k) : ''; ?>">
        <br><br>
        
        <label for="payment_method">payment_method:</label>
        <input type="text" name="payment_method" value="<?php echo isset($w) ? htmlspecialchars($w) : ''; ?>">
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
    $amount =$_POST['amount'];
    $payment_date=$_POST['payment_date'];
    $payment_method=$_POST['payment_method'];
    
    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE  payments SET student_id=?,amount=?,payment_date=?,payment_method=? WHERE payment_id =?");
    $stmt->bind_param("ssssi", $student_id, $amount, $payment_date, $payment_method, $payment_id );
    $stmt->execute();
    
    // Redirect to payments.php
    header('Location: Payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
