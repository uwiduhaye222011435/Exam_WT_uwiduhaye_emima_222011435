<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INSURANCE</title>
    <style>
  .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: #f1f1f1;
  }
</style>
<!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body bgcolor="skyblue">
   <ul style="list-style-type: none; padding: 0;">
   
    <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color:  black; text-decoration: none; margin-right: 15px;">Home</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html" style="padding: 10px; color: white; background-color:   black; text-decoration: none; margin-right: 15px;">About</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html" style="padding: 10px; color: white; background-color: black; text-decoration: none; margin-right: 15px;">Contact</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Courses.php" style="padding: 10px; color: white; background-color:   black; text-decoration: none; margin-right: 15px;">Courses</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Students.php" style="padding: 10px; color: white; background-color: black;text-decoration: none; margin-right: 15px;">Students</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Enrollements.php" style="padding: 10px; color: white; background-color:  black; text-decoration: none; margin-right: 15px;">Enrollements</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Instructors.php" style="padding: 10px; color: white; background-color:   black; text-decoration: none; margin-right: 15px;">Instructors</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Payments.php" style="padding: 10px; color: white; background-color:  black;text-decoration: none; margin-right: 15px;">Payments</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Reviews.php" style="padding: 10px; color: white; background-color:   black; text-decoration: none; margin-right: 15px;">Reviews</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Modules.php" style="padding: 10px; color: white; background-color: black;text-decoration: none; margin-right: 15px;">Module</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Tags.php" style="padding: 10px; color: white; background-color:   black; text-decoration: none; margin-right: 15px;">Tags</a></li>
     <li style="display: inline; margin-right: 10px;"><a href="./Messages.php" style="padding: 10px; color: white; background-color:  black; text-decoration: none; margin-right: 15px;">Messages</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./Progress_tracking.php" style="padding: 10px; color: white; background-color:  black; text-decoration: none; margin-right: 15px;">Progress_tracking</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: darkblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
    <h1>Tags Form</h1>
    
<form method="post" onsubmit="return confirmInsert();">

<label for="tags_id">tags_id:</label>
<input type="number" id="t_id" name="t_id" required><br><br>

<label for="tname">tags_name:</label>
<input type="name" id="tname" name="tname" required><br><br>
<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>

<?php
include('connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $tname  = $_POST['tname']; // Corrected: Variable name should be $tname
    
    // Preparing SQL query
    $sql = "INSERT INTO tags (tag_name) 
    VALUES ('$tname')"; // Corrected: Field name should be 'tag_name'

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to tags page on successful insertion
        echo "Data inserted successfully. <a href='tags.php'>View Results</a>"; // Updated success message
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>

<?php
include('connection.php'); // Corrected: 'include' instead of '/include'

// SQL query to fetch data from the tags table
$sql = "SELECT * FROM tags";
$result = $connection->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of tags</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of Tags</h2></center>
    <table border="5">
        <tr>
            <th>TagsId</th>
            <th>Tags Name</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
       <?php
include('connection.php');
// Prepare SQL query to retrieve all tags
$sql = "SELECT * FROM tags";
$result = $connection->query($sql);

// Check if there are any tags
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $t_id = $row['tag_id']; // Corrected: Variable name should be $t_id
        echo "<tr>
            <td>" . $row['tag_id'] . "</td>
            <td>" . $row['tag_name'] . "</td>
            <td><a style='padding:4px' href='delete_tags.php?tag_id=$t_id'>Delete</a></td> 
            <td><a style='padding:4px' href='update_tags.php?tag_id=$t_id'>Update</a></td> 
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>"; // Corrected: colspan should match the number of columns
}
// Close the database connection
$connection->close();
?>

    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Emima UWIDUHAYE</h2></b>
  </center>
</footer>
</body>
</html>