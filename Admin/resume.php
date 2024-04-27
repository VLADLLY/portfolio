<?php 
include '../includes/connect.php';

// Check if the form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];
    // Delete record from the database
    $sql_delete = "DELETE FROM resume WHERE id = '$delete_id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo '<script>alert("Record deleted successfully.");</script>';
    } else {
        echo '<script>alert("Error deleting record: ' . $conn->error . '");</script>';
    }
}

// Query to fetch data from the database
$sql = "SELECT `id`, `Course`, `School`, `Project/Thesis`, `School Image` FROM `resume`";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Resume Data</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/admin.php'; ?>
<div class="container">
  <h2>Manage Resume Data</h2>
  <a href="add_resume.php">Add New</a>
  <!-- Table to display stored data -->
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Course</th>
        <th>School</th>
        <th>Project/Thesis</th>
        <th>School Image</th>
        <th>Action</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["Course"] . "</td>";
                echo "<td>" . $row["School"] . "</td>";
                echo "<td>" . $row["Project/Thesis"] . "</td>";
                echo "<td><img src='../admin/uploads/" . $row["School Image"] . "' alt='Logo' style='max-width: 100px;'></td>";
                echo '<td><button class="btn btn-danger" onclick="deleteData(' . $row["id"] . ')">Delete</button></td>';
                echo "<td><a href='update_resume.php?id=".$row["id"]."' class='btn btn-primary'>Update</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  function deleteData(id) {
    if (confirm("Are you sure you want to delete this record?")) {
      // Create a form element
      var form = document.createElement("form");
      form.method = "post";
      form.action = ""; // Leave this blank to post to the same page

      // Create an input element to hold the ID value
      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "delete_id";
      input.value = id;

      // Append the input to the form
      form.appendChild(input);

      // Append the form to the body and submit it
      document.body.appendChild(form);
      form.submit();
    }
  }
</script>
</body>
</html>

<style>
     .container{
    position: relative;
    margin: 0px auto;
    width: 1000px;
    padding: 20px;
    background-color: #ffff;
    color: #fff;
    border: 5px solid #000;
    border-radius: 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    top: 10%;
    font-family: "Roboto", sans-serif;
    left: 440%; 
    background-image: linear-gradient(rgb( 61,40,30 ), #150d01e7);
  }

  .table{
    border: 2px solid #000;
  }
  tbody, td, tfoot, th, thead, tr {
    background-image: linear-gradient(rgb( 61,40,30 ), #150d01e7);
    color: #fff !important;
    border: 2px solid #000;
  }
</style>
