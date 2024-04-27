<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage About Me Data</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/admin.php'; ?>
<div class="container">
  <h2>Manage About Me Data</h2>
  <!-- Table to display stored data -->
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Image</th>
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
            $sql_delete = "DELETE FROM `about me` WHERE id = '$delete_id'";
            if ($conn->query($sql_delete) === TRUE) {
                echo '<script>alert("Record deleted successfully.");</script>';
            } else {
                echo '<script>alert("Error deleting record: ' . $conn->error . '");</script>';
            }
        }

        // Query to fetch data from the database
        $sql = "SELECT `id`, `Description`, `Image` FROM `about_me`";
        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td><img src='../admin/uploads/" . $row["Image"] . "' alt='Image' style='max-width: 100px;'></td>";
                echo '<td><button class="btn btn-danger" onclick="deleteData(' . $row["id"] . ')">Delete</button></td>';
                echo "<td><a href='Update_aboutme.php?id=".$row["id"]."' class='btn btn-primary'>Update</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }

        // Close database connection
        $conn->close();
      ?>
    </tbody>
  </table>

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
        form.action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"; // Post to the same page

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
    color: #000;
    border: 5px solid #ccc;
    border-radius: 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    top: 10%;
    left: 500%; 
  }

</style>

