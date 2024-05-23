<?php
include('connection.php');

// Check if Product_Id is set
if(isset($_REQUEST['tag_id'])) {
    $t_id = $_REQUEST['tag_id'];
    
    $stmt = $connection->prepare("SELECT * FROM tags WHERE tag_id=?");
    $stmt->bind_param("s",$t_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['tag_id'];
        $y = $row['tag_name'];
       
    } else {
        echo "tags not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update tags</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of tags</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    

        <label for="tname">tag_name:</label>
        <input type="text" name="tname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $tag_name = $_POST['tname'];
    
    // Update the tags in the database
    $stmt = $connection->prepare("UPDATE tags SET tag_name=? WHERE tag_id=?");
    $stmt->bind_param("ss",$tag_name, $t_id);
    $stmt->execute();
    
    // Redirect to tags.php
    header('Location: tags.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
