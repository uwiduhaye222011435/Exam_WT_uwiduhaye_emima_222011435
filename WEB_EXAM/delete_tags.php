<?php
include('connection.php');

// Check if tag_id is set
if(isset($_REQUEST['tag_id'])) {
    $t_id = $_REQUEST['tag_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM tags WHERE tag_id=?");
    $stmt->bind_param("i", $t_id);
    
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
            <input type="hidden" name="tag_id" value="<?php echo $t_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            if ($stmt->execute()) {
                echo "Record deleted successfully. <a href='tags.php'>CONFIRM</a>"; 
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
    echo "tag_id is not set.";
}

$connection->close();
?>
