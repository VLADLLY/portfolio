<?php 
include '../includes/connect.php';

// Initialize variables to store existing data
$id = '';
$course = '';
$school = '';
$project_thesis = '';
$school_image = '';

// Check if ID parameter is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];

    // Fetch existing data from the database based on ID
    $sql = "SELECT * FROM resume WHERE id = '$id'";
    $result = $conn->query($sql);

    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign existing data to variables
        $course = $row['Course'];
        $school = $row['School'];
        $project_thesis = $row['Project/Thesis'];
        $school_image = $row['School Image'];
    } else {
        echo "Record not found.";
        exit();
    }
}

// Check if form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $updated_course = isset($_POST['course']) ? $_POST['course'] : '';
    $updated_school = isset($_POST['school']) ? $_POST['school'] : '';
    $updated_project_thesis = isset($_POST['project_thesis']) ? $_POST['project_thesis'] : '';

    // Check if a new school image file is uploaded
    if (isset($_FILES['school_image']) && $_FILES['school_image']['error'] === UPLOAD_ERR_OK) {
        $school_image_name = $_FILES['school_image']['name'];
        $school_image_tmp = $_FILES['school_image']['tmp_name'];
        $school_image_destination = '../admin/uploads/' . $school_image_name;

        // Move uploaded file to destination folder
        if (move_uploaded_file($school_image_tmp, $school_image_destination)) {
            $school_image = $school_image_name;
        } else {
            echo "Failed to upload school image.";
        }
    }

    // Update record in the database
    $sql_update = "UPDATE resume SET Course='$updated_course', School='$updated_school', `Project/Thesis`='$updated_project_thesis', `School Image`='$school_image' WHERE id='$id'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully.";
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
      <label for="course">Course:</label>
      <input type="text" class="form-control" id="course" name="course" value="<?php echo $course; ?>" required>
    </div>
    <div class="form-group">
      <label for="school">School:</label>
      <input type="text" class="form-control" id="school" name="school" value="<?php echo $school; ?>" required>
    </div>
    <div class="form-group">
      <label for="project_thesis">Project/Thesis:</label>
      <input type="text" class="form-control" id="project_thesis" name="project_thesis" value="<?php echo $project_thesis; ?>" required>
    </div>
    <div class="form-group">
      <label for="school_image">Update School Image:</label>
      <input type="file" class="form-control" id="school_image" name="school_image">
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
