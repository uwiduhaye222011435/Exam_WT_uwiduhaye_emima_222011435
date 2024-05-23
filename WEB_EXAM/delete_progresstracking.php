<?php
include('connection.php');

// Check if     tracking_id is set
if(isset($_REQUEST['tracking_id'])) {
    $tracking_id= $_REQUEST['tracking_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM progresstracking WHERE tracking_id =?");
    $stmt->bind_param("i", $tracking_id );
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
            <input type="hidden" name="review_id " value="<?php echo $tracking_id ; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if ($stmt->execute()) {
      echo "Record deleted successfully.<a href='Progress_tracking.php'>CONFIRM</a"; 
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
    echo "progresstracking is not set.";
}

$connection->close();
?>