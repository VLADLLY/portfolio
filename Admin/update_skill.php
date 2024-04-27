<?php 
include '../includes/connect.php';

// Initialize variables to store existing data
$id = '';
$skill_name = '';
$skill_image = '';
$description = '';

// Check if ID parameter is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];

    // Fetch existing data from the database based on ID
    $sql = "SELECT * FROM skill WHERE id = '$id'";
    $result = $conn->query($sql);

    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign existing data to variables
        $skill_name = $row['skill_name'];
        $skill_image = $row['skill_image'];
        $description = $row['description'];
    } else {
        echo "Record not found.";
        exit();
    }
}

// Check if form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $updated_skill_name = isset($_POST['skill_name']) ? $_POST['skill_name'] : '';
    $updated_description = isset($_POST['description']) ? $_POST['description'] : '';

    // Check if a new image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_destination = '../admin/uploads/' . $image_name;

        // Move uploaded file to destination folder
        if (move_uploaded_file($image_tmp, $image_destination)) {
            $skill_image = $image_name;
        } else {
            echo "Failed to upload image.";
        }
    }

    // Update record in the database
    $sql_update = "UPDATE skill SET skill_name='$updated_skill_name', skill_image='$skill_image', description='$updated_description' WHERE id='$id'";
    if ($conn->query($sql_update) === TRUE) {
        header("location: skill.php");
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
  <title>Update skill Data</title>
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
      <label for="skill_name">Skill Name:</label>
      <input type="text" class="form-control" id="skill_name" name="skill_name" value="<?php echo $skill_name; ?>" required>
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $description; ?></textarea>
    </div>
    <div class="form-group">
      <label for="image">Update Image:</label>
      <input type="file" class="form-control" id="image" name="image">
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
