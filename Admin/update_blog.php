<?php 
include '../includes/connect.php';

// Initialize variables to store existing data
$id = '';
$project_name = '';
$project_description = '';
$project_image = '';

// Check if ID parameter is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];

    // Fetch existing data from the database based on ID
    $sql = "SELECT * FROM blog WHERE id = '$id'";
    $result = $conn->query($sql);

    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign existing data to variables
        $project_name = $row['project_name'];
        $project_description = $row['project_description'];
        $project_image = $row['project_image'];
    } else {
        echo "Record not found.";
        exit();
    }
}

// Check if form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $updated_project_name = isset($_POST['project_name']) ? $_POST['project_name'] : '';
    $updated_project_description = isset($_POST['project_description']) ? $_POST['project_description'] : '';

    // Check if a new image file is uploaded
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
        $project_image_name = $_FILES['project_image']['name'];
        $project_image_tmp = $_FILES['project_image']['tmp_name'];
        $project_image_destination = '../admin/uploads/' . $project_image_name;

        // Move uploaded file to destination folder
        if (move_uploaded_file($project_image_tmp, $project_image_destination)) {
            $project_image = $project_image_name;
        } else {
            echo "Failed to upload image.";
        }
    }

    // Update record in the database
    $sql_update = "UPDATE blog SET project_name='$updated_project_name', project_description='$updated_project_description', project_image='$project_image' WHERE id='$id'";
    if ($conn->query($sql_update) === TRUE) {
        header("location: blog.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Data</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include '../includes/admin.php'; ?>
<div class="container">
  <h2>Update Data</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
    <!-- Hidden input field to store ID -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label for="project_name">Project Name:</label>
      <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $project_name; ?>" required>
    </div>
    <div class="form-group">
      <label for="project_description">Project Description:</label>
      <input type="text" class="form-control" id="project_description" name="project_description" value="<?php echo $project_description; ?>" required>
    </div>
    <div class="form-group">
      <label for="project_image">Update Image:</label>
      <input type="file" class="form-control" id="project_image" name="project_image">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>

</body>
</html>

<style>
  .container{
    position: relative;
    margin: 0px auto;
    width: 700px;
    padding: 20px;
    background-color: #000;
    color: #fff;
    border: 1px solid #ccc;
    border-radius: 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    top: 10%;
    left: 500%;
  }
</style>
