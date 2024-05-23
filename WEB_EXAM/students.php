<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>STUDENTS</title>
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
<body bgcolor=" skyblue">
   <ul style="list-style-type: none; padding: 0;">
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
  <br><br>
  <h2>Students form</h2>
<form method="post" onsubmit="return confirmInsert();">

<label for="sid">Student Id:</label>
<input type="number" id="sid" name="student_id" required><br><br>

<label for="fname">Firstname:</label>
<input type="text" id="fname" name="fname" required><br><br>

<label for="lname">Lastname:</label>
<input type="text" id="lname" name="lname" required><br><br>

<label for="Email">Email:</label>
<input type="eml" id="eml" name="eml" required><br>

<label for="phone">Phonenumber:</label>
<input type="phone" id="phone" name="phone" required><br><br>



<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
<?php
include('connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $fname  = $_POST['fname'];
    $lname  = $_POST['lname'];
    $eml = $_POST['eml'];
    $phone = $_POST['phone'];
   
    
    // Preparing SQL query
    $sql = "INSERT INTO students (first_name,   last_name,email, phone_number) 
    VALUES ('$fname ','$lname','$eml','$phone')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
       // header("Location: login.html");
        echo "data inserted well .<a href='students.php'>RESULT</a>";
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
include('connection.php');


// SQL query to fetch data from the student table
$sql = "SELECT * FROM students";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of patient</title>
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
    <center><h2>Table of student</h2></center>
    <table border="5">
        <tr>
            <th>Student Id</th>
            <th>first_name</th>
            <th>Last_name</th>
            <th>Email</th>
            <th>Phone-number</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
include('connection.php');

// Prepare SQL query to retrieve all students
$sql = "SELECT * FROM students";
$result = $connection->query($sql);

// Check if there are any students
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $sid = $row['student_id']; // Fetch the student_id
        echo "<tr>
            <td>" . $row['student_id'] . "</td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone_number']."</td>
           
           
            <td><a style='padding:4px' href='delete_students.php?student_id=$sid'>Delete</a></td> 
            <td><a style='padding:4px' href='update_students.php?student_id=$sid'>Update</a></td> 
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
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