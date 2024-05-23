<?php
include('connection.php');

// Check if reviews is set
if(isset($_REQUEST['review_id'])) {
    $review_id= $_REQUEST['review_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reviews WHERE review_id =?");
    $stmt->bind_param("i", $review_id );
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
            <input type="hidden" name="review_id " value="<?php echo $review_id ; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if ($stmt->execute()) {
      echo "Record deleted successfully.<a href='Reviews.php'>CONFIRM</a"; 
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
    echo "reviews is not set.";
}

$connection->close();
?>