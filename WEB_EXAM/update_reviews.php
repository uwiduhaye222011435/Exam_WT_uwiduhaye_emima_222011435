<?php
include('connection.php');

// Check if review_id  is set
if(isset($_REQUEST['review_id'])) {
    $review_id=$_REQUEST['review_id'];
    
    $stmt = $connection->prepare("SELECT * FROM reviews WHERE review_id =?");
    $stmt->bind_param("i",$review_id ); // Assuming review_id  is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['student_id'];
        $z = $row['course_id'];
        $k = $row['rating'];
        $w = $row['review_text'];
        $t = $row['review_date'];
    } else {
        echo "reviews not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update reviews</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update reviews form -->
    <h2><u>Update Form of reviews</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="student_id">student_id:</label>
        <input type="text" name="student_id"value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="course_id">course_id:</label>
        <input type="text" name="course_id"value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="rating">rating:</label>
        <input type="text" name="rating"value="<?php echo isset($k) ? htmlspecialchars($k) : ''; ?>">
        <br><br>
        
        <label for="review_text">review_text:</label>
        <input type="text" name="review_text"value="<?php echo isset($w) ? htmlspecialchars($w) : ''; ?>">
        <br><br>
        <label for="review_date">review_date:</label>
        <input type="text" name="review_date"value="<?php echo isset($t) ? htmlspecialchars($t) : ''; ?>">
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
    $course_id =$_POST['course_id'];
    $rating=$_POST['rating'];
    $review_text=$_POST['review_text'];
    $review_date=$_POST['review_date'];
    
    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE  reviews SET student_id=?,course_id=?,rating=?,review_text=?,
        $review_date=? WHERE review_id=?");
    $stmt->bind_param("sssssi", $student_id, $course_id, $rating, $review_text, $review_id,$review_date );
    $stmt->execute();
    
    // Redirect to reviews.php
    header('Location:Reviews.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
