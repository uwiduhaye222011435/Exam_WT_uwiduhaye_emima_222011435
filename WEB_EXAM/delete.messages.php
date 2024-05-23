<?php
include('connection.php');

// Check if message is set
if(isset($_REQUEST['message_id'])) {
    $message_id = $_REQUEST['message_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM messages WHERE message_id=?");
    $stmt->bind_param("i", $message_id);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if ($stmt->execute()) {
      echo "Record deleted successfully.<a href='Messages.php'>CONFIRM</a"; 
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
    ?>
</body>
</html>
<?php
    $stmt->close();
} else {
    echo " message_id is not set.";
}

$connection->close();
?>