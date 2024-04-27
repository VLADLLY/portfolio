<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Landing Data</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/admin.php'; ?>
<div class="container">
  <h2>Manage Blog Data</h2>
    <a href="add_blog.php">Add New</a>
  <!-- Table to display stored data -->
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Project Name</th>
        <th>Project Description</th>
        <th>Project Image</th>
        <th>Action</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Include database connection
        include '../includes/connect.php';

        // Check if the form is submitted for deletion
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
            $delete_id = $_POST["delete_id"];
            // Delete record from database
            $sql_delete = "DELETE FROM blog WHERE id = '$delete_id'";
            if ($conn->query($sql_delete) === TRUE) {
                echo '<script>alert("Record deleted successfully.");</script>';
            } else {
                echo '<script>alert("Error deleting record: ' . $conn->error . '");</script>';
            }
        }

        // Query to fetch data from the database
        $sql = "SELECT `id`, `project_name`, `project_description`, `project_image` FROM `blog`";
        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["project_name"] . "</td>";
                echo "<td>" . $row["project_description"] . "</td>";
                echo "<td><img src='../admin/uploads/" . $row["project_image"] . "' alt='Project Image' style='max-width: 100px;'></td>";
                echo '<td><button class="btn btn-danger" onclick="deleteData(' . $row["id"] . ')">Delete</button></td>';
                echo "<td><a href='update_blog.php?id=".$row["id"]."' class='btn btn-primary'>Update</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }

        // Close database connection
        $conn->close();
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
