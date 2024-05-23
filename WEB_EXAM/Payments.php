<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>messages</title>
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
        <h1>payments form </h1>
<form method="post" onsubmit="return confirmInsert();">
    <label for="payment_id">payment_id:</label>
<input type="number" id="payment_id"name="message_id" required><br><br>

<label for="student_id">student_id:</label>
<input type="number" id="student_id"name="student_id" required><br><br>


<label for="amount">amount:</label>
<input type="number" id="amount"name="amount" required><br><br>
<label for="payment_date">payment_date:</label>
<input type="date" id="payment_date"name="payment_date" required><br><br>
<label for="payment_method">payment_method:</label>
<input type="text" id="payment_method"name="payment_method" required><br><br>

<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
<?php
include('connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] =="POST") {
    // Retrieving form data
    $student_id= $_POST['student_id'];
    $amount= $_POST['amount'];
    $payment_date= $_POST['payment_date'];
    $payment_method= $_POST['payment_method'];
   // Preparing SQL query
    $sql = "INSERT INTO payments (student_id,amount,payment_date,payment_method) VALUES ('$student_id','$amount','$payment_date','$payment_method')";
 
   
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
       // header("Location: login.html");
        echo "data inserted well.<a href='Payments.php'>OK</a>";
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
// SQL query to fetch data from the patient table
$sql = "SELECT * FROM payments";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of courses</title>
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
    <center><h2>Table of payments</h2></center>
    <table border="5">
        <tr>
            <th>payment_id </th>
            <th>student_id</th>
            <th>amount</th>
            <th>payment_date</th>
            <th>payment_method</th>
           <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
    include('connection.php');

        // Prepare SQL query to retrieve all  module
        $sql = "SELECT * FROM payments";
        $result = $connection->query($sql);

        // Check if there are any modules
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $payment_id  = $row['payment_id']; // Fetch the  module_id
                echo "<tr>
                    <td>" . $row['payment_id']."</td>
                    <td>" . $row['student_id']."</td>
                     <td>" . $row['amount']."</td>
                     <td>" . $row['payment_date']."</td>
                     <td>" . $row['payment_method']."</td>
            
                    <td><a style='padding:4px' href='delete_payments.php?payment_id=$payment_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_payments.php?payment_id=$payment_id'>Update</a></td> 
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