<?php
include('connection.php');

// Check if message_id is set
if(isset($_REQUEST['message_id'])) {
    $message_id=$_REQUEST['message_id'];
    
    $stmt = $connection->prepare("SELECT * FROM messages WHERE message_id=?");
    $stmt->bind_param("s",$message_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['message_id'];
        $y = $row['message_text'];
        $w = $row['sent_date'];
       
    } else {
        echo "messages not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update messages</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update messages form -->
    <h2><u>Update Form of messages</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    

        <label for="tname">message_text:</label>
        <input type="text" name="tname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="sent">sent_date:</label>
        <input type="text" name="sent" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $message_text = $_POST['tname'];
    $sent_date= $_POST['sent'];
    
    // Update the messages in the database
    $stmt = $connection->prepare("UPDATE messages SET message_text=?, sent_date=? WHERE message_id=?");
    $stmt->bind_param("ssi",$message_text, $sent_date, $message_id);
    $stmt->execute();
    
    // Redirect tomessages.php
    header('Location: Messages.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
